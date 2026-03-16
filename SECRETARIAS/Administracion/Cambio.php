<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../AccesoAdministracion.php');
    }
    $db = ConectarDB();
    $quiero = $_GET['id'];              //Este es el ID de la solicitud de cambio

    //Obtener los datos de la solicitud de cambio
    $Consulta = "SELECT * FROM solicitud_cambios WHERE id = $quiero;";
    $Resultado = mysqli_query($db, $Consulta);   
    $Empleado = mysqli_fetch_assoc($Resultado);

    //Obtener los datos de la persona que realizo la solicitud de cambio
    $ID = $Empleado['id_empleado'];     //Este es el ID del empleado
    $Persona = "SELECT * FROM secretarias WHERE id_encargado = $ID;";
    $Busca = mysqli_query($db,$Persona);
    $Muestra = mysqli_fetch_assoc($Busca);

    //============================================//
    //  Este es para atender solicitud de cambio  //
    //============================================//
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $VAL1 = mysqli_real_escape_string($db, $_POST["Aprobar"]);
        $VAL2 = mysqli_real_escape_string($db, $_POST["Indicaciones"]);
        $Query = "UPDATE solicitud_cambios SET Aprobado = '$VAL1', indicaciones = '$VAL2' WHERE id = $quiero;";
        $Ejecutar = mysqli_query($db, $Query);
        if($Ejecutar){
            echo "<div id='AlertaSolicitud'></div>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../Recursos/CSS/General.css">
        <title>Actualizacion</title>
        <script src="../../Recursos/JS/General.js"></script>
    </head>
    <body>
        <?php Banner(true,"../../Recursos/Imagenes/icono.png","Gobierno de Guadalupe"); ?>
        
        <h1 class="TextoCentrado ColorFondo">Solicitud de cambio de puesto</h1>
        <form method="POST" enctype="multipart/form-data">
            <fieldset>
                <h3 class="TextoCentrado ColorFondo">Datos de la solicitud y empleado</h3>
                <!--Nombres-->
                <div>
                    <label for="Nombre">Nombre completo: </label>
                    <input type="text" id="Nombre" class="No_Contestar" value="<?php echo $Empleado['nombre']; ?>" readonly required>
                </div>
                <!--Telefono-->
                <div>
                    <label for="Telefono">Telefono: </label>
                    <input type="number" id="Telefono" class="No_Contestar" value="<?php echo $Muestra['Telefono']; ?>" readonly required>
                </div>
                <!--Correo-->
                <div>
                    <label for="Correo">Correo: </label>
                    <input type="email" id="Correo" class="No_Contestar" value="<?php echo $Muestra['Correo']; ?>" readonly required>
                </div>
                <!--Cargo actual-->
                <div>
                    <label for="Cargo">Cargo actual: </label>
                    <input type="text" id="Cargo" class="No_Contestar" value="<?php echo Traductor($Empleado['cargo_actual']);?>" readonly required>
                </div>
                <!--Cargo a cambiar-->
                <div>
                    <label for="CargoCambiar">Cargo a cambiar: </label>
                    <input type="text" id="CargoCambiar" class="No_Contestar" value="<?php echo Traductor($Empleado['cargo_nuevo']);?>" readonly required>
                </div>
                <!--Cambio permanente-->
                <div>
                    <label for="Permanente">La solicitud de cambio sera permanente: </label>
                    <input type="text" id="Permanente" class="No_Contestar" value="<?php echo $Empleado['cambio_permanente'];?>" readonly required>
                </div>
                <!--Motivos-->
                <div>
                    <label for="Motivos">Motivos: </label>
                    <textarea id="Motivos" class="No_Contestar" rows="4" readonly required><?php echo $Empleado['motivos'];?></textarea>
                </div>
            </fieldset>
            <hr>
            <fieldset>
                <h3 class="TextoCentrado ColorFondo">Complete el registro:</h3>
                <div>
                    <label for="Aprobar">Aprobar</label>
                    <select id="Aprobar" name="Aprobar" required>
                        <option disabled selected>Selecciona una opcion</option>
                        <option value="si">si</option>
                        <option value="no">no</option>
                    </select>
                </div>
                <div>
                    <label for="Indicaciones">Indicaciones</label>
                    <textarea id="Indicaciones" name="Indicaciones" rows="4"></textarea>
                </div>
            </fieldset>
            <br>
            <input type="submit" value="Guardar">
            <a href="ListaCambios.php" class="BOTON BTN__Color_Verde">Regresar</a>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><!--Este sirve para mostrar alertas-->
        <script src="../../Recursos/JS/General.js"></script>
    </body>
</html>