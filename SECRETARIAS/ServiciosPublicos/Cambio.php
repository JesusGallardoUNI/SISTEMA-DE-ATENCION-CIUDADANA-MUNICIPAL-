<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    $ID_EMPLEADO = $_SESSION['ID_Empleado'];
    $Empleado = "SELECT * FROM secretarias WHERE id_encargado = {$ID_EMPLEADO};";
    $Busca = mysqli_query($db,$Empleado);
    if($Busca->num_rows){
        $Datos = mysqli_fetch_assoc($Busca);
        $Telefono = $Datos['Telefono'];
        $Correo = $Datos['Correo'];
        $Departamento = $Datos['Departamento'];
    }
    //Ahora agregar la funcion para subir la informacion a la base de datos
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        


        $VAL1 = mysqli_real_escape_string($db, $_POST["F_Actual"]);
        $VAL2 = mysqli_real_escape_string($db, $_POST["NombreCompleto"]);
        $VAL3 = mysqli_real_escape_string($db, $_POST["CargoActual"]);
        $VAL4 = mysqli_real_escape_string($db, $_POST["CargoCambio"]);
        $VAL5 = mysqli_real_escape_string($db, $_POST["Permanente"]);
        $VAL6 = mysqli_real_escape_string($db, $_POST["Motivo"]);
        $Solicitud = "INSERT INTO solicitud_cambios (fecha, id_empleado, nombre, cargo_actual, cargo_nuevo,	cambio_permanente, motivos) VALUES ('$VAL1','$ID_EMPLEADO','$VAL2','$VAL3','$VAL4','$VAL5','$VAL6');";
        $Accion = mysqli_query($db, $Solicitud);
        if($Accion){
            header("LOcation: SecretariaServiciosPublicos.php");
        }
    }
?>

<h1 class="TextoCentrado ColorFondo">Solicitud de cambio de puesto</h1>
<form action="Cambio.php" class="ContenidoCentrado" id="Cambio" method="POST">

    <div>
        <label for="F_Actual">Fecha actual:</label>
        <input type="date" value="<?php echo date('Y-m-d'); ?>" id="F_Actual" name="F_Actual" readonly required>
    </div>
    <div>
        <label for="NombreCompleto">Nombre Completo:</label>
        <input type="text" value="<?php echo $_SESSION['NombreCompleto'];?>" id="NombreCompleto" name="NombreCompleto" readonly required>
    </div>
    <div>
        <label for="Telefono">Telefono:</label>
        <input type="number" value="<?php echo $Telefono ;?>" id="Telefono" readonly required>
    </div>
    <div>
        <label for="Correo">Correo:</label>
        <input type="email" value="<?php echo $Correo ;?>" id="Correo" name="Correo" readonly required>
    </div>
    <div>
        <label for="CargoActual">Cargo actual</label>
        <input type="hidden" name="CargoActual" value="<?php echo $Departamento;?>">
        <input type="text" value="<?php echo Traductor($Departamento);?>" id="CargoActual" readonly required>
    </div>
    <div>
        <label for="Motivo">Motivos:</label>
        <textarea name="Motivo" id="Motivo" rows="4"></textarea>
    </div>
    <div>
        <label for="Permanente">El cambio sera permantente</label>
        <select name="Permanente" id="Permanente">
            <option value="" selected disabled>Seleccione una opcion</option>
            <option value="si">si</option>
            <option value="no">no</option>
        </select>
    </div>
    <div>
        <label for="CargoCambio">Selecciona dependencia que quieres cambiar</label>
        <select id="CargoCambio" name="CargoCambio" required>
            <option value="" selected disabled>Seleccione dependencia</option>
            <!-- <option value="1">Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales</option> -->
            <option value="2">Alumbrado público</option>
            <option value="3">Limpia, recolección, traslado, tratamiento y disposición final de residuos</option>
            <option value="4">Mercados y centrales de abasto</option>
            <!-- <option value="5">Panteones</option> -->
            <!-- <option value="6">Rastro</option> -->
            <option value="7">Calles, parques y jardines y su equipamiento</option>
            <option value="8">Seguridad pública, policía preventiva municipal y tránsito</option>
        </select>
    </div>
    <input type="submit" value="Enviar peticion">
</form>