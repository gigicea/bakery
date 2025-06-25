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

<body class="body-index">

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

    <div id="messageBox" class="message-box" style="display:none;"></div>

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

    <div class="hello-index">
        <img class="img-main" src="img/main_main.png" alt="Фон">
        <h1 class="slogan">Готовится с любовью, съедается с удовольствием!</h1>
        <a class="catalog-btn" href="catalog.php"><span class="text-btn">Каталог</span></a>
    </div>

    <div class="welcome">
        <p class="welcome-text">Добро пожаловать в <span class="diff-font">BAGEL</span> — место, где каждая булочка
            пахнет детством, а торты украшают самые важные моменты жизни!<br>
            <br>С 2020 года мы печём свежий хрустящий хлеб по семейным рецептам, нежные десерты из натуральных
            ингредиентов и создаём уют, который хочется <span class="bold">унести с собой.</span>
        </p>
        <img class="dough" src="img/dough.png" alt="Тесто">
    </div>

    <section class="products">
        <h2 class="products-title">Попробуйте наши новинки</h2>
        <div class="product-cards">

            <div class="product-card">
                <img src="img/new_1.png" alt="Круассан">
                <h2>Круассан с рыбой</h2>
                <p>Воздушный круассан с начинкой из нежного филе слабосолёной красной рыбы, огурцов, сливочного сыра и
                    зелени. Идеально подходит для сытного перекуса.</p>
            </div>

            <div class="product-card">
                <img src="img/new_2.png" alt="Эклер">
                <h2>Миндальный Эклер</h2>
                <p>Заварное тесто, наполненное лёгким миндальным кремом и покрытое глазурью из белого шоколада с
                    хрустящими лепестками миндаля.</p>
            </div>

            <div class="product-card">
                <img src="img/new_3.png" alt="Тарталетка">
                <h2>Тарталетка с малиной</h2>
                <p>Песочное тесто с ароматным ванильным кремом, украшенная свежими ягодами и пудрой. Идеальное сочетание
                    нежности и хруста.</p>
            </div>
        </div>
    </section>

    <section class="from-what">
        <h2 class="from-what-title">Из чего мы печём?</h2>
        <div class="from-what-cards">

            <div class="from-what-card">
                <img src="img/flour.png" alt="Мука">
                <h3>Мука высшего сорта</h3>
                <p>только отборная, с местных мельниц, без химических добавок</p>
            </div>

            <div class="from-what-card">
                <img src="img/eggs.png" alt="Яйца">
                <h3>Яйца первой категории</h3>
                <p>фермерские, с яркими желтками и натуральным вкусом.</p>
            </div>

            <div class="from-what-card">
                <img src="img/milk.png" alt="Молоко">
                <h3>Натуральное молоко</h3>
                <p>свежее, от коров на свободном выгуле, без антибиотиков.</p>
            </div>
        </div>
    </section>

    <section class="news">
        <h2 class="news-title">Последние новости</h2>
        <div class="news-cards">

            <div class="news-card">
                <h2>Нам 5 лет!</h2>
                <p>Спасибо, что выбираете нас! В честь юбилея весь июнь дарим фирменный мини-десерт к каждому заказу от
                    1500 рублей. <br>Приходите праздновать!</p>
                <div class="news-card-footer">
                    <h5 class="date">14.05.2025</h5>
                    <img src="img/cake.svg" alt="Торт">
                </div>
            </div>

            <div class="news-card">
                <h2>Пекарня года</h2>
                <p>WhereToEat Moscow признали нас лучшей пекарней 2024 года! <br>В честь этого дарим скидку 15% на весь
                    ассортимент до конца недели</p>
                <div class="news-card-footer">
                    <h5 class="date">07.05.2025</h5>
                    <img src="img/delivery.svg" alt="Доставка">
                </div>
            </div>

            <div class="news-card">
                <h2>Запустили доставку</h2>
                <p>Теперь привозим свежую выпечку прямо к вашей двери! Наши курьеры работают ежедневно с 10:00 до 21:00.
                    Первый заказ от 2000 рублей - бесплатно!</p>
                <div class="news-card-footer">
                    <h5 class="date">21.09.2024</h5>
                    <img src="img/medal.svg" alt="Медаль">
                </div>
            </div>
        </div>
    </section>

    <section class="special">
        <h2 class="special-title">Специальные предложения</h2>
        <div class="tags">
            <img class="tag1" src="img/tag.svg" alt="Бирка">
            <p class="tag-text1">-15% на все торты</p>
        </div>
        <div class="tags">
            <img class="tag2" src="img/tag.svg" alt="Бирка">
            <p class="tag-text2">1+1=3 эклера</p>
        </div>
        <div class="tags">
            <img class="tag3" src="img/tag.svg" alt="Бирка">
            <p class="tag-text3">-10% в день рождения</p>
        </div>
    </section>

    <footer class="footer-index">
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