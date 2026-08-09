<?php
    require_once __DIR__ . "/../Informacion.php";
    date_default_timezone_set('America/Mexico_City');


    //Aplica para servidores publicos y el alcalde
    function Seguridad (): bool {
        session_start();
        $InicioSession = $_SESSION['login'];
        if($InicioSession){
            return true;
        }else{
            return false;
        }
    }


    //Retorna la cantidad de registros de una tabla culla columna tenga un valor determinado
    //Pide 3 parametros [TABLA, COLUMNA, VALOR]
    function Total(string $TABLA, string $COLUMNA, $VALOR){
        $db = ConectarDB();
        $Contador = "SELECT COUNT(*) AS 'TOTAL' FROM {$TABLA} WHERE {$COLUMNA} = '{$VALOR}';";
        $Ejecutar = mysqli_query($db, $Contador);
        if($Ejecutar){
            $Numero = mysqli_fetch_assoc($Ejecutar);
            echo $Numero['TOTAL'];
        } else{
            echo "0";
        }
    }

    function Tabla(string $nombre){
        $db = ConectarDB(); 
        $Consulta = "SELECT * FROM $nombre;";
        $Ejecucion = mysqli_query($db,$Consulta);
        if($Ejecucion) {
            return $Ejecucion;
        }    
    }

    function TiempoTotal($Fecha, $opcion=false) {
        $Original = new DateTime($Fecha);
        $Actual = new DateTime(); // La actual
        $Tiempo = date_diff($Actual, $Original);

        $Retraso = $Tiempo->days;
        if($opcion) {
            return $Retraso;
        }

        if($Retraso <= 3){
            $color = "FondoVerde";

        }elseif($Retraso <= 7){
            $color = "FondoAmarillo";

        }elseif($Retraso <= 12){
            $color = "FondoNaranja";

        }else{
            $color = "FondoRojo";
        }
        SemaforoResuelto($Retraso, $color);

        /*
        switch($Retraso){
            case($Retraso <= 3):
                SemaforoResuelto($Retraso, "FondoVerde");
            break;

            case($Retraso >= 4 && $Retraso <= 7 ):
                SemaforoResuelto($Retraso, "FondoAmarillo");
            break;

            case($Retraso >= 8 && $Retraso <= 12 ):
                SemaforoResuelto($Retraso, "FondoNaranja");
            break;

            case($Retraso > 12):
                SemaforoResuelto($Retraso, "FondoRojo");
            break;

            default: 
                SemaforoResuelto($Retraso, "FondoNegro");
                break;

        }
        */

    }

    function ColorSemaforo($Fecha){
        $Original = new DateTime($Fecha);
        $Actual = new DateTime(); // La actual
        $Tiempo = date_diff($Actual, $Original);
        $Retraso = $Tiempo->days-1;
        switch($Retraso){
            case($Retraso <= 3 ):
                return "FondoVerde";
            break;

            case($Retraso >= 4 && $Retraso <= 7 ):
                return "FondoAmarillo";
            break;

            case($Retraso >= 8 && $Retraso <= 12 ):
                return "FondoNaranja";
            break;

            case($Retraso > 12):
                return "FondoRojo";
            break;

            default: 
                return "FondoNegro";
                break;
        }
    }

    //Retorna el total de cierto tipo de reporte con base en si estan resueltos o no;
    function Estadistica(int $tipo , string $resuelto) {
        $db = ConectarDB();
        $Reporte1 = "SELECT COUNT(*) AS 'Total' FROM reportes_colonias WHERE tipo_reporte = $tipo AND resuelto = '{$resuelto}';";
        $R = mysqli_query($db,$Reporte1);
        if ($R && $Total = mysqli_fetch_assoc($R)) {
            return $Total['Total'];
        } else {
            return int(0);
        }
    }

    //Retorna el total de cierto tipo de reporte con base en si estan descartados o no;
    function Descartados(int $tipo , string $descartado) {
        $db = ConectarDB();
        $Reporte1 = "SELECT COUNT(*) AS 'Total' FROM reportes_colonias WHERE tipo_reporte = $tipo AND descartado = '{$descartado}';";
        $R = mysqli_query($db,$Reporte1);
        if ($R && $Total = mysqli_fetch_assoc($R)) {
            return $Total['Total'];
        } else {
            return int(0);
        }
    }

    //Retorna el total de gasto de cierto tipo de reporte con base en si estan resueltos;
    function EstadisticaGasto(int $tipo) {
        $db = ConectarDB();
        $Reporte1 = "SELECT COALESCE(SUM(costo), 0) AS Total FROM reportes_resueltos WHERE tipo_reporte = $tipo;";
        $R = mysqli_query($db,$Reporte1);
        if ($R && $Total = mysqli_fetch_assoc($R)) {
            return $Total['Total'];
        } else {
            return "0";
        }
    }

    //Retorna total de reportes de todos los tipos donde se encuentre en cada colonia del total o parcial de Guadalupe
    function Particular(int $cantidad){
        $filtro = ($cantidad === 1) ? "LEFT" : "INNER";

        $db = ConectarDB();
        $RP = "SELECT 
            colonias_guadalupe.nombre,

            COALESCE(SUM(CASE 
                WHEN reportes_resueltos.tipo_reporte = 2 
                THEN reportes_resueltos.costo 
                ELSE 0 
            END), 0) AS gasto_tipo_2,

            COALESCE(SUM(CASE 
                WHEN reportes_resueltos.tipo_reporte = 3 
                THEN reportes_resueltos.costo 
                ELSE 0 
            END), 0) AS gasto_tipo_3,

            COALESCE(SUM(CASE 
                WHEN reportes_resueltos.tipo_reporte = 4 
                THEN reportes_resueltos.costo 
                ELSE 0 
            END), 0) AS gasto_tipo_4,

            COALESCE(SUM(CASE 
                WHEN reportes_resueltos.tipo_reporte = 7 
                THEN reportes_resueltos.costo 
                ELSE 0 
            END), 0) AS gasto_tipo_7,

            COALESCE(SUM(CASE 
                WHEN reportes_resueltos.tipo_reporte = 8 
                THEN reportes_resueltos.costo 
                ELSE 0 
            END), 0) AS gasto_tipo_8

        FROM colonias_guadalupe
        {$filtro} JOIN reportes_resueltos
            ON colonias_guadalupe.nombre = reportes_resueltos.nombre

        GROUP BY colonias_guadalupe.nombre
        ORDER BY colonias_guadalupe.nombre ASC;";
        //echo $RP;  //Muestra todo el query
        $resultado = mysqli_query($db, $RP);

        $datos = [];

        if($resultado){            
            while ($fila = mysqli_fetch_assoc($resultado)) {
                //echo " Colonia: " . $fila['nombre'] .  " \t Gasto: $" . $fila['Gasto'] . "<br>";
                $datos[] = $fila;
            }
        } else {
            return "No hay registros";
        }
        return $datos;
    }

    //Convierte el numero en su equivalencia textual
    function Traductor(int $Muestra) {
        $Resultado = "";
        switch($Muestra){
            case 1: $Resultado = "Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales"; break;
            case 2: $Resultado = "Alumbrado público"; break;
            case 3: $Resultado = "Limpia, recolección, traslado, tratamiento y disposición final de residuos"; break;
            case 4: $Resultado = "Mercados y centrales de abasto"; break;
            case 5: $Resultado = "Panteones"; break;
            case 6: $Resultado = "Rastro"; break;
            case 7: $Resultado = "Calles, parques y jardines y su equipamiento"; break;
            case 8: $Resultado = "Seguridad pública, policía preventiva municipal y tránsito"; break;
            default:
                $Resultado = "Reporte desconocido"; break;
        }
        return $Resultado;
    }


    //Esto es para ReporteCivil y genera una clave aleatoria mas simple
    function generarClave($longitud = 8) {
        $caracteres = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789';
        $max = strlen($caracteres) - 1;
        $clave = '';

        for ($i = 0; $i < $longitud; $i++) {
            $clave .= $caracteres[random_int(0, $max)];
        }

        return $clave;
    }
