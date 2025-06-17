<?php
include_once('config.php');

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = $_GET['id'];

    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: productsDashboard.php?msg=deleted");
        exit;
    } else {
        echo "Error deleting product.";
    }
} else {
    echo "Invalid product ID.";
}
?>
