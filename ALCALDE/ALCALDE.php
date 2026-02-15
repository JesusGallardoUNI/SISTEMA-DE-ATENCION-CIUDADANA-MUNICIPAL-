<?php
    include "../Recursos/Partes/Partes.php";
    $db = ConectarDB();
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Cuenta = mysqli_real_escape_string($db, $_POST['Correo']);
        $Clave = mysqli_real_escape_string($db, $_POST['contrasena']);
 
        $Consulta = "SELECT * FROM funcionarios WHERE correo = '{$Cuenta}'";
        $Resultado = mysqli_query($db, $Consulta);

        if($Resultado->num_rows){
            //Caso de que si exista
            $Usuario = mysqli_fetch_assoc($Resultado);
            $auth = password_verify($Clave,$Usuario['clave']);
            if($auth){
                //echo "Si esta valido";
                
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['usuario_tipo'] = $Usuario['cargo'];
                //$_SESSION['url'] = "/MUNICIPAL/ALCALDE/ALCALDE.php";   //Este puede ser descartado en un futuro
                
                $_SESSION['Municipio'] = $Usuario['municipio'];
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
</head>
<body>
    <?php Banner(true,"../Recursos/Imagenes/icono.png","Municipio de Guadalupe"); ?>
    <h2>Sistema de Atención Ciudadana</h2>
    <form method="POST">
        <div>
            <label for="Correo">Correo: </label>
            <input name="Correo" id="Correo" type="email" required>
        </div>
        <div>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
        </div>

        <input type="submit" value="Ingresar">
    </form>
    <script src="../Recursos/JS/General.js"></script>
</body>
</html>