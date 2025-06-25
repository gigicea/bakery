<?php
session_start();

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['customer_id'])) {
    header("Location: index.php");
    exit;
}

$customer_id = $_SESSION['customer_id'];

// Подключение к БД
$conn = new mysqli("localhost", "root", "", "bakery");
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение данных пользователя
$stmt = $conn->prepare("SELECT lastname, name, email FROM Customer WHERE ID_customer = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$stmt->bind_result($lastname, $name, $email);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAGEL — Личный кабинет</title>
</head>

<body class="body-account">
    <header>
        <a href="index.php"><img class="logo" src="img/logo.svg" alt="Логотип"></a>
        <a class="catalog-name" href="catalog.php">Каталог</a>
        <a class="aboutus-name" href="aboutus.php">О нас</a>
        <a class="contacts-name" href="contacts.php">Контакты</a>
        <a class="auth-name" href="logout.php">Выйти</a>
    </header>

    <div class="profile-container">
        <div class="title-account">Личный кабинет</div>

        <form action="update_profile.php" method="POST">
            <div class="form-labels">
                <div>Имя:</div>
                <div>Фамилия:</div>
                <div>Эл. почта:</div>
                <div>Пароль:</div>
            </div>
            <div class="form-inputs">
                <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required />
                <input type="text" name="lastname" value="<?= htmlspecialchars($lastname) ?>" required />
                <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required />
                <input type="password" name="password" placeholder="Новый пароль (необязательно)" />
            </div>
            <button class="save-button" type="submit">Сохранить изменения</button>
            <?php if (isset($_SESSION['customer_role']) && $_SESSION['customer_role'] === 'admin'): ?>
                <a href="admin.php" class="admin-panel-button">Перейти к панели администратора</a>
            <?php endif; ?>
        </form>
    </div>

    <footer class="footer-account">
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

</body>

</html>