<!DOCTYPE html>
<html>

<head>
  <title>Signup</title>
</head>

<body>
  <h2>Signup</h2>
  <form method="POST" action="signup_handler.php" enctype="multipart/form-data">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required><br><br>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="profile_picture">Profile Picture:</label>
    <input type="file" id="profile_picture" name="profile_picture"><br><br>

    <label for="phone">Phone Number:</label>
    <input type="text"" id=" phone" name="phone"><br><br>

    <button type="submit">Signup</button>
  </form>
</body>

</html>