<?php
    $submit = "Index";
    require_once '../../Controller/RegistrarReservaController.php';
?>
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
                <form id="frmCrearReservas" action="../../Controller/RegistrarReservaController.php?submit=Crear" method="POST" data-ajax="false">
                    <div data-role="fieldcontain">
                        <label for="txtFechaUltimaReserva">Fecha última Reserva:</label>
                        <input type="text" name="fechaUltimaReserva" id="txtFechaUltimaReserva" value="<?php echo $fechaUltimaReserva; ?>" readonly />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="dtCrearReservas">Crear reservas hasta:</label>
                        <input type="date" name="fechaCrearReserva" id="txtCrearReserva" value="" required/>
                    </div>
                    <div data-role="fieldcontain">
                        <input type="submit" name="submit" value="Crear" />
                    </div>
                </form>
                <script type="text/javascript">
                   $("#frmCrearReservas").submit(function() {
                        var fechaUltima = $("#txtFechaUltimaReserva").val();
                        var fechaHasta = $("#txtCrearReserva").val();
                        if(fechaUltima > fechaHasta) {
                            alert("Seleccionar una fecha posterior");
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