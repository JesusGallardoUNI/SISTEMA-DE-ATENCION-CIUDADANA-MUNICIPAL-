<?php
    function Seguridad (): bool {
        session_start();
        $InicioSession = $_SESSION['login'];
        if($InicioSession){
            return true;
        }else{
            return false;
        }
    }
?>