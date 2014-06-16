<?php
    $submit = "lista";
    require_once('../../Controller/AtenderPedidoController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Lista de Pedidos</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="listaPedidos" data-theme="a">
            <div data-role="header">
                <h1>Lista Pedidos</h1>
            </div>
            <div data-role="content">
                <div data-role="fieldcontain">
                    <label for="txtMozo">Mozo:</label>
                    <input type="text" name="mozo" id="txtMozo" value="<?php echo $mozo; ?>" readonly />
                </div>
                <table data-role="table" class="ui-responsive" data-split-icon="delete">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Mesa</th>
                            <th>Mozo</th>
                            <th>Fecha</th>
                            <th>Importe Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!is_array($pedidos)) {
                            echo "<td colspan='7'><center>No hay registrado ningún Pedido</center></td></tr>";
                        }
                        else {
                            foreach ($pedidos as $pedido) {
                        ?>
                        <tr>
                            <td><a href="DetallePedido.php?submit=detalle&idPedido=<?php echo $pedido["idPedido"]; ?>"><?php echo $pedido["idPedido"]; ?></a></td>
                            <td><?php echo $pedido["cliente"]; ?></td>
                            <td><?php echo $pedido["mesa"]; ?></td>
                            <td><?php echo $pedido["mozo"]; ?></td>
                            <td><?php echo $pedido["fecha"]; ?></td>
                            <td><?php echo $pedido["importeTotal"]; ?></td>
                            <td><?php echo $pedido["estado"]; ?></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>