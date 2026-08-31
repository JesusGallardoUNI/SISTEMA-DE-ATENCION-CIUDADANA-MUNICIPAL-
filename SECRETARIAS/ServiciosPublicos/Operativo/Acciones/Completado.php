<?php
    include "../../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    //=======================================================//
    //  Aqui empiezo a buscar todos los reportes necesarios  //
    //=======================================================//
    $Asignado_A = $_SESSION['ID_Empleado'];
    
    $Buscar = "SELECT reportes_colonias.clave, reportes_colonias.tipo_reporte, reportes_colonias.nombre_colonia, reportes_colonias.nombre_calle, reportes_colonias.fecha, reportes_resueltos.fecha_resuelto, reportes_resueltos.retraso FROM reportes_colonias INNER JOIN reportes_resueltos ON reportes_colonias.clave = reportes_resueltos.clave WHERE reportes_colonias.resuelto = 'si' AND reportes_colonias.tipo_reporte = '{$_SESSION['usuario_tipo']}' AND reportes_colonias.id_encargado = $Asignado_A";
    echo $Buscar;
    $Ejecutar = mysqli_query($db,$Buscar);
?>

<h1 class="TextoCentrado ColorFondo">Listado de reportes terminados</h1>
<table class="Configurar Espacio">
    <thead>
        <tr>
            <th>Folio</th>
            <th>Reporte</th>
            <th>Colonia</th>
            <th>Calle</th>
            <th>Fecha de reporte</th>
            <th>Fecha de solucion</th>
            <th>Dias de retraso</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($Registro = mysqli_fetch_assoc($Ejecutar)): ?>
            <?php if (!empty($Registro['clave'])): ?>
                <tr>
                    <td><?php echo $Registro['clave']; ?></td>
                    <td><?php echo Traductor($Registro['tipo_reporte']); ?></td>
                    <td><?php echo $Registro['nombre_colonia']; ?></td>
                    <td><?php echo $Registro['nombre_calle']; ?></td>
                    <td><?php echo $Registro['fecha']; ?></td>
                    <td><?php echo $Registro['fecha_resuelto']; ?></td>
                    <td><?php echo $Registro['retraso']; ?></td>
                </tr>
            <?php endif; ?>
        <?php endwhile; ?>
    </tbody>
</table>