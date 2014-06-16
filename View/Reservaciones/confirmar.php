<?php
    $submit = "Confirmar";
    require_once '../../Controller/RegistrarReservaController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Confirmar Reserva</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="confirmarReserva" data-theme="a">
            <div data-role="header">
                <a href="../../home.php" data-icon="home">Home</a>
                <h1>Confirmar Reserva</h1>
            </div>
            <div data-role="content">
                Mostrar Mesa: <?php echo $mesa["descripcion"]; ?> <br/>
                hidden idMesa: <?php echo $mesa["idMesa"]; ?> <br/>
                Mostrar Hora: <?php echo $hora; ?><br/>
                hidden idHora <br/>
                Mostrar Cliente <br/>
                hidden idUsuario <br/>
                Mostrar Fecha hora actual con input <br/>
                nPersonas input <br/>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>