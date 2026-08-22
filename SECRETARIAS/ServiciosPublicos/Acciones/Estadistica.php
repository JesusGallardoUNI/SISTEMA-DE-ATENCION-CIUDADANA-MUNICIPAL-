<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    $ID = $_SESSION['ID_Empleado'];
    $Pendientes = "SELECT COUNT(*) AS 'Pendientes' FROM reportes_colonias WHERE id_encargado = $ID AND resuelto = 'no';";
    $PendientesEjecuta = mysqli_query($db,$Pendientes);
    $PendientesMuestra = mysqli_fetch_assoc($PendientesEjecuta);

    $Resueltos = "SELECT COUNT(*) AS 'Resueltos' FROM reportes_colonias WHERE id_encargado = $ID AND resuelto = 'si';";
    $ResueltosEjecuta = mysqli_query($db, $Resueltos);
    $ResueltosMuestra = mysqli_fetch_assoc($ResueltosEjecuta);

    $Descartados = "SELECT COUNT(*) AS 'Descartados' FROM reportes_colonias WHERE id_encargado = $ID AND descartado IS NULL;";
    $DescartadosEjecuta = mysqli_query($db, $Descartados);
    $DescartadosMuestra = mysqli_fetch_assoc($DescartadosEjecuta);
?>


<h1 class="TextoCentrado ColorFondo">Tu rendimiento es: </h1>
<div class="ContenidoCentrado">
    <table class="Configurar Configurar__Local">
        <thead>
            <th>Pendientes</th>
            <th>Resueltos</th>
            <th>Descartados</th>
        </thead>
        <tbody>
            <tr>
                <td><input type="number" value="<?php echo $PendientesMuestra['Pendientes']; ?>" id="Pendientes"></td>
                <td><input type="number" value="<?php echo $ResueltosMuestra['Resueltos'];?>" id="Resueltos"></td>
                <td><input type="number" value="<?php echo $DescartadosMuestra['Descartados'];?>" id="Descartados"></td>
            </tr>
        </tbody>
    </table>
</div>

<div>
    <canvas class="VW25 VH50" id="Estadistica">
    </canvas>
</div>