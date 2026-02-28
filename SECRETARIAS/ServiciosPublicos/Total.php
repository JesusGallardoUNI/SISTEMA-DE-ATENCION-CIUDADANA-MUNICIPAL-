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
    $Buscar = "SELECT * FROM reportes_colonias WHERE resuelto != 'si' AND tipo_reporte = {$_SESSION['usuario_tipo']}";
    $Ejecutar = mysqli_query($db,$Buscar);
?>

<h1 class="TextoCentrado ColorFondo">Selecciona un reporte para integrarlo a tu bitacora de trabajo</h1>
<table class="Configurar Espacio" id="Opcion1">
    <thead>
        <tr>
            <th>Accion</th>
            <th>Clave</th>
            <th>Reporte</th>
            <th>Colonia</th>
            <th>Fecha de reporte</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($Registro = mysqli_fetch_assoc($Ejecutar)): ?>
            <?php if (!empty($Registro['clave'])): ?>
                <tr>
                    <td>
                        <center>
                            <form method="POST" class="elemento W80">
                                <input type="hidden" name="Seleccionar" value="<?php echo $Registro['nombre_colonia']; ?>">
                                <input type="submit" value="Integrar" class="BOTON BOTON_CERO BTN__Color_Verde">
                            </form>
                        </center>
                    </td>
                    <td><?php echo $Registro['clave']; ?></td>
                    <td><?php echo Traductor($Registro['tipo_reporte']); ?></td>
                    <td><?php echo $Registro['nombre_colonia']; ?></td>
                    <td class="<?php echo ColorSemaforo($Registro['fecha']); ?>"><?php echo $Registro['fecha']; ?></td>
                </tr>
            <?php endif; ?>
        <?php endwhile; ?>
    </tbody>
</table>