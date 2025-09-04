<?php
    function Banner (string $titulo="Municipio de Guadalupe", string $Contexto="") {
        ?>
            <header>
                <img src="../Imagenes/icono.png" alt="Logo" class="logo">
                <div>
                    <h1><?php echo $titulo ?></h1>
                    <h2><?php echo $Contexto ?></h2>
                </div>
            </header>
        <?php
    }
?>




<?php
    function Footer (string $titulo="Municipio de Guadalupe", string $Contexto="") {
        ?>
            <footer>
                <img src="/Recursos/Imagenes/icono.png" alt="Logo" class="logo">
                <div>
                    <h1><?php echo $titulo ?></h1>
                    <h2><?php echo $Contexto ?></h2>
                </div>
            </footer>
        <?php
    }
?>