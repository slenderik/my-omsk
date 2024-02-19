


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


function getMain($articleName, $workTime, $weekendDays, $adressPlaceName,  $placeDescription) {
    $text = <<<EOD
    <main>
        <div class="wrapper">

            <!-- Image -->
            <div class="place-image-container">
                <img class="place-image-container__image" src="assets/places_images/terra x1.png" alt="Уютное кофейня ">

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
            <div class="place-information-container">

                <div class="button-and-description-container">
                    <input
                        class="button-black"
                        type="button"
                        value="Открыть в картах"
                        onClick='location.href="https://yandex.ru/maps/?rtext=~55.029759, 73.276813. html/"'
                    >
                
                    <div class="place-description">
                        <p>
        EOD . $placeDescription . <<<EOD
                        </p>
                    </div>
                </div>
                
                <div class="map-container">
                    <a href="https://yandex.ru/maps/org/lapshichnaya_s_malenkim_tsvetkom_v_bolshom_okne/83581541986/?utm_medium=mapframe&utm_source=maps" class="map-container__placeholder">
                        Лапшичная с маленьким цветком в большом окне
                    </a>
                    <iframe
                        src="https://yandex.ru/map-widget/v1/org/lapshichnaya_s_malenkim_tsvetkom_v_bolshom_okne/83581541986/?ll=73.376316%2C54.981349&z=15.4"
                        allowfullscreen="true" class="map-container__frame"
                    ></iframe>
                </div>
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
                <p>К сожалению мы могли использовать чужие изображения.
                    Если хотите чтобы мы убрать изобрежение сообщите нам
                    <a class="no-link" href="https://vk.com/myomsk_app"><span class="color-telegram">в телеграмме</span></a> или
                    <a class="no-link" href="https://vk.com/myomsk_app"><span class="color-vkontakte">ВКонтакте</span></a>.
                </p>
                <p>
                    Что-то работает ни так? Получили плохой опыт от места из нашего приложения? Сообщите нам — а мы разберёмся.
                </p>
                <ul class="social-media"> 
                    <li><a class="social-media__item no-link" href="https://vk.com/myomsk_app" target="_blank"><img src="assets/images/VK Logo.svg" alt="Наша ВКонтакте страница"/></a></li>
                    <li><a class="social-media__item no-link" href="https://t.me/myomsk_app" target="_blank"><img src="assets/images/telegram logo.svg" alt="Наша Telegram канал"/></a></li>
                </ul>
            </div>
        </div>
    </footer>
    EOD;
    return $text;
}
?>

<form action="template.php" method="post">
    <p>Название статьи: <input name="place-name" type="text" size="40" required> </p>
    <p>Описание статьи: <textarea name="place-description" cols="40" rows="3" required> </p>
        </label>
            <input
                type="reset"
                value="Очистить"
                class="button button-blue"
            >
            <input
                type="submit"
                value="Отправить"
                class="button button-orange"
                disabled
            >
    </form>  

<?

if (isset($_POST['place-name'])) {

    // Анкер на статью
    $linkName = 'terra-coffe';
    // Название-статьи
    $placeName = $_POST['place-name']; "Terra Coffe В ОМскее";
    //Описание-статьи
    $placeDescription = $_POST['place-description'];
    "Магазин specialty кофе, чая, десертов и аксессуаров для заваривания. 
    Помогает в любой ситуации. Приятное кофе, со средними ценами. 
    Тут ценят доброту во всём. <br>
    Советуем капучино, макароны и места на входе.";

    // каталог / теги
    $tags = ['coffe', 'pivo']; 
    // время работы
    $workTime = '12:00 - 24:00';
    // выходные
    $weekendDays = 'сб-вс выходной';

    // адрес места текст
    $adressPlaceName = 'Ул. Колотушкина, 5/Б';
    // адрес места цифры
    $adressPlace = '54.980191,73.373409';


    $siteText = '';

    $siteText .= getHead($placeName);
    $siteText .= "<body>";
    $siteText .= getHeader();
    $siteText .= getMain($placeName, $workTime, $weekendDays, $adressPlaceName, $placeDescription);
    $siteText .= getFooter();
    $siteText .= "</body>";
    $siteText .= "</html>";


    $filename = __DIR__ . '/' . $linkName . '.html';
    
    $fh = fopen($filename, 'w');
    fwrite($fh, $siteText);
    fclose($fh);

    echo "im cool enought?";
    echo $siteText;
    
}
?>  