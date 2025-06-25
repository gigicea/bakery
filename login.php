<?php
session_start();

// Подключение к базе данных
$conn = new mysqli("localhost", "root", "", "bakery");
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение данных из формы
$email = trim($_POST['email']);
$password = $_POST['password'];

// Поиск пользователя по email
$stmt = $conn->prepare("SELECT ID_customer, password, name, lastname, role FROM Customer WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $hashedPassword, $name, $lastname, $role);
    $stmt->fetch();

    if (password_verify($password, $hashedPassword)) {
        // Успешная авторизация
        $_SESSION['customer_id'] = $id;
        $_SESSION['customer_name'] = "$name $lastname";
        $_SESSION['customer_role'] = $role;
        $_SESSION['message'] = ['text' => "Вы вошли как: $name $lastname", 'type' => 'success'];
    } else {
        $_SESSION['message'] = ['text' => 'Неверный пароль.', 'type' => 'error'];
    }
} else {
    $_SESSION['message'] = ['text' => 'Пользователь не найден.', 'type' => 'error'];
}

$stmt->close();
$conn->close();

header("Location: index.php");
exit;
