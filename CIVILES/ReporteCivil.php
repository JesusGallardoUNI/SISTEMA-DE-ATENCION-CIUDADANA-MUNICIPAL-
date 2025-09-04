<?php
    require "../Recursos/Informacion.php";
    $db = ConectarDB();
    
    //====================================================//
    //  Agarra los nombres de las colonias y las muestra  //
    //====================================================//
    $Colonias = "SELECT * FROM colonias_guadalupe";
    $ListaColonias = mysqli_query($db,$Colonias);
    //====================================================//


    if($_SERVER["REQUEST_METHOD"] === "POST"){
        //==========================================================//
        //  Guarda los valores para guardarlos en la base de datos  //
        //==========================================================//
        $Campo1 = mysqli_real_escape_string($db, $_POST["estado"] ?? 0);
        $Campo2 = mysqli_real_escape_string($db, $_POST["municipio"] ?? 0);
        $Campo3 = mysqli_real_escape_string($db, $_POST["codigoPostal"] ?? 0);
        $Campo4 = mysqli_real_escape_string($db, $_POST["colonia"] ?? 0);
        $Campo5 = mysqli_real_escape_string($db, $_POST["reporte"] ?? 0);
        $Campo6 = mysqli_real_escape_string($db, $_POST["Descripcion"] ?? 0);
        $Campo7 = mysqli_real_escape_string($db, $_POST["calle"] ?? 0);
        $Campo8 = mysqli_real_escape_string($db, $_POST["mi_mapa"] ?? 0);
        $Campo9 = $_FILES["imagen"];
        $Campo10 = mysqli_real_escape_string($db, $_POST["fechaHora"] ?? 0);


        //============================================================//
        //  Crea el num_pila a través de la cantidad de reportes      //
        //  de la colonia seleccionada                                //
        //============================================================//
        $consultaConteo = "SELECT COUNT(*) AS total FROM reportes_colonias WHERE nombre_colonia = ?";
        $stmt = mysqli_prepare($db, $consultaConteo);
        mysqli_stmt_bind_param($stmt, 's', $Campo4);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $totalReportes);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        $num_pila = $totalReportes++;
        $Campo11 = mysqli_real_escape_string($db,$_POST["Clave"]);
        $Campo11 = $Campo11 . $num_pila . "]";

        //==============================================//
        //   Aqui subir el reporte a la base de datos   //
        //==============================================//
        
        /*Creamos carpeta para guardar las imagenes de los reportes*/
        $CarpetaImagenes="../ImagenesReportes/";
        if(!is_dir($CarpetaImagenes)){
            mkdir($CarpetaImagenes);
        }
        $NombreImagen = md5(uniqid(rand(), true)) . '.jpg';
        move_uploaded_file($Campo9['tmp_name'], $CarpetaImagenes . $NombreImagen);

        $Campo12 = "no";


        $SubirReporte = "INSERT INTO reportes_colonias (estado, municipio, codigo_postal, nombre_colonia, tipo_reporte, descripcion, nombre_calle, ubicacion, imagen, fecha, clave, resuelto) VALUES ('$Campo1','$Campo2','$Campo3','$Campo4','$Campo5','$Campo6','$Campo7','$Campo8','$NombreImagen','$Campo10','$Campo11','$Campo12')";
        $Agregar = mysqli_query($db, $SubirReporte);
        if($Agregar){
            //echo "Insertado correctamente";
            //header("Location: https://guadalupe.gob.mx/");
            //echo '<script>location.reload();</script>';
            echo '<div id="alerta" class="alerta alerta__bueno">Reporte subido correctamente</div>';
            //header("Location: ReporteCivil.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Recursos/Imagenes/icono.png" type="image/png" sizes="174x256">
    <title>Atención Ciudadana</title>  
    <link rel="stylesheet" href="../Recursos/CSS/General.css">
    <link rel="stylesheet" href="CiudadanoEstilo.css">

    <!--Importante no borrar, sirve para la api del mapa-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="../Recursos/JS/General.js"></script>
    <script src="CiudadanoScript.js"></script>
</head>
<body>
    <header>
        <img src="../Recursos/Imagenes/icono.png" alt="Logo" class="logo">
        <div>
            <h1>Atención Ciudadana</h1>
            <h2>Ingrese su reporte</h2>
        </div>
    </header>
    <form method="POST" action="ReporteCivil.php" enctype="multipart/form-data">
        <!-- Nombre del Estado -->
        <div>
            <label for="estado">Nombre del Estado:</label>
            <input type="text" id="estado" name="estado" value="Nuevo León" readonly required>
        </div>
    
        <!-- Nombre del Municipio -->
        <div>
            <label for="municipio">Nombre del Municipio:</label>
            <input type="text" id="municipio" name="municipio" value="Guadalupe" readonly required>
        </div>

        <!-- Código Postal -->
        <div>
            <label for="codigoPostal">Código Postal:</label>
            <input type="number" id="codigoPostal" name="codigoPostal" min="0" maxlength="5" required>
        </div>

        <!-- Nombre de la Colonia -->
        <div>
            <label for="colonia">Nombre de la Colonia:</label>
            <select id="colonia" name="colonia" required>
                <option value="" selected disabled>Seleccione una colonia</option>        
                <?php while($Lista1 = mysqli_fetch_assoc($ListaColonias)):  ?>
                    <option value="<?php echo $Lista1['nombre_colonia'] ?>" title="<?php echo $Lista1['id'] ?>"><?php echo $Lista1['nombre_colonia'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Tipo de reporte -->  
        <!-- Eliminar: 1 5 6; SOLO PONERLOS COMENTADOS -->
        <div>
            <label for="reporte">Reporte que se quiere hacer:</label>
            <select id="reporte" name="reporte" required>
                <option value="" selected disabled>Seleccione un tipo de reporte</option>
                <!-- <option value="1">Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales</option> -->
                <option value="2">Alumbrado público</option>
                <option value="3">Limpia, recolección, traslado, tratamiento y disposición final de residuos</option>
                <option value="4">Mercados y centrales de abasto</option>
                <!-- <option value="5">Panteones</option> -->
                <!-- <option value="6">Rastro</option> -->
                <option value="7">Calles, parques y jardines y su equipamiento</option>
                <option value="8">Seguridad pública, policía preventiva municipal y tránsito</option>
            </select>
        </div>

        <!-- Descripcion de reporte -->
        <div>
            <label for="Descripcion">Descripción del reporte:</label>
            <textarea name="Descripcion" id="Descripcion" maxlength="400" rows="8" required></textarea>
        </div>

        <!-- Nombre de la Calle -->
        <div>
            <label for="calle">Nombre de la Calle:</label>
            <input type="text" id="calle" name="calle" required>
        </div>

        <!-- Mapa -->
        <div>
            <label for="mi_mapa">Ubica el lugar:</label>
            <div id="mi_mapa"></div>
            <input type="hidden" id="coordenadas" name="mi_mapa" readonly required>
        </div>

        <!-- Imagen de referencia -->
        <div>
            <label for="imagen">Imagen de referencia:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png" required>
        </div>

        <!-- Fecha y hora de acceso -->
        <div>
            <label for="fechaHora">Fecha y hora de acceso:</label>
            <input type="datetime-local" id="fechaHora" name="fechaHora" readonly>
        </div>

        <!-- Clave unica de reporte -->
        <div class="Ciego">
            <label for="Clave">Clave del reporte:</label>
            <input type="text" name="Clave" id="Clave" required readonly>
        </div>

        <input type="submit" value="Enviar reporte" onclick="generarPDF()">
    </form>

    <footer>
        <div class="footer_imagenes">
            <img src="../Recursos/Imagenes/UANL.png" alt="UANL" title="UANL">
            <img src="../Recursos/Imagenes/FIME.png" alt="FIME" title="FIME">
            <img src="../Recursos/Imagenes/FACDYC.png" alt="FACDYC" title="FACDYC">
        </div>

        <div class="footer_texto">
            <h3>Proyecto desarrollado por: Jesús Gallardo</h3>
            <h4>Esto no es un sitio oficial por parte del <span>Gobierno municipal de Guadalupe</span></h4>
            <hr>
            <h4><a href="https://guadalupe.gob.mx/noticia/atiende-lupita-de-forma-rapida-reportes-de-guadalupenses">Enlace directo al sitio oficial <span>Da clic aqui</span></a></h4>
        </div>

        <div>
            <h3 class="footer_texto">Sigueme en mis redes sociales:</h3>
            <div class="footer_imagenes">
                <a href="https://www.instagram.com/jesusgallardo4t/" title="Instagram"><img src="../Recursos/SVG/Instagram.svg" class="footer_redes"></a>
                <a href="https://x.com/JrGallardo4T" title="X"><img src="../Recursos/SVG/x.svg" class="footer_redes"></a>
                <a href="https://www.facebook.com/jesus.gallardo.856060" title="Facebook"><img src="../Recursos/SVG/facebook.svg" class="footer_redes"></a>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="CiudadanoScript.js"></script>


</body>
</html>