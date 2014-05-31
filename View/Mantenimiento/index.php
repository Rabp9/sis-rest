<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Mantenimiento</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css"/>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="mantenimiento" data-theme="a">
            <div data-role="header">
                <a href="../../index.php" data-icon="home">Home</a>
                <h1>Mantenimiento SIS-REST</h1>
            </div>
            <div data-role="content">
                <ul data-role="listview" data-inset="true">
                    <li>
                        <a href="Cliente/ListaCliente.php">
                            <img src="../../resources/img/icon-cliente.jpg">
                            Cliente
                        </a>
                    </li>
                    <li>
                        <a href="Plato/ListaPlato.php">
                            <img src="../../resources/img/icon-platos2.jpg">
                            Plato
                        </a>
                    </li>
                    <li>
                        <a href="Mesa//ListaMesa.php">
                            <img src="../../resources/img/icon-mesa2.png">
                            Mesa
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