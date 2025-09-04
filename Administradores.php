<?php
    //Conectarse a la base de datos
    /* <?php ?> */
    require "Recursos/Informacion.php";
    $db = ConectarDB();

    //Datos para los que accesan a FUNCIONARIOS/Administracion.php
    $Cargo = "Secretario2@gob.gpe.mx";
    $Login = "1qazxsw23edc";

    $Login1 = password_hash($Login,PASSWORD_BCRYPT);

    //Insertar Pero en otra tabla con sus propios atributos
    $Insertar = "INSERT INTO administradores (cargo, acceso) VALUES ('{$Cargo}','{$Login1}');";
    $Ejecucion = mysqli_query($db, $Insertar);

?>