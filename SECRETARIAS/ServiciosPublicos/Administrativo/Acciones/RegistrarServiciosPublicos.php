<?php
    include "../../../../Recursos/Partes/Partes.php";
   /*
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../GobiernoMunicipal.php');
    }
   */
    $db = ConectarDB();


    $ListaAreas = Tabla("secretarias");

    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        //
        $seccion = mysqli_real_escape_string($db, $_POST["Seccion"] ?? ''); 
        $Secretaria = mysqli_real_escape_string($db, $_POST["Secretaria"] ?? ''); 
        $Problema = mysqli_real_escape_string($db, $_POST["servicio"] ?? '');  //Problema
        $Encargado = mysqli_real_escape_string($db, $_POST["Encargado"] ?? '');  //Encargado

        $Query = "INSERT INTO reportes_especificacion(seccion, secretaria_nombre, problema, encargado) VALUES('$seccion', '$Secretaria', '$Problema', '$Encargado')";
        $Ejecutar = mysqli_query($db, $Query);
        if($Ejecutar){
            //Muestra alerta y regresa al menu principal
            header("Location: ../Administracion.php");
        }
    }


?>

<form action="Acciones/RegistrarServiciosPublicos.php" method="POST">
    <div>
        <label for="Seccion">Sección de reporte que se quiere registrar:</label>
        <select id="Seccion" name="Seccion" required>
            <option value="" selected disabled>Seleccione un tipo de reporte</option>
            <option value="1">Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales</option>
            <option value="2">Alumbrado público</option>
            <option value="3">Limpia, recolección, traslado, tratamiento y disposición final de residuos</option>
            <option value="4">Mercados y centrales de abasto</option>
            <option value="5">Panteones</option>
            <option value="7">Calles, parques y jardines y su equipamiento</option>
            <option value="8">Seguridad pública, policía preventiva municipal y tránsito</option>
        </select>
    </div>
    <div>
        <label for="Secretaria">Secretaria:</label>
        <input type="text" class="No_Contestar" name="Secretaria" id="Secretaria" value="Servicios Públicos" readonly>
    </div>
    <div>
        <label for="servicio">Ingresa el servicio o reporte por atender:</label>
        <input type="text" name="servicio" id="servicio">
    </div>
    <div>
        <label for="Encargado">Area encargada:</label>
        <select id="Encargado" name="Encargado" required>
            <option value="" selected disabled>Seleccione un area</option>        
            <?php while($Area = mysqli_fetch_assoc($ListaAreas)):  ?>
                <option value="<?php echo $Area['area_encargada'] ?>" title="<?php echo $Area['area_encargada'] ?>"><?php echo $Area['area_encargada'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <input type="submit" value="Registrar">
</form>