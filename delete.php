<?php
require_once 'db.php';
$table = $_GET['table'];
$id = $_GET['id'];
$pk = $conn->query("SHOW KEYS FROM `$table` WHERE Key_name = 'PRIMARY'")->fetch_assoc()['Column_name'];
$conn->query("DELETE FROM `$table` WHERE `$pk`='$id'");
header("Location: admin.php?table=$table");
exit;
