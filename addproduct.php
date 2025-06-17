<?php include("header.php"); ?>

<style>
    .signup {
        max-width: 400px;
        margin: 50px auto;
        background: #1a1a1a;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 15px #FF0000;
        font-family: 'Orbitron', monospace, sans-serif;
        color: #FFD700;
    }

    .signup h1 {
        text-align: center;
        color: #FF4500;
        margin-bottom: 25px;
        text-transform: uppercase;
        letter-spacing: 3px;
        text-shadow: 0 0 10px #FF4500;
    }

    .form-control {
        background: #222;
        border: 1px solid #FF4500;
        color: #FFD700;
        border-radius: 8px;
        margin-bottom: 15px;
        padding: 10px 15px;
        font-size: 1.1rem;
        box-shadow: inset 0 0 5px #FF4500;
        transition: border-color 0.3s ease;
    }
    .form-control:focus {
        border-color: #FFD700;
        outline: none;
        box-shadow: 0 0 10px #FFD700;
        background: #2a2a2a;
        color: #FFD700;
    }

    .btn-primary {
        background: linear-gradient(45deg, #FF0000, #FFD700);
        border: none;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 1.1rem;
        box-shadow: 0 0 10px #FF4500;
        transition: background 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(45deg, #FFD700, #FF0000);
        box-shadow: 0 0 20px #FFD700;
    }

    .text-muted {
        color: #777 !important;
        text-align: center;
        font-size: 0.85rem;
        margin-top: 40px;
        letter-spacing: 0.6px;
    }
</style>

<div class="signup">
    <form class="form-signin" action="products.php" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Add Product to Stark Inventory</h1>
        
        <label for="inputTitle" class="sr-only">Title</label>
        <input type="text" id="inputTitle" class="form-control" placeholder="Product Title" name="title" required autofocus>

        <label for="inputDescription" class="sr-only">Description</label>
        <input type="text" id="inputDescription" class="form-control" placeholder="Product Description" name="description" required>

        <label for="inputQuantity" class="sr-only">Quantity</label>
        <input type="number" id="inputQuantity" class="form-control" placeholder="Quantity" name="quantity" required min="1">

        <label for="inputPrice" class="sr-only">Price</label>
        <input type="number" id="inputPrice" class="form-control" placeholder="Price (USD)" name="price" required step="0.01" min="0">

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Add Product</button>

        <p class="mt-5 mb-3 text-muted">© 2023 Stark Industries - Innovating Tomorrow</p>
    </form>
</div>

<?php include("footer.php"); ?>
