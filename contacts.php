<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=67454a4f-5403-42b7-ae6a-9bf5ea6e2d6b&lang=ru_RU"></script>
    <script src="https://unpkg.com/inputmask@5.0.8/dist/inputmask.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAGEL</title>
</head>

<body class="body-contacts">

    <?php
    session_start();
    if (isset($_SESSION['message'])) {
        $msg = $_SESSION['message'];
        $text = htmlspecialchars($msg['text']);
        $type = $msg['type'] === 'success' ? 'message-success' : 'message-error';
        echo "<div id='messageBox' class='message-box {$type}'>{$text}</div>";
        unset($_SESSION['message']);
    }
    ?>

    <header>
        <a href="index.php"><img class="logo" src="img/logo.svg" alt="Логотип"></a>
        <a class="catalog-name" href="catalog.php">Каталог</a>
        <a class="aboutus-name" href="aboutus.php">О нас</a>
        <a class="contacts-name" href="contacts.php">Контакты</a>
        <?php if (isset($_SESSION['customer_id'])): ?>
            <a class="auth-name" href="account.php">Аккаунт</a>
        <?php else: ?>
            <a class="auth-name" onclick="openAuthForm()">Войти</a>
        <?php endif; ?>
    </header>

    <!-- Затемнённый фон -->
    <div class="overlay" id="overlay" style="display: none;"></div>

    <!-- Авторизация -->
    <div class="auth-modal" id="authModal" style="display: none;">
        <form method="POST" action="login.php">
            <h2 class="auth-title">Войти</h2>

            <label class="auth-label" style="top: 139px;">Эл. почта</label>
            <input type="email" name="email" class="auth-input" style="top: 171px;" required>

            <label class="auth-label" style="top: 239px;">Пароль</label>
            <input type="password" name="password" class="auth-input" style="top: 271px;" required>

            <button type="submit" class="auth-button">Войти</button>

            <a class="auth-register-text" href="#" onclick="switchToRegister()">Нет аккаунта? Зарегистрируйтесь</a>
        </form>
    </div>

    <!-- Форма регистрации -->
    <div class="register-modal" id="registerModal" style="display: none;">
        <form method="POST" action="register.php">
            <h2 class="register-title">Создать аккаунт</h2>

            <label class="auth-label" style="top: 136px;">Имя</label>
            <input type="text" name="firstname" class="auth-input" style="top: 165px;" required>

            <label class="auth-label" style="top: 226px;">Фамилия</label>
            <input type="text" name="lastname" class="auth-input" style="top: 255px;" required>

            <label class="auth-label" style="top: 317px;">Эл. почта</label>
            <input type="email" name="email" class="auth-input" style="top: 346px;" required>

            <label class="auth-label" style="top: 410px;">Пароль</label>
            <input type="password" name="password" class="auth-input" style="top: 437px;" required>

            <button type="submit" class="register-button">Зарегистрироваться</button>

            <a class="register-login-text" href="#" onclick="switchToLogin()">Уже есть аккаунт? Войти</a>
        </form>
    </div>

    <div class="hello-contacts">
        <img src="img/main_contact.png" alt="Фон">
        <h1 class="text-contacts">Есть вопросы? Свяжитесь с нами!</h1>
    </div>

    <section class="search">
        <h2 class="search-title">Наши контакты</h2>
        <h2 class="search-map">Найти нас на карте</h2>
        <div class="search-container">
            <div class="search-block">
                <img src="img/contact_place.png" alt="Точка на карте">
                <p>г. Звенигород, микрорайон Пронина, к10</p>
            </div>

            <div class="search-block">
                <img src="img/contact_mail.png" alt="Почта">
                <p>bagel_bakery@mail.ru</p>
            </div>

            <div class="search-block">
                <img src="img/contact_phone.png" alt="Телефон">
                <p>+7 (999) 999-99-99</p>
            </div>

            <div class="search-block">
                <img src="img/contact_clock.png" alt="Часы">
                <p>Время работы: 8:00-20:00</p>
            </div>
        </div>

        <div id="map"></div>
    </section>

    <div class="contact-us">
        <h2 class="contact-us-title">Свяжитесь с нами!</h2>
        <form class="feedback-form" id="feedback-form" novalidate>
            <label class="field-label label-name" for="name">Имя</label>
            <input class="input-field input-name" type="text" id="name" name="name" required>

            <label class="field-label label-surname" for="surname">Фамилия</label>
            <input class="input-field input-surname" type="text" id="surname" name="surname" required>

            <label class="field-label label-email" for="email">Почта</label>
            <input class="input-field input-email" type="email" id="email" name="email" required>

            <label class="field-label label-phone" for="phone">Телефон</label>
            <input class="input-field input-phone" type="tel" id="phone" name="phone"
                required placeholder="+79001234567">

            <label class="field-label label-message" for="message">Сообщение</label>
            <textarea class="message-field textarea-message" id="message" name="message" required></textarea>

            <button type="submit" class="submit-button">Отправить</button>
        </form>
    </div>


    <footer class="footer-contacts">
        <a href="index.php"><img class="logo-footer" src="img/logo.svg" alt="Лого"></a>
        <section class="social-media">
            <h3 class="social-title">Мы в социальных сетях</h3>

            <div class="media">
                <img src="img/mail.png" alt="Почта">
                <p>bagel_bakery@mail.ru</p>
            </div>

            <div class="media">
                <img src="img/vk.png" alt="ВК">
                <p>id/bagel_bakery</p>
            </div>

            <div class="media">
                <img src="img/tg.png" alt="Телеграм">
                <p>@bagel_bakery</p>
            </div>
        </section>
        <div class="footer-menu">
            <a href="catalog.php">Каталог</a>
            <a href="aboutus.php">О нас</a>
            <a href="contacts.php">Контакты</a>
        </div>
    </footer>

    <script src="script.js"></script>
    <script src="feedback.js"></script>
</body>

</html>