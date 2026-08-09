<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    //=======================================================//
    //  Aqui empiezo a buscar todos los reportes necesarios  //
    //=======================================================//
    $Asignado_A = $_SESSION['ID_Empleado'];
    $Buscar = "SELECT * FROM reportes_colonias WHERE resuelto = 'no' AND tipo_reporte = {$_SESSION['usuario_tipo']} AND id_encargado = $Asignado_A AND descartado IS NULL;";
    $Ejecutar = mysqli_query($db,$Buscar);
?>

<h1 class="TextoCentrado ColorFondo">Listado de reportes pendientes por terminar</h1>
<table class="Configurar Espacio" id="Opcion1">
    <thead>
        <tr>
            <th>Clave</th>
            <th>Reporte</th>
            <th>Colonia</th>
            <th>Calle</th>
            <th>Fecha de reporte</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($Registro = mysqli_fetch_assoc($Ejecutar)): ?>
            <?php if (!empty($Registro['clave'])): ?>
                <tr>
                    <td><a href="Solucion.php?clave=<?php echo $Registro['clave']; ?>"><?php echo $Registro['clave']; ?></a></td>
                    <td><?php echo Traductor($Registro['tipo_reporte']); ?></td>
                    <td><?php echo $Registro['nombre']; ?></td>
                    <td><?php echo $Registro['nombre_calle']; ?></td>
                    <td class="<?php echo ColorSemaforo($Registro['fecha']); ?>"><?php echo $Registro['fecha']; ?></td>
                </tr>
            <?php endif; ?>
        <?php endwhile; ?>
    </tbody>
</table>