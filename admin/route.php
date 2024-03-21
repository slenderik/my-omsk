<?php
    session_start();
    $mainPageLink = 'index.php';

    if (!isset($_POST["route_id"])){
        header('Location: '.$mainPageLink);
        die;
    }
    

    include('../functions/db.php');
    $routeId = $_POST["route_id"];
    echo $routeId;

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

        <h1>Маршруты сайта</h1>
        
        <div class="row">
            <div class="col-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-succses" data-bs-toggle="modal" data-bs-target="#routesModalCreate">
                Создать
                </button>

                
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($stmt->rowCount() > 0){
                            foreach ($stmt as $row) {
                                $placeId = $row["id"];
                                $placeTitle = $row["title"];
                                $placeDescription = $row["description"];;
                                echo "
                                <tr>
                                    <th scope='row'>{$placeId}</th>
                                    <td>{$placeTitle}</td>
                                    <td>{$placeDescription}</td>
                                    <td>
                                        <a class='btn btn-primary'>Перегенерировать</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>