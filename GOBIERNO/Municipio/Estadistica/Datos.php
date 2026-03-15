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
        <title>Estadisticas en municipio</title>
        <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
        <link rel="stylesheet" href="../../Ayuntamiento.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body id="Datos">
        <?php Banner(true,"../../../Recursos/Imagenes/icono.png", "Municipio de Guadalupe" ,"Datos estadisticos sobre los reportes"); ?>

        
        <div>
            <table class="Configurar Configurar__Mediano Configurar__Mediano__Centro Configurar__General">
                <thead>
                    <tr>
                        <th>Estado</th>
                        <th><?php echo Traductor(2)?></th>
                        <th><?php echo Traductor(3)?></th>
                        <th><?php echo Traductor(4)?></th>
                        <th><?php echo Traductor(7)?></th>
                        <th><?php echo Traductor(8)?></th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><p class="FondoAmarillo">No resuelto</p></td>
                        <td><input id="Rep2" type="number" readonly value="<?php echo Estadistica(2, "no")?>"></td>
                        <td><input id="Rep3" type="number" readonly value="<?php echo Estadistica(3, "no")?>"></td>
                        <td><input id="Rep4" type="number" readonly value="<?php echo Estadistica(4, "no")?>"></td>
                        <td><input id="Rep7" type="number" readonly value="<?php echo Estadistica(7, "no")?>"></td>
                        <td><input id="Rep8" type="number" readonly value="<?php echo Estadistica(8, "no")?>"></td>
                        <td><input type="number" readonly value="<?php echo Total("reportes_colonias","resuelto","no"); ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="FondoVerde">Si resuelto</p></td>
                        <td><input id="Sol2" type="number" readonly value="<?php echo Estadistica(2, "si")?>"></td>
                        <td><input id="Sol3" type="number" readonly value="<?php echo Estadistica(3, "si")?>"></td>
                        <td><input id="Sol4" type="number" readonly value="<?php echo Estadistica(4, "si")?>"></td>
                        <td><input id="Sol7" type="number" readonly value="<?php echo Estadistica(7, "si")?>"></td>
                        <td><input id="Sol8" type="number" readonly value="<?php echo Estadistica(8, "si")?>"></td>
                        <td><input type="number" readonly value="<?php echo Total("reportes_colonias","resuelto","si"); ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="FondoRojo">Descartado</p></td>
                        <td><input type="number" value="<?php echo Descartados(2, "si")?>" name="Descartado2" id="Descartado2"></td>
                        <td><input type="number" value="<?php echo Descartados(3, "si")?>" name="Descartado3" id="Descartado3"></td>
                        <td><input type="number" value="<?php echo Descartados(4, "si")?>" name="Descartado4" id="Descartado4"></td>
                        <td><input type="number" value="<?php echo Descartados(7, "si")?>" name="Descartado7" id="Descartado7"></td>
                        <td><input type="number" value="<?php echo Descartados(8, "si")?>" name="Descartado8" id="Descartado8"></td>
                        <td><input type="number" value="<?php echo Total("reportes_colonias","descartado","si"); ?>" name="" id=""></td>
                    </tr>
                </tbody>
            </table>
            
            <!--Aqui se usa la libreria chart.js-->
            <canvas id="GrafoEstadistico" class="GrafoEstadistico"></canvas>
        </div>
        

        <div>
            <button onclick="location.href='../MunicipioInforme.php'">Volver a la página principal</button>
        </div>
        <script src="../../Ayuntamiento.js"></script> 
        
    </body>
</html>