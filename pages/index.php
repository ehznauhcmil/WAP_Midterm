<?php
require 'connection.php';
require 'session_remain.php';

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($email)) {
    $errorMessage = "Email is required";

  }
  if (empty($password)) {
    $errorMessage = "Password is required";

  }

  if ($querydb = $connect->prepare("SELECT * FROM USERS WHERE email = ? AND password = ?")) {
    $querydb->bind_param("ss", $email, $password);
    $querydb->execute();
    $success = $querydb->get_result();

    if ($success->num_rows > 0) {
      $data = $success->fetch_assoc();

      if ($email === $data['email'] && $password === $data['password']) {
        echo nl2br("\nLogin Successfully");

        if (is_array($data)) {
          $_SESSION['id'] = $data['id'];
          $_SESSION['email'] = $data['email'];
          header("location: homepage.php");
        }
      } else {
        $errorMessage = "Incorrect Email or Password";
        // echo nl2br("\nIncorrect Email or Password");
      }
    } else {
      $errorMessage = "Incorrect Email and Password";
      // echo nl2br("<h3>\nIncorrect Email and Password</h3>");
    }
  }

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
</head>

<body>

  <form action="index.php" method="POST">
    <div class="container">
      <div class="login_cont">
        <h1>LOGIN</h1><br />
        <?php echo "<h2>" . $errorMessage . "</h2>" ?>
        <input type="email" placeholder="E-mail" name="email" required autocomplete="off"><br />
        <input type="password" maxlength="16" name="password" placeholder="Password" required autocomplete="off"><br />
        <button>Login</button><br /><br />
        <a href="signup.php">
          <button type="button">Sign Up</button>
        </a><br /><br />
      </div>

    </div>
  </form>
</body>

</html>