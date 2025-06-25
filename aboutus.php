<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAGEL</title>
</head>

<body class="body-aboutus">

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

    <div class="hello-aboutus">
        <img src="img/main_about.png" alt="Фон">
        <h1 class="text-aboutus">Почему в <span class="diff-font-aboutus">BAGEL</span> так вкусно?</h1>
    </div>

    <section class="history">
        <h2 class="history-title">Наша история</h2>
        <p>
            История пекарни началась в 2020 году с небольшой семейной пекарни, где все изделия готовились вручную
            по старинным рецептам.<br><br>

            Основательница пекарни, Мирошниченко Галина, решила возродить традиции настоящего ремесленного хлебопечения
            и октрыла первую точку в Звенигороде.<br><br>

            Сегодня <span>BAGEL</span> — это сеть пекарен, где по-прежнему чтят традиции и
            используют только натуральные
            ингредиенты.<br><br>

            Мы выросли, но сохранили душу маленькой семейной пекарни, где каждое изделие готовится с любовью.
        </p>
        <img src="img/bakery_history.png" alt="Пекарня">
    </section>

    <section class="mission">
        <h2 class="mission-title">Миссия</h2>
        <img src="img/bread_mission.png" alt="Хлеб">
        <p>
            Наша миссия — возрождать культуру настоящего хлеба и выпечки, созданных <span>вручную</span> из
            <span>натуральных</span> ингредиентов, и делать каждый день наших клиентов <span>немного вкуснее и
                счастливее.</span><br><br>

            Мы стремимся сделать качественную выпечку доступной для всех и верим, <span>что настоящий хлеб — это не
                просто продукт</span>, а произведение искусства, требующее мастерства, времени и <span>любви</span> к
            своему делу.
        </p>
    </section>

    <section class="team">
        <h2 class="team-title">Наша команда</h2>
        <div class="team-cards">
            <div class="team-card">
                <img src="img/Galina.png" alt="Управляющая Галина">
                <h3>Управляющая Галина</h3>
                <p>Разрабатывает новые рецепты, проверяет соблюдение рецептур, дегустирует новинки меню</p>
            </div>

            <div class="team-card">
                <img src="img/Valentin.png" alt="Пекарь Валентин">
                <h3>Пекарь Валентин</h3>
                <p>Замешивает тесто, выпекает хлеб, булки, делает основы для десертов</p>
            </div>
        </div>
    </section>

    <section class="feedback">
        <h2 class="feedback-title">Отзывы</h2>
        <div class="feedback-cards">
            <div class="feedback-card">
                <h3>Анастасия</h3>
                <p>Покупаю тут хлеб каждую неделю — всегда идеальная корочка и мякоть.<br>
                    А фисташковый эклер — просто песня! Рекомендую всем, кто ценит качество.</p>
                <img src="img/stars.svg" alt="Оценка">
            </div>

            <div class="feedback-card">
                <h3>Тимофей</h3>
                <p>Каждый раз, когда беру здесь круассан с сёмгой, понимаю — тут работают с душой. Всё свежее,
                    ароматное. Отдельный восторг от фирменного торта — теперь только сюда!</p>
                <img src="img/stars.svg" alt="Оценка">
            </div>

            <div class="feedback-card">
                <h3>Валерия</h3>
                <p>Зашла за чиабаттой, а получила заряд тепла и уюта. Персонал улыбается, выпечка свежая, а торты —
                    словно из французской кондитерской.<br>
                    BAGEL, вы волшебники!</p>
                <img src="img/stars.svg" alt="Оценка">
            </div>
        </div>
    </section>

    <footer class="footer-aboutus">
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
</body>

</html>