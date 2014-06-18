<?php
    $submit = "lista";
    require_once('../../../Controller/MantenimientoClienteController.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Lista Clientes</title>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
        <?php if(isset($_GET["rpta"])) { ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $.mobile.changePage( "#dialogo", { role: "dialog" } );
            });
        </script>   
        <?php }?>     
    </head>
    <body>
        <div data-role="page" id="listaClientes" data-theme="a">
            <div data-role="header">
                <a href="../../../home.php" data-icon="home">Home</a>
                <h1>Lista Clientes</h1>
            </div>
            <div data-role="content">
                <table data-role="table" class="ui-responsive" data-split-icon="delete">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!is_array($clientes)) {
                            echo "<td colspan='5'><center>No hay registrado ningún Cliente</center></td></tr>";
                        }
                        else {
                            foreach ($clientes as $cliente) {
                        ?>
                        <tr>
                            <td><?php echo $cliente["idCliente"]; ?></td>
                            <td><a href="RegistroCliente.php?idCliente=<?php echo $cliente["idCliente"]; ?>"><?php echo $cliente["nombreCompleto"]; ?></a></td>
                            <td><a href="tel:<?php echo $cliente["telefono"]; ?>"><?php echo $cliente["telefono"]; ?></a></td>
                            <td><?php echo $cliente["direccion"]; ?></td>
                            <td><a href="mailto:<?php echo $cliente["email"]; ?>"><?php echo $cliente["email"]; ?></a></td>
                            <td><a href="../../../Controller/MantenimientoClienteController.php?submit=Eliminar&idCliente=<?php echo $cliente["idCliente"]; ?>" data-role="button" data-icon="delete" data-iconpos="notext" data-ajax="false">Delete</a></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <a href="RegistroCliente.php?accion=nuevo"><button>Nuevo Cliente</button></a>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
        
        <div data-role="dialog" id="dialogo">
            <div data-role="header">
                <h1>Mensaje</h1>
            </div>
            <div data-role="content">
                <?php if($_GET["mensaje"] == "nuevo") { ?>
                    <?php if($_GET["rpta"] == "correcto") {?>
                    <p>Cliente Registrado correctamente</p>
                    <p>Código Cliente: <?php echo $_GET["id"]; ?></p>
                    <?php }?>
                    <?php if($_GET["rpta"] == "incorrecto") {?>
                    <p>No fue posible registrar al cliente</p>
                    <?php } ?>
                <?php } ?>
                
                <?php if($_GET["mensaje"] == "editar") { ?>
                    <?php if($_GET["rpta"] == "correcto") {?>
                    <p>Cliente Modificado correctamente</p>
                    <p>Código Cliente: <?php echo $_GET["id"]; ?></p>
                    <?php }?>
                    <?php if($_GET["rpta"] == "incorrecto") {?>
                    <p>No fue posible modificar al cliente</p>
                    <p>Código Cliente: <?php echo $_GET["id"]; ?></p>
                    <?php } ?>
                <?php } ?>
                
                <?php if($_GET["mensaje"] == "eliminar") { ?>
                    <?php if($_GET["rpta"] == "correcto") {?>
                    <p>Cliente Eliminado correctamente</p>
                    <p>Código Cliente: <?php echo $_GET["id"]; ?></p>
                    <?php }?>
                    <?php if($_GET["rpta"] == "incorrecto") {?>
                    <p>No fue posible eliminar al cliente</p>
                    <p>Código Cliente: <?php echo $_GET["id"]; ?></p>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>​
    </body>
</html>