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
                    <li>
                        <a href="View/Mantenimiento/">
                            <img src="resources/img/icon-mantenimiento3.png">
                            Mantenimiento
                        </a>
                    </li>
                    <li>
                        <a href="View/RegistrarPedido/">
                            <img src="resources/img/icon-pedidos3.png">
                            Pedidos
                        </a>
                    </li>
                    <li>
                        <a href="View/Reservaciones/">
                            <img src="resources/img/icon-reservaciones2.jpg">
                            Reservaciones
                        </a>
                    </li>
                    <li>
                        <a href="View/Reportes/">
                            <img src="resources/img/icon-reportes2.jpg">
                            Reportes
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