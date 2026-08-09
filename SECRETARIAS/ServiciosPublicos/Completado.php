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
    $Buscar = "SELECT * FROM reportes_colonias WHERE resuelto = 'si' AND tipo_reporte = {$_SESSION['usuario_tipo']} AND id_encargado = $Asignado_A";
    $Ejecutar = mysqli_query($db,$Buscar);
?>

<h1 class="TextoCentrado ColorFondo">Listado de reportes terminados</h1>
<table class="Configurar Espacio">
    <thead>
        <tr>
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
                    <td><?php echo Traductor($Registro['tipo_reporte']); ?></td>
                    <td><?php echo $Registro['nombre']; ?></td>
                    <td><?php echo $Registro['nombre_calle']; ?></td>
                    <td class="<?php echo ColorSemaforo($Registro['fecha']); ?>"><?php echo $Registro['fecha']; ?></td>
                </tr>
            <?php endif; ?>
        <?php endwhile; ?>
    </tbody>
</table>