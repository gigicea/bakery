<?php
session_start();
require_once 'db.php';

// Получаем название таблицы из GET-запроса
$tableName = $_GET['table'] ?? '';

if (!$tableName) {
    echo "Не указана таблица.";
    exit;
}

// Проверка на корректность имени таблицы (в целях безопасности)
$allowedTables = ['product', 'recipe', 'ingredient', 'structure_recipe', 'supplier', 'supply', 'employee', 'shift', 'baking', 'customer', 'sale', 'feedback'];

if (!in_array($tableName, $allowedTables)) {
    echo "Недопустимая таблица.";
    exit;
}

try {
    $stmt = $pdo->query("SELECT * FROM `$tableName`");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Таблица: $tableName</h2>";

    if (count($data) > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr>";
        // Заголовки таблицы
        foreach (array_keys($data[0]) as $colName) {
            echo "<th>$colName</th>";
        }
        echo "</tr>";

        // Данные таблицы
        foreach ($data as $row) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Таблица пуста.";
    }
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
