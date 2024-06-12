<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
  <link rel="stylesheet" href="styles/general.css">
  <link rel="stylesheet" href="styles/signup.css">
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">

</head>

<body>
  <div class="card" id="signup-block">

    <div class="image">
      <img src="images/logo.png" alt="">
    </div>

    <div class="form-and-buttons">
      <form method="POST" action="signup_handler.php" enctype="multipart/form-data">

        <div class="form">

          <div class="label">
            <label for="first_name">First Name:</label>
          </div>

          <div class="form-input">
            <input type="text" id="first_name" name="first_name" required><br><br>
          </div>

          <div class="label">
            <label for="last_name">Last Name:</label>
          </div>

          <div class="form-input">
            <input type="text" id="last_name" name="last_name" required><br><br>
          </div>

          <div class="label">
            <label for="email">Email:</label>
          </div>

          <div class="form-input">
            <input type="email" id="email" name="email" required><br><br>
          </div>

          <div class="label">
            <label for="password">Password:</label>
          </div>

          <div class="form-input">
            <input type="password" id="password" name="password" required><br><br>
          </div>

          <div class="label">
            <label for="profile_picture">Profile Picture:</label>
          </div>

          <div class="file">
            <div class="form-input" id="profile-picture">
              <label for="file-upload" class="custom-file-upload">
                Choose File
              </label>
              <input type="file" id="file-upload" />
            </div>
            <div id="fileNamePreview">No file selected</div>
          </div>

          <div class="label">
            <label for="phone">Phone Number:</label>
          </div>

          <div class="form-input">
            <input type="text" id="phone" name="phone" required><br><br>
          </div>
        </div>

        <div class="button-grid">

          <div class="button-container" id="button-left">
            <a href="index.php"> <button type="button" id="signup-button">Back to Log In</button>
            </a><br /><br />
          </div>

          <div class="button-container" id="button-right">
            <button type="submit">Signup</button>
          </div>

        </div>

      </form>

    </div>

  </div>

  <footer>
    <script src="js/file_upload.js"></script>
  </footer>

</body>

</html>