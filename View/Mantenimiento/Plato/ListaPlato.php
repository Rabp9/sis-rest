<?php
    $submit = "lista";
    require_once('../../../Controller/MantenimientoPlatoController.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Lista Platos</title>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="listaPlatos" data-theme="a">
            <div data-role="header">
                <a href="../../../index.php" data-icon="home">Home</a>
                <h1>Lista Platos</h1>
            </div>
            <div data-role="content">
                <table data-role="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!is_array($platos)) {
                            echo "<td colspan='3'><center>No hay registrado ningún Plato</center></td></tr>";
                        }
                        else {
                            foreach ($platos as $plato) {
                        ?>
                        <tr>
                            <td><?php echo $plato["idPlato"]; ?></td>
                            <td><?php echo $plato["descripcion"]; ?></td>
                            <td><?php echo $plato["precio"]; ?></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <a href="RegistroPlato.php"><button>Nuevo Plato</button></a>
            </div>
            <div data-role="footer" data-position="fixed" data-fullscreen="true">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>