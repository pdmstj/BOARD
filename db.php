<?php
$host = 'localhost';
$db = 'board';
$user = 'root';
$password = '111111';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
