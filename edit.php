<?php
require_once 'db.php';
$table = $_GET['table'];
$id = $_GET['id'];
$pk = $conn->query("SHOW KEYS FROM `$table` WHERE Key_name = 'PRIMARY'")->fetch_assoc()['Column_name'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updates = [];
    foreach ($_POST as $key => $value) {
        $escaped = $conn->real_escape_string($value);
        $updates[] = "`$key`='$escaped'";
    }
    $sql = "UPDATE `$table` SET " . implode(", ", $updates) . " WHERE `$pk`='$id'";
    $conn->query($sql);
    header("Location: admin.php?table=$table");
    exit;
}

$row = $conn->query("SELECT * FROM `$table` WHERE `$pk`='$id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Админка</title>
    <link rel="stylesheet" href="style.css">
</head>

<div class="body-admin-edit">
    <div class="admin-panel-edit">
        <h1 class="admin-title-edit">Редактировать</h1>
        <a href="admin.php?table=<?= urlencode($table) ?>" class="back-button">← Назад</a>
        <section class="admin-table-edit">
            <h2>Запись №<?= htmlspecialchars($id) ?> в <?= htmlspecialchars($table) ?></h2>
            <form method="post" class="admin-form-edit">
                <?php foreach ($row as $key => $val):
                    if ($key == $pk) continue; ?>
                    <label><?= $key ?>:<br>
                        <input type="text" name="<?= $key ?>" value="<?= htmlspecialchars($val) ?>" class="form-input">
                    </label><br><br>
                <?php endforeach; ?>
                <button type="submit" class="form-button-edit">Сохранить</button>
            </form>
        </section>
    </div>
</div>