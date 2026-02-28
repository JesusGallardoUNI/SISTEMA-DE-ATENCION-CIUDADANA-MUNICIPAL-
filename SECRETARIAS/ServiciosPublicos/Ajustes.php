<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    //=======================================================//
    //  Aqui empiezo a buscar todos los reportes necesarios  //
    //=======================================================//
    $Buscar = "SELECT * FROM reportes_colonias WHERE resuelto != 'si' AND tipo_reporte = {$_SESSION['usuario_tipo']}";
    $Ejecutar = mysqli_query($db,$Buscar);
?>


<h1 class="TextoCentrado ColorFondo">Ajustes</h1>