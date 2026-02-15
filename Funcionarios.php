<?php
    require "Recursos/Partes/Partes.php";
    $db = ConectarDB();

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $Campo1 = mysqli_real_escape_string($db, $_POST["Municipio"]);
        $Campo2 = mysqli_real_escape_string($db, $_POST["Nombre"]);
        $Campo3 = mysqli_real_escape_string($db, $_POST["Cargo"]);
        $Campo4 = mysqli_real_escape_string($db, $_POST["Correo"]);
        $Campo5 = mysqli_real_escape_string($db, $_POST["Clave"]);
        $Login = password_hash($Campo5,PASSWORD_BCRYPT);

        $Crear = "INSERT INTO funcionarios (municipio, nombre, cargo, correo, clave) VALUES ('$Campo1', '$Campo2', '$Campo3', '$Campo4', '$Login');";
        $Agregar = mysqli_query($db, $Crear);
        if($Agregar) {
            echo "<div id='Funcionario'></div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Recursos/CSS/General.css">
    <script scr="Recursos/JS/General.js"></script>
</head>
<body>
    <?php Banner(); ?>
    <form method="POST">

        <div>
            <label for="Municipio">Municipio:</label>
            <select name="Municipio" id="Municipio" required>
                <option value="" selected disabled>Ingrese un municipio</option>
                <option value="Guadalupe">Guadalupe</option>
            </select>
        </div>

        <div>
            <label for="Nombre">Nombre:</label>
            <input type="text" name="Nombre" id="Nombre" required>
        </div>

        <div>
            <label for="Cargo">Cargo:</label>
            <select name="Cargo" id="Cargo" required>
                <option value="" selected disabled>Seleccione cargo</option>
                <option value="Alcalde">Alcalde</option>
                <option value="Regidor">Regidor</option>
                <option value="Síndico Primero">Síndico Primero</option>
                <option value="Síndico Segundo">Síndico Segundo</option>
            </select>
        </div>

        <div>
            <label for="Correo">Correo:</label>
            <input type="email" name="Correo" id="Correo" required>
        </div>

        <div>
            <label for="Clave">Ingresa contraseña:</label>
            <input type="password" name="Clave" id="Clave" required>
        </div>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>