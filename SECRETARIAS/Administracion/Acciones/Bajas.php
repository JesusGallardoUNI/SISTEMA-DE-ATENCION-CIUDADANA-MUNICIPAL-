<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../AccesoAdministracion.php');
    }
    $db = ConectarDB();
    //============================================================//
    //  Aqui empiezo a buscar todos los funcionarios registrados  //
    //============================================================//
    $Buscar = "SELECT * FROM secretarias_cuentas";
    $Ejecutar = mysqli_query($db,$Buscar);

    //========================================//
    //  Este es para eliminar al funcionario  //
    //========================================//
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $Eliminado = mysqli_real_escape_string($db, $_POST['ServidorEliminar']);

        if (!empty($Eliminado)) {
            $EliminarPersona = "DELETE FROM secretarias_cuentas WHERE id_encargado = '$Eliminado'";
            $Eliminar = mysqli_query($db, $EliminarPersona);

            if ($Eliminar) {
                header("Location: ../Inicio.php");
                exit;
            } 
        } else {
            echo "El nombre de la persona a eliminar no puede estar vacío.";
        }
    }
?>


<table class="Configurar Espacio_10">
    <thead>
        <tr>
            <th>Nombre completo</th>
            <th>Telefono</th>
            <th>Secretaria</th>
            <th>Area</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($Registro = mysqli_fetch_assoc($Ejecutar)): ?>
            <tr>
                <td><?php echo $Registro['Nombres'] . " " . $Registro['Apellidos']; ?></td>
                <td><?php echo $Registro['Telefono']; ?></td>
                <td><?php echo $Registro['Nombre_Secretaria']; ?></td>
                <td><?php echo $Registro['Area_Encargada']; ?></td>
                <td>
                    <center>
                        <form method="POST" action="Acciones/Bajas.php" class="elemento W100" id="Bajas">
                            <input type="hidden" name="ServidorEliminar" value="<?php echo $Registro['id_encargado']; ?>">
                            <input type="submit" value="Eliminar" class="BOTON BOTON_CERO BTN__Color_Rojo">
                        </form>
                    </center>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>