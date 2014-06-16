<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Reservaciones</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css"/>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="reservaciones" data-theme="a">
            <div data-role="header">
                <a href="../../home.php" data-icon="home">Home</a>
                <h1>SIS-REST - Reservaciones</h1>
            </div>
            <div data-role="content">
                <ul data-role="listview" data-inset="true">
                    <?php if($_SESSION["rol"] == "administrador") { ?> 
                    <li>
                        <a href="crearReservas.php">
                            <img src="../../resources/img/icon-reservaciones2.jpg">
                            Generar Reservaciones
                        </a>
                    </li>
                    <?php } ?>
                    <?php if($_SESSION["rol"] == "administrador") { ?> 
                    <li>
                        <a href="listaReservas.php">
                            <img src="../../resources/img/lista2.png">
                            Lista Reservaciones
                        </a>
                    </li>
                    <?php } ?>
                    <?php if($_SESSION["rol"] == "cliente") { ?> 
                    <li>
                        <a href="registrarReserva.php">
                            <img src="../../resources/img/icon-reservaciones2.jpg">
                            Registrar Reservación
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div data-role="footer">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>