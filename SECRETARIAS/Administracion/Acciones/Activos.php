<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../AccesoAdministracion.php');
    }
    $db = ConectarDB();
    //==================================//
    //  Consulta a la tabla servidores  //
    //==================================//
    $Ejecutar = Tabla("secretarias_cuentas");
?>


<table class="Configurar Espacio_10">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Secretaria</th>
            <th>Area</th>
            <th>Correo</th>
            <th>Contraseña</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($Registro = mysqli_fetch_assoc($Ejecutar)): ?>
            <tr class="trMaximo">
                <td><?php echo $Registro['Nombres'] . " " . $Registro['Apellidos']; ?></td>
                <td><?php echo $Registro['Telefono']; ?></td>
                <td><?php echo $Registro['Nombre_Secretaria']; ?></td>
                <td><?php echo $Registro['Area_Encargada']; ?></td>
                <td><?php echo $Registro['Correo']; ?></td>
                <td><?php echo $Registro['Acceso']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>