<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST</title>
        <link rel="stylesheet" type="text/css" href="resources/css/los_patos.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <link rel="stylesheet" type="text/css" href="resources/css/dashborad.css"/>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="homePage" data-theme="a">
            <div data-role="header">
                <h1>Bienvenido a SIS-REST</h1>
            </div>
            <div data-role="content">
                <ul data-role="listview" data-inset="true">
                    <?php if($_SESSION["rol"] == "administrador" || $_SESSION["rol"] == "mozo") { ?> 
                    <li>
                        <a href="View/Mantenimiento/">
                            <img src="resources/img/icon-mantenimiento.png">
                            Mantenimiento
                        </a>
                    </li>
                    <?php } ?>
                    <?php if($_SESSION["rol"] == "cliente" || $_SESSION["rol"] == "mozo" || $_SESSION["rol"] == "jefecocina") { ?> 
                    <li>
                        <a href="View/Pedidos/index.php">
                            <img src="resources/img/icon-pedidos.png">
                            Pedidos
                        </a>
                    </li>
                    <?php } ?>
                    <?php if($_SESSION["rol"] == "cliente" || $_SESSION["rol"] == "administrador") { ?> 
                    <li>
                        <a href="View/Reservaciones/">
                            <img src="resources/img/icon-reservaciones.png">
                            Reservaciones
                        </a>
                    </li>
                    <?php } ?>
                    <?php if($_SESSION["rol"] == "administrador" || $_SESSION["rol"] == "jefecocina") { ?> 
                    <li>
                        <a href="View/Reporte/">
                            <img src="resources/img/icon-reportes.png">
                            Reportes
                        </a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="Controller/HomeController.php?submit=Cerrar" data-ajax="false">
                            <img src="resources/img/icon-cerrar-sesion.png">
                            Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>
            <div data-role="footer">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>