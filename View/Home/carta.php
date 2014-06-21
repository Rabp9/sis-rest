<?php
    require_once('../../Controller/HomeController.php');
    $productos = getProductosOrdenados();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>Los Patos - Nuestros Productos</title>
        <link rel="stylesheet" type="text/css" href="../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/dashborad.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="nuestrosProductos" data-theme="a" data-add-back-btn="true" data-back-btn-text="Atrás" >
            <div data-role="header">
                <h1>Nuestros Productos</h1>
            </div>
            <div data-role="content">
                <ul data-role="listview" data-inset="true" data-divider-theme="a">
                    <?php
                    if(!is_array($productos)) {
                        echo "Ningún producto registrado en el sistema";
                    }
                    else {
                        $tipo = "Entrada";
                    ?>
                    <li data-role="list-divider"><?php echo $tipo; ?></li>
                    <?php
                        foreach ($productos as $producto) {
                            if($producto["tipo"] == $tipo) {
                    ?>
                    <li>
                        <a href="carta-foto.php?idProducto=<?php echo $producto["idProducto"]; ?>">
                            <img src="../../resources/img/productos/<?php echo $producto["foto"];?>">
                            <?php echo $producto["descripcion"]; ?>
                            <span class="ui-li-count"><?php echo $producto["precio"]; ?></span>
                        </a>
                    </li>
                    <?php
                            }
                        }        
                        $tipo = "Criollo";
                    ?>
                    <li data-role="list-divider"><?php echo $tipo; ?></li>
                    <?php
                        foreach ($productos as $producto) {
                            if($producto["tipo"] == $tipo) {
                    ?>
                    <li>
                        <a href="carta-foto.php?idProducto=<?php echo $producto["idProducto"]; ?>">
                            <img src="../../resources/img/productos/<?php echo $producto["foto"];?>">
                            <?php echo $producto["descripcion"]; ?>
                            <span class="ui-li-count"><?php echo $producto["precio"]; ?></span>
                        </a>
                    </li>
                    <?php
                            }
                        }               
                        $tipo = "Grill";
                    ?>
                    <li data-role="list-divider"><?php echo $tipo; ?></li>
                    <?php
                        foreach ($productos as $producto) {
                            if($producto["tipo"] == $tipo) {
                    ?>
                    <li>
                        <a href="carta-foto.php?idProducto=<?php echo $producto["idProducto"]; ?>">
                            <img src="../../resources/img/productos/<?php echo $producto["foto"];?>">
                            <?php echo $producto["descripcion"]; ?>
                            <span class="ui-li-count"><?php echo $producto["precio"]; ?></span>
                        </a>
                    </li>
                    <?php
                            }
                        }
                        $tipo = "Pescados y Mariscos";
                    ?>
                    <li data-role="list-divider"><?php echo $tipo; ?></li>
                    <?php
                        foreach ($productos as $producto) {
                            if($producto["tipo"] == $tipo) {
                    ?>
                    <li>
                        <a href="carta-foto.php?idProducto=<?php echo $producto["idProducto"]; ?>">
                            <img src="../../resources/img/productos/<?php echo $producto["foto"];?>">
                            <?php echo $producto["descripcion"]; ?>
                            <span class="ui-li-count"><?php echo $producto["precio"]; ?></span>
                        </a>
                    </li>
                    <?php
                            }
                        }                        
                        $tipo = "Guarniciones Adicionales";
                    ?>
                    <li data-role="list-divider"><?php echo $tipo; ?></li>
                    <?php
                        foreach ($productos as $producto) {
                            if($producto["tipo"] == $tipo) {
                    ?>
                    <li>
                        <a href="carta-foto.php?idProducto=<?php echo $producto["idProducto"]; ?>">
                            <img src="../../resources/img/productos/<?php echo $producto["foto"];?>">
                            <?php echo $producto["descripcion"]; ?>
                            <span class="ui-li-count"><?php echo $producto["precio"]; ?></span>
                        </a>
                    </li>
                    <?php
                            }
                        }                     
                        $tipo = "Piqueo";
                    ?>
                    <li data-role="list-divider"><?php echo $tipo; ?></li>
                    <?php
                        foreach ($productos as $producto) {
                            if($producto["tipo"] == $tipo) {
                    ?>
                    <li>
                        <a href="carta-foto.php?idProducto=<?php echo $producto["idProducto"]; ?>">
                            <img src="../../resources/img/productos/<?php echo $producto["foto"];?>">
                            <?php echo $producto["descripcion"]; ?>
                            <span class="ui-li-count"><?php echo $producto["precio"]; ?></span>
                        </a>
                    </li>
                    <?php
                            } 
                        }                     
                        $tipo = "Bebida Fria";
                    ?>
                    <li data-role="list-divider"><?php echo $tipo; ?></li>
                    <?php
                        foreach ($productos as $producto) {
                            if($producto["tipo"] == $tipo) {
                    ?>
                    <li>
                        <a href="carta-foto.php?idProducto=<?php echo $producto["idProducto"]; ?>">
                            <img src="../../resources/img/productos/<?php echo $producto["foto"];?>">
                            <?php echo $producto["descripcion"]; ?>
                            <span class="ui-li-count"><?php echo $producto["precio"]; ?></span>
                        </a>
                    </li>
                    <?php
                            }
                        }                     
                        $tipo = "Bebida Caliente";
                    ?>
                    <li data-role="list-divider"><?php echo $tipo; ?></li>
                    <?php
                        foreach ($productos as $producto) {
                            if($producto["tipo"] == $tipo) {
                    ?>
                    <li>
                        <a href="carta-foto.php?idProducto=<?php echo $producto["idProducto"]; ?>">
                            <img src="../../resources/img/productos/<?php echo $producto["foto"];?>">
                            <?php echo $producto["descripcion"]; ?>
                            <span class="ui-li-count"><?php echo $producto["precio"]; ?></span>
                        </a>
                    </li>
                    <?php
                            }
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