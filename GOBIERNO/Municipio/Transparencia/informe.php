<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Ayuntamiento.php');
    }
    $db = ConectarDB();

    $informe = $_SESSION['Informe'] ?? ''; 

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $Inicio = mysqli_real_escape_string($db, $_POST["Inicio"]);
        $Fin = mysqli_real_escape_string($db, $_POST["Fin"]);
        $Resuelto = mysqli_real_escape_string($db, $_POST["Informe"]);
        $Descripcion = mysqli_real_escape_string($db, $_POST["Descripcion"]);
        $Query = "SELECT r.codigo_postal, r.nombre_colonia, r.tipo_reporte, rr.costo, r.fecha, rr.fecha_resuelto FROM reportes_colonias r LEFT JOIN reportes_resueltos rr ON r.clave = rr.clave WHERE r.resuelto = '$Resuelto' AND r.fecha BETWEEN '$Inicio' AND '$Fin';";    
        $Ejecuta = mysqli_query($db, $Query);

        //=================================================//
        //   GUARDAR DATOS DESPUES DE BUSCAR INFORMACION   //
        //=================================================//
        $_SESSION['Inicio'] = $_POST['Inicio'] ?? '';
        $_SESSION['Fin'] = $_POST['Fin'] ?? '';
        $_SESSION['Informe'] = $_POST['Informe'] ?? '';
        $_SESSION['Descripcion'] = $_POST['Descripcion'] ?? '';       
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
    <?php Banner(true,"../../../Recursos/Imagenes/icono.png","Transparencia","Informe de acciones",false); ?>

    <form id="infoForm" method="POST">
        <div>
            <label for="estado">Nombre del Estado:</label>
            <input type="text" id="estado" name="estado" value="Nuevo León" readonly>
        </div>
        <div>
            <label for="municipio">Nombre del Municipio:</label>
            <input type="text" id="municipio" name="municipio" value="Guadalupe" readonly>
        </div>
        <div>
            <label for="alcalde">Nombre del Alcalde:</label>
            <input type="text" id="alcalde" name="alcalde" value="<?php echo $_SESSION['Nombre']; ?>" readonly required>
        </div>
        <div>
            <label for="fecha">Fecha actual:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" readonly required>
        </div>
        <div>
            <label for="Informe">Elige un tipo de informe</label>
            <select name="Informe" id="Informe" required>
                <option disabled>Elige una opcion</option>
                <option value="si" <?php echo ($informe == 'si') ? 'selected' : ''; ?>>Atendidos</option>
                <option value="no" <?php echo ($informe == 'no') ? 'selected' : ''; ?>>Pendientes</option>
            </select>
        </div>
        <div>
            <label for="Inicio">Ingrese la fecha de inicio</label>
            <input type="date" name="Inicio" id="Inicio" value="<?php echo isset($_SESSION['Inicio']) ? $_SESSION['Inicio'] : ''; ?>" required>
        </div>
        <div>
            <label for="Fin">Ingrese la fecha de fin</label>
            <input type="date" name="Fin" id="Fin" value="<?php echo isset($_SESSION['Fin']) ? $_SESSION['Fin'] : ''; ?>" required>
        </div>
        <div>
            <label for="Descripcion">Descripcion:</label>
            <textarea id="Descripcion" name="Descripcion" rows="10" required><?php echo isset($_SESSION['Descripcion']) ? $_SESSION['Descripcion'] : ''; ?></textarea>
        </div>
        <div>
            <label>Firma Digital:</label>
            <canvas id="firma" width="400" height="200"></canvas>
        </div>
        <input type="submit" value="Buscar información">
        <div>
            <label>Listado completo</label>
            <ul id="Listado">
                <?php if (isset($Ejecuta) && $Ejecuta && mysqli_num_rows($Ejecuta) > 0): ?>
                    <?php while ($Registro = mysqli_fetch_assoc($Ejecuta)): ?>
                        <li>
                            <td>Codigo postal: <?php echo $Registro['codigo_postal'] ?? ""; ?>.</td>
                            <td>Colonia: <?php echo $Registro['nombre'] ?? ""; ?>.</td>
                            <td>Reporte: <?php echo Traductor($Registro['tipo_reporte']) ?? ""; ?>.</td>
                            <td>Costo:<?php echo $Registro['costo'] ?? ""; ?>.</td>
                            <td>Fecha de reporte:<?php echo $Registro['fecha'] ?? ""; ?>.</td>
                            <td>Fecha de solucion:<?php echo $Registro['fecha_resuelto'] ?? ""; ?>.</td>
                        </li>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>
        
    </form>
    <br>
    <button type="button" onclick="clearSignature()">Borrar Firma</button>
    <br>
    <button type="button" onclick="generatePDF()">Generar informe</button>
    <br>
    <button onclick="location.href='../MunicipioInforme.php'">Volver a la página principal</button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script><!--ESTE ES PARA EL PDF-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script><!--ESTE ES PARA EL PDF-->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script><!--ESTE ES PARA HACER LA FIRMA-->
    <script src="../../Ayuntamiento.js"></script>
</body>
</html>