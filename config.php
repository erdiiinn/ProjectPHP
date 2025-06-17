<?php

$user = "root";
$pass = "";
$server = "localhost";
$dbname = "db";

try {
    $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<div style='
        background-color: #330000;
        color: #FF3333;
        font-family: \"Orbitron\", monospace;
        padding: 20px;
        border-radius: 10px;
        max-width: 600px;
        margin: 40px auto;
        box-shadow: 0 0 15px #FF0000;
        text-align: center;
    '>";
    echo "<strong>Stark Tech Error:</strong> Unable to establish connection to Arc Reactor DB Core.<br>";
    echo "Error Details: " . htmlspecialchars($e->getMessage());
    echo "</div>";
    exit; 
}

?>
