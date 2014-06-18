<?php 
    if(!defined('__ROOT__'))
        define('__ROOT__', dirname(dirname(__FILE__))); 
    require_once(__ROOT__.'/DAO/ReservaDAO.php');
    require_once(__ROOT__.'/DAO/MesaDAO.php');
    require_once(__ROOT__.'/DAO/HoraDAO.php');
    require_once(__ROOT__.'/DAO/ClienteDAO.php');
    
    if(isset($_GET["submit"]))
        $submit = $_GET["submit"];
    
    elseif(!empty($_POST))
        $submit = $_POST["submit"];
    
    if($submit == "Index") {
        $fechaUltimaReserva = getUltimaFecha();
    }
    
    if($submit == "Crear") {
        $fechaActual = $_POST["fechaUltimaReserva"];
        $fecha = $_POST["fechaCrearReserva"];
        crearReservas($fechaActual, $fecha);
        
        header("Location: ../View/Reservaciones/listaReservas.php?rpta=correcto&fecha=" . $fecha);
    }
      
    if($submit == "Buscar") {
        $fecha = $_POST["fecha"];
        
        header("Location: ../View/Reservaciones/DetalleFecha.php?fecha=" . $fecha);
    }
    
    if($submit == "Lista") {
        $reservas = getReservasActuales();
    }
    
    if($submit == "Detalle") {
        if(isset($_GET["fecha"])) {
            $fecha = $_GET["fecha"];
            $mesas1 = getMesasReservas($fecha . " 11:00:00");
            $mesas2 = getMesasReservas($fecha . " 13:00:00");
            $mesas3 = getMesasReservas($fecha . " 15:00:00");
        }
    }
    
    if($submit == "Confirmar") {
        if(isset($_GET["idMesa"])) {
            $mesa = getMesa($_GET["idMesa"]);
            $fechaHora = $_GET["fecha"] . " " . $_GET["hora"];
            $hora = getHoraByHoraInicio($fechaHora); 
            if($_SESSION["rol"] == "cliente") {
                $cliente = getClienteByIdUsuario($_SESSION["idUsuario"]);
                $nombreCompleto = $cliente["apellidoPaterno"] . " " . $cliente["apellidoMaterno"] . ", " . $cliente["nombres"];
            }
            elseif($_SESSION["rol"] == "administrador") {
                $reserva =  getReservaByIdHoraIdMesa($hora["idHora"], $mesa["idMesa"]);
                $cliente = getClienteByIdUsuario($reserva["idUsuario"]);
                $nombreCompleto = $cliente["apellidoPaterno"] . " " . $cliente["apellidoMaterno"] . ", " . $cliente["nombres"];
            }
        }
    } 
    
    if($submit == "Registrar") {
        $reserva["idMesa"] = $_POST["idMesa"];
        $reserva["idHora"] = $_POST["idHora"];
        $reserva["idUsuario"] = $_POST["idUsuario"];
        $reserva["fechaHora"] = $_POST["fechaHora"];
        $reserva["nPersonas"] = $_POST["nPersonas"];
        if($id = registrarReserva($reserva))
            header("Location: ../View/Reservaciones/listaReservasCliente.php?rpta=correcto&id=" . $id);
        else
            header("Location: ../View/Reservaciones/listaReservasCliente.php?rpta=incorrecto");  
    }
    
    if($submit == "ListaCliente") {
        $reservas = getReservaByIdUsuario($_SESSION["idUsuario"]);
    }
      
    if($submit == "DetalleReservaCliente") {
        echo "dsadd";
        if(isset($_GET["idReserva"])) {
            echo $_GET["idReserva"];
            $reserva = getReserva($_GET["idReserva"]);
            $cliente = getClienteByIdUsuario($reserva["idUsuario"]);
            $nombreCompleto = $cliente["apellidoPaterno"] . " " . $cliente["apellidoMaterno"] . ", " . $cliente["nombres"];
        }
    } 
?>