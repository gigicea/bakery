<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $surname = htmlspecialchars($_POST["surname"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $message = htmlspecialchars($_POST["message"]);

    $to = "isip_d.d.danilina@mpt.ru";
    $subject = "Новое сообщение с сайта";
    $body = "Имя: $name\nФамилия: $surname\nПочта: $email\nТелефон: $phone\nСообщение:\n$message";

    $headers = "From: <$email>";

    if (mail($to, $subject, $body, $headers)) {
        echo "success";
    } else {
        echo "error";
    }
}
