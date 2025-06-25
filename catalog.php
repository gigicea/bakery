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

<body class="body-catalog">

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

    <div class="hello-catalog">
        <img src="img/main_catalog.png" alt="Фон">
        <h1 class="text-catalog">Попробуйте лучшую выпечку в вашем городе!</h1>
    </div>

    <div style="height: 650px;"></div>
    <div class="menu">
        <a href="#1" class="menu-link">Хлеб</a>
        <a href="#2" class="menu-link">Эклеры</a>
        <a href="#3" class="menu-link">Тарталетки</a>
        <a href="#4" class="menu-link">Круассаны</a>
        <a href="#5" class="menu-link">Торты</a>
        <a href="#6" class="menu-link">Закуски</a>
    </div>

    <section class="bread" id="1">
        <h2 class="bread-title">Хлеб</h2>
        <div class="catalog-cards">
            <div class="catalog-card">
                <img src="img/bread_1.png" alt="Хлеб ржаной">
                <h3>Хлеб ржаной</h3>
                <div class="info">
                    <p class="gramm">340 г.</p>
                    <p class="price">90 р.</p>
                </div>
            </div>

            <div class="catalog-card">
                <img src="img/bread_2.png" alt="Багет французский">
                <h3>Багет французский</h3>
                <div class="info">
                    <p class="gramm">340 г.</p>
                    <p class="price">60 р.</p>
                </div>
            </div>

            <div class="catalog-card">
                <img src="img/bread_3.png" alt="Чиабатта">
                <h3>Чиабатта</h3>
                <div class="info">
                    <p class="gramm">310 г.</p>
                    <p class="price">80 р.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="eclair" id="2">
        <h2 class="eclair-title">Эклеры</h2>
        <div class="catalog-cards">
            <div class="catalog-card">
                <img src="img/eclair_1.png" alt="Миндальный эклер">
                <h3>Миндальный</h3>
                <div class="info">
                    <p class="gramm">110 г.</p>
                    <p class="price">180 р.</p>
                </div>
            </div>

            <div class="catalog-card">
                <img src="img/eclair_2.png" alt="Ванильный эклер">
                <h3>Ванильный</h3>
                <div class="info">
                    <p class="gramm">90 г.</p>
                    <p class="price">170 р.</p>
                </div>
            </div>

            <div class="catalog-card">
                <img src="img/eclair_3.png" alt="Фисташковый эклер">
                <h3>Фисташковый</h3>
                <div class="info">
                    <p class="gramm">105 г.</p>
                    <p class="price">170 р.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="tartlet" id="3">
        <h2 class="tartlet-title">Тарталетки</h2>
        <div class="catalog-cards">
            <div class="catalog-card">
                <img src="img/tartlet_1.png" alt="Тарталетка с голубикой">
                <h3>С голубикой</h3>
                <div class="info">
                    <p class="gramm">110 г.</p>
                    <p class="price">360 р.</p>
                </div>
            </div>

            <div class="catalog-card">
                <img src="img/tartlet_2.png" alt="Тарталетка ванильная">
                <h3>Ванильная</h3>
                <div class="info">
                    <p class="gramm">90 г.</p>
                    <p class="price">220 р.</p>
                </div>
            </div>

            <div class="catalog-card">
                <img src="img/tartlet_3.png" alt="Тарталетка с малиной">
                <h3>С малиной</h3>
                <div class="info">
                    <p class="gramm">120 г.</p>
                    <p class="price">380 р.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="croissant" id="4">
        <h2 class="croissant-title">Круассаны</h2>
        <div class="catalog-cards">
            <div class="catalog-card">
                <img src="img/croissant_1.png" alt="Круассан классический">
                <h3>Классический</h3>
                <div class="info">
                    <p class="gramm">70 г.</p>
                    <p class="price">130 р.</p>
                </div>
            </div>

            <div class="catalog-card">
                <img src="img/croissant_2.png" alt="Круассан с сёмгой">
                <h3>С сёмгой</h3>
                <div class="info">
                    <p class="gramm">150 г.</p>
                    <p class="price">370 р.</p>
                </div>
            </div>

            <div class="catalog-card">
                <img src="img/croissant_3.png" alt="Круассан ванильный">
                <h3>Ванильный</h3>
                <div class="info">
                    <p class="gramm">110 г.</p>
                    <p class="price">200 р.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cake" id="5">
        <h2 class="cake-title">Торты</h2>
        <div class="catalog-cards">
            <div class="catalog-card">
                <img src="img/cake_1.png" alt="Торт красный бархат">
                <h3>Красный бархат</h3>
                <div class="info">
                    <p class="gramm">1000 г.</p>
                    <p class="price">1500 р.</p>
                </div>
            </div>

            <div class="catalog-card">
                <img src="img/cake_2.png" alt="Торт фирменный">
                <h3>Фирменный</h3>
                <div class="info">
                    <p class="gramm">850 г.</p>
                    <p class="price">900 р.</p>
                </div>
            </div>

            <div class="catalog-card">
                <img src="img/cake_3.png" alt="Торт меренговый">
                <h3>Меренговый</h3>
                <div class="info">
                    <p class="gramm">800 г.</p>
                    <p class="price">520 р.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="snack" id="6">
        <h2 class="snack-title">Закуски</h2>
        <div class="catalog-cards">
            <div class="catalog-card">
                <img src="img/snack_1.png" alt="Чикен ролл">
                <h3>Чикен ролл</h3>
                <div class="info">
                    <p class="gramm">240 г.</p>
                    <p class="price">330 р.</p>
                </div>
            </div>

            <div class="catalog-card">
                <img src="img/snack_2.png" alt="Сэндвич с ветчиной">
                <h3>Сэндвич с ветчиной</h3>
                <div class="info">
                    <p class="gramm">260 г.</p>
                    <p class="price">300 р.</p>
                </div>
            </div>

            <div class="catalog-card">
                <img src="img/snack_3.png" alt="Киш 4 сыра">
                <h3>Киш 4 сыра</h3>
                <div class="info">
                    <p class="gramm">220 г.</p>
                    <p class="price">250 р.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-catalog">
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