<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Ayuntamiento.php');
    }
    $db = ConectarDB();
    //$Personal = Tabla("secretarias");

    //Me trae todo el personal de las secretarias 
    $Personal = "SELECT s.id_encargado, s.Departamento, CONCAT(s.Nombres, ' ', s.Apellidos) AS 'NombreCompleto', COUNT(r.id_encargado) AS Resueltos FROM secretarias s LEFT JOIN reportes_colonias r ON s.id_encargado = r.id_encargado WHERE r.resuelto = 'si' GROUP BY s.id_encargado;";
    $Buscar = mysqli_query($db,$Personal);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Personal registrado</title>
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../../Ayuntamiento.css">
</head>

<body>
    <?php Banner(true,"../../../Recursos/Imagenes/icono.png","Secretarias","Listado de personal dado de alta"); ?>
    
    <main>
        <table class="Configurar">
            <thead>
                <tr>
                    <th>id</th>
                    <th>puesto</th>
                    <th>nombre completo</th>
                    <th>reportes atentidos</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php while($Miembro = mysqli_fetch_assoc($Buscar)): ?>
                    <tr>
                        <td><?php echo $Miembro['id_encargado'];?></td>
                        <td><?php echo Traductor($Miembro['Departamento']);?></td>
                        <td><?php echo $Miembro['NombreCompleto'];?></td>
                        <td><?php echo $Miembro['Resueltos'];?></td>
                        <td><a href="Particular.php?id=<?php echo $Miembro['id_encargado'];?>" class="BOTON BTN__Color_Verde">Ver historial</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <div>
        <button onclick="location.href='../MunicipioInforme.php'">Volver a la página principal</button>
    </div>

<script src="../../Ayuntamiento.js"></script>
<script src="../../../Recursos/JS/General.js"></script>
</body>

</html>