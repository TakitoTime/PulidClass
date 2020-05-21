<?php

    $servidor='SG-pulidclass-2383-master.servers.mongodirector.com';
    $database='pulidclass';
    $user='sgroot';
    $password='J4.bV2ou3lILmfhN';

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$database", $user, $password);
    } catch (PDOException $e) {
        echo "Error:" . $e->getMessage();
    }

?>