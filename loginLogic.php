<?php
session_start();

require 'config.php';

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "Fill all the fields!";
        header("refresh:2; url=login.php");
        exit;
    } else {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $data['password'])) {
                $_SESSION['username'] = $data['username'];
                header("Location: dashboard.php");
                exit;
            } else {
                echo "Password incorrect";
                header("refresh:2; url=login.php");
                exit;
            }
        } else {
            echo "User not found!!";
            header("refresh:2; url=login.php");
            exit;
        }
    }
} else {
    header("Location: login.php");
    exit;
}
