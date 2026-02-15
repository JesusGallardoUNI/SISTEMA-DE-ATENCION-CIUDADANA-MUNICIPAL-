<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../ALCALDE.php');
    }

    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facultades que otorga el reglamento interno municipal</title>
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../../ALCALDE.css">
</head>
<body>
    <?php Banner(false,"","Facultades que otorga el reglamento Municipal"); ?>
    <div class="container">
        <div class="content">
            <h2>Compendio</h2>
            <p><strong>Facultades y obligaciones del municipio según los reglamentos internos de Guadalupe:</strong></p>
            <p><strong>Servicios Públicos:</strong></p>
            
            <button onclick="location.href='../MunicipioInforme.php'">Volver a la página principal</button>
        </div>
    </div>
</body>
</html>

