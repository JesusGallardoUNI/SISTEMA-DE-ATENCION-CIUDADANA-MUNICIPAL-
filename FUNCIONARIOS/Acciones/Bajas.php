<?php

    require "../../Recursos/Partes/Bloqueo.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../AccesoAdministracion.php');
    }
    
    require "../../Recursos/Informacion.php";
    $db = ConectarDB();
    //============================================================//
    //  Aqui empiezo a buscar todos los funcionarios registrados  //
    //============================================================//
    $Buscar = "SELECT * FROM servidores_publicos";
    $Ejecutar = mysqli_query($db,$Buscar);

    //================================================================//
    //  Este es para eliminar una colonia del municipio de Guadalupe  //
    //================================================================//
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $Eliminado = mysqli_real_escape_string($db, $_POST['ServidorEliminar']);

        if (!empty($Eliminado)) {
            $EliminarPersona = "DELETE FROM servidores_publicos WHERE Curp = '$Eliminado'";
            $Eliminar = mysqli_query($db, $EliminarPersona);

            if ($Eliminar) {
                header("Location: Bajas.php");
                exit;
            } else {
                echo "Error al eliminar al funcionario.";
            }
        } else {
            echo "El nombre de la persona a eliminar no puede estar vacío.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../BuscarEstilo.css">
        <link rel="stylesheet" href="../../Recursos/CSS/General.css">
    </head>
    <body>
        <br><br>
        <a href="../Administracion.php" class="BOTON BTN__Color_Verde">Regresar</a>
        <br><br>
        <div class="Configurar alto">
            <table>
                <thead>
                    <tr>
                        <th>Curp</th>
                        <th>Nombre completo</th>
                        <th>Telefono</th>
                        <th>Departamento</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($Registro = mysqli_fetch_assoc($Ejecutar)): ?>
                        <tr>
                            <td><?php echo $Registro['Curp']; ?></td>
                            <td><?php echo $Registro['Nombres'] . " " . $Registro['Apellidos']; ?></td>
                            <td><?php echo $Registro['Telefono']; ?></td>
                            <td><?php echo $Registro['Departamento']; ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="ServidorEliminar" value="<?php echo $Registro['Curp']; ?>">
                                    <input type="submit" value="Eliminar" class="BOTON BTN__Color_Rojo">
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>