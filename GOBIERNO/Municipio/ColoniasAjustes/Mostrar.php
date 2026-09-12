<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Ayuntamiento.php');
    }
    $db = ConectarDB();
    //=================================================================//
    //  Este es para ingresar nueva colonia al municipio de Guadalupe  //
    //=================================================================//
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Nombre'])) {
        

        $Asentamiento = mysqli_real_escape_string($db, $_POST['asentamiento']);
        $Nombre = mysqli_real_escape_string($db, $_POST['Nombre']);
        $Codigo = mysqli_real_escape_string($db, $_POST['postal']);
        
        //Agregar los otros campos

        if (!empty($Nombre)) {
            // Verificar si ya existe ese nombre
            $ConsultaExistente = "SELECT * FROM colonias_guadalupe WHERE nombre = '$Nombre'";
            $Resultado = mysqli_query($db, $ConsultaExistente);

            if (mysqli_num_rows($Resultado) > 0) {
                echo "<script>alert('Esta colonia ya existe.');</script>";
            } else {
                $AgregarColonia = "INSERT INTO colonias_guadalupe (tipo_asentamiento, nombre, codigo_postal) VALUES ('$Asentamiento','$Nombre','$Codigo')";
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
            $EliminarColonia = "DELETE FROM colonias_guadalupe WHERE nombre = '$ColoniaNombre';";
            echo $EliminarColonia;
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
    <link rel="stylesheet" href="../../Ayuntamiento.css">
    <title>Configuración municipal</title>
</head>

<body>
    <?php Banner(true,"../../../Recursos/Imagenes/icono.png","Gobierno municipal de Guadalupe","Configuración de colonias"); ?>
    
    <a href="../MunicipioInforme.php" class="BOTON">Volver a la pagina principal</a>

    <form method="POST" action="Mostrar.php" enctype="multipart/form-data">
        <h2>Agregar nueva colonia</h2>
        <div>
            <label for="asentamiento">Tipo de asentamiento:</label>
            <select name="asentamiento" id="asentamiento">
                <option selected disabled>Selecciona una opcion</option>
                <option value="Colonia">Colonia</option>
                <option value="Condominio">Condominio</option>
                <option value="Fraccionamiento">Fraccionamiento</option>
                <option value="Rancho">Rancho</option>
                <option value="Unidad habitacional">Unidad habitacional</option>
                <option value="Zona comercial">Zona comercial</option>
                <option value="Zona industrial">Zona industrial</option>
            </select>
        </div>
        <div>
            <label for="Nombre">Nombre de la colonia:</label>
            <input type="text" name="Nombre" id="Nombre" required>
        </div>
        <div>
            <label for="postal">Codigo postal:</label>
            <input type="number" name="postal" id="postal" required>
        </div>
        <input type="submit" value="Agregar colonia" class="BOTON BTN__Color_Verde">
    </form>
    
    <h2>Configurar colonias del municipio de Guadalupe</h2>
    <div class="tabla-contenedor">
        <table class="Configurar">
            <thead>
                <tr>
                    <th>Nombre de la colonia</th>
                    <th>Asentamiento</th>
                    <th>Codigo postal</th>
                    <th>Renombrar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($Registro = mysqli_fetch_assoc($Tabla)): ?>
                    <?php if (!empty($Registro['nombre'])): ?>
                        <tr>
                            <td><?php echo $Registro['nombre']; ?></td>
                            <td><?php echo $Registro['tipo_asentamiento']; ?></td>
                            <td><?php echo $Registro['codigo_postal']; ?></td>
                            <td><a href="Actualizar.php?nombre=<?php echo urlencode($Registro['nombre']); ?>" class="BOTON BOTON_CERO BTN__Color_Verde">Cambiar nombre</a></td>
                            <td>
                                <center>
                                    <form method="POST" class="elemento W100">
                                        <input type="hidden" name="NombreEliminar" value="<?php echo $Registro['nombre']; ?>">
                                        <input type="submit" value="Eliminar colonia" class="BOTON BOTON_CERO BTN__Color_Rojo">
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