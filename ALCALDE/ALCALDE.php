<?php
    require "../Recursos/Informacion.php";
    $db = ConectarDB();

    include "../Recursos/Partes/Partes.php";
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
                $_SESSION['login'] = true;
                $_SESSION['usuario_tipo'] = 'alcalde';
                //$_SESSION['url'] = "/MUNICIPAL/ALCALDE/ALCALDE.php";   //Este puede ser descartado en un futuro
                
                $_SESSION['Municipio'] = $Usuario['cargo'];
                $_SESSION['Nombre'] = $Usuario['nombre'];
                header('Location: Municipio/MunicipioInforme.php');
            } else {
                echo '<div id="alerta" class="alerta alerta__malo">la contraseña no es correcta</div>';
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
    <link rel="stylesheet" href="../Recursos/CSS/General.css">
    <script src="../Recursos/JS/General.js"></script>
</head>
<body>
    <?php Banner(true,"../Recursos/Imagenes/icono.png","Municipio de Guadalupe"); ?>
        <h2>Sistema de Atención Ciudadana</h2>
        <form method="POST" action="ALCALDE.php" id="loginForm">
            <div>
                <label for="Cargo">Cargo: </label>
                <input name="Cargo" id="Cargo" type="text" value="Guadalupe" readonly required>
            </div>
            <div>
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>

            <input type="submit" value="Ingresar">
        </form>
</body>
</html>