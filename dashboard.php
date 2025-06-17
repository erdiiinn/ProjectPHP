<?php 
  include_once('config.php');  

  session_start();
  if(empty($_SESSION['username']))
  {
    header('Location: login.php');
    exit();
  }

  $sql = "SELECT * FROM users";
  $selectUsers = $conn->prepare($sql);
  $selectUsers->execute();
  $users_data = $selectUsers->fetchAll();
?>

<?php include("header.php"); ?>

<style>

  body {
    background-color: #121212;
    color: #FFD700;
    font-family: 'Orbitron', monospace, sans-serif;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #1a1a1a;
    box-shadow: 0 0 20px #FF4500;
    border-radius: 12px;
    overflow: hidden;
  }

  th, td {
    border: 1px solid #FF4500;
    padding: 12px 15px;
    text-align: center;
    color: #FFD700;
  }

  th {
    background: linear-gradient(90deg, #FF0000, #FFD700);
    text-transform: uppercase;
    letter-spacing: 2px;
  }

  tr:nth-child(even) {
    background-color: #2a2a2a;
  }

  tr:hover {
    background-color: #FF4500;
    color: #121212;
    cursor: pointer;
  }

  a {
    color: #FFD700;
    text-decoration: none;
    font-weight: 700;
    transition: color 0.3s ease;
  }

  a:hover {
    color: #FF0000;
  }

  .navbar {
    background-color: #1a1a1a !important;
    border-bottom: 3px solid #FF4500;
    box-shadow: 0 0 15px #FF4500;
  }

  .navbar-brand {
    color: #FF4500 !important;
    font-weight: 900;
    font-size: 1.3rem;
    letter-spacing: 1.5px;
  }

  .navbar-brand i {
    font-style: normal;
    color: #FFD700;
  }

  .nav-link {
    color: #FFD700 !important;
    font-weight: 600;
  }

  .nav-link:hover {
    color: #FF0000 !important;
  }

  .sidebar {
    background-color: #1a1a1a !important;
    border-right: 3px solid #FF4500;
    height: 100vh;
    padding-top: 20px;
  }

  .sidebar .nav-link.active {
    background: linear-gradient(90deg, #FF0000, #FFD700);
    color: #121212 !important;
    font-weight: 900;
    box-shadow: 0 0 15px #FFD700;
  }

  .sidebar .nav-link {
    color: #FFD700 !important;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.2px;
  }

  .sidebar .nav-link:hover {
    color: #FF0000 !important;
  }

  main {
    padding: 30px;
  }

  h1.h2 {
    color: #FF4500;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 20px;
    text-shadow: 0 0 10px #FF4500;
  }
</style>

<nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">
    Stark Dashboard - Welcome, <i><?php echo htmlspecialchars($_SESSION['username']); ?></i>
  </a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="logout.php">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid" style="margin-top: 70px;">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="dashboard.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <?php foreach ($users_data as $user_data) { ?>
              <a class="nav-link" href="profile.php?id=<?= $user_data['id'];?>">
                Edit Profile: <?= htmlspecialchars($user_data['username']); ?>
              </a>
            <?php } ?>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
        <h1 class="h2">User Control Panel</h1>
      </div>  

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users_data as $user) { ?>
            <tr> 
              <td><?= htmlspecialchars($user['id']) ?></td>
              <td><?= htmlspecialchars($user['username']) ?></td>
              <td><?= htmlspecialchars($user['name']) ?></td> 
              <td><?= htmlspecialchars($user['surname']) ?></td> 
              <td><?= htmlspecialchars($user['email']) ?></td>
              <td>
                <a href="delete.php?id=<?= $user['id'] ?>">Delete</a> | 
                <a href="profile.php?id=<?= $user['id'] ?>">Update</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </div>
</div>

<?php include("footer.php"); ?>
