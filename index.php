<?php
    session_start();
    include('template.php');

    $mainPageLink = 'index.php';
?>

<!DOCTYPE html>
<html lang="ru" xmlns:og="http://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой Омск</title>
    <link rel="stylesheet" href="../css/main.css">
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
</head>
<body>
    <?php
    echo getHeader();
    ?>

    <div class="wrapper">
        <div class="title-container centered-container">
            <h1>Куда сегодня сходить в Омске?</h1>
        </div>
        
        <h2>Место дня</h2>

        <div class="day-place">
            <div class="day-place__image">
                <img src="content/lenin-street-high.png" alt="Дома с красивой лепниной">
            </div>
            <div class="day-place__inner-container">
                <p>Историческая застройка сохранилась единственная в своём роде. Здесь собран архитектурный ансамбль конца XIX — начала XX веков. Получивший статус исторического памятника федерального значения.</p>
                <p>ул. Ленина</p>
            </div>
        </div>
    </div>

    <main>
        <div class="wrapper">

            <!-- Category header -->
            <h2 class="mobile-only">Категории</h2>
            <div class="chips-wrap mobile-only">
                <div class="chips-container">
                    <a href="#"><div class="chip light-green">Парки</div></a>
                    <a href="#"><div class="chip light-yellow">Кафе</div></a>
                    <a href="#"><div class="chip light-blue">События</div></a>
                    <a href="#"><div class="chip light-orange">Памятники</div></a>
                </div>
            </div>
            <!-- Category header -->

            <!-- Category header -->
            <div class="category-container">
                <h2>Лучшие кафе сегодня</h2>
                <a class="category-container__all-link" href="categories/cafe">
                    <p>Все ></p>
                </a>
            </div>
            <!-- Category header -->

            <!-- Places list  -->
            <div class="places-list">

                <article class="place-card">
                    <a href="terr-coffe.html">
                            <img class="place-card__image" src="content/cafe-mesto-pro-testo.png"
                            alt="Кафе место про тесто изнутри" loading="lazy">
                        <p>Место про тесто</p>
                    </a>
                </article>

                
            </div>
            <!-- Places list  -->

            <!-- Category header -->
            <div class="category-container">
                <h2>Помните памятники?</h2>
                <a class="category-container__all-link" href="categories/cafe">
                    <p>Все ></p>
                </a>
            </div>
            <!-- Category header -->

            <!-- Places list  -->
            <div class="places-list">


            </div>
            <!-- Places list  -->
        </div>
    </main>

    <footer>
        <div class="wrapper">
            <hr>

            <div class="footer-inner">
                <p>К сожалению мы могли использовать чужие изображения.
                    Если хотите чтобы мы убрать изобрежение сообщите нам
                    <a href="https://t.me/myomsk_app"><span class="color-telegram">в телеграмме</span></a> или
                    <a href="https://vk.com/myomsk_app"><span class="color-vkontakte">ВКонтакте</span></a>.
                </p>
                
                <p>Что-то работает ни так? Получили плохой опыт от места из нашего приложения? <a href="https://t.me/MyOmskBot"><span class="color-telegram">Сообщите нам</span></a> — мы разберёмся.</p>

                <div class="social-media"> 
                    <a href="https://vk.com/myomsk_app" target="_blank"><img class="social-media__item-square" src="assets/images/VK Logo.svg" alt="Наша ВКонтакте страница"/></a>
                    <a href="https://t.me/myomsk_app" target="_blank"><img class="social-media__item-round" src="assets/images/telegram logo.svg" alt="Наша Telegram канал"/></a>
                </div>
            </div>
        </div>
    </footer>

    <a href="#top">
        <div class="fab-container mobile-only">
            <img src="assets/images/up.svg" alt="Вверх!" aria-hidden="true" height="24" width="24">
        </div>
    </a>
    
</body>
</html>