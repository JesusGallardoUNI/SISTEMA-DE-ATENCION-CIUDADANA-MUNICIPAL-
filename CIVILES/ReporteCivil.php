<?php
    include "../Recursos/Partes/Partes.php";
    $db = ConectarDB();

    //====================================================//
    //  Agarra los nombres de las colonias y las muestra  //
    //====================================================//
    $ListaColonias = Tabla("colonias_guadalupe");
    //====================================================//


    //============================================================//
    //                      Crea clave unica                      //
    //============================================================//
    do {
        $Clave = generarClave(8);
        $Query = "SELECT * FROM reportes_colonias WHERE clave = '$Clave';";
        $existe = mysqli_query($db, $Query);
    } while(mysqli_num_rows($existe) > 0);


    if($_SERVER["REQUEST_METHOD"] === "POST"){
        //==========================================================//
        //  Guarda los valores para guardarlos en la base de datos  //
        //==========================================================//
        $Identificacion1 = mysqli_real_escape_string($db, $_POST["nombre_persona"] ?? "");
        $Identificacion2 = mysqli_real_escape_string($db, $_POST["telefono_persona"] ?? 0);
        $Identificacion3 = mysqli_real_escape_string($db, $_POST["correo_persona"] ?? "");
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
        $Campo11 = mysqli_real_escape_string($db, $_POST["Clave"] ?? 0);


        

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


        $SubirReporte = "INSERT INTO reportes_colonias (nombre_persona, telefono_persona, correo_persona, estado, municipio, codigo_postal, nombre_colonia, tipo_reporte, descripcion, nombre_calle, ubicacion, imagen, fecha, clave, resuelto) VALUES ('$Identificacion1', '$Identificacion2', '$Identificacion3','$Campo1','$Campo2','$Campo3','$Campo4','$Campo5','$Campo6','$Campo7','$Campo8','$NombreImagen','$Campo10','$Campo11','$Campo12')";
        $Agregar = mysqli_query($db, $SubirReporte);
        if ($Agregar) {
            echo "<div id='ReporteCivil'></div>";
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
    <link rel="stylesheet" href="ReporteCivil.css">

    <!--Importante no borrar, sirve para la api del mapa-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
</head>
<body class="Relativo">
    <?php Banner(true,"../Recursos/Imagenes/icono.png","Atención Ciudadana","Ingrese su reporte"); ?>
    
    <div id="fondo">
        <div class="Anuncio Color_Back" id="Anuncio">
            <img src="../Recursos/SVG/Anuncio.svg" alt="">
            <div class="Ciego">
                <h4>¿Realizaste un reporte y quieres saber el seguimiento?</h4>
                <h4>Consulta el estado de tu reporte</h4>
                <p>Ingresa tu clave de reporte para conocer el avance y seguimiento de tu reporte en tiempo real.</p>
                <a href="BuscaReporte.php" class="BOTON ColorOscuro">Consultar mi reporte</a>
            </div>
        </div>
    </div>

    <form method="POST" action="ReporteCivil.php" enctype="multipart/form-data" id="FormularioReporte">

        <fieldset>
            <legend>Datos de identificacion</legend>

            <!-- Nombre del ciudadano que lo reporta -->
            <div>
                <label for="nombre_persona">Ingresa tu nombre:</label>
                <input type="text" id="nombre_persona" name="nombre_persona" required>
            </div>

            <!-- Telefono del ciudadano que lo reporta -->
            <div>
                <label for="telefono_persona">Ingresa tu numero telefono:</label>
                <input type="number" id="telefono_persona" name="telefono_persona">
            </div>

            <!-- Correo del ciudadano que lo reporta -->
            <div>
                <label for="correo_persona">Ingresa tu correo:</label>
                <input type="email" id="correo_persona" name="correo_persona">
            </div>
        </fieldset> <br>

        <!-- Nombre del Estado -->
        <div>
            <label for="estado">Nombre del Estado:</label>
            <input type="text" id="estado" name="estado" value="Nuevo León" class="No_Contestar" readonly required>
        </div>
    
        <!-- Nombre del Municipio -->
        <div>
            <label for="municipio">Nombre del Municipio:</label>
            <input type="text" id="municipio" name="municipio" value="Guadalupe" class="No_Contestar" readonly required>
        </div>

        <!-- Código Postal -->
        <div>
            <label for="codigoPostal">Código Postal:</label>
            <input type="text" maxlength="5" pattern="\d{5}" id="codigoPostal" name="codigoPostal" title="Ingrese los cinco digitos numericos" required>
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

        <!-- Nombre de la Calle -->
        <div>
            <label for="calle">Nombre de la Calle:</label>
            <input type="text" id="calle" name="calle" maxlength="50" required>
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

        <!-- Mapa -->
        <div>
            <label for="mi_mapa">Ubica el lugar:</label>
            <div id="mi_mapa"></div>
            <input type="text" id="coordenadas" name="mi_mapa" class="Ciego" required>
        </div>

        <!-- Imagen de referencia -->
        <div>
            <label for="imagen">Imagen de referencia:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png" required>
        </div>

        <!-- Fecha de acceso -->
        <div>
            <label for="fechaHora">Fecha de acceso:</label>
            <input type="date" id="fechaHora" name="fechaHora" value="<?php echo date('Y-m-d'); ?>" readonly>
        </div>

        <div class="Ciego">
            <input type="text" id="Clave" name="Clave" value="<?php echo $Clave; ?>" readonly required>
        </div>

        <input type="submit" value="Enviar reporte">
    </form>

    <footer>
        <div class="footer_imagenes footer_facultades">
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

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><!--Este sirve para mostrar alertas-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script><!--ESTE ES PARA EL PDF-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script><!--ESTE ES PARA EL PDF-->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script><!--Este sirve para mostrar un mapa-->
    <script src="../Recursos/JS/General.js"></script>
    <script src="ReporteCivil.js"></script>

</body>
</html>