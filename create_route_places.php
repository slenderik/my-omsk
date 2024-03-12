<?php
    include('db_connect.php');
    include('template.php');
    
    $filePath = generate_route(1);
    echo "<a href='{$filePath}'>Ссылка на статью {$filePath}</a>";

    function generate_route($routeId) {
        global $db;
        global $filePath;
        $routeContent = '';
        $routeTitle = '';
        $linkName = '';

        try {
            $sql = "SELECT * FROM `routes` WHERE `id` = :route_id";

            $stmt = $db->prepare($sql);
            $stmt->bindValue(":route_id", $routeId);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                foreach ($stmt as $row) {
                    global $linkName;
                    global $routeTitle;
                    $routeTitle = $row['title'];
                    $linkName = $row['link_name'];  
                }
            };  
            
            $i = 0; 
            // if(!$stmt->rowCount() > 0){
            //     $routeContent .= 'Не найдены места в маршруте.';
            //     continue;
            // }
            $sql = "SELECT * FROM `route_places` WHERE `route_id` = :route_id";

            $stmt = $db->prepare($sql);
            $stmt->bindValue(":route_id", $routeId);
            $stmt->execute();

            foreach ($stmt as $row) {
                $i += 1;

                $placeId = $row["place_id"];
                
                $sql = "SELECT * FROM `places` WHERE `id` = :place_id";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":place_id", $placeId);
                $stmt->execute();
                
                if($stmt->rowCount() > 0){
                    foreach ($stmt as $row) {
                        $placeTitle = $row['title'];
                        $routeLinkName = $row['link_name'];
                    };
                };
                
                $pagePath = 'places/' . $routeLinkName . '.html';
                $sql = "SELECT * FROM `place_images` WHERE `place_id` = $placeId";
                $result = $db->query($sql);

                $imagePath = [];
                $imageAlt = [];

                while($row = $result->fetch()){
                    $imageAlt[] = $row["alt"];
                    $imagePath[] = $row["image_path"];
                }

                global $routeContent;
                $routeContent .= "
                <div class='route-block' id='place{$i}'>
                    <div class='route-block__number'>{$i}</div>
                    <a href='{$pagePath}'><div id='title{$i}' class='route-block__title'>{$placeTitle}</div></a>
                    <img id='image{$i}' class='route-block__image' src='places_images/{$imagePath[0]}' alt='{$imageAlt[0]}' loading='lazy'>
                    
                    <a class='route-block__link' href='terr-coffe.html'>
                        <div id='button{$i}' class='route-block__button'>Пойти</div>
                    </a>
                </div>";
            }
        }
        catch (Exception  $e) {
            echo "Ошибка генирации: " . $e->getMessage();
        }
        catch (PDOException $e) {
            echo "Ошибка : " . $e->getMessage();
        }

        $siteText = '';
        $siteText .= getHead($routeTitle);
        $siteText .= getHeader();
        $siteText .= "<div class='routes_wrapper'>";
        $siteText .= $routeContent;
        $siteText .= "
            <script>
                var allButtons = document.querySelectorAll('div[class=route-block]');
                console.log('Found', allButtons.length);

                for (var i = 0; i < allButtons.length; i++) {
                allButtons[i].addEventListener('click', function RouteCliker(event) {
                    let id = event.currentTarget.id.replace('place', '');
                    console.log(id);

                    let block = document.getElementById('place' + id);
                    block.classList.toggle('open');

                    let image = document.getElementById('image' + id);
                    image.classList.toggle('open');

                    let title = document.getElementById('title' + id);
                    title.classList.toggle('open');

                    let button = document.getElementById('button' + id);
                    button.classList.toggle('open');

                    console.log('GREAT');
                })};
            </script>
            ";
        $siteText .= "</div>";
        $siteText .= getFooter();


        $filePath = 'routes/' . $linkName . '.html';
        
        $fh = fopen($filePath, 'w');
        fwrite($fh, $siteText);
        fclose($fh);

        return $filePath;
    };
?>