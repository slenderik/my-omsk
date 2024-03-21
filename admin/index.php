<?php 
    session_start();
    //setcookie("age", $age, time() + 3600);
    $_SESSION["admin"] = "yes bro";
    echo "Выдал админ права, Брательник";
    
    // Check to admin bro
    if (!isset($_SESSION["admin"])){
        include('../functions/address.php');
        header('Location: '.$mainPageLink);
        die;
    }
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
                <li class="breadcrumb-item active" aria-current="page">Админка</li>
            </ol>
        </nav>

        <h1>Админка. Здорово что вы админ!</h1>
        
        <div class="row">
            <div class="col-12">
                <a href="routes.php" class="btn btn-primary">Маршруты</a>
                <a href="places.php" class="btn btn-primary">Места</a>
            
            </div>     

        </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>