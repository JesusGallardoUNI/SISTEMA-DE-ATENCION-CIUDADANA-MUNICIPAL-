<?php
    include "../Recursos/Partes/Partes.php";
    $db = ConectarDB();
    //====================================================//
    $INFORMACION = [];

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        //
        $Clave = mysqli_real_escape_string($db, $_POST["Codigo"]);
        $Reportes = "SELECT * FROM reportes_colonias WHERE clave = '$Clave';";
        $Busca = mysqli_query($db, $Reportes);
        $Muestra = mysqli_fetch_assoc($Busca);
        if($Muestra){
            //
            $Col1 = "El reporte fue realizado el dia " . $Muestra["fecha"] . " y se encuentra ubicado en el estado de " . $Muestra["estado"] . " en el municipio de " . $Muestra["municipio"] . " en la colonia " . $Muestra["nombre_colonia"] . " en la calle " . $Muestra["nombre_calle"] . " el reporte es " . Traductor($Muestra["tipo_reporte"]) . " y la descripcion dice " . $Muestra["descripcion"];
            $Responsable = $Muestra["id_encargado"];
            if(!$Responsable) {
                $Col2 = "Tu reporte todavia no a sido asignado a un encargado";
            } else {
                $Encargado = "SELECT * FROM secretarias WHERE id_encargado = $Responsable;";
                $Busca = mysqli_query($db,$Encargado);
                $Respuesta = mysqli_fetch_assoc($Busca);
                $Col2 = $Respuesta["Nombres"] . " " . $Respuesta["Apellidos"];
            }
            $Resuelto = $Muestra["resuelto"];
            if($Resuelto == "si") {
                $Col3 = "El reporte ya a sido resuelto";
            } elseif($Resuelto == "no") {
                $Col3 = "El reporte todavia no a sido resuelto";
            }
            $Descartado = $Muestra["descartado"];
            if($Descartado == NULL) {
                $Col4 = "El reporte no a sido descartado";
            } else {
                //
                $Error = "SELECT * FROM reportes_descartados WHERE id_reporte = $ID;";
                $Selecciona = mysqli_query($db, $Error);
                $Detalla = mysqli_fetch_assoc($Selecciona);
                $Col4 = "El reporte si fue descartado por " . $Responsable . " esto por el motivo de " . $Detalla["tipo"] . " y " . $Detalla["motivo"];
            }
            
            
            $INFORMACION = $Muestra;
        } else {
            //Caso donde no se vea 
            echo "<div id='ErrorReporte'></div>";
        }
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Recursos/Imagenes/icono.png" type="image/png" sizes="174x256">
    <title>Busca tu reporte</title>  
    <link defer rel="stylesheet" href="../Recursos/CSS/General.css">
    <link defer rel="stylesheet" href="ReporteCivil.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><!--Este sirve para mostrar alertas-->
    <script defer src="../Recursos/JS/General.js"></script>
</head>
<body>
    <?php Banner(true,"../Recursos/Imagenes/icono.png","Atención Ciudadana","Seguimiento del reporte"); ?>
    
    <form action="BuscaReporte.php" method="POST">
        <div>
            <label for="Codigo">Ingresa tu codigo de reporte:</label>
            <input type="text" id="Codigo" name="Codigo" required>
        </div>
        <br>
        <input type="submit" value="Buscar reporte">
        <br>
        <a href="ReporteCivil.php" class="BOTON">Clik aqui para regresar</a>
    </form>

    <table class="Configurar Configurar__Mediano">
        <thead>
            <tr><th>Informacion del reporte</th></tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $Col1 ?? "";?></td>
            </tr>
            <tr>
                <td>Encargado del reporte: <?php echo $Col2 ?? "";?></td>
            </tr>
            <tr>
                <td>Estado del reporte: <?php echo $Col3 ?? "";?></td>
            </tr>
            <tr>
                <td>Reporte descartado: <?php echo $Col4 ?? "";?></td>
            </tr>

        </tbody>
    </table>

    

    

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
</body>
</html>