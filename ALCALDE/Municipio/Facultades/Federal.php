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
    <title>Facultades que otorga la constitución federal</title>
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../../ALCALDE.css">
</head>
<body>
    <?php Banner(false,"","Facultades que otorga la Constitución Federal"); ?>
    <div class="container">
        <div class="content">
            <h2>FEDERAL</h2>
            <p><strong>Constitución Política de los Estados Unidos Mexicanos Título Quinto Artículo 115 fracción III</strong></p>
            <p>Los Municipios tendrán a su cargo las funciones y servicios públicos siguientes:</p>
            <ul>
                <li>a) Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales;</li>
                <li>b) Alumbrado público.</li>
                <li>c) Limpia, recolección, traslado, tratamiento y disposición final de residuos;</li>
                <li>d) Mercados y centrales de abasto.</li>
                <li>e) Panteones.</li>
                <li>f) Rastro.</li>
                <li>g) Calles, parques y jardines y su equipamiento;</li>
                <li>h) Seguridad pública, en los términos del artículo 21 de esta Constitución, policía preventiva municipal y tránsito;</li>
                <li>i) Los demás que las Legislaturas locales determinen según las condiciones territoriales y socio-económicas de los Municipios, así como su capacidad administrativa y financiera.</li>
            </ul>
            <button onclick="location.href='../MunicipioInforme.php'">Volver a la página principal</button>
        </div>
    </div>
</body>
</html>

