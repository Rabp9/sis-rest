<?php
    $submit = "editar";
    require_once('../../../Controller/MantenimientoProductoController.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Registro</title>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="registroProducto" data-add-back-btn="true" data-back-btn-text="Atrás" data-theme="a">
            <div data-role="header">
                <?php
                    if(is_array($producto)) $header = "Editar";
                    else $header = "Nuevo";
                ?>
                <h1><?php echo $header; ?></h1>
            </div>
            <div data-role="content">
                <form action="../../../Controller/MantenimientoProductoController.php" method="post" data-ajax="false" enctype="multipart/form-data">
                    <?php if(is_array($producto)) { ?>
                    <div data-role="fieldcontain">
                        <label for="txtCodigo">Código:</label>
                        <input type="text" name="idProducto" id="txtCodigo" value="<?php if(is_array($producto)) echo $producto["idProducto"]; ?>" readonly />
                    </div>
                    <?php } ?>
                    <div data-role="fieldcontain">
                        <label for="txtDescripcion">Descripción:</label>
                        <input type="text" name="descripcion" id="txtDescripcion" value="<?php if(is_array($producto)) echo $producto["descripcion"]; ?>" required maxlength="50" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="flFoto">Foto:</label>
                        <input type="file" name="foto" id="flFoto" value="" />
                        <?php if(is_array($producto)) { ?>
                            <img src="../../../resources/img/productos/<?php echo $producto["foto"]; ?>" alt="Foto" width="100%"/>
                        <?php } ?>
                    </div>
                    <div data-role="fieldcontain">
                        <label for="sltTipo" class="select">Tipo:</label>
                        <select name="tipo" id="sltRol" data-native-menu="false" required>
                            <option data-placeholder="true" value="">Seleccionar</option>
                            <option value="Entrada" <?php if($producto["tipo"] == "Entrada") echo "selected"; ?>>Entrada</option>
                            <option value="Criollo" <?php if($producto["tipo"] == "Criollo") echo "selected"; ?>>Criollo</option>
                            <option value="Grill" <?php if($producto["tipo"] == "Grill") echo "selected"; ?>>Grill</option>
                            <option value="Pescados y Mariscos" <?php if($producto["tipo"] == "Pescados y Mariscos") echo "selected"; ?>>Pesacados y Mariscos</option>
                            <option value="Guarniciones Adicionales" <?php if($producto["tipo"] == "Guarniciones Adicionales") echo "selected"; ?>>Guarniciones Adicionales</option>
                            <option value="Piqueo" <?php if($producto["tipo"] == "Piqueo") echo "selected"; ?>>Piqueo</option>
                            <option value="Bebida Fria" <?php if($producto["tipo"] == "Bebida Fria") echo "selected"; ?>>Bebida Fria</option>
                            <option value="Bebida Caliente" <?php if($producto["tipo"] == "Bebida Caliente") echo "selected"; ?>>Bebida Caliente</option>
                        </select>
                    </div>
                    <div data-role="fieldcontain">
                        <label for="nmbPrecio">Precio:</label> 	
                        <input type="range" name="precio" width="100px" id="nmbPrecio" step="0.5" min="0" max="50" data-popup-enabled="true"  value="<?php if(is_array($producto)) echo $producto["precio"]; ?>" required />
                    </div>
                    <div data-role="fieldcontain">
                        <?php
                            if(is_array($producto)) $opcion = "Modificar";
                            else $opcion = "Registrar";
                        ?>
                        <input type="submit" name="submit" value="<?php echo $opcion; ?>" />
                    </div>
                </form>
            </div>
            <div data-role="footer">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>