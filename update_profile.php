<?php
session_start();

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

// Получение текущих данных, если нужно
$currentStmt = $conn->prepare("SELECT lastname, name, email FROM Customer WHERE ID_customer = ?");
$currentStmt->bind_param("i", $customer_id);
$currentStmt->execute();
$currentStmt->bind_result($current_lastname, $current_name, $current_email);
$currentStmt->fetch();
$currentStmt->close();

// Данные из формы
$lastname = trim($_POST['lastname']) ?: $current_lastname;
$name = trim($_POST['name']) ?: $current_name;
$email = trim($_POST['email']) ?: $current_email;
$password = $_POST['password'];

if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE Customer SET lastname=?, name=?, email=?, password=? WHERE ID_customer=?");
    $stmt->bind_param("ssssi", $lastname, $name, $email, $hashedPassword, $customer_id);
} else {
    $stmt = $conn->prepare("UPDATE Customer SET lastname=?, name=?, email=? WHERE ID_customer=?");
    $stmt->bind_param("sssi", $lastname, $name, $email, $customer_id);
}

$stmt->execute();
$stmt->close();
$conn->close();

// Обновление сессии
$_SESSION['customer_name'] = $name;
$_SESSION['message'] = ['text' => 'Данные успешно обновлены.', 'type' => 'success'];

header("Location: account.php");
exit;
