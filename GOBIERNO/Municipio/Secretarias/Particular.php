<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Ayuntamiento.php');
    }
    $db = ConectarDB();

    //Datos del empleado
    $ID = $_GET["id"];
    $Empleado = "SELECT * FROM secretarias WHERE id_encargado = $ID;";
    $Ejecuta = mysqli_query($db, $Empleado);
    $Busca = mysqli_fetch_assoc($Ejecuta);

    //Total de reportes atendidos
    $Total ="SELECT COUNT(id_encargado) AS 'TOTAL' FROM reportes_colonias WHERE id_encargado = $ID AND resuelto = 'si';";
    $TotalMuestra = mysqli_query($db,$Total);
    $Muestra = mysqli_fetch_assoc($TotalMuestra);

    //Dame todos los reportes del empleado
    $Listado = "SELECT rep.clave, rep.tipo_reporte, rep.nombre_colonia, rep.nombre_calle, res.costo, res.retraso FROM reportes_colonias rep LEFT JOIN reportes_resueltos res ON rep.clave = res.clave WHERE rep.id_encargado = $ID AND rep.resuelto = 'si';";
    $TablaListado = mysqli_query($db,$Listado);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Historial de reportes atendidos</title>
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../../Ayuntamiento.css">
</head>

<body>
    <?php Banner(true,"../../../Recursos/Imagenes/icono.png","Secretarias","Reportes resueltos"); ?>
    <main>
        <p>Nombre: <?php echo $Busca['Nombres'] . " " . $Busca['Apellidos'];?></p>
        <p>Cargo actual: <?php echo Traductor($Busca['Departamento']);?></p>
        <p>Total de reportes atendidos: <?php echo $Muestra["TOTAL"];?></p>
        <br>
        <table class="Configurar">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Tipo</th>
                    <th>Colonia</th>
                    <th>Calle</th>
                    <th>Costo</th>
                    <th>Tiempo (Dias)</th>
                </tr>
            </thead>
            <tbody>
                <?php while($Miembro = mysqli_fetch_assoc($TablaListado)): ?>
                    <tr>
                        <td><?php echo $Miembro['clave'];?></td>
                        <td><?php echo Traductor($Miembro['tipo_reporte']);?></td>
                        <td><?php echo $Miembro['nombre_colonia'];?></td>
                        <td><?php echo $Miembro['nombre_calle'];?></td>
                        <td><?php echo $Miembro['costo'];?></td>
                        <td><?php echo $Miembro['retraso'];?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <div>
        <button onclick="location.href='General.php'">Volver al listado</button>
    </div>

</body>

</html>