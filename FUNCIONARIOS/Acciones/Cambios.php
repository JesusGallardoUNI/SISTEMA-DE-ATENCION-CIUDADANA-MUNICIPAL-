<?php

    require "../../Recursos/Partes/Bloqueo.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../AccesoAdministracion.php');
    }

    require "../../Recursos/Informacion.php";
    $db = ConectarDB();
    //============================================================//
    //  Aqui empiezo a buscar todos los funcionarios registrados  //
    //============================================================//
    $Buscar = "SELECT * FROM servidores_publicos";
    $Ejecutar = mysqli_query($db,$Buscar);
    
    //==============================================================================//
    //  Este es para actualizar el nombre de la colonia del municipio de guadalupe  //
    //==============================================================================//
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $Valor1 = mysqli_real_escape_string($db,$_POST['Nombre']);

        //Verificar que ese nombre no exista en la base de datos, si existe no hacer nada, caso contrario si actualiza
        $Existe = "SELECT * FROM colonias_guadalupe WHERE nombre_colonia = '$Valor1'";
        $Resultado = mysqli_query($db, $Existe);
        if(mysqli_num_rows($Resultado) === 0){
            $ActualizarColonia = "UPDATE colonias_guadalupe SET nombre_colonia = '$Valor1' WHERE nombre_colonia = '{$nombre_colonia}'";
            $Actualizar = mysqli_query($db, $ActualizarColonia);
            if($Actualizar){
                header("Location: Mostrar.php");
            }
        }else{
            echo "<script>alert('Este nombre de colonia ya existe en el registro de colonias existentes \\nIngrese otro nombre valido.');</script>";
        }
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../BuscarEstilo.css">
</head>
<body>
    <br><br>
    <a href="../Administracion.php" class="BOTON BTN__Color_Verde">Regresar</a>
    <br><br>
    <div class="Configurar alto">
            <table>
                <thead>
                    <tr>
                        <th>Curp</th>
                        <th>Nombre completo</th>
                        <th>Telefono</th>
                        <th>Departamento</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($Registro = mysqli_fetch_assoc($Ejecutar)): ?>
                        <tr>
                            <td><?php echo $Registro['Curp']; ?></td>
                            <td><?php echo $Registro['Nombres'] . " " . $Registro['Apellidos']; ?></td>
                            <td><?php echo $Registro['Telefono']; ?></td>
                            <td><?php echo $Registro['Departamento']; ?></td>
                            <td>
                                <a href="Actualizar.php?Curp=<?php echo $Registro['Curp']; ?>" class="BOTON BTN__Color_Verde">Cambiar registro</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
</body>
</html>