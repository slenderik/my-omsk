<?php
require('template.php');

session_start();
if (isset($_POST['admin-password']) && $_POST['admin-password'] == 'admin-pidoras') {

    try {
        $db = new PDO("mysql:host=localhost;dbname=my-omsk", "root", "");
        $sql = "INSERT INTO `places`
                (`title`, `link_name`, `description`, `work_time`, `weekends`, `address_name`, `yandex_map_id`, `map_link`)
                VALUES (:title, :link_name, :place_description, :work_time, :weekends, :address_name, :yandex_map_id, :map_link, :vk_link)";
        $stmt = $db->prepare($sql);

        $title = $_POST["title"];
        $place_description = $_POST["description"];

        // Загружаем сточные данные
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":link_name", $_POST["link-name"]);
        $stmt->bindValue(":place_description", $place_description);
        
        $stmt->bindValue(":work_time", $_POST["work-time"]);
        $stmt->bindValue(":weekends", $_POST["weekends"]);

        $stmt->bindValue(":address_name", $_POST["address-name"]);
        $stmt->bindValue(":yandex_map_id", $_POST["org-map-id"]);
        $stmt->bindValue(":map_link", $_POST["map_link"]);

        $stmt->bindValue(":", $_POST["address-name"]);
        $stmt->bindValue(":yandex_map_id", $_POST["org-map-id"]);
        $stmt->bindValue(":map_link", $_POST["map_link"]);
        
        // выполняем prepared statement
        $affectedRowsNumber = $stmt->execute();
        echo "Добавлено: $affectedRowsNumber строк";

        $sql = "SELECT `id` FROM `places` WHERE `title` = :title AND `description` = :place_description";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":place_description", $place_description);
        $stmt->execute();
        $placeId = "";
        foreach ($stmt as $row) {
            $placeId = $row["id"];
        };
        echo 'ID -> ' . $placeId; echo "<br>";

        // Загружаем теги
        // foreach($tags as $tag) {
        //     echo "$tag<br />"; 
        //     $sql = "INSERT INTO `place_categories` (`place_id`, `link-name`) VALUES ($tag, :linkname)";
        //     $affectedRowsNumber = $stmt->execute();
        //     echo "Добавлено: $affectedRowsNumber тегов";
        // };


        // Загружаем фотографии
        if ($_FILES) {
            foreach ($_FILES["image-files"]["error"] as $key => $error) {
                if ($error != UPLOAD_ERR_OK) {
                    echo "UPLOAD_ERR_OK добавления фото. Фото №" . $key . " не загружено.";
                    continue;
                }

                // Загружаем файл в папку
                $tmp_name = $_FILES["image-files"]["tmp_name"][$key];
                $imageFilePath = "place_images/" . $_FILES["image-files"]["name"][$key];
                $isFileUploated = move_uploaded_file($tmp_name, $imageFilePath);
                $alt = $_POST["image-alts"][$key];
                if ($isFileUploated) {
                    echo "ЗАГРУЖЕНОы" . $key . ".";
                    continue;
                }
                else {
                    echo "Ошибка загрузки фото на сервер. Фото №" . $key . " не загружено.";
                    continue;
                }
                
                // Добавляем в базу данных информацию о фотографии
                $sql = "INSERT INTO `place_images`
                (`place_id`, `image_path`, `alt`)
                VALUES (:place_id, :image_path, :alt)";

                $stmt = $db->prepare($sql);

                $stmt->bindValue(":place_id", $placeId);
                $stmt->bindValue(":image_path", $imageFilePath);
                $stmt->bindValue(":alt", $alt);

                $affectedRowsNumber = $stmt->execute();

                echo "Добавлено: $affectedRowsNumber фото";
                echo "<br>";
            }
        }

        $filePath = create_or_update_place($placeId);
        echo '<a target="_blank" href="' . $filePath . '"> Ссылка на статью </a>';
    }
    catch (PDOException $e) {
        echo "Ошибка добавления: " . $e->getMessage() . " - " . $e->getTraceAsString();
    }
};


?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new place</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>

<div class="wrapper">
    <form  class="admin-panel" action="create_post.php" method="post"  enctype="multipart/form-data">
        <h2>Добавить место в базу данных</h2>

        <label for="title">Название</label>
        <input name="title" value="Terra Coffe" type="text" size="30">

        <label for="link-name">Ссылка на место</label>
        <input name="link-name" value="terr-coffe" type="text" size="30">

        <label for="description">Описание</label>
        <input name="description" value="Кофеварка ебаная" cols="40" rows="3"></input>

        <label for="work-time">Время работы</label>
        <input name="work-time" value="12:00 - 21:00" type="text" size="40">
        
        <label for="weekends">Выходные дни</label>
        <input name="weekends" value="сб-вс выходные" type="text" size="40">
    
        <label for="address-name">Адрес буквами</label>
        <input name="address-name" value="ул. Ленина, 9Б" type="text" size="40">

        <label for="org-map-id">ID организации на картах</label>
        <input name="org-map-id" value="20435594221" type="text" size="40">

        <label for="map_link">Ссылка на карту</label>
        <input name="map_link" value="20435594221" type="text" size="40">
        
        <fieldset>
            <legend>Соц сети</legend>
            <label for="map_link">Caйт</label>
            <input name="site-link" value="https://vk.com/myomsk_app" type="text">

            <label for="map_link">ВКонтакте</label>
            <input name="vk-link" value="https://vk.com/myomsk_app" type="text">

            <label for="map_link">Telegramm</label>
            <input name="tg-link" value="https://vk.com/myomsk_app" type="text">
        </fieldset>

        <fieldset>
            <legend>Изображение~</legend>
            <div>
                <input type="file" name="image-files[]"/>
                <input name="image-alts[]" value="Например, красное бревно" type="text">
            </div>

            <div>
                <input type="file" name="image-files[]"/>
                <input name="image-alts[]" value="Красное бревно" type="text">
            </div>

            <div>
                <input type="file" name="image-files[]"/>
                <input name="image-alts[]" value="вау!! расное бревно" type="text">
            </div>
        </fieldset>

        <fieldset>
            <legend>Теги</legend>
            <p>Кофейня <input type="checkbox" name="tags[]" value="Кофейня"></p>
            <p>Ресторан <input type="checkbox" name="tags[]" value="Ресторан"></p>
            <p>Памятник <input type="checkbox" name="tags[]" value="Памятник"></p>
        </fieldset>

        <label for="admin-password">Пароль админа:</label>
        <input type="password" value="admin-pidoras" name="admin-password">

        <div>
            <input class="button-black half-container" type="reset" value="Очистить">
            <input class="button-black half-container" type="submit"value="Добавить и создать">
        </div>

    </form>
</div>
    
</body>
</html>