<?php
include_once('config.php');

if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    die("Invalid user ID.");
}

$id = $_GET['id'];

// If form is submitted, process the update
if (isset($_POST['update'])) {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $email = $_POST['email'] ?? '';

    $sql = "UPDATE users SET name = :name, surname = :surname, email = :email WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: dashboard.php?msg=updated");
        exit();
    } else {
        echo "Error updating user.";
    }
}

// Fetch current user data to pre-fill the form
$sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("User not found.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit User</title>
    <style>
        form > input {
            margin-bottom: 10px;
            font-size: 20px;
            padding: 5px;
            width: 300px;
            display: block;
        }
        button {
            background-color: transparent;
            border: 1px solid black;
            padding: 10px 40px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>Edit User</h1>
    <form action="edit.php?id=<?= htmlspecialchars($id) ?>" method="POST">
        <input type="text" name="name" placeholder="Name" value="<?= htmlspecialchars($data['name']) ?>" required />
        <input type="text" name="surname" placeholder="Surname" value="<?= htmlspecialchars($data['surname']) ?>" required />
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($data['email']) ?>" required />

        <button type="submit" name="update">Update</button>
    </form>

</body>
</html>
