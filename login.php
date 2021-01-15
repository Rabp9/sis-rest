<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST</title>
        <link rel="stylesheet" type="text/css" href="resources/css/los_patos.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <link rel="stylesheet" type="text/css" href="resources/css/dashborad.css"/>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="homePage" data-theme="a">
            <div data-role="header">
                <h1>LOGIN</h1>
            </div>
            <div data-role="content">
                <form action="Controller/LoguearController.php" method="post" data-ajax="false" data-add-back-btn="true" data-back-btn-text="Atrás" >
                    <figure id="topimg">
                        <img src="resources/img/logo.png" alt="image" />
                    </figure>
                    <div data-role="fieldcontain">
                        <label for="txtUsername">Username:</label>
                        <input type="text" name="username" id="txtUsername" value="" />
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtPassword">Password:</label>
                        <input type="password" name="password" id="txtPassword" value="" />
                    </div>
                    <div data-role="fieldcontain">
                        <input type="submit" name="submit" value="Ingresar" />
                    </div>
                    <div data-role="fieldcontain">
                        <a style="text-decoration: none;" href="registrarUsuario.php" data-ajax="false"><button type="button">Registrar Usuario</button></a>
                    </div>
                </form>
            </div>
            <div data-role="footer">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>    
        <?php
        if ($_GET["rpta"] == "loginError") {
        ?>
        <div data-role="dialog" id="dialogo" data-close-btn="none">
            <div data-role="header">
                <h1>Mensaje</h1>
            </div>
            <div data-role="content">
                <p>Usuario o Contraseña incorrectos</p>
                <a href="login.php" data-role="button" data-ajax="false" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-up-a"><span class="ui-btn-inner"><span class="ui-btn-text">Cerrar</span></span></a>
            </div>
        </div>​        
        <script type="text/javascript">
            $(document).on('pageinit', function() {
                $.mobile.changePage( "#dialogo", { role: "dialog" } );
            });
        </script>
        <?php }?>
    </body>
</html>