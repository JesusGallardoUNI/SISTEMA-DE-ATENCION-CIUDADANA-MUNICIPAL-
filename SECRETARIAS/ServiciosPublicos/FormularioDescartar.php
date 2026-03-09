<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    $Clave = $_GET["id"];

    //=====================================================================//
    //  Consulta a la tabla buscando la informacion que contiene la clave  //
    //=====================================================================//
    $Busqueda = "SELECT * FROM reportes_colonias WHERE id = '{$Clave}';";
    $Ejecuta = mysqli_query($db, $Busqueda);
    $Resultado = mysqli_fetch_assoc($Ejecuta);
    $Reporte = Traductor($Resultado["tipo_reporte"]);
    
    //====================================================//
    //  Aqui subo la informacion del reporte ya resuelto  //
    //====================================================//
    if($_SERVER["REQUEST_METHOD"] === "POST"){

        //VALORES PARA LA TABLA DE REPORTES_DESCARTADOS
        $VAL0 = $Clave;                                                         //id_reporte
        $VAL1 = mysqli_real_escape_string($db , $_POST["MotivOpcion"] ?? "");   //tipo
        $VAL2 = mysqli_real_escape_string($db , $_POST["Justifica"] ?? "");     //motivo
        $VAL3 = $_SESSION['ID_Empleado'];                                       //encargado
        
        $Query = "INSERT INTO reportes_descartados (id_reporte, tipo, motivo, encargado) VALUES ('$VAL0', '$VAL1', '$VAL2', '$VAL3');";
        $Ejecutar = mysqli_query($db, $Query);
        
        //MODIFICAR LA TABLA DE REPORTES_COLONIAS
        $Localiza = "UPDATE reportes_colonias SET descartado = 'si' WHERE id_encargado = $VAL3 AND id = $VAL0;";
        $Actualizar = mysqli_query($db, $Localiza);
        
        if($Ejecutar && $Actualizar) {
            echo "<div id='alerta'></div>";
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Reporte</title>
    <link rel="stylesheet" href="../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../FUNCIONARIOS.css">

    <!--Importante no borrar, sirve para la api del mapa-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
</head>
<body>
    <?php Banner(true,"../../Recursos/Imagenes/icono.png","Atención Ciudadana","Detalles del reporte"); ?>
    <form method="POST"  enctype="multipart/form-data">
        <fieldset>
            <legend>Datos del reporte:</legend>
            <div>
                <label>Clave de reporte:</label>
                <input type="text" id="Clave" name="Clave1" value="<?php echo $Resultado['clave']; ?>" readonly>
            </div>
            <div>
                <label>Codigo postal:</label>
                <input type="text" id="CodigoPostal" value="<?php echo $Resultado['codigo_postal']; ?>" readonly>
            </div>
            <div>
                <label>Nombre de la Colonia:</label>
                <input type="text" id="nombre_colonia" name="nombre_colonia" value="<?php echo $Resultado['nombre_colonia']; ?>" readonly>
            </div>
            <div>
                <label> Tipo de reporte realizado:</label>
                <input type="text" id="reporte" value="<?php echo $Reporte ?>" readonly>
                <input type="hidden" id="reporte_subir" name="tipo_reporte" value="<?php echo $Resultado['tipo_reporte'] ?>" readonly>
            </div>
            <div>
                <label for="Descripcion">Descripción del reporte:</label>
                <textarea name="Descripcion" id="Descripcion" maxlength="400" rows="8" readonly><?php echo $Resultado['descripcion']; ?></textarea>
            </div>
            <div>
                <label>Nombre de la calle:</label>
                <input type="text" id="Calle_Colonia" value="<?php echo $Resultado['nombre_calle']; ?>" readonly>
            </div>
            <div>
                <label>Lugar del reporte:</label>
                <div id="mi_mapa"></div>
                <input type="hidden" id="coordenadas" name="mi_mapa" value="<?php echo $Resultado['ubicacion']; ?>" readonly required>
            </div>
            <div>
                <label>Imagen del reporte:</label>
                <img loading="lazy" src="../../ImagenesReportes/<?php echo $Resultado['imagen']; ?>" alt="Foto">
            </div>

            <div>
                <label for="">Fecha del reporte:</label>
                <input type="text" value="<?php echo $Resultado['fecha']; ?>" readonly required>
            </div>
        </fieldset>

        <br>
        <h2 class="TextoCentrado ColorFondo">Define el motivo por el cual descartas el reporte</h2>

        <fieldset>
            <div>
                <label for="MotivOpcion">Selecciona la opcion del motivo</label>
                <select name="MotivOpcion" id="MotivOpcion">
                    <option value="Reporte repetido">Reporte repetido</option>
                    <option value="Reporte ya resuelto">Reporte ya resuelto</option>
                    <option value="Reporte falso">Reporte falso</option>
                    <option value="Informacion incorrecta o insuficiente">Informacion incorrecta o insuficiente</option>
                    <option value="No corresponde a mi area">No corresponde a mi area</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div>
                <label for="Justifica">Justifica un motivo valido por el cual deceas descartar este reporte</label>
                <textarea name="Justifica" id="Justifica" rows="4"></textarea>
            </div>
        </fieldset>

        <br>
        <input type="submit" value="Descartar reporte" class="BTN__Color_Rojo">
        <br><br>
        <a href="SecretariaServiciosPublicos.php" class="BOTON BTN__Color_Verde">Regresar</a>
        <!-- <button type="button" onclick="validarYGenerarPDF()">Subir reporte</button> -->
        
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><!--Este sirve para mostrar alertas-->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="../FUNCIONARIOS.js"></script>
    <script src="../../Recursos/JS/General.js"></script>
</body>
</html>