<?php
include "connection-db.php";

if (isset($_POST['signup'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "INSERT INTO users (username, password)
          VALUES ('$username', '$password')";
  mysqli_query($con, $sql);

  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Riwaq – Sign Up</title>
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
  <h2>Create Account</h2>

  <form method="post">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <input type="submit" name="signup" value="Sign Up">
  </form>

  <p>
    Already have an account?
    <a href="login.php">Login</a>
  </p>
</main>

</body>
</html>
