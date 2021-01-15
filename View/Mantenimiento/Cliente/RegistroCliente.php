<?php
    $submit = "editar";
    require_once('../../../Controller/MantenimientoClienteController.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Registro Cliente</title>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="registroCliente" data-add-back-btn="true" data-back-btn-text="Atrás" data-theme="a">
            <div data-role="header">
                <?php
                    if(is_array($cliente)) $header = "Editar";
                    else $header = "Nuevo";
                ?>
                <h1><?php echo $header; ?> Cliente</h1>
            </div>
            <div data-role="content">
                <form id="frmRegistroCliente" action="../../../Controller/MantenimientoClienteController.php" method="post" data-ajax="false">
                    <?php if(is_array($cliente)) { ?>
                    <div data-role="fieldcontain">
                        <label for="txtCodigo">Código:</label>
                        <input type="text" name="idCliente" id="txtCodigo" value="<?php if(is_array($cliente)) echo $cliente["idCliente"]; ?>" readonly />
                    </div>
                    <?php } ?>
                    <div data-role="fieldcontain">
                        <label for="txtNombres">Nombres:</label>
                        <input type="text" name="nombres" id="txtNombres" value="<?php if(is_array($cliente)) echo $cliente["nombres"]; ?>" required maxlength="60" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtApellidoPaterno">Apellido Paterno:</label>
                        <input type="text" name="apellidoPaterno" id="txtApellidoPaterno" value="<?php if(is_array($cliente)) echo $cliente["apellidoPaterno"]; ?>" required maxlength="40" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtApellidoMaterno">Apellido Materno:</label>
                        <input type="text" name="apellidoMaterno" id="txtApellidoMaterno" value="<?php if(is_array($cliente)) echo $cliente["apellidoMaterno"]; ?>" required maxlength="40"  />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtTelefono">Teléfono:</label>
                        <input type="text" name="telefono" id="txtTelefono" value="<?php if(is_array($cliente)) echo $cliente["telefono"]; ?>" maxlength="10"  />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtEmail">Email:</label>
                        <input type="email" name="email" id="txtEmail" value="<?php if(is_array($cliente)) echo $cliente["email"]; ?>" maxlength="45"  />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtaDireccion">Dirección:</label>	
                        <textarea rows="8" name="direccion" id="txtaDireccion" maxlength="60"><?php if(is_array($cliente)) echo $cliente["direccion"]; ?></textarea>
                    </div>
                    <div data-role="fieldcontain">
                        <label for="sltUsuario" class="select">Usuario:</label>  <?php
                        if(!is_array($usuarios))
                            echo "<input type='text' value='Crear un usuario nuevo para asociarlo al cliente' />";
                        ?>
                        <select name="idUsuario" id="sltUsuario" data-native-menu="false">
                            <option data-placeholder="true" >Seleccionar</option>
                            <?php foreach ($usuarios as $usuario) { ?>
                            <option value="<?php echo $usuario["idUsuario"] ?>" <?php if(is_array($cliente)) if($cliente["idUsuario"] == $usuario["idUsuario"]) echo "selected" ?>><?php echo $usuario["username"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div data-role="fieldcontain">
                        <?php
                            if (is_array($cliente)) $opcion = "Modificar";
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
        
        <?php if(isset($_GET["rpta"]) === "correcto") { ?>
        <div data-role="dialog" id="dialogo" data-close-btn="none">
            <div data-role="header">
                <h1>Mensaje</h1>
            </div>
            <div data-role="content">
                Todo bien
                <a href="ListaClientes.php" data-role="button" data-ajax="false" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-up-a"><span class="ui-btn-inner"><span class="ui-btn-text">Cerrar</span></span></a>
            </div>
        </div>​
        <?php } ?>
        <?php if(isset($_GET["rpta"])) { ?>
        <script type="text/javascript">
            $(document).on('pageinit', function() {
                $.mobile.changePage( "#dialogo", { role: "dialog" } );
            });
        </script>
        <?php }?>
    </body>
</html>