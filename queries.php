<?php
require_once 'db.php';

function showQuery($number, $description, $sql, $params = [])
{
    global $conn;

    echo "<h3>$number. $description</h3>";
    $stmt = $conn->prepare($sql);

    if (!empty($params)) {
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);
    }

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            echo "<table border='1'><tr>";
            foreach ($result->fetch_fields() as $field) {
                echo "<th>{$field->name}</th>";
            }
            echo "</tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $val) {
                    echo "<td>" . htmlspecialchars($val) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Нет результатов</p>";
        }
    } else {
        echo "<p>Ошибка выполнения запроса: " . $stmt->error . "</p>";
    }

    echo "<hr>";
}

showQuery(
    1,
    "Список и число поставщиков, поставляющих указанный ингредиент в нужном объеме за период",
    "SELECT s.ID_supplier, sp.name, SUM(s.quantity) as total_quantity
     FROM Supply s
     JOIN Supplier sp ON s.ID_supplier = sp.ID_supplier
     WHERE s.ID_ingredient = 1 AND s.date BETWEEN '2025-01-01' AND '2025-12-31'
     GROUP BY s.ID_supplier
     HAVING total_quantity >= 100"
);

showQuery(
    2,
    "Список и общее число поставленных изделий (выпечек)",
    "SELECT p.name AS product, SUM(b.quantity) as total_baked
     FROM Baking b
     JOIN Product p ON b.ID_product = p.ID_product
     GROUP BY p.ID_product"
);

showQuery(
    3,
    "Сведения об ингредиентах, поставщиках, ценах и дате поставки",
    "SELECT i.name AS ingredient, s.date, s.price, sp.name AS supplier
     FROM Supply s
     JOIN Ingredient i ON s.ID_ingredient = i.ID_ingredient
     JOIN Supplier sp ON s.ID_supplier = sp.ID_supplier
     ORDER BY i.name, s.date DESC"
);

showQuery(
    4,
    "Изделия, выпеченные за период, в рецепте которых используется указанный ингредиент",
    "SELECT DISTINCT p.name AS product, r.name AS recipe, i.name AS ingredient, b.bake_date
     FROM baking b
     JOIN product p ON b.ID_product = p.ID_product
     JOIN recipe r ON p.ID_product = r.ID_product
     JOIN structure_recipe sr ON r.ID_recipe = sr.ID_recipe
     JOIN ingredient i ON sr.ID_ingredient = i.ID_ingredient
     WHERE b.bake_date BETWEEN '2025-01-01' AND '2025-12-31'
       AND i.name = 'Мука ржаная'
     ORDER BY b.bake_date"
);


showQuery(
    5,
    "Список, количество и стоимость изделий, выпеченных за день",
    "SELECT p.name AS product, b.quantity, (b.quantity * p.price) AS total
     FROM Baking b
     JOIN Product p ON b.ID_product = p.ID_product
     WHERE b.bake_date = '2025-06-15'"
);

showQuery(
    6,
    "Изделия, выпеченные конкретным пекарем за последнюю неделю",
    "SELECT p.name AS product, b.quantity, b.bake_date
     FROM Baking b
     JOIN Product p ON b.ID_product = p.ID_product
     WHERE b.ID_employee = 1 AND b.bake_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)"
);

showQuery(
    7,
    "Ингредиенты, необходимые для изготовления конкретного продукта",
    "SELECT p.name AS product, r.name AS recipe, i.name AS ingredient, sr.quantity, i.unit
     FROM product p
     JOIN recipe r ON p.ID_product = r.ID_product
     JOIN structure_recipe sr ON r.ID_recipe = sr.ID_recipe
     JOIN ingredient i ON sr.ID_ingredient = i.ID_ingredient
     WHERE p.name = 'Хлеб ржаной'"
);

showQuery(
    8,
    "Покупатели, купившие определенную продукцию за период",
    "SELECT DISTINCT c.name, c.lastname, s.date
     FROM sale s
     JOIN customer c ON s.ID_customer = c.ID_customer
     JOIN product p ON s.ID_product = p.ID_product
     WHERE p.name = 'Хлеб ржаной' AND s.date BETWEEN '2025-01-01' AND '2025-07-01'"
);

showQuery(
    9,
    "Среднее количество продаж на месяц по продукции",
    "SELECT p.name, AVG(s.quantity) AS avg_monthly_sales
     FROM Sale s
     JOIN Product p ON s.ID_product = p.ID_product
     GROUP BY p.ID_product"
);

showQuery(
    10,
    "Кассовый отчет за период",
    "SELECT s.date, SUM(s.total_amount) AS total_income
     FROM Sale s
     WHERE s.date BETWEEN '2025-01-01' AND '2025-07-01'
     GROUP BY s.date
     ORDER BY s.date"
);
