<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>SIS-REST - Registro Mesa</title>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/los_patos.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="registroMesa" data-add-back-btn="true" data-back-btn-text="Atrás" data-theme="a">
            <div data-role="header">
                <h1>Registro Mesa</h1>
            </div>
            <div data-role="content">
                <form action="../../../Controller/MantenimientoMesaController.php" method="post" data-ajax="false">
                    <div data-role="fieldcontain">
                        <label for="txtDescripcion">Descripción:</label>
                        <input type="text" name="descripcion" id="txtDescripcion" value="" />
                    </div>
                    <div data-role="fieldcontain">
                        <input type="submit" name="submit" value="Registrar" />
                    </div>
                </form>
            </div>
            <div data-role="footer">
                <h4>Copyright SIS-REST &copy; 2014</h4>
            </div>
        </div>
    </body>
</html>