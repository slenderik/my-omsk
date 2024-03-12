<?php
    $db;

    try {
        // подключаемся к серверу
        $db = new PDO("mysql:host=localhost;dbname=my-omsk", "root", "");
        echo "БД подключена";
    }
    catch (PDOException $e) {
        echo "БД ошибка: " . $e->getMessage();
    }
?>