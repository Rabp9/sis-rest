<?php
    $submit = "lista";
    require_once('../../../Controller/MantenimientoLugarController.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Lista Lugares</title>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../../resources/css/dashborad.css" />
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
        <div data-role="page" id="listaLugares" data-theme="a">
            <div data-role="header">
                <a href="../../../home.php" data-icon="home">Home</a>
                <h1>Lista Lugares</h1>
            </div>
            <div data-role="content">
                <table data-role="table" class="ui-responsive" data-split-icon="delete">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!is_array($lugares)) {
                            echo "<td colspan='3'><center>No hay registrado ningún Lugar</center></td></tr>";
                        }
                        else {
                            foreach ($lugares as $lugar) {
                        ?>
                        <tr>
                            <td><?php echo $lugar["idLugar"]; ?></td>
                            <td><a href="RegistroLugar.php?idLugar=<?php echo $lugar["idLugar"]; ?>"><?php echo $lugar["titulo"]; ?></a></td>
                            <td><a href="../../../Controller/MantenimientoLugarController.php?submit=Eliminar&idLugar=<?php echo $lugar["idLugar"]; ?>" data-role="button" data-icon="delete" data-iconpos="notext" data-ajax="false">Delete</a></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <a href="RegistroLugar.php?accion=nuevo"><button>Nuevo Lugar</button></a>
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
                <?php if($_GET["mensaje"] == "nuevo") { ?>
                    <?php if($_GET["rpta"] == "correcto") {?>
                    <p>Lugar Registrado correctamente</p>
                    <p>Código Lugar: <?php echo $_GET["id"]; ?></p>
                    <?php }?>
                    <?php if($_GET["rpta"] == "incorrecto") {?>
                    <p>No fue posible registrar el lugar. Verifique el tamaño del archivo</p>
                    <?php } ?>
                <?php } ?>
                
                <?php if($_GET["mensaje"] == "editar") { ?>
                    <?php if($_GET["rpta"] == "correcto") {?>
                    <p>Lugar Modificado correctamente</p>
                    <p>Código Lugar: <?php echo $_GET["id"]; ?></p>
                    <?php }?>
                    <?php if($_GET["rpta"] == "incorrecto") {?>
                    <p>No fue posible modificar el lugar. Verifique el tamaño del archivo</p>
                    <p>Código Lugar: <?php echo $_GET["id"]; ?></p>
                    <?php } ?>
                <?php } ?>
                
                <?php if($_GET["mensaje"] == "eliminar") { ?>
                    <?php if($_GET["rpta"] == "correcto") {?>
                    <p>Lugar Eliminado correctamente</p>
                    <p>Código Lugar: <?php echo $_GET["id"]; ?></p>
                    <?php }?>
                    <?php if($_GET["rpta"] == "incorrecto") {?>
                    <p>No fue posible eliminar el lugar</p>
                    <p>Código Lugar: <?php echo $_GET["id"]; ?></p>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>​
    </body>
</html>