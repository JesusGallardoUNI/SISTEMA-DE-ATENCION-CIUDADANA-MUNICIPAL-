<?php
    function ConectarDB(){
        $db = mysqli_connect("localhost","root","", "gobierno_municipal");
        if(!$db){
            http_response_code(500);
            echo json_encode([
                "success" => false,
                "message" => "Error de conexión a la base de datos"
            ]);
            exit;
        }
        return $db;
    }
?>