<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Reporte Consumo</title>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="reporteConsumo" data-theme="a">
            <div data-role="header">
                <a href="../../home.php" data-icon="home">Home</a>
                <h1>Reporte Consumo</h1>
            </div>
            <div data-role="content">
                <form action="../../Controller/ReporteController.php?submit=Consumo" method="POST" data-ajax="false">
                    <div data-role="fieldcontain">
                        <label for="dtFechaInicio">Fecha Inicio:</label>
                        <input type="date" name="fechaInicio" id="dtFechaInicio" value="" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="dtFechaFin">Fecha Fin:</label>
                        <input type="date" name="fechaFin" id="dtFechaFin" value="" />
                    </div>
                    <div data-role="fieldcontain">
                        <input type="submit" name="submit" value="Reportar" data-icon="search" />
                    </div>
                </form>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>