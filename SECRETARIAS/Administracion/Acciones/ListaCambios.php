<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../SecretariaAdministracion.php');
    }
    $db = ConectarDB();
    //============================================================//
    //  Aqui empiezo a buscar todos los funcionarios registrados  //
    //============================================================//
    $Pendientes = "SELECT * FROM solicitud_cambios WHERE Aprobado IS NULL;";
    $Ejecutar = mysqli_query($db, $Pendientes);
?>



<table class="Configurar Espacio_10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre completo</th>
            <th>Departamento</th>
            <th>Fecha de solicitud</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($Registro = mysqli_fetch_assoc($Ejecutar)): ?>
            <tr>
                <td><?php echo $Registro['id_empleado']; ?></td>
                <td><?php echo $Registro['nombre'];?></td>
                <td><?php echo $Registro['cargo_actual']; ?></td>
                <td><?php echo $Registro['fecha'];?></td>
                <td><a href="Acciones/Cambio.php?id=<?php echo $Registro['id']; ?>" class="BOTON BOTON_CERO BTN__Color_Verde">Atender registro</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>