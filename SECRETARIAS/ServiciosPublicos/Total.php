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
    $Buscar = "SELECT * FROM reportes_colonias WHERE resuelto = 'no' AND tipo_reporte = {$_SESSION['usuario_tipo']} AND id_encargado IS NULL;";
    $Ejecutar = mysqli_query($db,$Buscar);

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $IDENTIFICACION = mysqli_real_escape_string($db, $_POST["Integrar"]);
        $Asignado_A = $_SESSION['ID_Empleado'];
        $Query = "UPDATE reportes_colonias SET id_encargado = $Asignado_A WHERE id = $IDENTIFICACION;";
        $Asignar = mysqli_query($db, $Query);
        if($Asignar){
            echo "<div id='alerta'></div>";
        }
    }
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
                            <form method="POST" class="elemento W80 FormularioTotal" id="">
                                <input type="hidden" name="Integrar" value="<?php echo $Registro['id']; ?>">
                                <input type="submit" value="Integrar" class="BOTON BOTON_CERO BTN__Color_Verde" title="Da doble clic para integrarlo">
                            </form>
                        </center>
                    </td>
                    <td><?php echo $Registro['clave']; ?></td>
                    <td><?php echo Traductor($Registro['tipo_reporte']); ?></td>
                    <td><?php echo $Registro['nombre']; ?></td>
                    <td class="<?php echo ColorSemaforo($Registro['fecha']); ?>"><?php echo $Registro['fecha']; ?></td>
                </tr>
            <?php endif; ?>
        <?php endwhile; ?>
    </tbody>
</table>