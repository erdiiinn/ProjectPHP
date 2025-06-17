<?php

include_once('config.php');

if(isset($_POST['submit']))
{
    // Initiating user creation in Stark Industries database
    $username = $_POST['username'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users(username,name,surname,password,email) VALUES (:username, :name, :surname, :password, :email)";

    $insertSql = $conn->prepare($sql);

    $insertSql->bindParam(':username', $username);
    $insertSql->bindParam(':name', $name);
    $insertSql->bindParam(':surname', $surname);
    $insertSql->bindParam(':password', $password);
    $insertSql->bindParam(':email', $email);

    $insertSql->execute();


    echo "<div style='
        background: linear-gradient(135deg, #FF0000 0%, #FFC107 100%);
        color: #FFF;
        font-family: \"Orbitron\", monospace;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 0 15px #FF0000;
        max-width: 500px;
        margin: 30px auto;
        text-align: center;
    '>";
    echo "User successfully integrated into Stark Tech database. Welcome aboard, Operative <strong>$username</strong>!";
    echo "<br><br>";
    echo "<a href='dashboard.php' style='
        background-color: #FF0000;
        color: #FFF;
        padding: 10px 25px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        font-family: \"Orbitron\", monospace;
    '>Access Stark Dashboard</a>";
    echo "</div>";
}

?>
