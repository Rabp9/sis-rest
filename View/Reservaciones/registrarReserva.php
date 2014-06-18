<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Reservaciones</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="reservaciones" data-theme="a">
            <div data-role="header">
                <a href="../../home.php" data-icon="home">Home</a>
                <h1>Reservaciones</h1>
            </div>
            <div data-role="content">
                <form id="frmReservaciones" action="../../Controller/RegistrarReservaController.php?submit=Buscar" method="POST" data-ajax="false">
                    <input type="hidden" id="hdnFechaActual" value="<?php echo date("Y-m-d"); ?>" />
                    <div data-role="fieldcontain">
                        <label for="dtFecha">Fecha:</label>
                        <input type="date" name="fecha" id="txtFecha" value="" required />
                    </div>
                    <div data-role="fieldcontain">
                        <input type="submit" name="submit" value="Buscar" />
                    </div>
                </form>
                <script type="text/javascript">
                   $("#frmReservaciones").submit(function() {
                        var fechaActual = $("#hdnFechaActual").val();
                        var fecha = $("#txtFecha").val();
                        if(fechaActual > fecha) {
                            alert("La fechan debe ser posterior a la fecha Actual: " + fechaActual);
                            return false;
                        }
                    });
                </script>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>