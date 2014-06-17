<?php
    session_start();
    $submit = "Confirmar";
    require_once '../../Controller/RegistrarReservaController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Confirmar Reserva</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="confirmarReserva" data-theme="a">
            <div data-role="header">
                <a href="../../home.php" data-icon="home">Home</a>
                <h1>Confirmar Reserva</h1>
            </div>
            <div data-role="content"> 
                <form action="../../Controller/RegistrarReservaController.php?submit=Registrar" method="POST" data-ajax="false">
                    <div data-role="fieldcontain">
                        <label for="txtNombreCompleto">Cliente: </label>
                        <input id="txtNombreCompleto" type="text" value="<?php echo $nombreCompleto; ?>" readonly />
                        <input id="idUsuario" type="hidden" name="idUsuario" value="<?php echo $_SESSION["idUsuario"]; ?>">
                    </div>                  
                    <div data-role="fieldcontain">
                        <label for="txtMesa">Mesa: </label>         
                        <input id="txtMesa" type="text" name="mesa" value="<?php echo $mesa["descripcion"]; ?>" readonly />
                        <input id="idMesa" type="hidden" name="idMesa" value="<?php echo $mesa["idMesa"]; ?>">
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtFechaHora">Fecha y Hora Reserva: </label>         
                        <input id="txtFechaReserva" type="text" name="fechaReserva" value="<?php echo $hora["horaInicio"] . " - " .  $hora["horaFin"]; ?>" readonly/>
                        <input id="idHora" type="hidden" name="idHora" value="<?php echo $hora["idHora"]; ?>">
                    </div>    
                    <div data-role="fieldcontain">
                        <label for="txtFechaActual">Fecha y Hora Actual: </label>         
                        <input id="txtFechaHora" type="text" name="fechaHora" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly/>
                    </div>
                    <div data-role="fieldcontain">
                        <label for="nmbNPersonas">Número de Personas:</label> 	
                        <input type="range" name="nPersonas" id="nmbNPersonas" step="1" min="1" max="20" data-popup-enabled="true"  value="1" />
                    </div>
                    <div data-role="fieldcontain">
                        <input type="submit" name="submit" value="Registrar" data-ajax="false" />
                    </div>
                </form>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>