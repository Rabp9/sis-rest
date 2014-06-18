<?php
    session_start();
    $submit = "DetalleReservaCliente";
    require_once '../../Controller/RegistrarReservaController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Detalle Reserva</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="confirmarReserva" data-add-back-btn="true" data-back-btn-text="Atrás"  data-theme="a">
            <div data-role="header">
                <h1>Detalle Reserva</h1>
            </div>
            <div data-role="content"> 
                <div data-role="fieldcontain">
                    <label for="txtNombreCompleto">Cliente: </label>
                    <input id="txtNombreCompleto" type="text" value="<?php echo $nombreCompleto; ?>" readonly />
                    <input id="idUsuario" type="hidden" name="idUsuario" value="<?php echo $_SESSION["idUsuario"]; ?>">
                </div>                  
                <div data-role="fieldcontain">
                    <label for="txtMesa">Mesa: </label>         
                    <input id="txtMesa" type="text" name="mesa" value="<?php echo $reserva["mesa"]; ?>" readonly />
                </div>
                <div data-role="fieldcontain">
                    <label for="txtFechaHora">Fecha y Hora Reserva: </label>         
                    <input id="txtFechaReserva" type="text" name="fechaReserva" value="<?php echo $reserva["hora"]; ?>" readonly/>
                </div>	
                <div data-role="fieldcontain">
                    <label for="txtNPersonas">Número de Personas:</label>
                    <input type="text" name="nPersonas" id="txtNPersonas" value="<?php echo $reserva["nPersonas"]; ?>" readonly />
                </div>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>