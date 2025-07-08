<?php
    //Conectarse a la base de datos
    /* <?php ?> */
    require "Recursos/Informacion.php";
    $db = ConectarDB();

    //Datos
    $Cargo = "Guadalupe";
    $Login = "FIME/UANL.gob.mx";

    $Login1 = password_hash($Login,PASSWORD_BCRYPT);

    //Insertar
    $Insertar = "INSERT INTO alcalde (cargo, acceso) VALUES ('{$Cargo}','{$Login1}');";
    $Ejecucion = mysqli_query($db, $Insertar);

?>