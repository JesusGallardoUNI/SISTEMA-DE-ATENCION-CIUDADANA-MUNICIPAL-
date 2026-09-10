<?php
    include "../../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    $ID_EMPLEADO = $_SESSION['ID_Empleado'];
    $Empleado = "SELECT * FROM secretarias_cuentas WHERE id_encargado = {$ID_EMPLEADO};";
    $Busca = mysqli_query($db,$Empleado);


    $ListaOpciones = Tabla("secretarias");

    if($Busca->num_rows){
        $Datos = mysqli_fetch_assoc($Busca);
        $Telefono = $Datos['Telefono'];
        $Correo = $Datos['Correo'];
        $Departamento = $Datos['Area_Encargada'];
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
            header("Location: ../Inicio.php");
        }
    }
?>

<h1 class="TextoCentrado ColorFondo">Solicitud de cambio de puesto</h1>
<form action="Acciones/Cambio.php" class="ContenidoCentrado" id="Cambio" method="POST">

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
        <input type="text" value="<?php echo $Departamento;?>" id="CargoActual" readonly required>
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
            <?php while($Opcion = mysqli_fetch_assoc($ListaOpciones)):  ?>
                <option value="<?php echo $Opcion['area_encargada'] ?>"><?php echo $Opcion['area_encargada'] . " de la " . $Opcion['nombre_secretaria']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <input type="submit" value="Enviar peticion">
</form>