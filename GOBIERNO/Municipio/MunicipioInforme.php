<?php
    include '../../Recursos/Partes/Partes.php';
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../Ayuntamiento.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Municipio</title>
    <link rel="stylesheet" href="../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../Ayuntamiento.css">
</head>
<body>
    <?php Banner(false,"","Municipio de Guadalupe","Estado de Nuevo León", true,"../../Recursos/SVG/Cerrar.svg","../../Recursos/Partes/Salir.php"); ?>
    <main class="principal">
        <strong><?php echo $_SESSION['Nombre'] . " " . $_SESSION['usuario_tipo'] . " del municipio de " . $_SESSION['Municipio'];?>
        <h2>Menu de operaciones</strong></h2>
        <div class="contenido">

            <div class="opcion">
                <a href="Facultades/Federal.php">
                    <img src="../../Recursos/Imagenes/Mexico.png" alt="Escudo Nacional de México">
                </a>
                <p>Legislación federal</p>
            </div>

            <div class="opcion">
                <a href="Facultades/Estatal.php">
                    <img src="../../Recursos/Imagenes/NuevoLeón.png" alt="Escudo Estatal de Nuevo León">
                </a>
                <p>Legislacion estatal</p>
            </div>

            <div class="opcion">
                <a href="Facultades/Reglamento.php">
                    <img src="../../Recursos/Imagenes/Guadalupe.png" alt="Escudo Estatal de Nuevo León">
                </a>
                <p>Reglamento interno</p>
            </div>

            <div class="opcion opcion_reporte">
                <a href="ReporteColonias/ReportesEnColonias.php">
                    <img id="municipio-image" src="../../Recursos/SVG/reportes.svg" alt="Escudo Municipipal de Guadalupe">
                </a>
                <div>
                    <?php Contador("no"); ?>
                </div>
                <p>Reportes al Municipio</p>
            </div>

            <div class="opcion opcion_resuelto">
                <a href="ReporteColonias/ReportesEnColoniasResueltos.php">
                    <img id="municipio-image" src="../../Recursos/SVG/resuelto.svg" alt="Escudo Municipipal de Guadalupe">
                </a>
                <div>
                    <?php Contador("si"); ?>
                </div>
                <p>Reportes atendidos</p>
            </div>

            <?php Opcion6(); ?>

            <div class="opcion">
                 <a href="Estadistica/Datos.php">
                    <img src="../../Recursos/SVG/estadistica.svg" alt="Escudo Nacional de México">
                </a>
                <p>Estadistica municipal</p>
            </div>
            
            <div class="opcion">
                 <a href="Estadistica/Gastos.php">
                    <img src="../../Recursos/SVG/gasto.svg" alt="Escudo Nacional de México">
                </a>
                <p>Gasto municipal</p>
            </div>
            
            <?php Opcion9(); ?>

            <?php OpcionUltima(); ?>
        </div>
        <!--
        <form id="infoForm">
            <div class="form-group">
                <label for="estado">Nombre del Estado:</label>
                <input type="text" id="estado" name="estado" value="Nuevo León" readonly>
            </div>
            <div class="form-group">
                <label for="municipio">Nombre del Municipio:</label>
                <input type="text" id="municipio" name="municipio" value="Guadalupe" readonly>
            </div>
            <div class="form-group">
                <label for="alcalde">Nombre del Alcalde:</label>
                <input type="text" id="alcalde" name="alcalde" value="<?php echo $_SESSION['Nombre']; ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
            </div>
            <div class="form-group">
                <label for="firma">Firma Digital:</label>
                <canvas id="signature-pad" width="400" height="200"></canvas>
                <button type="button" onclick="clearSignature()">Borrar Firma</button>
            </div>
            <button type="button" onclick="generatePDF()">Aceptar</button>
        </form>
        -->
        
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="../Ayuntamiento.js"></script>
</body>
</html>