<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../SecretariaAdministracion.php');
    }
    $Ejecutar = Tabla("secretarias");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención Ciudadana - Inicio de Sesión</title>
    <link rel="stylesheet" href="../../Recursos/CSS/General.css">
</head>
<body>
    <?php Banner(true, "../../Recursos/Imagenes/icono.png","Municipio de Guadalupe","Panel de administracion de control de usuarios", true,"../../Recursos/SVG/Cerrar.svg","../../Recursos/Partes/Salir.php"); ?>

    <div class="Cuerpo">
        <nav>
            <div class="opcion Titulo_opcion" id="ScrollNavBar">
                <h2>Menu de opciones</h2>
                <img src="../../Recursos/SVG/menu.svg" loading="lazy">
            </div>
            <div class="opcion">
                <img src="../../Recursos/SVG/Altas.svg" alt="">
                <a href="Altas.php">Generar altas</a>
            </div>
            <div class="opcion">
                <img src="../../Recursos/SVG/Cambios.svg" alt="">
                <a href="Cambios.php">Solicitud de cambios</a>
            </div>
            <div class="opcion">
                <img src="../../Recursos/SVG/Eliminar.svg" alt="">
                <a href="Bajas.php">Generar bajas</a>
            </div>
        </nav>
        <section>
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
        </section>
    </div>
    <script src="../../Recursos/JS/General.js"></script>
</body>
</html>