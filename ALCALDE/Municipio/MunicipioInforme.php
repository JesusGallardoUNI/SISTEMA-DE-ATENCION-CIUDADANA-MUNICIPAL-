<?php
    
    include '../../Recursos/Informacion.php';
    $db = ConectarDB();
    require "../../Recursos/Partes/Bloqueo.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../Portal.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Municipio</title>
    <link rel="stylesheet" href="../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div>
            <h1 id="page-title">Municipio de Guadalupe</h1>
            <h2>Estado de Nuevo León</h2>
        </div>
        <div class="Salir">
            <img src="../../Recursos/SVG/Cerrar.svg" alt="">
            <a href="../../Recursos/Partes/Salir.php" class="">Cerrar sesión</a>
        </div>
    </header>
    <main class="principal">
        <h2>Menu de operaciones</h2>
        <div class="contenido">
            <div class="opcion">
                <a href="Facultades/Federal/Federal.php">
                    <img src="../../Recursos/Imagenes/Mexico.png" alt="Escudo Nacional de México">
                </a>
                <p>Legislación federal</p>
            </div>
            <div class="opcion">
                <a href="Facultades/Estatal/Estatal.php">
                    <img src="../../Recursos/Imagenes/NuevoLeón.png" alt="Escudo Estatal de Nuevo León">
                </a>
                <p>Legislacion estatal</p>
            </div>
            <div class="opcion">
                <a href="Facultades/Municipal/Reglamento.php">
                    <img src="../../Recursos/Imagenes/Guadalupe.png" alt="Escudo Estatal de Nuevo León">
                </a>
                <p>Reglamento interno</p>
            </div>
            <div class="opcion opcion_reporte">
                <a href="ReporteColonias/ReportesEnColonias.php">
                    <img id="municipio-image" src="../../Recursos/SVG/reportes.svg" alt="Escudo Municipipal de Guadalupe">
                </a>
                <div>
                    <?php 
                        $no = "SELECT COUNT(*) AS 'total' FROM reportes_colonias WHERE resuelto = 'no'";
                        $Ejecucion = mysqli_query($db, $no);
                        if ($Ejecucion) {
                            $fila = mysqli_fetch_assoc($Ejecucion);
                            if ( $fila['total'] <= 99 ) {
                                echo $fila['total'];
                            } else {
                                echo "+99";
                            }
                        } else {
                            echo "Error en la consulta: " . mysqli_error($db);
                            //Poner 0 en caso de resolucion corta y temporal
                        }

                    ?>
                </div>
                <p>Reportes al Municipio</p>
            </div>
            <div class="opcion opcion_resuelto">
                <a href="ReporteColonias/ReportesEnColoniasResueltos.php">
                    <img id="municipio-image" src="../../Recursos/SVG/resuelto.svg" alt="Escudo Municipipal de Guadalupe">
                </a>
                <div>
                    <?php 
                        $si = "SELECT COUNT(*) AS 'total' FROM reportes_colonias WHERE resuelto = 'si'";
                        $Ejecucion = mysqli_query($db, $si);
                        if ($Ejecucion) {
                            $fila = mysqli_fetch_assoc($Ejecucion); 
                            echo $fila['total'];
                        } else {
                            echo "Error en la consulta: " . mysqli_error($db);
                            //Poner 0 en caso de resolucion corta y temporal
                        }

                    ?>
                </div>
                <p>Reportes atendidos</p>
            </div>
            <div class="opcion">
                <a href="ColoniasAjustes/Mostrar.php">
                    <img src="../../Recursos/SVG/ModificarColonia.svg" alt="Modifica las propiedades de las colonias">
                </a>
                <p>Mostrar colonias</p>
            </div>
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
    <script src="script.js"></script>
</body>
</html>