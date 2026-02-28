<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    //=======================================================//
    //  Aqui empiezo a buscar todos los reportes necesarios  //
    //=======================================================//
    $Buscar = "SELECT * FROM reportes_colonias WHERE resuelto != 'si' AND tipo_reporte = {$_SESSION['usuario_tipo']}";
    $Ejecutar = mysqli_query($db,$Buscar);
?>

<h1 class="TextoCentrado ColorFondo">Solicitud de cambio de puesto</h1>
<form action="" class="ContenidoCentrado">

    <div>
        <label for="">Fecha actual:</label>
        <input type="date">
    </div>
    <div>
        <label for="">Nombre Completo:</label>
        <input type="text" readonly required>
    </div>
    <div>
        <label for="">Cargo actual</label>
        <input type="text" name="" id="">
    </div>
    <div>
        <label for="">Motivos:</label>
        <textarea name="" id="" rows="3"></textarea>
    </div>
    <div>
        <label for="">El cambio sera permantente</label>
        <select name="" id="">
            <option value=""></option>
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