<?php
    require_once('../../Controller/HomeController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>Los Patos - <?php echo $lugar["titulo"]; ?></title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="lugarDetalle" data-theme="a" data-fullscreen="true" data-add-back-btn="true" data-back-btn-text="Atrás">
            <div data-role="header" data-position="fixed">
                <h1><?php echo $lugar["titulo"]; ?></h1>
            </div>
            <div data-role="content">
                <img src="../../resources/img/lugares/<?php echo $lugar["foto"]; ?>" alt="Foto" width="100%"/>
                <p style="padding: 0px 10px; text-align: justify;"><?php echo $lugar["descripcion"]; ?></p>
            </div>
            <div data-role="footer" data-position="fixed">
                <h4>Copyright Los Patos &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>