<?php
    require "../Recursos/Informacion.php";
    $db = ConectarDB();

    require "../Recursos/Partes/Bloqueo.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: AccesoAdministracion.php');
    }
    //============================================================//
    //  Aqui empiezo a buscar todos los funcionarios registrados  //
    //============================================================//
    $Buscar = "SELECT * FROM servidores_publicos";
    $Ejecutar = mysqli_query($db,$Buscar);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención Ciudadana - Inicio de Sesión</title>
    <link rel="stylesheet" href="../Recursos/CSS/General.css">
    <link rel="stylesheet" href="BuscarEstilo.css">
    
</head>
<body>
    <header>
        <img src="../Recursos/Imagenes/Guadalupe.png" alt="Logo" class="logo">
        <div>
            <h1>Municipio de Guadalupe</h1>
            <h2>Panel de administracion de control de usuarios</h2>
        </div>
    </header>
    <nav>
        <section class="Titulo">
            <h2>Menu de opciones</h2>
        </section>
        <div>
            <img src="../Recursos/SVG/Altas.svg" alt="">
            
            <a href="Acciones/Altas.php">Altas</a>
        </div>
        <div>
            <img src="../Recursos/SVG/Cambios.svg" alt="">
            <a href="Acciones/Cambios.php">Cambios</a>
        </div>
        <div>
            <img src="../Recursos/SVG/Eliminar.svg" alt="">
            <a href="Acciones/Bajas.php">Bajas</a>
        </div>
        <div>
            <img src="../Recursos/SVG/Cerrar.svg" alt="">
            <a href="../Recursos/Partes/Salir.php" class="">Salir</a>
        </div>
    </nav>
    <main>
        <div class="Configurar ancholistado">
            <table>
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
                        <tr>
                            <td><?php echo $Registro['Curp']; ?></td>
                            <td><?php echo $Registro['Nombres'] . " " . $Registro['Apellidos']; ?></td>
                            <td><?php echo $Registro['Telefono']; ?></td>
                            <td><?php echo $Registro['Departamento']; ?></td>
                            <td><?php echo $Registro['Correo']; ?></td>
                            <td><?php echo $Registro['Acceso']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>