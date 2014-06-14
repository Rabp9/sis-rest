<?php
    require_once('../../Controller/HomeController.php');
    $lugares = getLugaresOrdenados();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>Los Patos - Lugares Turísticos</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="lugaresTuristicos" data-theme="a" data-add-back-btn="true" data-back-btn-text="Atrás" >
            <div data-role="header">
                <h1>Lugares Turísticos</h1>
            </div>
            <div data-role="content">
                <ul data-role="listview" data-inset="true">
                    <?php
                    if(!is_array($lugares)) {
                        echo "Ningún lugar registrado en el sistema";
                    }
                    else {
                        foreach ($lugares as $lugar) {
                    ?>
                    <li>
                        <a href="lugar-foto.php?idLugar=<?php echo $lugar["idLugar"]; ?>">
                            <img src="../../resources/img/lugares/<?php echo $lugar["foto"];?>">
                            <?php echo $lugar["titulo"]; ?>
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