<?php
    require "../../../../Recursos/Partes/Bloqueo.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../../Portal.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facultades que otorga la constitución federal</title>
    <link rel="stylesheet" href="../../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../Facultades.css">
</head>
<body>
    <header>
        <h1>Facultades que otorga el reglamento municipal</h1>
    </header>
    <div class="container">
        <div class="content">
            <h2>Compendio</h2>
            <p><strong>Facultades y obligaciones del municipio según los reglamentos internos de Guadalupe:</strong></p>
            <p><strong>Servicios Públicos:</strong></p>
            
            <button onclick="location.href='../../MunicipioInforme.php'">Volver a la página principal</button>
        </div>
    </div>
</body>
</html>

