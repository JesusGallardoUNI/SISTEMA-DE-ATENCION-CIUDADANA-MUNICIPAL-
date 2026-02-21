<?php
    include "../Recursos/Partes/Partes.php";
    $db = ConectarDB();

    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Cuenta = mysqli_real_escape_string($db, $_POST['Cargo']);
        $Clave = mysqli_real_escape_string($db, $_POST['contrasena']);
 
        $Consulta = "SELECT * FROM administradores WHERE cargo = '{$Cuenta}';";
        $Resultado = mysqli_query($db, $Consulta);

        if($Resultado->num_rows){
            //Caso de que si exista
            $Usuario = mysqli_fetch_assoc($Resultado);
            //$auth = ;
            if ($Clave == password_verify($Clave,$Usuario['acceso'])){
                $auth = True;
            } else {
                $auth = False;
            }

            
            if($auth){
                //echo "Si esta valido";
                
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['usuario_tipo'] = 'administracion';
                //$_SESSION['url'] = "/MUNICIPAL/FUNCIONARIOS/AccesoAdministracion.php";   //Este puede ser descartado en un futuro
                
                header('Location: Administracion/Administracion.php');
            } else {
                //echo '<div id="alerta" class="alerta alerta__malo">la contraseña no es correcta</div>';
                //Integra las nuevas alertas de la libreria
            }
        }else{
            //echo  '<div id="alerta" class="alerta alerta__malo">el correo no existe</div>';
            //Integra las nuevas alertas de la libreria
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
        <?php Banner(true,"../Recursos/Imagenes/icono.png","Municipio de Guadalupe","Secretaria de administración"); ?>
        <h2>Acceso al panel de control</h2>
        <form method="POST">
            <div>
                <label for="Cargo">Cargo: </label>
                <input name="Cargo" id="Cargo" type="email" required>
            </div><br>

            <div>
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div><br>

            <input type="submit" value="Ingresar">
        </form>
        
    </body>
</html>