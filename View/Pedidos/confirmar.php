<?php
    session_start();
    $submit = "Confirmar";
    require_once('../../Controller/RegistrarPedidoController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Confirmar Pedido</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="confirmarPedido" data-theme="a">
            <div data-role="header">
                <a href="../../Controller/RegistrarPedidoController.php?submit=Cancelar" data-icon="close" data-ajax="false">Cancelar</a>
                <h1>Confirmar Pedido</h1>
            </div>
            <div data-role="content">
                <form action="../../Controller/RegistrarPedidoController.php?submit=Registrar" method="POST" data-ajax="false">
                    <div data-role="fieldcontain">
                        <label for="txtNombreCompleto">Cliente: </label>
                        <input id="txtNombreCompleto" type="text" value="<?php echo $_SESSION["cliente"]["nombreCompleto"]; ?>" readonly />
                        <input id="idCliente" type="hidden" name="idCliente" value="<?php echo $_SESSION["cliente"]["idCliente"]; ?>">
                    </div>                  
                    <input id="idMozo" type="hidden" name="idMozo" value="<?php echo $mozo["idMozo"]; ?>">
                    <input id="idUsuario" type="hidden" name="idUsuario" value="<?php echo $usuario["idUsuario"]; ?>">
                    <div data-role="fieldcontain">
                        <label for="txtImporteTotal">Importe Total: </label>         
                        <input id="txtImporteTotal" type="text" name="importeTotal" value="<?php echo $importeTotal; ?>" readonly />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="sltMesa" class="select">Mesa:</label>
                        <select name="idMesa" id="sltMesa" data-native-menu="false">
                            <option data-placeholder="true">Seleccionar</option>
                            <?php foreach ($mesas as $mesa) { ?>
                            <option value="<?php echo $mesa["idMesa"] ?>"><?php echo $mesa["descripcion"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtFecha">Fecha: </label>         
                        <input id="txtFecha" type="text" name="fecha" value="<?php echo date("d/m/Y"); ?>" readonly/>
                    </div>    
                    <div data-role="fieldcontain">
                        <label for="txtaObservaciones">Observaciones:</label>
                        <textarea rows="8" name="observaciones" id="txtaObservaceiones"></textarea>
                    </div>
                    <div data-role="fieldcontain">
                        <input type="submit" name="submit" value="Registrar" data-ajax="false" />
                    </div>
                </form>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>