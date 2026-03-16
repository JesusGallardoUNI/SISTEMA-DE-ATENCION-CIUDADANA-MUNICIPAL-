<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../AccesoAdministracion.php');
    }
    $db = ConectarDB();
    //==================================//
    //  Consulta a la tabla servidores  //
    //==================================//
    $Ejecutar = Tabla("secretarias");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../../Recursos/CSS/General.css">
    </head>
    <body>
        <?php Banner(true,"../../Recursos/Imagenes/icono.png","Gobierno de Guadalupe","Listado de personal"); ?>
        <table class="Configurar">
            <thead>
                <tr>
                    <th>Curp</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Departamento</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($Registro = mysqli_fetch_assoc($Ejecutar)): ?>
                    <tr class="trMaximo">
                        <td><?php echo $Registro['Curp']; ?></td>
                        <td><?php echo $Registro['Nombres'] . " " . $Registro['Apellidos']; ?></td>
                        <td><?php echo $Registro['Telefono']; ?></td>
                        <td><?php echo Traductor($Registro['Departamento']); ?></td>
                        <td><?php echo $Registro['Correo']; ?></td>
                        <td><?php echo $Registro['Acceso']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="SecretariaAdministracion.php" class="BOTON">Regresar</a>
    </body>
</html>