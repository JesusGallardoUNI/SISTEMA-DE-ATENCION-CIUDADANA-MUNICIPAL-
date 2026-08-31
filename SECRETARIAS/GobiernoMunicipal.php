<?php
    include "../Recursos/Partes/Partes.php";
    $db = ConectarDB();
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Cuenta = mysqli_real_escape_string($db, $_POST['Correo']);
        $Clave = mysqli_real_escape_string($db, $_POST['Clave']);
 
        $Consulta = "SELECT * FROM secretarias_cuentas WHERE Correo = '{$Cuenta}';";
        $Resultado = mysqli_query($db, $Consulta);

        if($Resultado->num_rows){
            //Caso de que si exista
            $Usuario = mysqli_fetch_assoc($Resultado);
            
            if($Clave == $Usuario['Acceso']){
                //echo "Si esta valido";
                
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['usuario_tipo'] = $Usuario['Area_Encargada'];
                
                
                $_SESSION['Secretaria'] = $Usuario['Nombre_Secretaria'];
                $_SESSION['Area'] = $Usuario['Area_Encargada'];
                $_SESSION['NombreCompleto'] = $Usuario['Nombres'] . " " . $Usuario['Apellidos'];
                $_SESSION['ID_Empleado'] = $Usuario['id_encargado'];
                
                
                
                header("Location: ServiciosPublicos/Operativo/Inicio.php");
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
        <?php Banner(true,"../Recursos/Imagenes/icono.png","Municipio de Guadalupe","Inicia sessión"); ?>
        <div>
            <form method="POST" class="VW50">
                <div>
                    <label for="Correo">Ingresa tu correo:</label>
                    <input type="email" name="Correo" id="Correo">
                </div>

                <div>
                    <label for="Clave">Ingresa la contraseña:</label>
                    <input type="password" name="Clave" id="Clave">
                </div>

                <input type="submit" value="Ingresar">
            </form>
        </div>
        
    </body>
</html>