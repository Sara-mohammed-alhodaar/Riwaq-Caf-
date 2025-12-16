<?php
session_start();
include "connection-db.php";

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users
          WHERE username='$username' AND password='$password'";
  $result = mysqli_query($con, $sql);

  if (mysqli_num_rows($result) == 1) {
    $_SESSION['user'] = $username;
    header("Location: order.php"); //Go directly to the order.php page 
    exit(); // stop the code 
  } else {
    $error = "Wrong username or password";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Riwaq – Login</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<header>
  <h1><img src="Riwaq.jpg" height="36"> Riwaq</h1>
  <nav>
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="menu.html">Menu</a></li>
      <li><a href="contact.html">Contact</a></li>
    </ul>
  </nav>
</header>

<main style="padding:20px;">
  <h2>Login</h2>

  <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

  <form method="post">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <input type="submit" name="login" value="Login">
  </form>

  <p>
    Don’t have an account?
    <a href="signup.php">Sign Up</a>
  </p>
</main>

</body>
</html>
