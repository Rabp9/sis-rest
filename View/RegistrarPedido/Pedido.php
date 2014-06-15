<?php
    session_start();
    $submit = "pedido";
    require_once('../../Controller/RegistrarPedidoController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Pedido</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="pedido" data-theme="a">
            <div data-role="header">
                <h1>Pedido</h1>
            </div>
            <div data-role="content">
                <div data-role="fieldcontain">
                    <label for="txtNombreCompleto">Cliente: </label>
                    <span id="txtNombreCompleto"><?php echo $_SESSION["cliente"]["nombreCompleto"]; ?></span>
                </div>
                <div data-role="fieldcontain">
                    <label for="txtImporteTotal">Importe Total: </label>
                    <span id="txtImporteTotal"><?php echo $importeTotal; ?></span>
                </div>
                <table data-role="table" class="ui-responsive" data-split-icon="delete">
                    <thead>
                        <tr>
                            <th>Plato</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Importe</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!is_array($listaPedidos)) {
                            echo "<td colspan='2'><center>No hay registrado ningún Pedido</center></td></tr>";
                        }
                        else {
                            foreach ($listaPedidos as $pedido) {
                        ?>
                        <tr>
                            <td><?php echo $pedido["plato"]; ?></td>
                            <td><?php echo $pedido["precio"]; ?></td>
                            <td><?php echo $pedido["cantidad"]; ?></td>    
                            <td><?php echo $pedido["importe"]; ?></td>    
                            <td><a href="../../Controller/RegistrarPedidoController.php?submit=Eliminar&idPlato=<?php echo $pedido["idPlato"]; ?>" data-role="button" data-icon="delete" data-iconpos="notext" data-ajax="false">Delete</a></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>      
                <a href="seleccionarPlato.php" data-ajax="false"><button>Agregar Plato</button></a>
                <a href="confirmar.php"><button>Finalizar Pedido</button></a>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>