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
    <title>Facultades que otorga la constitución estatal</title>
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../../ALCALDE.css">
</head>
<body>
    <?php Banner(false,"","Facultades que otorga la Constitución Estatal"); ?>
    <div class="container">
        <div class="content">
            <h2>ESTATAL</h2>
            <p><strong>Constitución Política del Estado Libre y Soberano de Nuevo León TÍTULO VI CAPÍTULO II Artículo 181:</strong></p>
            <p>Los Municipios tendrán las siguientes atribuciones:</p>
            <p>I. Prestar las funciones y servicios públicos siguientes:</p>
            <ul>
                <li>a) Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales.</li>
                <li>b) Alumbrado público.</li>
                <li>c) Limpia, recolección, traslado, tratamiento y disposición final de residuos.</li>
                <li>d) Mercados y centrales de abastos.</li>
                <li>e) Panteones.</li>
                <li>f) Rastro.</li>
                <li>g) Calles, parques y jardines y su equipamiento.</li>
                <li>h) Seguridad pública en los términos del artículo 21 de la Constitución Política de los Estados Unidos Mexicanos, policía municipal y tránsito. La policía municipal estará al mando del Presidente Municipal, en los términos de la Ley de Seguridad Pública del Estado. Aquélla acatará las órdenes que el Gobernador del Estado le transmita en aquellos casos que éste juzgue como de fuerza mayor o alteración grave del orden público.</li>
                <li>i) Las demás que el Congreso del Estado determine según las condiciones territoriales, socioeconómicas, capacidad administrativa y financiera de los municipios, los que previo acuerdo entre sus Ayuntamientos y sujeción a la ley, podrán coordinarse y asociarse para la más eficaz prestación de los servicios públicos o el mejor ejercicio de las funciones que les corresponden. </li>
            </ul>
            <button onclick="location.href='../MunicipioInforme.php'">Volver a la página principal</button>
        </div>
    </div>
</body>
</html>