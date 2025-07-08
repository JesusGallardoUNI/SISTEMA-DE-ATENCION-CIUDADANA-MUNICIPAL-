<?php
    require "../../../Recursos/Partes/Bloqueo.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Portal.php');
    }
    require "../../../Recursos/Informacion.php";
    $db = ConectarDB();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Reportes</title>
    <link rel="stylesheet" href="ColoniaEstilos.css">
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
    <script src="ColoniaFunciones.js" defer></script>
</head>

<body>
    <header>
        <img src="../../../Recursos/Imagenes/Guadalupe.png" alt="" class="logo">
        <h1 id="page-title">Colonias de Guadalupe</h1>
    </header>
    <?php
        include '../../../Recursos/Partes/Listado.php';
    ?>

<script src="ColoniaFunciones.js"></script>
</body>

</html>