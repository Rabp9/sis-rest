<?php
    $submit = "editar";
    require_once('../../../Controller/MantenimientoMozoController.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Registro Mozo</title>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="registroMozo" data-add-back-btn="true" data-back-btn-text="Atrás" data-theme="a">
            <div data-role="header">
                <?php
                    if(is_array($mozo)) $header = "Editar";
                    else $header = "Nuevo";
                ?>
                <h1><?php echo $header; ?> Mozo</h1>
            </div>
            <div data-role="content">
                <form action="../../../Controller/MantenimientoMozoController.php" method="post" data-ajax="false">
                    <?php if(is_array($mozo)) { ?>
                    <div data-role="fieldcontain">
                        <label for="txtCodigo">Código:</label>
                        <input type="text" name="idMozo" id="txtCodigo" value="<?php if(is_array($mozo)) echo $mozo["idMozo"]; ?>" readonly />
                    </div>
                    <?php } ?>
                    <div data-role="fieldcontain">
                        <label for="txtNombres">Nombres:</label>
                        <input type="text" name="nombres" id="txtNombres" value="<?php if(is_array($mozo)) echo $mozo["nombres"]; ?>" required maxlength="50" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtApellidoPaterno">Apellido Paterno:</label>
                        <input type="text" name="apellidoPaterno" id="txtApellidoPaterno" value="<?php if(is_array($mozo)) echo $mozo["apellidoPaterno"]; ?>" required maxlength="40" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtApellidoMaterno">Apellido Materno:</label>
                        <input type="text" name="apellidoMaterno" id="txtApellidoMaterno" value="<?php if(is_array($mozo)) echo $mozo["apellidoMaterno"]; ?>" required maxlength="40"/>
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtTelefono">Teléfono:</label>
                        <input type="text" name="telefono" id="txtTelefono" value="<?php if(is_array($mozo)) echo $mozo["telefono"]; ?>" maxlength="10" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtaDireccion">Dirección:</label>	
                        <textarea rows="8" name="direccion" id="txtaDireccion" maxlength="60"><?php if(is_array($mozo)) echo $mozo["direccion"]; ?></textarea>
                    </div>
                    <div data-role="fieldcontain">
                        <label for="sltUsuario" class="select">Usuario:</label>
                        <?php
                        if(!is_array($usuarios)) { 
                            echo "<input type='text' value='Registrar nuevo usuario antes de continuar' />";
                        }
                        else {
                        ?>
                        <select name="idUsuario" id="sltUsuario" data-native-menu="false" required>
                            <option data-placeholder="true" value="">Seleccionar</option>
                            <?php foreach ($usuarios as $usuario) { ?>
                            <option value="<?php echo $usuario["idUsuario"] ?>" <?php if(is_array($mozo)) if($mozo["idUsuario"] == $usuario["idUsuario"]) echo "selected" ?>><?php echo $usuario["username"]; ?></option>
                            <?php } ?>
                        </select>
                        <?php } ?>
                    </div>
                    <div data-role="fieldcontain">
                        <?php
                            if(is_array($mozo)) $opcion = "Modificar";
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