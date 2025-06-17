<?php
session_start();
include_once('config.php');

if(empty($_SESSION['username'])){
    header("Location: login.php");
    exit;
}

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = trim($_POST['username']);
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(empty($username) || empty($name) || empty($surname) || empty($email) || empty($password)) {
        echo "Please fill all the fields.";
        exit;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    $sqlCheck = "SELECT id FROM users WHERE username = :username AND id != :id";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bindParam(':username', $username);
    $stmtCheck->bindParam(':id', $id);
    $stmtCheck->execute();

    if($stmtCheck->rowCount() > 0){
        echo "Username already taken by another user.";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET username=:username, name=:name, surname=:surname, email=:email, password=:password WHERE id=:id";
    $prep = $conn->prepare($sql);
    $prep->bindParam(':id', $id);
    $prep->bindParam(':username', $username);
    $prep->bindParam(':name', $name);
    $prep->bindParam(':surname', $surname);
    $prep->bindParam(':email', $email);
    $prep->bindParam(':password', $hashedPassword);

    $prep->execute();

    header("Location: dashboard.php");
    exit;
}
?>
