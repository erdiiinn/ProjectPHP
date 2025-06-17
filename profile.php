<?php
session_start();

include_once("config.php");

// Redirect if not logged in
if(empty($_SESSION['username'])){
    header('Location: login.php');
    exit;
}

// Fetch user info based on logged-in username (ignore any id from GET)
$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username = :username";
$selectUser = $conn->prepare($sql);
$selectUser->bindParam(':username', $username);
$selectUser->execute();

$user_data = $selectUser->fetch();

if (!$user_data) {
    // User not found in DB - logout or redirect
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<?php include_once('header.php') ?>

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Welcome, <i> <?php echo htmlspecialchars($_SESSION['username']); ?> </i></a>

  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="logout.php">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link " href="dashboard.php">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="profile.php">
              <span data-feather="file"></span>
              Edit Profile
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <form class="form-profile" action="update.php" method="post">

              <input type="hidden" name="id" value="<?php echo (int)$user_data['id']; ?>">

              <label for="name" class="text-muted">Name</label>
              <input class="form-control" type="text" name="name" id="name" value="<?php echo htmlspecialchars($user_data['name']); ?>" required><br>

              <label for="surname" class="text-muted">Surname</label>
              <input class="form-control" type="text" name="surname" id="surname" value="<?php echo htmlspecialchars($user_data['surname']); ?>" required><br>

              <label for="username" class="text-muted">Username</label>
              <input class="form-control" type="text" name="username" id="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" required><br>

              <label for="email" class="text-muted">Email</label>
              <input class="form-control" type="email" name="email" id="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required><br>

              <label for="password" class="text-muted">Password <small>(leave blank to keep current)</small></label>
              <input class="form-control" type="password" name="password" id="password" placeholder="New password"><br><br>
              
              <button class="btn btn-lg btn-primary" type="submit" name="update">Update</button>
            </form>
          </div>
        </div>    
      </div>
    </main>
  </div>
</div>

<?php include_once('footer.php') ?>
