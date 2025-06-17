<?php
include_once('config.php');

if (!isset($_GET['id'])) {
    echo "Product ID is required.";
    exit;
}

$id = (int)$_GET['id'];

try {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "Product not found.";
        exit;
    }
} catch (PDOException $e) {
    echo "Error fetching product: " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $quantity = (int)($_POST['quantity'] ?? 0);
    $price = (float)($_POST['price'] ?? 0);

    if ($title === '' || $description === '' || $quantity < 1 || $price <= 0) {
        $error = "Please fill all fields correctly.";
    } else {
        try {
            $updateStmt = $conn->prepare("UPDATE products SET title = :title, description = :description, quantity = :quantity, price = :price WHERE id = :id");
            $updateStmt->bindParam(':title', $title);
            $updateStmt->bindParam(':description', $description);
            $updateStmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $updateStmt->bindParam(':price', $price);
            $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $updateStmt->execute();

            header("Location: productsDashboard.php");
            exit;
        } catch (PDOException $e) {
            $error = "Error updating product: " . $e->getMessage();
        }
    }
}
?>

<?php include("header.php"); ?>

<div class="container mt-5">
    <h1>Edit Product</h1>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($product['title']); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="<?php echo htmlspecialchars($product['description']); ?>" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" min="1" id="quantity" name="quantity" class="form-control" value="<?php echo htmlspecialchars($product['quantity']); ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" min="0.01" step="0.01" id="price" name="price" class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="productsDashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include("footer.php"); ?>
