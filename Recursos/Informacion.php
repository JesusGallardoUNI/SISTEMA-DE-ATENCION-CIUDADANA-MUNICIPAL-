<?php
    function ConectarDB(){
        $db = mysqli_connect("localhost","root","root", "gobierno_municipal");
        if(!$db){
            echo "No se pudo conectar la base de datos";
            exit;
        }
        return $db;
    }
?>