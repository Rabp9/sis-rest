<?php
    require_once('../../Controller/HomeController.php');
    $platos = getPlatosOrdenados();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>Los Patos - Nuestros Platos</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="nuestrosPlatos" data-theme="a" data-add-back-btn="true" data-back-btn-text="Atrás" >
            <div data-role="header">
                <h1>Nuestros Platos</h1>
            </div>
            <div data-role="content">
                <ul data-role="listview" data-inset="true">
                    <?php
                    if(!is_array($platos)) {
                        echo "Ningún plato registrado en el sistema";
                    }
                    else {
                        foreach ($platos as $plato) {
                    ?>
                    <li>
                        <a href="plato-foto.php?idPlato=<?php echo $plato["idPlato"]; ?>">
                            <img src="../../resources/img/platos/<?php echo $plato["foto"];?>">
                            <?php echo $plato["descripcion"]; ?>
                            <span class="ui-li-count"><?php echo $plato["precio"]; ?></span>
                        </a>
                    </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div data-role="footer">
                <h4>Copyright Los Patos &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>