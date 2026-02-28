<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Ayuntamiento.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facultades que otorga la constitución estatal</title>
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../../Ayuntamiento.css">
</head>
<body>
    <?php Banner(true,"../../../Recursos/Imagenes/icono.png","Configuracion","Menu de opciones"); ?>
    <table class="Configurar">
        <thead>
            <th>1</th>
            <th>2</th>
        </thead>
        <tr>
            <td>Selecciona color</td>
            <td>
                
            </td>
        </tr>
    </table>

    <button onclick="location.href='../MunicipioInforme.php'">Volver a la página principal</button>
    
</body>
</html>