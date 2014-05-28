<?php
    $submit = "index";
    require_once('../../Controller/RegistrarPedidoController.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Registrar Pedido</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="registrarPedido" data-theme="a">
            <div data-role="header">   
                <a href="../../index.php" data-icon="home">Home</a>
                <h1>Registrar Pedido</h1>
            </div>
            <div data-role="content">
                <form action="../../Controller/MantenimientoClienteController.php" method="post" data-ajax="false">
                    <ul data-role="listview" data-role="listview" data-inset="true" data-autodividers="true" data-theme="a" data-divider-theme="a">
                        <!--<li data-role="list-divider" data-theme="a">Lista de Platos</li>-->
                        <?php
                        foreach ($platos as $plato) {
                        ?>
                        <li><a href="#"><?php echo $plato["descripcion"]; ?><span class="ui-li-count"><?php echo $plato["precio"]; ?></span></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </form>
            </div>
            <div data-role="footer" data-position="fixed">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>