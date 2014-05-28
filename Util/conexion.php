<?php
    $dsn = "mysql:dbname=patos-bd;host=localhost";
    $user = "root";
    $password = "";
    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo "Falló la conexión: " . $e->getMessage();
    }

?>