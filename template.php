<?php

function getHead($articleName) {
    $text = <<<EOD
    <!DOCTYPE html>
    <html lang="ru" xmlns:og="http://ogp.me/ns#">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
    EOD . $articleName . <<<EOD
        </title>
        <link rel="stylesheet" href="main.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="assets/images/logo-favicon.ico">
        <link rel="icon" type="image/x-icon" href="assets/images/logo-favicon.png">

        <meta name="keywords" content="Куда сходить в омске, омск, карта омска, omsk"/>
        <meta name="robots" content="index,follow"/>
        <meta name="theme-color" content="#00000">
        <meta name="description" content="Список классных мест омска. Покажем куда сегодня сходить, где поесть, погулять, развлечься или потанцевать в Омске. Не важно в какой компании, с детьми, семьёй, друзьями или девушкой">

        <meta property="og:title" content="Куда сегодня сходить в Омске?"/>
        <meta property="og:type" content="article"/>
        <meta property="og:url" content="https://my-omsk.ru/index.html"/>
        <meta property="og:site_name" content="Твой список мест Омска"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="630"/>
        <meta property="og:description" content="Список классных мест омска. Покажем куда сегодня сходить, где поесть, погулять, развлечься или потанцевать в Омске. Не важно в какой компании, с детьми, семьёй, друзьями или девушкой ^^"/>

        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        
            ym(96294939, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true,
                ecommerce:"dataLayer"
            });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/96294939" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
    </head>
    EOD;
    return $text;
}

function getHeader() {
    $text = <<<EOD
    <header>
        <a href="index.html">
            <img src='assets/images/logo.svg' alt='Логотип My-Omsk ✨' aria-hidden="true">
        </a>
    </header>
    EOD;
    return $text;
}


function getMain($articleName, $workTime, $weekendDays, $addressName, $yandexMapId, $mapLink,  $description, $imagePath, $altText) {
    $text = <<<EOD
    <main>
        <div class="wrapper">

            <!-- Image -->
            <div class="place-image-container">
                <img class="place-image-container__image" src="
    EOD . $imagePath[0] . <<<EOD
                " alt="
    EOD . $altText[0] . <<<EOD
                ">

                <!-- Back button -->
                <a href="index.html">
                    <div class="button-back">
                        <img  class="button-back__image"src="assets/images/back.svg">  
                    </div>
                </a>
                <!-- /Back button -->

                <!-- Title -->
                <div class="place-title-container">
                    <h1 class="place-title-container__text">
    EOD . $articleName . <<<EOD
                    </h1>
                </div>
                <!-- /Title -->

                <!-- Left div -->
                <div class="place-image__left-container">
                    <div class="capsule-container">
    EOD . $workTime . <<<EOD
                    </div>
                    <div class="capsule-container">
    EOD . $weekendDays . <<<EOD
                </div>
                </div>
                <!-- /left div -->
            </div>
            <!-- /Image -->

            <!-- INFO -->
            <div class="place-body-container">

                <div class="place-info-container">
                    <input
                        class="button-black"
                        type="button"
                        value="Пойти!"
                        onClick='location.href="https://yandex.ru/maps/org/
        EOD . $yandexMapId . <<<EOD
                    "'>

                    <input
                        class="text-button mobile-only"
                        type="button"
                        value="Открыть в картах"
                        onClick='location.href="yandexmaps://maps.yandex.ru/?oid=
        EOD . $yandexMapId . <<<EOD
                    "'>
                    <div class="place-description">
                        <p>
        EOD . $description . <<<EOD
                        </p>
                    </div>
                </div>
                
                <!-- MAP -->
                <div class="place-map-container">
                    <iframe
                        src="
        EOD . $mapLink . <<<EOD
                        " allowfullscreen="true" class="map-container__frame"
                    ></iframe>
                    <div class="capsule-container map-address-capsule">
        EOD . $addressName . <<<EOD
                    </div>
                </div>
                <!-- /MAP -->
            </div>
            <!-- /INFO -->
        </div>
    </main>
    EOD;
    return $text;
}


function getFooter() {
    $text = <<<EOD
    <footer>
        <div class="wrapper">
            <hr>

            <div class="footer-inner">
                <p>Что-то работает ни так? Получили плохой опыт от места из нашего приложения? Сообщите нам — а мы разберёмся.</p>

                <p>К сожалению мы могли использовать чужие изображения.
                    Если хотите чтобы мы убрать изобрежение сообщите нам
                    <a class="no-link" href="https://vk.com/myomsk_app"><span class="color-telegram">в телеграмме</span></a> или
                    <a class="no-link" href="https://vk.com/myomsk_app"><span class="color-vkontakte">ВКонтакте</span></a>.
                </p>
                
                <ul class="social-media"> 
                    <a href="https://vk.com/myomsk_app" target="_blank"><img class="social-media__item-square" src="assets/images/VK Logo.svg" alt="Наша ВКонтакте страница"/></a>
                    <a href="https://t.me/myomsk_app" target="_blank"><img class="social-media__item-round" src="assets/images/telegram logo.svg" alt="Наша Telegram канал"/></a>
                </ul>
            </div>
        </div>
    </footer>
    EOD;
    return $text;
}


function create_or_update_place($placeId) {
    
    try {
        $db = new PDO("mysql:host=localhost;dbname=my-omsk", "root", "");

        $sql = "SELECT * FROM `places` WHERE `id` = $placeId";
        $result = $db->query($sql);

        while($row = $result->fetch()){
            $title = $row["title"];
            $linkName = $row["link_name"];
            $description = $row["description"];

            $workTime = $row["work_time"];
            $weekendDays = $row["weekends"];

            $mapLink = $row["map_link"];
            $addressName = $row["address_name"];
            $yandexMapId = $row["yandex_map_id"];
        }

        $sql = "SELECT * FROM `place_images` WHERE `place_id` = $placeId";
        $result = $db->query($sql);

        $altText = [];
        $imagePath = [];

        while($row = $result->fetch()){
            $altText[] = $row["alt"];
            $imagePath[] = $row["image_path"];
        }

    }
    catch (PDOException $e) {
        echo "Ошикба создания: " . $e->getTraceAsString();
    }

    $siteText = '';
    $siteText .= getHead($title);
    $siteText .= "<body>";
    $siteText .= getHeader();
    //tags may be here later!
    $siteText .= getMain(
        $title,
        $workTime,
        $weekendDays,
        $addressName,
        $yandexMapId,
        $mapLink,
        $description,
        $imagePath,
        $altText
    );
    $siteText .= getFooter();
    $siteText .= "</body>";
    $siteText .= "</html>";


    $filePath = $linkName . '.html';
    
    $fh = fopen($filePath, 'w');
    fwrite($fh, $siteText);
    fclose($fh);
    
    return $filePath;
}
?>