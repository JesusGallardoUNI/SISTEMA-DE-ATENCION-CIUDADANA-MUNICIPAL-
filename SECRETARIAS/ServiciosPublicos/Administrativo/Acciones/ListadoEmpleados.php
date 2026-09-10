<?php
    include "../../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    $Secretaria = $_SESSION['Secretaria'];
    
    $Buscar = "SELECT *  FROM secretarias_cuentas WHERE Nombre_Secretaria = '$Secretaria' AND Administrativo = 'no';";
    $Ejecutar = mysqli_query($db,$Buscar);
?>



<table class="Configurar Espacio">
    <thead>
        <tr>
            <th>Nombre completo</th>
            <th>Edad</th>
            <th>Genero</th>
            <th>Telefono</th>
            <th>Area encargada</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($Registro = mysqli_fetch_assoc($Ejecutar)): ?>
            <tr>
                <td><?php echo $Registro['Nombres'] . " " . $Registro['Apellidos']; ?></td>
                <td><?php echo $Registro['Edad']; ?></td>
                <td><?php echo $Registro['Sexo']; ?></td>
                <td><?php echo $Registro['Telefono']; ?></td>
                <td><?php echo $Registro['Area_Encargada']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>