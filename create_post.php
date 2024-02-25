<?php
require('template.php');

session_start();
if (isset($_POST['admin-password']) && $_POST['admin-password'] == 'admin-pidoras') {

    try {
        $db = new PDO("mysql:host=localhost;dbname=my-omsk", "root", "");
        $sql = "INSERT INTO `places`
                (`title`, `link_name`, `description`, `work_time`, `weekand_days`, `address_name`, `yandex_map_id`, `map_link`)
                VALUES (:title, :linkname, :description, :work_time, :weekand_days, :address_name, :yandex_map_id, :map_link)";
        $stmt = $db->prepare($sql);

        $title = $_POST["title"];
        $description = $_POST["description"];

        // Загружаем сточные данные
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":linkname", $_POST["link-name"]);
        $stmt->bindValue(":description", $description);
        
        $stmt->bindValue(":work_time", $_POST["work-time"]);
        $stmt->bindValue(":weekand_days", $_POST["weekands"]);

        $stmt->bindValue(":address_name", $_POST["address-name"]);
        $stmt->bindValue(":yandex_map_id", $_POST["org-map-id"]);
        $stmt->bindValue(":map_link", $_POST["map_link"]);
        
        // выполняем prepared statement
        $affectedRowsNumber = $stmt->execute();
        echo "Добавлено: $affectedRowsNumber строк";

        // Получаем Id только добаленной записи для соединения с другими таблицами
        // $sql = "SELECT id FROM places WHERE `title`=$title AND `description`=$description";
        // $result = $conn->query($sql);
        // $result->fetch();
        // $placeId = $result->id;
        // echo 'ID -> ' . $placeId;

        $sql = "SELECT `id` FROM `places` WHERE `title` = :title AND `description` = :description";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":description", $description);
        $stmt->execute();
        $placeId = "";
        foreach ($stmt as $row) {
            $placeId = $row["id"];
        };
        echo 'ID -> ' . $placeId;

        // Загружаем теги
        // foreach($tags as $tag) {
        //     echo "$tag<br />"; 
        //     $sql = "INSERT INTO `place_categories` (`place_id`, `link-name`) VALUES ($tag, :linkname)";
        //     $affectedRowsNumber = $stmt->execute();
        //     echo "Добавлено: $affectedRowsNumber тегов";
        // };

        // Загружаем фотки
        if ($_FILES) {
            foreach ($_FILES["image-file"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    // Загружаем файл в папку
                    $tmp_name = $_FILES["image-file"]["tmp_name"][$key];
                    $imageFilePath = "place_images/" . $_FILES["uploads"]["name"][$key];
                    move_uploaded_file($tmp_name, $imageFilePath);
                    
                    // Загружаем в базу информацию о фотке
                    $sql = "INSERT INTO `place_images` (`place_id`, `image_path`, `alt`) VALUES (:place_id, :image_path, :alt)";

                    $stmt->bindValue(":place_id", $placeId);
                    $stmt->bindValue(":image_path", $imageFilePath);
                    $stmt->bindValue(":alt", $_POST["image-alt"]);

                    $stmt = $db->prepare($sql);
                    $affectedRowsNumber = $stmt->execute();

                    echo "Добавлено: $affectedRowsNumber фото";
                }
                else {
                    echo "Ошикба добавления фото " . $key;
                }
            }
        }

        $filePath = create_or_update_place($placeId);
        echo '<a target="_blank" href="' . $filePath . '"> Ссылка на статью </a>';
    }
    catch (PDOException $e) {
        echo "Ошибка добавления: " . $e->getTraceAsString();
    }
};


?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать плейс</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

<div class="wrapper">
    <form style="display: inline-grid;" action="create_post.php" method="post"  enctype="multipart/form-data">
        <h2>Создать статью</h2>

        <label for="title">Название</label>
        <input name="title" placeholder="Terra Coffe" type="text" size="30">

        <label for="link-name">Ссылка на место</label>
        <input name="link-name" placeholder="terr-coffe" type="text" size="30">

        <label for="description">Описание</label>
        <textarea name="description" placeholder="Кофеварка ебаная" cols="40" rows="3"></textarea>

        <label for="work-time">Время работы</label>
        <input name="work-time" placeholder="12:00 - 21:00" type="text" size="40">
        
        <label for="weekands">Выходные дни</label>
        <input name="weekands" placeholder="сб-вс выходные" type="text" size="40">
    
        <label for="address-name">Адрес буквами</label>
        <input name="address-name" placeholder="ул. Ленина, 9Б" type="text" size="40">

        <label for="org-map-id">ID организации на картах</label>
        <input name="org-map-id" placeholder="20435594221" type="text" size="40">

        <label for="map_link">Ссылка на карту</label>
        <input name="map_link" placeholder="20435594221" type="text" size="40">
        
        <fieldset>
            <legend>Соц сети</legend>
            <input name="vk-link" placeholder="https://vk.com/myomsk_app" type="text">
        </fieldset>

        <fieldset>
            <legend>Изображение~</legend>
            <input type="file" name="image-file[]"/>
            <input name="image-alt[]" placeholder="Например, красное бревно" type="text">
            
            <input type="file" name="image-file[]"/>
            <input name="image-alt[]" placeholder="Красное бревно" type="text">

            <input type="file" name="image-file[]"/>
            <input name="image-alt[]" placeholder="вау!! расное бревно" type="text">
        </fieldset>

        <fieldset>
            <legend>Теги</legend>
            <p>Кофейня <input type="checkbox" name="tags[]" value="Кофейня"></p>
            <p>Ресторан <input type="checkbox" name="tags[]" value="Ресторан"></p>
            <p>Памятник <input type="checkbox" name="tags[]" value="Памятник"></p>
        </fieldset>

        <label for="admin-password">Пароль админа:</label>
        <input type="password" name="admin-password">

        <input type="reset" value="Очистить">
        <input type="submit"value="Добавить и создать">
    </form>
</div>
    
</body>
</html>