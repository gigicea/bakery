<?php
require_once 'db.php';
$table = $_GET['table'] ?? null;
$queries = $_GET['queries'] ?? null;
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="body-admin">
    <header>
        <a href="index.php"><img class="logo" src="img/logo.svg" alt="Логотип"></a>
        <a class="catalog-name" href="catalog.php">Каталог</a>
        <a class="aboutus-name" href="aboutus.php">О нас</a>
        <a class="contacts-name" href="contacts.php">Контакты</a>
        <a class="auth-name" href="logout.php">Выйти</a>
    </header>

    <div class="admin-panel">
        <h1 class="admin-title">Панель администратора</h1>
        <nav>
            <ul>
                <?php
                $tables = ['product', 'recipe', 'ingredient', 'structure_recipe', 'supplier', 'supply', 'employee', 'shift', 'baking', 'customer', 'sale', 'feedback'];
                foreach ($tables as $t) {
                    echo "<li><a href='?table=$t'>$t</a></li>";
                }
                ?>
                <li><a href='?queries=1'>SQL-запросы</a></li>
            </ul>
        </nav>

        <section class="admin-table">
            <?php if ($table): ?>
                <h2><?= htmlspecialchars($table) ?></h2>
                <a href="add.php?table=<?= $table ?>">Добавить запись</a>
                <table>
                    <?php
                    $result = $conn->query("SELECT * FROM `$table`");
                    if ($result->num_rows > 0) {
                        echo "<tr>";
                        while ($fieldinfo = $result->fetch_field()) {
                            echo "<th>{$fieldinfo->name}</th>";
                        }
                        echo "<th>Действия</th></tr>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            foreach ($row as $key => $value) {
                                if ($key === 'password') {
                                    echo "<td>********</td>";
                                } else {
                                    echo "<td>" . htmlspecialchars($value) . "</td>";
                                }
                            }

                            $id = $row[array_key_first($row)];
                            echo "<td>
                            <a href='edit.php?table=$table&id=$id' class='edit-icon'></a> 
                            <a href='delete.php?table=$table&id=$id' class='delete-icon' onclick=\"return confirm('Удалить запись?');\"></a>
                            </td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='100%'>Нет данных</td></tr>";
                    }
                    ?>
                </table>
            <?php elseif ($queries): ?>
                <?php include 'queries.php'; ?>
            <?php endif; ?>
        </section>
    </div>

    <footer class="footer-admin">
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