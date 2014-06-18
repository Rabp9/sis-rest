<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Registro Usuario</title>
        <link rel="stylesheet" type="text/css" href="resources/css/los_patos.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="registroUsuario" data-theme="a">
            <div data-role="header">
                <a href="login.php" data-icon="back" data-ajax="false">Atrás</a>
                <h1>Registrar Usuario</h1>
            </div>
            <div data-role="content">
                <form id="frmRegistroUsuario" action="Controller/HomeController.php?submit=Registrar" method="post" data-ajax="false">
                    <div data-role="fieldcontain">
                        <label for="txtNombres">Nombres:</label>
                        <input type="text" name="nombres" id="txtNombres" value="" required maxlength="60" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtApellidoPaterno">Apellido Paterno:</label>
                        <input type="text" name="apellidoPaterno" id="txtApellidoPaterno" value="" required maxlength="40" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtApellidoMaterno">Apellido Materno:</label>
                        <input type="text" name="apellidoMaterno" id="txtApellidoMaterno" value="" required maxlength="40"  />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtTelefono">Teléfono:</label>
                        <input type="text" name="telefono" id="txtTelefono" value="" maxlength="10"  />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtEmail">Email:</label>
                        <input type="email" name="email" id="txtEmail" value="" maxlength="45"  />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtaDireccion">Dirección:</label>	
                        <textarea rows="8" name="direccion" id="txtaDireccion" maxlength="60"></textarea>
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtUsername">Username:</label>
                        <input type="text" name="username" id="txtUsername" value="" required maxlength="20"/>
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtPassword">Password:</label>
                        <input type="password" name="password" id="txtPassword" value="" maxlength="45" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtRepassword">Confirmar Password:</label>
                        <input type="password" name="repassword" id="txtRepassword" value="" maxlength="45" />
                    </div>
                    <div data-role="fieldcontain">
                        <input type="submit" name="submit" value="Registrar" />
                    </div>
                </form>
                <script type="text/javascript">
                    $("#frmRegistroUsuario").submit(function() {
                        var password = $("#txtPassword").val();
                        var repassword = $("#txtRepassword").val();
                        if(password != repassword) {
                            alert("Las contraseñas no coinciden");
                            return false;
                        }
                    });
                </script>
            </div>
            <div data-role="footer">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>