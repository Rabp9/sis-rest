<?php
    $submit = "Lista";
    require_once '../../Controller/RegistrarReservaController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Lista Reservaciones</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
        <?php if(isset($_GET["rpta"])) { ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $.mobile.changePage( "#dialogo", { role: "dialog" } );
            });
        </script>
        <?php }?>
    </head>
    <body>
        <div data-role="page" id="listaReservaciones" data-theme="a">
            <div data-role="header">
                <a href="../../../home.php" data-icon="home">Home</a>
                <h1>Lista Reservaciones</h1>
            </div>
            <div data-role="content">
                <ul data-role="listview" data-inset="true" data-divider-theme="a">
                    <?php
                    if(!is_array($reservas)) {
                        echo "Ninguna reserva registrada en el sistema";
                    }
                    else {
                        foreach ($reservas as $reserva) {
                    ?>
                    <li>
                        <a href="DetalleFecha.php?fecha=<?php echo $reserva["fecha"]; ?>">
                            <?php echo $reserva["fecha"]; ?>
                            <span class="ui-li-count"><?php echo $reserva["reservas"]; ?></span>
                        </a>
                    </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div data-role="footer" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div> 
        
        <div data-role="dialog" id="dialogo">
            <div data-role="header">
                <h1>Mensaje</h1>
            </div>
            <div data-role="content">
                <?php if($_GET["rpta"] == "correcto") {?>
                <p>Registro de reservaciones creados correctamente</p>
                <p>Reservaciones generadas hasta: <?php echo $_GET["fecha"]; ?></p>
                <?php }?>
            </div>
        </div>​
    </body>
</html>