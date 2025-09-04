<?php
    $Clave = $_GET["clave"];
    
    require "../../Recursos/Informacion.php";
    $db = ConectarDB();

    require "../../Recursos/Partes/Bloqueo.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../Acceso.php');
    }

    //=====================================================================//
    //  Consulta a la tabla buscando la informacion que contiene la clave  //
    //=====================================================================//
    $Busqueda = "SELECT * FROM reportes_colonias WHERE clave = '{$Clave}'";
    $Ejecuta = mysqli_query($db, $Busqueda);
    $Resultado = mysqli_fetch_assoc($Ejecuta);
    switch($Resultado["tipo_reporte"]){
        case 1:
            $Reporte="Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales";
        break;
        case 2:
            $Reporte="Alumbrado público";
        break;
        case 3:
            $Reporte="Limpia, recolección, traslado, tratamiento y disposición final de residuos";
        break;
        case 4:
            $Reporte="Mercados y centrales de abasto";
        break;
        case 5:
            $Reporte="Panteones";
        break;
        case 6:
            $Reporte="Rastro";
        break;
        case 7:
            $Reporte="Calles, parques y jardines y su equipamiento";
        break;
        case 8:
            $Reporte="Seguridad pública, policía preventiva municipal y tránsito";
        break;
    }

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

        $SubirSolucion = "INSERT INTO reportes_resueltos (clave, resuelto, foto, costo,descripcion , fecha_resuelto) VALUES ('$Val1','$Val2','$NombreImagen','$Val4','$Val5','$Val6')";        
        $Informar = mysqli_query($db,$SubirSolucion);
        if($Informar){
            //===============//
            //  Primer paso  //
            //===============//
            $Primer = "UPDATE reportes_colonias SET resuelto = 'si' WHERE clave = '{$Val1}'";
            $Actualizado = mysqli_query($db, $Primer);
            header("Location: ../Muestra.php");
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
    <link rel="stylesheet" href="Solucion.css">
</head>
<body>
    <header>
        <img src="../../Recursos/Imagenes/Guadalupe.png" alt="Logo" class="logo">
        <div>
            <h1>Atención Ciudadana</h1>
            <h2>Detalles del reporte</h2>
        </div>
    </header>
    <form id="detallesReporteForm" method="POST" action="Solucion.php" enctype="multipart/form-data">
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
                <input type="text" id="colonia" value="<?php echo $Resultado['nombre_colonia']; ?>" readonly>
            </div>
            <div>
                <label> Tipo de reporte realizado:</label>
                <input type="text" id="reporte" value="<?php echo $Reporte ?>" readonly>
            </div>
            <div>
                <label for="Descripcion">Descripción del reporte:</label>
                <textarea name="Descripcion" id="Descripcion" maxlength="400" rows="8" readonly><?php echo $Resultado['descripcion']; ?></textarea>
            </div>
            <div>
                <label>Nombre de la calle:</label>
                <input type="text" id="colonia" value="<?php echo $Resultado['nombre_calle']; ?>" readonly>
            </div>
            <div>
                <label>Link de google maps:</label>
                <a target="_blank" href="<?php echo $Resultado['ubicacion']; ?>">Da clic para ver</a>
            </div>
            <div>
                <label for="imagen">Imagen del reporte:</label>
                <img loading="lazy" src="../../ImagenesReportes/<?php echo $Resultado['imagen']; ?>" alt="Foto">
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
        </fieldset>
        <br>
        <input type="submit" value="Subir reporte">
        <br><br>
        <a href="Muestra.php" class="BOTON BTN__Color_Rojo">Cancelar</a>
        <!-- <button type="button" onclick="validarYGenerarPDF()">Subir reporte</button> -->
        
    </form>

    <script src="Solucion.js"></script>
</body>
</html>