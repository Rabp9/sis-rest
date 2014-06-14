<?php
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ); 
    $dsn = "mysql:dbname=patos-bd;host=localhost";
    $user = "root";
    $password = "";
    try {
        $dbh = new PDO($dsn, $user, $password, $options);
    } catch (PDOException $e) {
        echo "Falló la conexión: " . $e->getMessage();
    }

?>