<?php
    session_start();
    $submit = "ListaCliente";
    require_once '../../Controller/RegistrarReservaController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Lista Reservaciones</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
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
        <div data-role="page" id="listaLugares" data-theme="a" >
            <div data-role="header">
                <a href="../../home.php" data-icon="home">Home</a>
                <h1>Lista Reservaciones</h1>
            </div>
            <div data-role="content">
                <table data-role="table" class="ui-responsive" data-split-icon="delete">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mesa</th>
                            <th>Hora</th>
                            <th>N° Personas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!is_array($reservas)) {
                            echo "<td colspan='4'><center>No hay registrado ninguna Reservación</center></td></tr>";
                        }
                        else {
                            foreach ($reservas as $reserva) {
                        ?>
                        <tr>
                            <td><a href="detalleReservaCliente.php?idReserva=<?php echo $reserva["idReserva"]; ?>"><?php echo $reserva["idReserva"]; ?></a></td>
                            <td><?php echo $reserva["mesa"]; ?></td>
                            <td><?php echo $reserva["hora"]; ?></td>
                            <td><?php echo $reserva["nPersonas"]; ?></td>
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
                
        <div data-role="dialog" id="dialogo">
            <div data-role="header">
                <h1>Mensaje</h1>
            </div>
            <div data-role="content">
                <?php if($_GET["rpta"] == "correcto") {?>
                <p>Reservación Registrada correctamente</p>
                <p>Código Lugar: <?php echo $_GET["id"]; ?></p>
                <?php }?>
                <?php if($_GET["rpta"] == "incorrecto") {?>
                <p>No fue posible registrar la reservación. Verifique el tamaño del archivo</p>
                <?php } ?>
            </div>
        </div>​
    </body>
</html>