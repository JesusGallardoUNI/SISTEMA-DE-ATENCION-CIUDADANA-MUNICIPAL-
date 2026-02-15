<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../AccesoAdministracion.php');
    }
    $quiero = $_GET['Curp'];
    $db = ConectarDB();

    //Obtener los datos de la colonia
    $Consulta = "SELECT * FROM servidores_publicos WHERE Curp = '{$quiero}'";
    $Resultado = mysqli_query($db, $Consulta);   
    $Empleado = mysqli_fetch_assoc($Resultado);

    //=============================================================//
    //  Este es para actualizar el registro completo del empleado  //
    //=============================================================//
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $Val1 = mysqli_real_escape_string($db,$_POST["Nombres"]);
        $Val2 = mysqli_real_escape_string($db,$_POST["Apellidos"]);
        $Val3 = mysqli_real_escape_string($db,$_POST["Edad"]);
        $Val4 = mysqli_real_escape_string($db,$_POST["Sexo"]);
        $Val5 = mysqli_real_escape_string($db,$_POST["FDN"]);
        $Val6 = mysqli_real_escape_string($db,$_POST["Telefono"]);
        $Val7 = mysqli_real_escape_string($db,$_POST["Departamento"]);
        $Val8 = mysqli_real_escape_string($db,$_POST["Correo"]);
        $Val9 = mysqli_real_escape_string($db,$_POST["Contra"]);
        $Val10 = mysqli_real_escape_string($db,$_POST["Curp"]);

        $CurpOriginal = mysqli_real_escape_string($db, $_POST["CurpOriginal"]);

        //Verificar que ese nombre no exista en la base de datos, si existe no hacer nada, caso contrario si actualiza
        $Existe = "SELECT * FROM servidores_publicos WHERE Curp = '$quiero' ";
        $Resultado = mysqli_query($db, $Existe);

        if(mysqli_num_rows($Resultado) === 0){
            $Actualizar = "UPDATE servidores_publicos SET Nombres = '$Val1', Apellidos = '$Val2', Edad = '$Val3', Sexo = '$Val4', FDN = '$Val5', Telefono = '$Val6', Departamento = '$Val7', Correo = '$Val8', Acceso = '$Val9', Curp = '$Val10' WHERE Curp = '$CurpOriginal';";
            $Actualizar2 = mysqli_query($db, $Actualizar);

            if($Actualizar2){
                header("Location: Cambios.php");
            }
        }else{
            echo "<script>alert('Curp ya existe en el registro');</script>";
            header("Location: Cambios.php");
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../Recursos/CSS/General.css">
        <title>Actualizacion</title>
    </head>
<body>
    <?php Banner(true,"../../Recursos/Imagenes/icono.png","Gobierno de Guadalupe"); ?>
    
    <form method="POST" action="Actualizar.php" enctype="multipart/form-data">
        <fieldset>
            <!--Nombres-->
            <div>
                <label for="Nombres">Ingresa sus nombres: </label>
                <input type="text" id="Nombres" name="Nombres" value="<?php echo $Empleado['Nombres']; ?>" required>
            </div>
            <!--Apellidos-->
            <div>
                <label for="Apellidos">Ingresa sus apellidos: </label>
                <input type="text" id="Apellidos" name="Apellidos" value="<?php echo $Empleado['Apellidos']; ?>" required>
            </div>
            <!--Edad-->
            <div>
                <label for="Edad">Edad: </label>
                <input type="number" id="Edad" name="Edad" value="<?php echo $Empleado['Edad']; ?>" required>
            </div>
            <!--Sexo-->
            <div>
                <label for="Sexo">Sexo: </label>
                <select name="Sexo" id="Sexo" required>
                    <option value="" selected disabled>Ingrese el sexo</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
            </div>
            <!--Fecha de nacimiento-->
            <div>
                <label for="FDN">Fecha de nacimiento: </label>
                <input type="date" name="FDN" id="FDN" value="<?php echo $Empleado['FDN']; ?>" required>
            </div>
            <!--Curp de empleado-->
            <div>
                <label for="Curp">Curp de empleado: </label>
                <input type="hidden" name="CurpOriginal" value="<?php echo $Empleado['Curp']; ?>">
                <input type="text" name="Curp" id="Curp" maxlength="18" value="<?php echo $Empleado['Curp']; ?>" required>
            </div>
            </fieldset>
            <hr>
            <fieldset>
                <div>
                    <label for="Telefono">Telefono de identificacion: </label>
                    <input type="number" id="Telefono" name="Telefono" value="<?php echo $Empleado['Telefono']; ?>" required>
                </div>
                <div>
                    <label for="Departamento">Selecciona el departamento a asignar</label>
                    <select name="Departamento" id="Departamento" required>
                        <option disabled selected>Ingresa departamento</option>
                        <option value="2">Alumbrado público</option>
                        <option value="3">Limpia, recolección, traslado, tratamiento y disposición final de residuos</option>
                        <option value="4">Mercados y centrales de abasto</option>
                        <option value="7">Calles, parques y jardines y su equipamiento</option>
                        <option value="8">Seguridad pública, policía preventiva municipal y tránsito</option>
                    </select>
                </div>
                <div>
                    <label for="Correo">Correo de usuario a crear: </label>
                    <input type="text" name="Correo" id="Correo" value="<?php echo $Empleado['Correo']; ?>" required>
                </div>
                <div>
                    <label for="Contra">Contraseña a ingresar: </label>
                    <input type="password" id="Contra" name="Contra" value="<?php echo $Empleado['Nombres']; ?>" required>
                </div>
            </fieldset>
            <br>
            <input type="submit" value="Actualizar">
            <a href="Cambios.php" class="BOTON BTN__Color_Verde">Regresar</a>
        </form>
    
    
</body>
</html>