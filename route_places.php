<?php

    include('index.php');
    include('db_connect.php');

    // if (!isset($_POST["route_id"])){
    //     header('Location: '.$mainPageLink);
    //     die;
    // }
    echo "anime";

    $route_id = $_POST["route_id"];

    try {
        $sql = "SELECT * FROM route_places WHERE route_id = :route_id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":route_id", $route_id);
        $stmt->execute();

        if(!$stmt->rowCount() > 0){
            foreach ($stmt as $row) {
                $place_id = $row["place_id"];
                $route_id = $row["route_id"];
                $type = $row["type"];
                $created_at = $row["created_at"];
                // гененировавть
                // изменить
                // удалить
                // создать
                echo "
                <div>
                    <h3>Информация о пользователе</h3>
                    <p>Имя: $username</p>
                    <p>Возраст: $userage</p>
                </div>";
            }
        }
        else{
            echo "Не найдены места в маршруте.";
        }
    }
    catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    };
?>