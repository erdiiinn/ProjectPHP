<?php
include_once('config.php');

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = :id";
    $deleteUsers = $conn->prepare($sql);
    $deleteUsers->bindParam(':id', $id, PDO::PARAM_INT);

    if ($deleteUsers->execute()) {
        header("Location: dashboard.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting the user.";
    }
} else {
    echo "Invalid user ID.";
}
?>
