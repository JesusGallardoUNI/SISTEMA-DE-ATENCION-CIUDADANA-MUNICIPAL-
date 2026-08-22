<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    $ID = $_SESSION['ID_Empleado'];
    $Informe = "SELECT * FROM solicitud_cambios WHERE id_empleado = $ID;";
    $Traer = mysqli_query($db, $Informe);
?>


<h1 class="TextoCentrado ColorFondo">Informes actuales:</h1>


<div>
    <ul>
        <?php while ($Registro = mysqli_fetch_assoc($Traer)): ?>
            <li>
                <td>Fecha de solicitud:<?php echo $Registro['fecha']; ?>.</td>
                <td>Cambio: <?php echo Traductor($Registro['cargo_nuevo']); ?>.</td>
                <td>Aprobado: <?php echo $Registro['Aprobado'] ?? "Pendiente"; ?>.</td>
                <td>Indicaciones: <?php echo $Registro['indicaciones'] ?? "Pendiente"; ?>.</td>
            </li>
        <?php endwhile; ?>
    </ul>
</div>