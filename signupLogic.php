<?php
include_once('config.php');

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $tempPass = $_POST['password'];

    if (empty($name) || empty($surname) || empty($username) || empty($email) || empty($tempPass)) {
        echo "You need to fill all the fields.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        header("refresh:2; url=signup.php");
        exit;
    }

    $password = password_hash($tempPass, PASSWORD_DEFAULT);

    $sql = "SELECT username FROM users WHERE username = :username";
    $tempSQL = $conn->prepare($sql);
    $tempSQL->bindParam(':username', $username);
    $tempSQL->execute();

    if ($tempSQL->rowCount() > 0) {
        echo "Username exists!";
        header("refresh:2; url=signup.php");
        exit;
    } else {
        $sql = "INSERT INTO users (name, surname, username, email, password) VALUES (:name, :surname, :username, :email, :password)";
        $insertSql = $conn->prepare($sql);

        $insertSql->bindParam(':name', $name);
        $insertSql->bindParam(':surname', $surname);
        $insertSql->bindParam(':username', $username);
        $insertSql->bindParam(':email', $email);
        $insertSql->bindParam(':password', $password);

        $insertSql->execute();

        echo "Data saved successfully...";
        header("refresh:2; url=login.php");
        exit;
    }
}
?>
