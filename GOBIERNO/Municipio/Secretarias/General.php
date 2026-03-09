<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Ayuntamiento.php');
    }
    $db = ConectarDB();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Personal registrado</title>
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../../Ayuntamiento.css">
</head>

<body>
    <?php Banner(true,"../../../Recursos/Imagenes/icono.png","Secretarias","Listado de personal dado de alta"); ?>
    

<script src="../../Ayuntamiento.js"></script>
<script src="../../../Recursos/JS/General.js"></script>
</body>

</html>