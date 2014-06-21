<?php
    session_start();
    require_once('../../Controller/AtenderPedidoController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Pedido <?php echo $pedido["idPedido"]; ?></title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="pedidoDetalle" data-theme="a" data-add-back-btn="true" data-back-btn-text="Atrás" >
            <div data-role="header">
                <h1>Pedido <?php echo $pedido["idPedido"]; ?></h1>
            </div>
            <div data-role="content">
                <div data-role="fieldcontain">
                    <label for="txtCliente">Cliente:</label>
                    <input type="text" name="cliente" id="txtCliente" value="<?php echo $pedido["cliente"]; ?>" readonly />
                </div>
                <div data-role="fieldcontain">
                    <label for="txtMesa">Mesa:</label>
                    <input type="text" name="mesa" id="txtMesa" value="<?php echo $pedido["mesa"]; ?>" readonly />
                </div>
                <div data-role="fieldcontain">
                    <label for="txtMozo">Mozo:</label>
                    <input type="text" name="mozo" id="txtMozo" value="<?php echo $pedido["mozo"]; ?>" readonly />
                </div>
                <div data-role="fieldcontain">
                    <label for="txtImporteTotal">Importe Total:</label>
                    <input type="text" name="importeTotal" id="txtImporteTotal" value="<?php echo $pedido["importeTotal"]; ?>" readonly />
                </div>
                <table data-role="table" class="ui-responsive" data-split-icon="delete">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!is_array($detallePedidos)) {
                            echo "<td colspan='7'><center>No hay registrado ningún Producto</center></td></tr>";
                        }
                        else {
                            foreach ($detallePedidos as $detallePedido) {
                        ?>
                        <tr>
                            <td><?php echo $detallePedido["producto"]; ?></td>
                            <td><?php echo $detallePedido["precio"]; ?></td>
                            <td><?php echo $detallePedido["cantidad"]; ?></td>
                            <td><?php echo $detallePedido["importe"]; ?></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <?php if($pedido["estado"] == 2) { ?>
                <div data-role="fieldcontain">
                    <a href="../../Controller/AtenderPedidoController.php?submit=boleta&idPedido=<?php echo $pedido["idPedido"]; ?>" data-ajax="false"><button>Generar Boleta</button></a>
                </div>
                <?php } ?>
                <?php if($_SESSION["rol"] == "jefecocina" && $pedido["estado"] != 2) { ?>
                <div data-role="fieldcontain">
                    <a href="../../Controller/AtenderPedidoController.php?submit=atender&idPedido=<?php echo $pedido["idPedido"]; ?>" data-ajax="false"><button>Atender Pedido</button></a>
                </div>
                <?php } ?>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>