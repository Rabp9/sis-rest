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
    </head>
    <body>
        <div data-role="page" id="listaClientes" data-theme="a">
            <div data-role="header">
                <a href="../../../index.php" data-icon="home">Home</a>
                <h1>Lista Clientes</h1>
            </div>
            <div data-role="content">
                <table data-role="table" class="ui-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Dirección</th>
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
                            <td><a href="RegistroCliente.php?<?php echo $cliente["idCliente"]; ?>"><?php echo $cliente["nombreCompleto"]; ?></a></td>
                            <td><?php echo $cliente["telefono"]; ?></td>
                            <td><?php echo $cliente["correo"]; ?></td>
                            <td><?php echo $cliente["direccion"]; ?></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <a href="RegistroCliente.php"><button>Nuevo Cliente</button></a>
            </div>
            <div data-role="footer" data-position="fixed" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>