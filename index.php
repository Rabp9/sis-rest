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
            <div data-role="header" data-position="fixed">
                <h1>Bienvenido a SIS-REST</h1>
            </div>
            <div data-role="content">
                <div id="dashboard">
                    <a href="View/Mantenimiento/" class="dashboard_icon">
                        <figure>
                            <img src="resources/img/icon-mantenimiento2.jpg"/>
                            <figcaption>Mantenimiento</figcaption>
                        </figure>
                    </a>
                    <a href="View/RegistrarPedido/" class="dashboard_icon">
                        <figure>
                            <img src="resources/img/icon-pedidos2.jpg"/>
                            <figcaption>Pedido</figcaption>
                        </figure>
                    </a>
                    <a href="View/Reservaciones/" class="dashboard_icon">
                        <figure>
                            <img src="resources/img/icon-reservaciones2.jpg"/>
                            <figcaption>Reservaciones</figcaption>
                        </figure>
                    </a>
                    <a href="View/Reportes/" class="dashboard_icon">
                        <figure>
                            <img src="resources/img/icon-reportes2.jpg"/>
                            <figcaption>Reportes</figcaption>
                        </figure>
                    </a>
                </div>
            </div>
            <div data-role="footer" data-position="fixed">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>