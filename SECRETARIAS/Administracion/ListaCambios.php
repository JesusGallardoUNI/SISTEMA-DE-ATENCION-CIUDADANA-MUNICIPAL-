<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../SecretariaAdministracion.php');
    }
    $db = ConectarDB();
    //============================================================//
    //  Aqui empiezo a buscar todos los funcionarios registrados  //
    //============================================================//
    $Pendientes = "SELECT * FROM solicitud_cambios WHERE Aprobado IS NULL;";
    $Ejecutar = mysqli_query($db, $Pendientes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de solicitudes</title>
    <link rel="stylesheet" href="../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../BuscarEstilo.css">
</head>
<body>
    <?php Banner(true,"../../Recursos/Imagenes/icono.png","Gobierno de Guadalupe","Actualizacion de datos de personal"); ?>
    <br><br>
    <a href="SecretariaAdministracion.php" class="BOTON">Regresar</a>
    <br><br>
    <table class="Configurar Configurar__Mediano">
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
                    <td><?php echo Traductor($Registro['cargo_actual']); ?></td>
                    <td><?php echo $Registro['fecha'];?></td>
                    <td><a href="Cambio.php?id=<?php echo $Registro['id']; ?>" class="BOTON BOTON_CERO BTN__Color_Verde">Atender registro</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>