<?php

    require "../../../Recursos/Partes/Bloqueo.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Portal.php');
    }

    require "../../../Recursos/Informacion.php";
    $db = ConectarDB();

    //=================================================================//
    //  Este es para ingresar nueva colonia al municipio de Guadalupe  //
    //=================================================================//
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Nombre'])) {
        $Nombre = mysqli_real_escape_string($db, $_POST['Nombre']);

        if (!empty($Nombre)) {
            // Verificar si ya existe esa colonia
            $ConsultaExistente = "SELECT * FROM colonias_guadalupe WHERE nombre_colonia = '$Nombre'";
            $Resultado = mysqli_query($db, $ConsultaExistente);

            if (mysqli_num_rows($Resultado) > 0) {
                echo "<script>alert('Esta colonia ya existe.');</script>";
            } else {
                $AgregarColonia = "INSERT INTO colonias_guadalupe (nombre_colonia) VALUES ('$Nombre')";
                $Insertar = mysqli_query($db, $AgregarColonia);

                if ($Insertar) {
                    header("Location: Mostrar.php");
                } else {
                    echo "Error al insertar la colonia.";
                }
            }
        } else {
            echo "El nombre de la colonia no puede estar vacío.";
        }
    }


    //================================================================//
    //  Este es para eliminar una colonia del municipio de Guadalupe  //
    //================================================================//
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["NombreEliminar"])) {
        $ColoniaNombre = mysqli_real_escape_string($db, $_POST['NombreEliminar']);

        if (!empty($ColoniaNombre)) {
            $EliminarColonia = "DELETE FROM colonias_guadalupe WHERE nombre_colonia = '$ColoniaNombre'";
            $Eliminar = mysqli_query($db, $EliminarColonia);

            if ($Eliminar) {
                header("Location: Mostrar.php");
                exit;
            } else {
                echo "Error al eliminar la colonia.";
            }
        } else {
            echo "El nombre de la colonia a eliminar no puede estar vacío.";
        }
    }

    //==========================================================================//
    //  Este es para mostrar la lista de las colonias en la tabla y configurar  //
    //==========================================================================//
    $Muestra = "SELECT * FROM colonias_guadalupe";
    $Tabla = mysqli_query($db, $Muestra);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="Ajustes.css">
    <title>Configuración municipal</title>
</head>

<body>
    <header>
        <img src="../../../Recursos/Imagenes/Guadalupe.png" alt="Logo" class="logo">
        <div>
            <h1>Gobierno municipal de Guadalupe</h1>
            <h2>Configuración de colonias</h2>
        </div>
    </header>
    
    <a href="../MunicipioInforme.php" class="BOTON BTN__Color_Verde">Volver a la pagina principal</a>

    <form method="POST" action="Mostrar.php" enctype="multipart/form-data">
        <h2>Agregar nueva colonia</h2>
        <div>
            <label for="Nombre">Nombre de la colonia:</label>
            <input type="text" name="Nombre" id="Nombre" required>
        </div>
        <input type="submit" value="Agregar colonia" class="BOTON BTN__Color_Verde">
    </form>
    
    <h2>Configurar colonias del municipio de Guadalupe</h2>
    <div class="tabla-contenedor">
        <table class="Configurar">
            <thead>
                <tr>
                    <th>Nombre de la colonia</th>
                    <th>Renombrar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($Registro = mysqli_fetch_assoc($Tabla)): ?>
                    <?php if (!empty($Registro['nombre_colonia'])): ?>
                        <tr>
                            <td><?php echo $Registro['nombre_colonia']; ?></td>
                            <td><a href="Actualizar.php?nombre_colonia=<?php echo urlencode($Registro['nombre_colonia']); ?>" class="BOTON BTN__Color_Verde">Cambiar nombre</a></td>
                            <td>
                                <center>
                                    <form method="POST">
                                        <input type="hidden" name="NombreEliminar" value="<?php echo $Registro['nombre_colonia']; ?>">
                                        <input type="submit" value="Eliminar colonia" class="BOTON BTN__Color_Rojo">
                                    </form>
                                </center>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    
    <?php mysqli_close($db); ?>
</body>

</html>