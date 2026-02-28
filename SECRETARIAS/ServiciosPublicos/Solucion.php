<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    $Clave = $_GET["clave"];

    //=====================================================================//
    //  Consulta a la tabla buscando la informacion que contiene la clave  //
    //=====================================================================//
    $Busqueda = "SELECT * FROM reportes_colonias WHERE clave = '{$Clave}';";
    $Ejecuta = mysqli_query($db, $Busqueda);
    $Resultado = mysqli_fetch_assoc($Ejecuta);
    $Reporte = Traductor($Resultado["tipo_reporte"]);
    
    //====================================================//
    //  Aqui subo la informacion del reporte ya resuelto  //
    //====================================================//
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        //================//
        //  Segundo paso  //
        //================//
        $Val1 = mysqli_real_escape_string($db,$_POST["ClaveResuelto"]);
        $Val2 = "si";

        //    AREA PARA LA FOTO    //
        $Val3 = $_FILES["ImagenResuelto"];  //Este es para la foto
        /*Creamos carpeta para guardar las imagenes de los reportes*/
        $CarpetaImagenes="../../ReportesResueltos/";
        if(!is_dir($CarpetaImagenes)){
            mkdir($CarpetaImagenes);
        }
        $NombreImagen = md5(uniqid(rand(), true)) . '.jpg';
        move_uploaded_file($Val3['tmp_name'], $CarpetaImagenes . $NombreImagen);


        $Val4 = mysqli_real_escape_string($db,$_POST["CostoResuelto"]);
        $Val5 = mysqli_real_escape_string($db,$_POST["DescripcionSolucion"]);
        $Val6 = mysqli_real_escape_string($db,$_POST["FechaHoraResuelto"]);
        $Val7 = mysqli_real_escape_string($db, $_POST["NombreCompleto"]);

        $Identificacion1 = mysqli_real_escape_string($db,$_POST["nombre_colonia"]);
        $Identificacion2 = mysqli_real_escape_string($db,$_POST["tipo_reporte"]);

        
        $SubirSolucion = "INSERT INTO reportes_resueltos (clave, nombre_colonia, tipo_reporte, resuelto, foto, costo, descripcion , fecha_resuelto, nombre) VALUES ('$Val1','$Identificacion1','$Identificacion2','$Val2','$NombreImagen','$Val4','$Val5','$Val6','$Val7');";        
        $Informar = mysqli_query($db,$SubirSolucion);

        
        if($Informar){
            //===============//
            //  Primer paso  //
            //===============//
            $Primer = "UPDATE reportes_colonias SET resuelto = 'si' WHERE clave = '{$Val1}'";
            $Actualizado = mysqli_query($db, $Primer);
            echo "<div id='alerta__resuelto'></div>";
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
                <input type="text" id="Clave" value="<?php echo $Resultado['clave']; ?>" readonly>
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

        <fieldset>
            <legend>Contesta los campos:</legend>
            <div>
                <label for="ClaveResuelto">Clave de reporte:</label>
                <input type="text" name="ClaveResuelto" id="ClaveResuelto" value="<?php echo $Resultado['clave']; ?>" required readonly>
            </div>
            <div>
                <label for="ImagenResuelto">Imagen de reporte resuelto:</label>
                <input type="file" name="ImagenResuelto" id="ImagenResuelto" accept="image/*" required>
            </div>
            <div>
                <label for="CostoResuelto">Costo de atención:</label>
                <input type="number" name="CostoResuelto" id="CostoResuelto" step="any" required>
            </div>
            <div>
                <label for="DescripcionSolucion">Descripción de atención al reporte: </label>
                <textarea name="DescripcionSolucion" id="DescripcionSolucion" rows="8" maxlength="200" required></textarea>
            </div>
            <div>
                <label for="FechaHoraResuelto">Fecha y hora de acceso:</label>
                <input type="datetime-local" name="FechaHoraResuelto" id="FechaHoraResuelto" required readonly>
            </div>

            <div>
                <label for="">Dias de retraso:</label>
                <input type="number" class="No_Contestar" value="<?php echo TiempoTotal($Resultado['fecha'],true); ?>" required readonly>
            </div>

            <div>
                <input type="hidden" value="<?php echo $_SESSION['NombreCompleto']; ?>" name="NombreCompleto" required readonly>
            </div>
        </fieldset>
        <br>
        <input type="submit" value="Subir reporte">
        <br><br>
        <a href="SecretariaServiciosPublicos.php" class="BOTON BTN__Color_Rojo">Cancelar</a>
        <!-- <button type="button" onclick="validarYGenerarPDF()">Subir reporte</button> -->
        
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><!--Este sirve para mostrar alertas-->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="../FUNCIONARIOS.js"></script>
    <script src="../../Recursos/JS/General.js"></script>
</body>
</html>