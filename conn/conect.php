<?php
$servername = "{servername}";
$username = "{username}";
$password = "{password}";
$dbname = "{dbname}";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
