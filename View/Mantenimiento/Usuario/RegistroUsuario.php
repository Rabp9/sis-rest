<?php
    $submit = "editar";
    require_once('../../../Controller/MantenimientoUsuarioController.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Registro Usuario</title>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </script>
    </head>
    <body>
        <div data-role="page" id="registroUsuario" data-add-back-btn="true" data-back-btn-text="Atrás" data-theme="a">
            <div data-role="header">
                <?php
                    if(is_array($usuario)) $header = "Editar";
                    else $header = "Nuevo";
                ?>
                <h1><?php echo $header; ?> Usuario</h1>
            </div>
            <div data-role="content">
                <form action="../../../Controller/MantenimientoUsuarioController.php" method="post" data-ajax="false">
                    <?php if(is_array($usuario)) { ?>
                    <div data-role="fieldcontain">
                        <label for="txtCodigo">Código:</label>
                        <input type="text" name="idUsuario" id="txtCodigo" value="<?php if(is_array($usuario)) echo $usuario["idUsuario"]; ?>" readonly />
                    </div>
                    <?php } ?>
                    <div data-role="fieldcontain">
                        <label for="txtUsername">Username:</label>
                        <input type="text" name="username" id="txtUsername" value="<?php if(is_array($usuario)) echo $usuario["username"]; ?>" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtPassword">Password:</label>
                        <input type="password" name="password" id="txtPassword" value="<?php if(is_array($usuario)) echo $usuario["password"]; ?>" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtRepassword">Confirmar Password:</label>
                        <input type="password" name="repassword" id="txtRepassword" value="<?php if(is_array($usuario)) echo $usuario["password"]; ?>" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="sltRol" class="select">Rol:</label>
                        <select name="rol" id="sltRol" data-native-menu="false">
                            <option data-placeholder="true">Seleccionar</option>
                            <option value="administrador" <?php if($usuario["rol"] == "administrador") echo "selected"; ?>>Administrador</option>
                            <option value="mozo" <?php if($usuario["rol"] == "mozo") echo "selected"; ?>>Mozo</option>
                            <option value="cliente" <?php if($usuario["rol"] == "cliente") echo "selected"; ?>>Cliente</option>
                        </select>
                    </div>
                    <div data-role="fieldcontain">
                        <?php
                            if(is_array($usuario)) $opcion = "Modificar";
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