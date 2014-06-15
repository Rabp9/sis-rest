<?php
    $submit = "editar";
    require_once('../../../Controller/MantenimientoLugarController.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Registro Lugar</title>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="registroLugar" data-add-back-btn="true" data-back-btn-text="Atrás" data-theme="a">
            <div data-role="header">
                <?php
                    if(is_array($lugar)) $header = "Editar";
                    else $header = "Nuevo";
                ?>
                <h1><?php echo $header; ?> Lugar</h1>
            </div>
            <div data-role="content">
                <form action="../../../Controller/MantenimientoLugarController.php" method="post" data-ajax="false" enctype="multipart/form-data">
                    <?php if(is_array($lugar)) { ?>
                    <div data-role="fieldcontain">
                        <label for="txtCodigo">Código:</label>
                        <input type="text" name="idLugar" id="txtCodigo" value="<?php if(is_array($lugar)) echo $lugar["idLugar"]; ?>" readonly />
                    </div>
                    <?php } ?>
                    <div data-role="fieldcontain">
                        <label for="txtTitulo">Título:</label>
                        <input type="text" name="titulo" id="txtTitulo" value="<?php if(is_array($lugar)) echo $lugar["titulo"]; ?>" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtaDescripcion">Descripción:</label>
                        <textarea rows="8" name="descripcion" id="txtaDescripcion"><?php if(is_array($lugar)) echo $lugar["descripcion"]; ?></textarea>
                    </div>
                    <div data-role="fieldcontain">
                        <label for="flFoto">Foto:</label>
                        <input type="file" name="foto" id="flFoto" value="" />
                        <?php if(is_array($lugar)) { ?>
                            <img src="../../../resources/img/lugares/<?php echo $lugar["foto"]; ?>" alt="Foto" width="100%"/>
                        <?php } ?>
                    </div>
                    <div data-role="fieldcontain">
                        <?php
                            if(is_array($lugar)) $opcion = "Modificar";
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