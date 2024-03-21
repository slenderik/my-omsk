<?php
    session_start();
    include('../functions/address.php');

    // Check to admin bro
    if (!isset($_SESSION["admin"])){
        header('Location: '.$mainPageLink);
        die;
    }

    if (!isset($_POST["route_id"])){
        header('Location: '.$mainPageLink);
        die;
    }
    

    include('../functions/db.php');
    $routeId = $_POST["route_id"];

    $sql = "SELECT * FROM route_places WHERE route_id = :route_id";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":route_id", $routeId);
    $stmt->execute();

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin * Routes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Админка</a></li>
                <li class="breadcrumb-item"><a href="routes.php">Маршруты</a></li>
                <li class="breadcrumb-item active" aria-current="page">Маршрут №<?echo $routeId?></li>
            </ol>
        </nav>
        
        <h1>Изменить маршрут №<?echo $routeId?></h1>
        
        <div class="row">
            <div class="col-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#routesModalCreate">
                Добавить место в маршрут
                </button>
                
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Время создания</th>
                            <th scope="col">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($stmt->rowCount() > 0){
                            foreach ($stmt as $row) {
                                $rowRouteId = $row["route_id"];
                                if (!$rowRouteId==$routeId) {
                                    echo "ОШИБКА! АЙДИ НЕ СХОДИТСЯ";
                                }
                                
                                $placeId = $row["place_id"];
                                $routeType = $row["type"];
                                $routeCreatedAt= $row["created_at"];

                                $sql = "SELECT * FROM places WHERE id = :place_id";

                                $stmt = $db->prepare($sql);
                                $stmt->bindValue(":place_id", $placeId);
                                $stmt->execute();

                                $placeTitle = "";
                                $placeLink = "";
                                $placeLinkName = "";
                                $placeDescription = "";
                                foreach ($stmt as $row) {
                                    $placeTitle = $row["title"];
                                    $placeLinkName = $row["link_name"];
                                    $placeDescription = $row["description"];
                                    $placeLink .= getLinkToPlace($placeLinkName);
                                }

                                echo "
                                <tr>
                                    <th scope='row'>{$placeId}</th>
                                    <td>{$placeTitle}</td>
                                    <td>{$placeDescription}</td>
                                    <td>{$routeCreatedAt}</td>
                                    <td>
                                        <form action='route.php' method='post'>
                                            <button type='submit' name='route_id' value={$placeId} class='btn btn-link'>Перейти</button>
                                        </form>
                                    </td>
                                </tr>";
                            }
                        }
                        else{
                            echo "<tr><td>Не найдены места в маршруте.</td><tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

                
        </div>
    </div>
    <!-- Modal Edit Route Place -->
    <div class="modal fade" id="routeModalEdit" tabindex="-1" aria-labelledby="routeModalEdit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="routeModalLabel">Создать новый маршрут</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                    <button type="button" class="btn btn-primary">Создать</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal Create New -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>