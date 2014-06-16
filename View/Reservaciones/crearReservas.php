<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Crear Reservas</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="crearReservas" data-theme="a">
            <div data-role="header">
                <a href="../../home.php" data-icon="home">Home</a>
                <h1>Crear Reservas</h1>
            </div>
            <div data-role="content">
                <div data-role="fieldcontain">
                    <label for="dtFecha">Fecha:</label>
                    <input type="date" name="fecha" id="dtFecha" value="" />
                </div>
                <ul data-role="listview" data-inset="true" data-divider-theme="a">
                    <li data-role="list-divider">11:00 am - 1:00 pm</li>
                    <li>Mesa 1</li>
                    <li>Mesa 1</li>
                    <li>Mesa 1</li>
                    <li data-role="list-divider">1:00 pm - 3:00 pm</li>
                    <li>Mesa 1</li>
                    <li>Mesa 1</li>
                    <li>Mesa 1</li>
                    <li data-role="list-divider">3:00 pm - 5:00 pm</li>
                    <li>Mesa 1</li>
                    <li>Mesa 1</li>
                    <li>Mesa 1</li>
                </ul>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>