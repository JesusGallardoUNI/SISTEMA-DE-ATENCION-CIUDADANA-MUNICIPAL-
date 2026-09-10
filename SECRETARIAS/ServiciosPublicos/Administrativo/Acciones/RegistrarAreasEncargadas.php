<?php
    include "../../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    $ListaAreas = Tabla("secretarias");
    $Secretaria = $_SESSION['Secretaria'];
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        //
        $Secretaria = mysqli_real_escape_string($db, $_POST["Secretaria"] ?? ''); 
        $Area = mysqli_real_escape_string($db, $_POST["Area"] ?? '');  //Problema

        $Query = "INSERT INTO secretarias(nombre_secretaria, area_encargada) VALUES('$Secretaria', '$Area')";
        $Ejecutar = mysqli_query($db, $Query);
        if($Ejecutar){
            //Muestra alerta y regresa al menu principal
            header("Location: ../Administracion.php");
        }
    }


?>

<form action="Acciones/RegistrarAreasEncargadas.php" method="POST" id="RegistrarAreasEncargadas">
    <div>
        <label for="Secretaria">Secretaria:</label>
        <input type="text" class="No_Contestar" name="Secretaria" id="Secretaria" value="<?php echo $Secretaria; ?>" readonly>
    </div>
    <div>
        <label for="Area">Registrar area encargada:</label>
        <input type="text" name="Area" id="Area">
    </div>
    <input type="submit" value="Registrar">
</form>