<?php

    require "../../Recursos/Partes/Bloqueo.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../AccesoAdministracion.php');
    }

    require "../../Recursos/Informacion.php";
    include "../../Recursos/Partes/Partes.php";
    $db = ConectarDB();

    //=======================================================================//
    //  Consulta a la tabla buscando la informacion antes de insertar nuevo  //
    //=======================================================================//

    

    //====================================================//
    //  Aqui subo la informacion del reporte ya resuelto  //
    //====================================================//
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
        //$Val11 = mysqli_real_escape_string($db,$_POST[""]);

        $SubirSolucion = "INSERT INTO servidores_publicos (Nombres, Apellidos, Edad, Sexo, FDN, Telefono, Departamento, Correo, Acceso, Curp) VALUES ('$Val1','$Val2',$Val3,'$Val4','$Val5',$Val6,'$Val7','$Val8','$Val9','$Val10')";        
        
        $Informar = mysqli_query($db,$SubirSolucion);
    }

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
        <form method="POST" action="Altas.php" enctype="multipart/form-data">
            <fieldset>
                <!--Nombres-->
                <div>
                    <label for="Nombres">Ingresa sus nombres: </label>
                    <input type="text" id="Nombres" name="Nombres" required>
                </div>
                <!--Apellidos-->
                <div>
                    <label for="Apellidos">Ingresa sus apellidos: </label>
                    <input type="text" id="Apellidos" name="Apellidos" required>
                </div>
                <!--Edad-->
                <div>
                    <label for="Edad">Edad: </label>
                    <input type="number" id="Edad" name="Edad" required>
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
                    <input type="date" name="FDN" id="FDN" required>
                </div>
                <!--Curp de empleado-->
                <div>
                    <label for="Curp">Curp de empleado: </label>
                    <input type="text" name="Curp" id="Curp" maxlength="18" required>
                </div>
            </fieldset>
            <hr>
            <fieldset>
                <!--Telefono-->
                <div>
                    <label for="Telefono">Telefono de identificacion: </label>
                    <input type="number" id="Telefono" name="Telefono" required>
                </div>
                <!--Departamento-->
                <div>
                    <label for="Departamento">Selecciona el departamento a asignar</label>
                    <select name="Departamento" id="Departamento" required>
                        <option disabled selected>Ingresa departamento</option>
                        <option value="Alumbrado Publico">Alumbrado Publico</option>
                        <option value="Limpia de residuos">Limpia de residuos</option>
                        <option value="Recoleccion y traslado de residuos">Recoleccion y traslado de residuos</option>
                        <option value="Calles">Calles</option>
                        <option value="Parques y jardines">Parques y jardines</option>
                    </select>
                </div>
                <!--Correo-->
                <div>
                    <label for="Correo">Correo de usuario a crear: </label>
                    <input type="text" name="Correo" id="Correo" required>
                </div>
                <!--Contraseña-->
                <div>
                    <label for="Contra">Contraseña a ingresar: </label>
                    <input type="password" id="Contra" name="Contra" required>
                </div>
            </fieldset>
            <br>
            <input type="submit" value="Registar">
            <a href="../Administracion.php" class="BOTON BTN__Color_Verde">Regresar</a>
        </form>
    </body>
</html>