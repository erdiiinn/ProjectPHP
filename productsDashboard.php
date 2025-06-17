<?php
include("header.php");
include("config.php");

try {
    $stmt = $conn->query("SELECT id, title, description, quantity, price FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching products: " . $e->getMessage();
    $products = [];
}
?>

<div class="container mt-5">
    <h1>Products Dashboard</h1>
    <a href="addProduct.php" class="btn btn-success mb-3">Add New Product</a>
    <?php if (count($products) > 0): ?>
    <table class="table table-bordered table-striped mt-3">
        <thead class="thead-dark">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['title']); ?></td>
                <td><?php echo htmlspecialchars($product['description']); ?></td>
                <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                <td><?php echo htmlspecialchars($product['price']); ?></td>
                <td>
                    <a href="editProduct.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-primary">Update</a>
                    <a href="deleteProduct.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No products found.</p>
    <?php endif; ?>
</div>

<?php include("footer.php"); ?>
