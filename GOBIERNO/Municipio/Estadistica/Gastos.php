<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Ayuntamiento.php');
    }
?>


<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gastos en obra publica</title>
        <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
        <link rel="stylesheet" href="../../Ayuntamiento.css">
        

        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css" />
    </head>
    <body id="Gastos">
        <?php Banner(true,"../../../Recursos/Imagenes/icono.png", "Municipio de Guadalupe" ,"Datos sobre los gastos aplicados a los reportes"); ?>

        <!--Aqui se usa la libreria datatables-->
        <table class="Configurar" id="myTable">
            <thead>
                <tr>
                    <th>Colonia</th>
                    <th><?php echo Traductor(2)?></th>
                    <th><?php echo Traductor(3)?></th>
                    <th><?php echo Traductor(4)?></th>
                    <th><?php echo Traductor(7)?></th>
                    <th><?php echo Traductor(8)?></th>
                    <th>Total de presupuesto ejercido</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $registros = Particular(0); // trae el arreglo 0 para colonias aplicadas 1 para todo
                    foreach ($registros as $fila) {
                        ?>
                            <tr>
                                <td><?= $fila['nombre'] ?></td>
                                <td>$<?= $fila['gasto_tipo_2'] ?? 0 ?></td>
                                <td>$<?= $fila['gasto_tipo_3'] ?? 0 ?></td>
                                <td>$<?= $fila['gasto_tipo_4'] ?? 0 ?></td>
                                <td>$<?= $fila['gasto_tipo_7'] ?? 0 ?></td>
                                <td>$<?= $fila['gasto_tipo_8'] ?? 0 ?></td>
                                <td>$<?= $fila['gasto_tipo_2'] + $fila['gasto_tipo_3'] + $fila['gasto_tipo_4'] + $fila['gasto_tipo_7'] + $fila['gasto_tipo_8'] ?? 0 ?></td>
                            </tr>
                        <?php } 
                    ?>
                
            </tbody>
        </table>


        <table class="Configurar">
            <thead>
                <tr>
                    <th>Servicios públicos</th>
                    <th><?php echo Traductor(2)?></th>
                    <th><?php echo Traductor(3)?></th>
                    <th><?php echo Traductor(4)?></th>
                    <th><?php echo Traductor(7)?></th>
                    <th><?php echo Traductor(8)?></th>
                    <th>Total de presupuesto ejercido</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gasto total</td>
                    <td>$<?php echo EstadisticaGasto(2); ?></td>
                    <td>$<?php echo EstadisticaGasto(3); ?></td>
                    <td>$<?php echo EstadisticaGasto(4); ?></td>
                    <td>$<?php echo EstadisticaGasto(7); ?></td>
                    <td>$<?php echo EstadisticaGasto(8); ?></td>
                    <td>$<?php echo EstadisticaGasto(2) + EstadisticaGasto(3) + EstadisticaGasto(4) + EstadisticaGasto(7) + EstadisticaGasto(8); ?></td>
                </tr>
            </tbody>
        </table>
        

        <div>
            <button onclick="location.href='../MunicipioInforme.php'">Volver a la página principal</button>
        </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    <script src="../../Ayuntamiento.js"></script>
                 
    </body>
</html>