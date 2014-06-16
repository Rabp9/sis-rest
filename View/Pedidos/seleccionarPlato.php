<?php
    session_start();
    $submit = "platos";
    require_once('../../Controller/RegistrarPedidoController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Seleccionar Plato</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
        <script type="text/javascript">
            $(document).on('pagebeforeshow', "#seleccionarPlatos", function(){       
                $("a.plato").click(function(e) {
                    e.preventDefault();
                    var cantidad = $("#nmbCantidad").val();
                    var idPlato = $(this).find("input").val();
                    window.location= "Pedido.php?idPlato=" + idPlato + "&cantidad=" + cantidad;
                }); 
            });
        </script>
    </head>
    <body>
        <div data-role="page" id="seleccionarPlatos" data-theme="a">
            <div data-role="header">
                <a href="<?php if($_SESSION["rol"] == "mozo") echo "seleccionarCliente.php"; elseif($_SESSION["rol"] == "cliente") echo "index.php"; ?>" data-icon="back">Atrás</a>
                <h1>Seleccionar Plato</h1>
            </div>
            <div data-role="content">
                <div data-role="fieldcontain">
                    <label for="nmbCantidad">Cliente: </label> 	
                    <span><?php echo $_SESSION["cliente"]["nombreCompleto"]; ?></span>
                </div>
                <div data-role="fieldcontain">
                    <label for="nmbCantidad">Cantidad:</label> 	
                    <input type="range" name="cantidad" width="100px" id="nmbCantidad" step="1" min="1" max="20" data-popup-enabled="true"  value="1" />
                </div>
                <ul data-role="listview" data-inset="true">
                    <?php
                    if(!is_array($platos)) {
                        echo "Ningún plato registrado en el sistema";
                    }
                    else {
                        foreach ($platos as $plato) {
                    ?>
                    <li>
                        <a class="plato" href="#">
                            <input type="hidden" value="<?php echo $plato["idPlato"]; ?>" />
                            <img src="../../resources/img/platos/<?php echo $plato["foto"];?>">
                            <?php echo $plato["descripcion"]; ?>
                            <span class="ui-li-count"><?php echo $plato["precio"]; ?></span>
                        </a>
                    </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>