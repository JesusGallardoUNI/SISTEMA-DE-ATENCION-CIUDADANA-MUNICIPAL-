<?php
    require "../Recursos/Informacion.php";
    $db = ConectarDB();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Cuenta = mysqli_real_escape_string($db, $_POST['Cargo']);
        $Clave = mysqli_real_escape_string($db, $_POST['contrasena']);
 
        $Consulta = "SELECT * FROM alcalde WHERE cargo = '{$Cuenta}'";
        $Resultado = mysqli_query($db, $Consulta);

        if($Resultado->num_rows){
            //Caso de que si exista
            $Usuario = mysqli_fetch_assoc($Resultado);
            $auth = password_verify($Clave,$Usuario['acceso']);
            if($auth){
                //echo "Si esta valido";
                session_start();
                $_SESSION['Municipio'] = $Usuario['cargo'];
                $_SESSION['Nombre'] = $Usuario['nombre'];
                $_SESSION['login'] = true;
                header('Location: Municipio/MunicipioInforme.php');
            }
        }else{
            //Caso de que no exista
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención Ciudadana - Inicio de Sesión</title>
    <link rel="stylesheet" href="EstilosPortal.css">
    
</head>
<body>
    <div class="barra-superior">
        <img src="../Recursos/Imagenes/Guadalupe.png" alt="Estado de Nuevo León" class="logo">
        <h1>Municipio de Guadalupe</h1>
    </div>
    <div class="container">
        <h2>Sistema de Atención Ciudadana</h2>
        <form method="POST" action="Portal.php" id="loginForm">
            <label for="Cargo">Cargo: </label>
            <input name="Cargo" id="Cargo" type="text" value="Guadalupe" readonly required>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <input type="submit" value="Ingresar">
        </form>
    </div>
</body>
</html>