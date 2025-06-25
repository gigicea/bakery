<?php
require_once 'db.php';
$table = $_GET['table'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $columns = array_keys($_POST);
    $values = array_map([$conn, 'real_escape_string'], array_values($_POST));
    $columns_sql = "`" . implode("`, `", $columns) . "`";
    $values_sql = "'" . implode("', '", $values) . "'";
    $conn->query("INSERT INTO `$table` ($columns_sql) VALUES ($values_sql)");
    header("Location: admin.php?table=$table");
    exit;
}

$columns = $conn->query("SHOW COLUMNS FROM `$table`");
?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Админка</title>
    <link rel="stylesheet" href="style.css">
</head>

<div class="body-admin-add">
    <div class="admin-panel-add">
        <h1 class="admin-title-add">Добавить запись</h1>
        <a href="admin.php?table=<?= urlencode($table) ?>" class="back-button">← Назад</a>
        <section class="admin-table-add">
            <h2>Таблица: <?= htmlspecialchars($table) ?></h2>
            <form method="post" class="admin-form-add">
                <?php while ($col = $columns->fetch_assoc()):
                    if ($col['Extra'] === 'auto_increment') continue; ?>
                    <label><?= $col['Field'] ?>:<br>
                        <input type="text" name="<?= $col['Field'] ?>" class="form-input">
                    </label><br><br>
                <?php endwhile; ?>
                <button type="submit" class="form-button-add">Сохранить</button>
            </form>
        </section>
    </div>
</div>