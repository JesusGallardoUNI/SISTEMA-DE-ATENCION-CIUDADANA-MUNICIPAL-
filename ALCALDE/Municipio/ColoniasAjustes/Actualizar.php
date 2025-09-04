<?php

    require "../../../Recursos/Partes/Bloqueo.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Portal.php');
    }

    $nombre_colonia = $_GET['nombre_colonia'];
    
    require "../../../Recursos/Informacion.php";
    $db = ConectarDB();

    //Obtener los datos de la colonia
    $Consulta = "SELECT * FROM colonias_guadalupe WHERE nombre_colonia = '{$nombre_colonia}'";
    $Resultado = mysqli_query($db, $Consulta);   
    $Propiedad = mysqli_fetch_assoc($Resultado);


    $Valor1 = $Propiedad['nombre_colonia'];

    //==============================================================================//
    //  Este es para actualizar el nombre de la colonia del municipio de guadalupe  //
    //==============================================================================//
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $Valor1 = mysqli_real_escape_string($db,$_POST['Nombre']);

        //Verificar que ese nombre no exista en la base de datos, si existe no hacer nada, caso contrario si actualiza
        $Existe = "SELECT * FROM colonias_guadalupe WHERE nombre_colonia = '$Valor1'";
        $Resultado = mysqli_query($db, $Existe);
        if(mysqli_num_rows($Resultado) === 0){
            $ActualizarColonia = "UPDATE colonias_guadalupe SET nombre_colonia = '$Valor1' WHERE nombre_colonia = '{$nombre_colonia}'";
            $Actualizar = mysqli_query($db, $ActualizarColonia);
            if($Actualizar){
                header("Location: Mostrar.php");
            }
        }else{
            echo "<script>alert('Este nombre de colonia ya existe en el registro de colonias existentes \\nIngrese otro nombre valido.');</script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="Ajustes.css">
    <title>Actualizacion</title>
</head>
<body>
    <header>
        <img src="../../../Recursos/Imagenes/Guadalupe.png" alt="Logo" class="logo">
        <div>
            <h1>Gobierno municipal de Guadalupe</h1>
            <h2>Configuración de colonias</h2>
        </div>
    </header>
    <main>
    
        <form method="POST" enctype="multipart/form-data" class="Form Configurar">
            <h2>Cambiar nombre de la colonia</h2>
            <div>
                <label for="Nombre">Nuevo nombre de la colonia: </label>
                <input type="text" name="Nombre" id="Nombre" value="<?php echo $Valor1; ?>" required>
            </div>
            <input type="submit" value="Actualizar" class="BOTON BTN__Color_Verde">
            <a href="Mostrar.php" class="BOTON BTN__Color_Rojo">Cancelar</a>
        </form>
        
    </main>
    <?php mysqli_close($db); ?>
</body>
</html>