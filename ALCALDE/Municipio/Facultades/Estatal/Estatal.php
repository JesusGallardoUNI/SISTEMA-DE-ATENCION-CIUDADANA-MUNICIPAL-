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
    <title>Facultades que otorga la constitución estatal</title>
    <link rel="stylesheet" href="../../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../Facultades.css">
</head>
<body>
    <header>
        <h1>Facultades que otorga la constitución estatal</h1>
    </header>
    <div class="container">
        <div class="content">
            <h2>ESTATAL</h2>
            <p><strong>Facultades que son otorgadas a los municipios según el <strong>Artículo 181</strong> de la Constitución Política del Estado Libre y Soberano de Nuevo León:</strong></p>
            <ul>
                <li>Los Municipios tendrán las siguientes atribuciones:</li>
                <li>I. Prestar las funciones y servicios públicos siguientes:</li>
                <li>a) Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales.</li>
                <li>b) Alumbrado público.</li>
                <li>c) Limpia, recolección, traslado, tratamiento y disposición final de residuos.</li>
                <li>d) Mercados y centrales de abastos.</li>
                <li>e) Panteones.</li>
                <li>f) Rastro.</li>
                <li>g) Calles, parques y jardines y su equipamiento.</li>
            </ul>
            <button onclick="location.href='../../MunicipioInforme.php'">Volver a la página principal</button>
        </div>
    </div>
</body>
</html>