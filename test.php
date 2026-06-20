<?php
$conn = new mysqli("127.0.0.1", "root", "Shravani@224");

if ($conn->connect_error) {
    die("Error: " . $conn->connect_error);
}

echo "Connected Successfully!";
?>