?>






<?php
    function Banner (/*Esta parte indica la imagen (opcional)*/

                        //determina si se muestra o no una imagen
                        bool $Imagen = false,
                        //pide la direccion de la imagen
                        string $url="", 

                        /*Esta parte indica la informacion*/
                        string $titulo="Municipio de Guadalupe", 
                        string $Contexto="", 

                        /*Esta parte indica el boton de salida (opcional)*/
                        //Aqui determina si se crea o no el boton
                        bool $Boton = false, 

                        //Aqui te pide la direccion de la imagen
                        string $Salida="",

                        //Aqui te manda a la pagina de inicio, depende del tipo de usuario
                        string $Direccion=""
                    ) {
        ?>
            <header>
                <?php if($Imagen){ ?>
                        <img src="<?php echo $url ;?>" alt="Logo" class="logo">
                <?php } ?>
                <div>
                    <h1 id="HeaderTitulo"><?php echo $titulo ?></h1>
                    <h2 id="HeaderSubtitulo"><?php echo $Contexto ?></h2>
                </div>
                <?php if($Boton){ ?>
                    <div class="Salir">
                        <img src="<?php echo $Salida ;?>" alt="">
                        <a href="<?php echo $Direccion ;?>" class="">Cerrar sesión</a>
                    </div>
                <?php } ?>
            </header>
        <?php
    }
?>

<?php
    function Footer (bool $imagen, string $url, string $titulo="Municipio de Guadalupe", string $Contexto="") {
        ?>
            <footer class="Footer_Creditos">
                <?php if($imagen){ ?>
                    <img src="<?php echo $url;?>" alt="Logo" class="logo">
                <?php } ?>
                
                <div>
                    <h4><?php echo $titulo ?></h4>
                    <h4><?php echo $Contexto ?></h4>
                </div>
            </footer>
        <?php
    }
?>

<?php
    function SemaforoResuelto ($DIAS, string $COLOR) {
        ?>
            <div class="Tiempo <?php echo $COLOR ;?>">
                <?php echo $DIAS; ?>
            </div>
        <?php
    }
?>


<?php 
    function Opcion6() {
        if($_SESSION['usuario_tipo'] == "Alcalde"){
            ?>
                <div class="opcion">
                    <a href="ColoniasAjustes/Mostrar.php">
                        <img src="../../Recursos/SVG/ModificarColonia.svg" alt="Modifica las propiedades de las colonias">
                    </a>
                    <p>Mostrar colonias</p>
                </div>
        <?php } ;?>
    <?php }
?>

<?php 
    function Opcion9() {
        if($_SESSION['usuario_tipo'] == "Alcalde"){
            ?>
                <div class="opcion">
                    <a href="Inteligencia/AutoReparacion.php">
                        <img src="../../Recursos/SVG/opcion9.svg" alt="Asistencia con IA" class="FondoRojo">
                    </a>
                    <p>Asistencia de IA</p>
                </div>
        <?php } ;?>
    <?php }
?>
