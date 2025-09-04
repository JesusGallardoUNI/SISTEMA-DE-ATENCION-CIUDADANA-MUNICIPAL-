<?php
    require "../Recursos/Informacion.php";
    
    $db = ConectarDB();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Cuenta = mysqli_real_escape_string($db, $_POST['Cargo']);
        $Clave = mysqli_real_escape_string($db, $_POST['contrasena']);
 
        $Consulta = "SELECT * FROM servidores_publicos WHERE Correo = '{$Cuenta}';";
        $Resultado = mysqli_query($db, $Consulta);

        if($Resultado->num_rows){
            //Caso de que si exista
            $Usuario = mysqli_fetch_assoc($Resultado);
            if ($Clave == $Usuario['Acceso']){
                $auth = True;
            } else {
                $auth = False;
            }

            
            if($auth){
                //echo "Si esta valido";
                session_start();
                $_SESSION['NombreCompleto'] = $Usuario['Nombres'] . " " . $Usuario['Apellidos'];
                $_SESSION['login'] = true;
                $_SESSION['url'] = "/MUNICIPAL/FUNCIONARIOS/Acceso.php";
                header('Location: Resuelto/Muestra.php');
            } else {
                echo '<div id="alerta" class="alerta alerta__malo">la contraseña no es correcta</div>';
            }
        }else{
            echo  '<div id="alerta" class="alerta alerta__malo">el correo no existe</div>';
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención Ciudadana - Inicio de Sesión</title>
    <link rel="stylesheet" href="../Recursos/CSS/General.css">
    <link rel="stylesheet" href="BuscarEstilo.css">
    <script src="../Recursos/JS/General.js"></script>
    
</head>
<body>
    <header>
        <img src="../Recursos/Imagenes/Guadalupe.png" alt="Logo" class="logo">
        <div>
            <h1>Municipio de Guadalupe</h1>
            <h2>Acceso Funcionarios</h2>
        </div>
    </header>
    <h2>Ingrese correo y contraseña para entrar</h2>
    <form method="POST" action="Acceso.php" id="loginForm">
        <div>
            <label for="Cargo">Correo: </label>
            <input name="Cargo" id="Cargo" type="email" required>
        </div>
        <div>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
        </div>

        <input type="submit" value="Ingresar">
    </form>

</body>
</html>