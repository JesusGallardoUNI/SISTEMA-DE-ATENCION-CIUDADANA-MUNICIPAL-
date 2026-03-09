<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    $ID_EMPLEADO = $_SESSION['ID_Empleado'];
    $Empleado = "SELECT * FROM secretarias WHERE id = {$ID_EMPLEADO};";
    $Busca = mysqli_query($db,$Empleado);
    if($Busca->num_rows){
        $Datos = mysqli_fetch_assoc($Busca);
        $Telefono = $Datos['Telefono'];
        $Correo = $Datos['Correo'];
        $Departamento = $Datos['Departamento'];

    }
?>

<h1 class="TextoCentrado ColorFondo">Solicitud de cambio de puesto</h1>
<form action="" class="ContenidoCentrado" id="Cambio">

    <div>
        <label for="F_Actual">Fecha actual:</label>
        <input type="date" id="F_Actual" readonly required>
    </div>
    <div>
        <label for="NombreCompleto">Nombre Completo:</label>
        <input type="text" value="<?php echo $_SESSION['NombreCompleto'];?>" id="NombreCompleto" readonly required>
    </div>
    <div>
        <label for="Telefono">Telefono:</label>
        <input type="number" value="<?php echo $Telefono ;?>" id="Telefono"readonly required>
    </div>
    <div>
        <label for="Correo">Correo:</label>
        <input type="email" value="<?php echo $Correo ;?>" id="Correo">
    </div>
    <div>
        <label for="CargoActual">Cargo actual</label>
        <input type="text" value="<?php echo Traductor($Departamento);?>" name="" id="CargoActual">
    </div>
    <div>
        <label for="Motivo">Motivos:</label>
        <textarea name="" id="Motivo" rows="4"></textarea>
    </div>
    <div>
        <label for="">El cambio sera permantente</label>
        <select name="" id="cambio">
            <option value="" selected disabled>Seleccione una opcion</option>
            <option value="si">si</option>
            <option value="no">no</option>
        </select>
    </div>
    <div>
        <label for="">Selecciona dependencia que quieres cambiar</label>
        <select id="reporte" name="reporte" required>
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