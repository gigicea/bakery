<?php
session_start();

// Подключение к базе данных
$conn = new mysqli("localhost", "root", "", "bakery");
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение данных из формы
$lastname = trim($_POST['lastname']);  
$firstname = trim($_POST['firstname']); 
$email = trim($_POST['email']);
$password = $_POST['password'];

// Проверка: ни одно поле не должно быть пустым
if (empty($lastname) || empty($firstname) || empty($email) || empty($password)) {
    $_SESSION['message'] = ['text' => 'Пожалуйста, заполните все поля.', 'type' => 'error'];
    header("Location: index.php");
    exit;
}

// Проверка, что email уникален
$stmt = $conn->prepare("SELECT ID_customer FROM Customer WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['message'] = ['text' => 'Пользователь с таким email уже зарегистрирован.', 'type' => 'error'];
    $stmt->close();
    $conn->close();
    header("Location: index.php");
    exit;
}
$stmt->close();

// Хеширование пароля
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Вставка нового пользователя
$stmt = $conn->prepare("INSERT INTO Customer (lastname, name, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $lastname, $firstname, $email, $hashedPassword);

if ($stmt->execute()) {
    $_SESSION['message'] = ['text' => 'Регистрация прошла успешно!', 'type' => 'success'];
} else {
    $_SESSION['message'] = ['text' => 'Ошибка регистрации: ' . $stmt->error, 'type' => 'error'];
}

$stmt->close();
$conn->close();

header("Location: index.php");
exit;
