<?php
    session_start();
    $submit = "Detalle";
    require_once '../../Controller/RegistrarReservaController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Detalle <?php echo $fecha; ?></title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="detalleReservaciones" data-theme="a">
            <div data-role="header">
                <a href="../../home.php" data-icon="home">Home</a>
                <h1>Detalle <?php echo $fecha; ?></h1>
            </div>
            <div data-role="content">
                <ul id="ulDetalleReserva" data-role="listview" data-inset="true" data-divider-theme="a">
                    <li data-role="list-divider">11:00 am - 1:00 pm</li>
                    <?php foreach($mesas1 as $mesa1) {?>
                    <li data-icon="<?php if($mesa1["reservado"] == "SI") echo "search"; else echo "check"; ?>">
                        <a href="confirmar.php?idMesa=<?php echo $mesa1["idMesa"]; ?>&fecha=<?php echo $fecha ?>&hora=11:00:00" data-ajax="false">
                            <?php echo $mesa1["descripcion"]; ?>
                            <input class="hdnReservado" type="hidden" value="<?php echo $mesa1["reservado"]; ?>" />
                        </a>
                    </li>
                    <?php } ?>
                    <li data-role="list-divider">1:00 pm - 3:00 pm</li>
                    <?php foreach($mesas2 as $mesa2) {?>
                    <li data-icon="<?php if($mesa2["reservado"] == "SI") echo "search"; else echo "check"; ?>">
                        <a href="confirmar.php?idMesa=<?php echo $mesa2["idMesa"]; ?>&fecha=<?php echo $fecha ?>&hora=13:00:00" data-ajax="false">
                            <?php echo $mesa2["descripcion"]; ?>
                            <input class="hdnReservado" type="hidden" value="<?php echo $mesa2["reservado"]; ?>" />
                        </a>
                    </li>
                    <?php } ?>
                    <li data-role="list-divider">3:00 pm - 5:00 pm</li>
                    <?php foreach($mesas3 as $mesa3) {?>
                    <li data-icon="<?php if($mesa3["reservado"] == "SI") echo "search"; else echo "check"; ?>">
                        <a href="confirmar.php?idMesa=<?php echo $mesa3["idMesa"]; ?>&fecha=<?php echo $fecha ?>&hora=15:00:00" data-ajax="false">
                            <?php echo $mesa3["descripcion"]; ?>
                            <input class="hdnReservado" type="hidden" value="<?php echo $mesa3["reservado"]; ?>" />
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php if($_SESSION["rol"] == "administrador") { ?>
            <script type="text/javascript">
                $("#ulDetalleReserva li a").click(function(e) {
                    var reserva = $(this).parent().find(".hdnReservado").val();
                    if(reserva == "NO") {
                        alert("Reserva disponible");
                        e.preventDefault();
                    }
                });
            </script>
            <?php } ?>
            <?php if($_SESSION["rol"] == "cliente") { ?>
            <script type="text/javascript">
                $("#ulDetalleReserva li a").click(function(e) {
                    var reserva = $(this).parent().find(".hdnReservado").val();
                    if(reserva == "SI") {
                        alert("Ya está reservado");
                        e.preventDefault();
                    }
                });
            </script>
            <?php } ?>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>