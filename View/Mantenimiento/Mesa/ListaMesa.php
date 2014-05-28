<?php
    $submit = "lista";
    require_once('../../../Controller/MantenimientoMesaController.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Lista Mesas</title>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="listaMesas" data-theme="a">
            <div data-role="header">
                <a href="../../../index.php" data-icon="home">Home</a>
                <h1>Lista Mesas</h1>
            </div>
            <div data-role="content">
                <table data-role="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!is_array($mesas)) {
                            echo "<td colspan='3'><center>No hay registrado ninguna Mesa</center></td></tr>";
                        }
                        else {
                            foreach ($mesa as $mesa) {
                        ?>
                        <tr>
                            <td><?php echo $mesa["idMesa"]; ?></td>
                            <td><?php echo $mesa["descripcion"]; ?></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <a href="RegistroMesa.php"><button>Nueva Mesa</button></a>
            </div>
            <div data-role="footer" data-position="fixed" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>