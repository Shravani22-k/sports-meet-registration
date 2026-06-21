<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "sports_meet";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
?>