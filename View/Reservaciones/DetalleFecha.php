<?php
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
                <ul data-role="listview" data-inset="true" data-divider-theme="a">
                    <li data-role="list-divider">11:00 am - 1:00 pm</li>
                    <?php foreach($mesas1 as $mesa1) {?>
                    <li data-icon="<?php if($mesa1["reservado"] == "SI") echo "lock"; else echo "check"; ?>"><a href="confirmar.php?idMesa=<?php echo $mesa1["idMesa"]; ?>&fecha=<?php echo $fecha ?>" data-ajax="false"><?php echo $mesa1["descripcion"]; ?></a></li>
                    <?php } ?>
                    <li data-role="list-divider">1:00 pm - 3:00 pm</li>
                    <?php foreach($mesas2 as $mesa2) {?>
                    <li data-icon="<?php if($mesa2["reservado"] == "SI") echo "lock"; else echo "check"; ?>"><a href="confirmar.php?idMesa=<?php echo $mesa2["idMesa"]; ?>&fecha=<?php echo $fecha ?>" data-ajax="false"><?php echo $mesa2["descripcion"]; ?></a></li>
                    <?php } ?>
                    <li data-role="list-divider">3:00 pm - 5:00 pm</li>
                    <?php foreach($mesas3 as $mesa3) {?>
                    <li data-icon="<?php if($mesa3["reservado"] == "SI") echo "lock"; else echo "check"; ?>"><a href="confirmar.php?idMesa=<?php echo $mesa3["idMesa"]; ?>&fecha=<?php echo $fecha ?>" data-ajax="false"><?php echo $mesa3["descripcion"]; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>