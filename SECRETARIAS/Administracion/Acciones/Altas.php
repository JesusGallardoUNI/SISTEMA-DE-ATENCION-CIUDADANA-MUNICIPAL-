<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../AccesoAdministracion.php');
    }
    $db = ConectarDB();
    
    $ListaAreas = Tabla("secretarias");
    

    //====================================================//
    //  Aqui subo la informacion del reporte ya resuelto  //
    //====================================================//
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        
        $Val1 = mysqli_real_escape_string($db,$_POST["Nombres"]);
        $Val2 = mysqli_real_escape_string($db,$_POST["Apellidos"]);
        $Val3 = mysqli_real_escape_string($db,$_POST["Edad"]);
        $Val4 = mysqli_real_escape_string($db,$_POST["Sexo"]);
        $Val5 = mysqli_real_escape_string($db,$_POST["FDN"]);
        $Val6 = mysqli_real_escape_string($db,$_POST["Telefono"]);
        $Val7 = mysqli_real_escape_string($db,$_POST["Area_Encargada"]);
        $ListaBusca = "SELECT * FROM secretarias WHERE area_encargada = '$Val7';";
        $Ejecuta_Lista = mysqli_query($db,$ListaBusca);
        $Total = mysqli_fetch_assoc($Ejecuta_Lista);
        
        $Secretaria = $Total['secretaria_nombre'];
        $Val8 = mysqli_real_escape_string($db,$_POST["Correo"]);
        $Val9 = mysqli_real_escape_string($db,$_POST["Contra"]);

        //Determinar si es administrativo o no
        $Val10 = mysqli_real_escape_string($db,$_POST["Administrativo"]);

        //$Val10 = mysqli_real_escape_string($db,$_POST[""]);

        $SubirSolucion = "INSERT INTO secretarias_cuentas (Nombres, Apellidos, Edad, Sexo, FDN, Telefono, Nombre_Secretaria, Area_Encargada, Correo, Acceso, Administrativo) VALUES ('$Val1','$Val2',$Val3,'$Val4','$Val5',$Val6,'$Secretaria', '$Val7','$Val8','$Val9', '$Val10');";        
        $Informar = mysqli_query($db,$SubirSolucion);
        

        if($Informar){
            header("Location: ../Inicio.php");
        }
    }
?>


<form method="POST" action="Acciones/Altas.php" id="Altas_Formulario" >
    <fieldset>
        <!--Nombres-->
        <div>
            <label for="Nombres">Ingresa sus nombres: </label>
            <input type="text" id="Nombres" name="Nombres" required>
        </div>
        <!--Apellidos-->
        <div>
            <label for="Apellidos">Ingresa sus apellidos: </label>
            <input type="text" id="Apellidos" name="Apellidos" required>
        </div>
        <!--Edad-->
        <div>
            <label for="Edad">Edad: </label>
            <input type="number" id="Edad" name="Edad" required>
        </div>
        <!--Sexo-->
        <div>
            <label for="Sexo">Sexo: </label>
            <select name="Sexo" id="Sexo" required>
                <option value="" selected disabled>Ingrese el sexo</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
        </div>
        <!--Fecha de nacimiento-->
        <div>
            <label for="FDN">Fecha de nacimiento: </label>
            <input type="date" name="FDN" id="FDN" required>
        </div>
    </fieldset>
    <hr>
    <fieldset>
    <!--Telefono-->
        <div>
            <label for="Telefono">Telefono de identificacion: </label>
            <input type="number" id="Telefono" name="Telefono" required>
        </div>
        <!--Departamento-->
        <div>
            <label for="Area_Encargada">Selecciona el departamento a asignar</label>
            <select name="Area_Encargada" id="Area_Encargada" required>
                <option value="" selected disabled>Seleccione un area</option>        
                <?php while($Area = mysqli_fetch_assoc($ListaAreas)):  ?>
                    <option value="<?php echo $Area['area_encargada'] ?>" title="<?php echo $Area['area_encargada'] ?>"><?php echo $Area['area_encargada'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <!--Correo-->
        <div>
            <label for="Correo">Correo de usuario a crear: </label>
            <input type="text" name="Correo" id="Correo" required>
        </div>
        <!--Contraseña-->
        <div>
            <label for="Contra">Contraseña a ingresar: </label>
            <input type="password" id="Contra" name="Contra" required>
        </div>
        <!--Administrativo-->
        <div>
            <label for="Contra">Administrativo</label>
            <select name="Administrativo" id="Administrativo" required>
                <option selected disabled>Ingresa una opcion</option>
                <option value="si">si</option>
                <option value="no">no</option>
            </select>
        </div>
    </fieldset>
    <br>
    <input type="submit" value="Registar">
    <a href="SecretariaAdministracion.php" class="BOTON BTN__Color_Verde">Regresar</a>
</form>