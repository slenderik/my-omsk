<?php

$mainPageLink = 'index.php';

function getCSS(...$filenames) {
    $text = "";
    $text .= "<!-- CSS styles -->";
    foreach ($filenames as $filename) {
        $text .= "<link rel='stylesheet' href='css/{$filename}'>";
    };
    $text .= "<!-- /CSS styles -->";
    return $text;
}

function getSEO() {
    $text = "<!-- SEO tags-->
    <meta name='keywords' content='Куда сходить в омске, омск, карта омска, omsk'/>
    <meta name='robots' content='index,follow'/>
    <meta name='theme-color' content='#00000'>
    <meta name='description' content='Список классных мест омска. Покажем куда сегодня сходить, где поесть, погулять, развлечься или потанцевать в Омске. Не важно в какой компании, с детьми, семьёй, друзьями или девушкой'>
    <!-- /SEO tags-->";
    return $text;
}

function getOpenGraph() {
    $text = "<!-- Open Graph -->
    <meta property='og:type' content='article'/>
    <meta property='og:title' content='Куда сегодня сходить в Омске?'/>
    <meta property='og:site_name' content='Твои места Омска'/>
    <meta property='og:url' content='https://my-omsk.ru/index.html'/>

    <meta property='og:image:height' content='630'/>
    <meta property='og:image:width' content='1200'/>
    <meta property='og:description' content='Список классных мест омска. Покажем куда сегодня сходить, где поесть, погулять, развлечься или потанцевать в Омске. Не важно в какой компании, с детьми, семьёй, друзьями или девушкой ^^'/>
    <!-- /Open Graph -->";
    return $text;
}

function getPreloads() {
    $text = "<!-- Preloads -->
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link rel='preload' href='/fonts/static/Raleway-Regular.ttf'
        as='font' type='font/ttf' crossorigin='anonymous'/>
    <!-- /Preloads -->";
    return $text;
}

function getFavicon() {
    $text = "<!-- Favicon -->
    <link rel='shortcut icon' href='assets/images/logo-favicon.ico'>
    <link rel='icon' type='image/x-icon' href='assets/images/logo-favicon.png'>
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap' rel='stylesheet'>
    <!-- /Favicon -->";
    return $text;
}

function getYandexMetrika() {
    $text = "<!-- Yandex.Metrika counter -->
        <script type='text/javascript' >
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
            (window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js', 'ym');
        
            ym(96294939, 'init', {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true,
                ecommerce:'dataLayer'
            });
        </script>
        <noscript><div><img src='https://mc.yandex.ru/watch/96294939' style='position:absolute; left:-9999px;' alt='' /></div></noscript>
        <!-- /Yandex.Metrika counter -->";
        return $text;
}

function getGoogleAnalytics() {
    $text = "<!-- Google tag (gtag.js) -->
<script async src='https://www.googletagmanager.com/gtag/js?id=G-L90RFB24P5'></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-L90RFB24P5');
</script>";
    return $text;
}


function getHead($articleName, ...$headBlocks) {
    $text = "
    <!DOCTYPE html>
    <html lang='ru' xmlns:og='http://ogp.me/ns#'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>{$articleName}</title>";
        
    foreach ($headBlocks as $block) {
        $text .= $block;
    }

    $text .= "</head>
    <body>"; 
    return $text;
}

function getHeader() {
    global $mainPageLink;
    $text = "
    <header>
        <a href='{$mainPageLink}'>
            <img src='assets/images/logo.svg' alt='Логотип My-Omsk ✨' aria-label='Link to main page' aria-hidden='true'>
        </a>
    </header>
    ";
    return $text;
}


function getMain($articleName, $workTime, $weekendDays, $addressName, $yandexMapId, $mapLink,  $description, $imagePath, $altText) {
    global $mainPageLink;
    $text = "
    <main>
        <div class='wrapper'>

            <!-- Image -->
            <div class='place-image-container'>
                <img class='place-image-container__image' src='{$imagePath[0]}' alt='{$altText[0]}'>

                <!-- Back button -->
                <a href='javascript:history.back()'>
                    <div class='button-back'>
                        <img class='button-back__image'src='assets/images/back.svg'>  
                    </div>
                </a>
                <!-- /Back button -->

                <!-- Title -->
                <div class='place-title-container'>
                    <h1 class='place-title-container__text'>{$articleName}</h1>
                </div>
                <!-- /Title -->

                <!-- Left div -->
                <div class='place-image__left-container'>
                    <div class='capsule-container'>{$workTime}</div>
                    <div class='capsule-container'>{$weekendDays}</div>
                </div>
                <!-- /left div -->
            </div>
            <!-- /Image -->


            <div class='place-body-container'>

                <!-- INFO -->
                <div class='place-info-container'>
                    <input
                        type='button' class='button-black fil-container'
                        value='Пойти!' accesskey='o'
                        onClick='location.href='https://yandex.ru/maps/org/{$yandexMapId}''
                    >
                    <input type='button' class='text-button mobile-only' accesskey='y'
                        value='Открыть в картах' onClick='location.href='yandexmaps://maps.yandex.ru/?oid={$yandexMapId}''>

                    <div class='place-description'>
                        <p>{$description}</p>
                    </div>
                </div>
                <!-- /Info -->
                
                <!-- MAP -->
                <div class='place-map-container'>
                    <iframe src='{$mapLink}' allowfullscreen='true' class='map-container__frame' accesskey='m'></iframe>
                    <div class='capsule-container map-address-capsule'>{$addressName}</div>
                </div>
                <!-- /MAP -->

            </div>
        </div>
    </main>
    ";
    return $text;
}


function getFooter() {
    $text = "
    <footer>
        <div class='wrapper'>
            <hr>

            <div class='footer-inner'>
            <p>Что-то работает ни так? Получили плохой опыт от места из нашего приложения? Сообщите нам — в
            <a class='no-link' href='https://vk.com/myomsk_app'><span class='color-telegram'>в телеграмме</span></a> или
            <a class='no-link' href='https://vk.com/myomsk_app'><span class='color-vkontakte'>ВКонтакте</span></a>.
        </p></p>
            
            <ul class='social-media'> 
                <a href='https://vk.com/myomsk_app' target='_blank'><img class='social-media__item-square' src='assets/images/VK Logo.svg' alt='Наша ВКонтакте страница'/></a>
                <a href='https://t.me/myomsk_app' target='_blank'><img class='social-media__item-round' src='assets/images/telegram logo.svg' alt='Наша Telegram канал'/></a>
            </ul>

            <p class='footer__copyright'>&copy; 2024</p>
            </div>
        </div>
    </footer>
    </body>
    </html>
    ";
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
    $siteText .= getHead(
        getCSS(["route.css", "main.css"]),
        getSEO(),
        getFavicon(),
        getPreloads(),
        getOpenGraph(),
        getYandexMetrika(),
        getGoogleAnalytics()
    );
    $siteText .= getHeader();
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


    $filePath = 'places/' . $linkName . '.html';
    
    $fh = fopen($filePath, 'w');
    fwrite($fh, $siteText);
    fclose($fh);
    
    return $filePath;
}
?>
