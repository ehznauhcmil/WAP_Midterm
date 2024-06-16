<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
  <link href="styles/general.css" rel="stylesheet" />
  <link href="styles/navbar.css" rel="stylesheet" />
  <link href="styles/profile.css" rel="stylesheet" />

</head>

<?php
include ('session_abort.php');
include ('connection.php');
?>



<body>

  <header>
    <div class="navbar">

      <div class="logo">
        <a href="#home"><img src="images/logo.png" alt="Logo" /></a>
        <span>MyWebsite</span>
      </div>

      <div class="nav-links">
        <a href="homepage.php">STORE</a>
        <a href="">LIBRARY</a>
        <a href="profile.php">PROFILE</a>
        <a href="logout.php">SIGN OUT</a>
      </div>

      <div class="burger" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
      </div>

    </div>

  </header>

  <div class="content">

    <div class="container-profile">

      <div class="card" id="profile">

        <div class="profile-picture">
          <?php
          $userId = $_SESSION['id'];
          $stmt = $connect->prepare("SELECT profile_picture FROM users WHERE id = ?");
          $stmt->bind_param("i", $userId);
          $stmt->execute();
          $result = $stmt->get_result();
          $user = $result->fetch_assoc();

          $profilePicture = $user['profile_picture']; // Assuming you use 'profile_pictures' column
          ?>
          <img src="profile_pictures/<?php echo $profilePicture; ?>" alt="Profile Picture" width="100">
        </div>

        <div class="details">
          <?php
          $email = $_SESSION['email'];
          $profile_query = "SELECT * FROM users WHERE email = '$email'";
          $result = mysqli_query($connect, $profile_query);
          $row = mysqli_fetch_assoc($result);

          echo "<h2 style='font-size: 30px;'>" . $row['first_name'] . " " . $row['last_name'] . "</h2>";
          echo "<h2 style='font-size: 30px;'>" . $row['email'] . "</h2>";
          echo "<h2 style='font-size: 30px;'>" . $row['phone'] . "</h2>";
          ?>
        </div>

      </div>

      <div class="buttons">

        <div class="button-container">
          <button id="update-picture-button">Change Profile Picture</button>
        </div>

        <div class="button-container">
          <button id="edit-profile-button">Edit Profile</button>
        </div>

        <div class="button-container">
          <button id="add-friend-button">Add Friend</button>
        </div>

        <div class="button-container">
          <button id="remove-friend-button">Remove Friend</button>
        </div>

      </div>

    </div>

    <div class="friends">
      <div>
        <h1>Your Friends</h1>
      </div>
      <div class="table">

        <?php

        $userId = $_SESSION['id'];

        // Query to get friends and their details
        $friend_query = "SELECT id, first_name, last_name, email, phone
        FROM friends
        JOIN users ON IF(friends.id_1 = ?, friends.id_2, friends.id_1) = id
        WHERE ? IN (friends.id_1, friends.id_2)"; // Modified JOIN condition to get details
        
        $stmt = $connect->prepare($friend_query);
        $stmt->bind_param("ii", $userId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          echo "<table>
        <tr>
      <th>User ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Phone Number</th>
      </tr>";
        } else {
          echo "<h1>No friends found for this user.</h1>";
        }
        ?>

        <?php
        while ($row = $result->fetch_assoc()):
          ?>

          <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["first_name"] ?></td>
            <td><?php echo $row["last_name"] ?></td>
            <td><?php echo $row["email"] ?></td>
            <td><?php echo $row["phone"] ?></td>
          </tr>
        <?php endwhile; ?>
        </table>

      </div>

    </div>

    <div class="container" id="update-picture" style="display:none;">
      <div class="card" id="change-profile-picture">
        <h1>Choose Profile Picture</h1>
        <form method="POST" action="profile_picture_update.php" enctype="multipart/form-data">

          <div class="file-upload-input">

            <div class="form-input" id="picture">
              <label for="file-upload" class="custom-file-upload">
                Choose File
              </label>
              <input type="file" id="file-upload" name="file-upload" />
            </div>

            <div id="fileNamePreview">No file selected</div>

          </div>

          <div class="padding"></div>

          <div class="button-container">
            <button type="submit">Submit</button>
          </div>

          <div class="padding"></div>

        </form>
      </div>
    </div>

    <div class="container" id="edit-profile" style="display:none;">
      <?php
      $email = $_SESSION['email'];
      $profile_query = "SELECT * FROM users WHERE email = '$email'";
      $result = mysqli_query($connect, $profile_query);
      $row = mysqli_fetch_assoc($result);
      ?>
      <div class="card" id=" edit profile">

        <form action="profile_edit.php" method="POST" id="update-form">
          <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">

          <div class="form">

            <div class="label">
              <label for="first_name">First Name:</label>
            </div>

            <div class="form-input">
              <input type="text" name="first_name" id="first_name" value="<?php echo $row['first_name']; ?>"><br><br>
            </div>

            <div class="label">
              <label for="last_name">Last Name:</label>
            </div>

            <div class="form-input">
              <input type="text" name="last_name" id="last_name" value="<?php echo $row['last_name']; ?>"><br><br>
            </div>

            <div class="label">
              <label for="email">Email:</label>
            </div>

            <div class="form-input">
              <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>"><br><br>
            </div>

            <div class="label">
              <label for="password">Password:</label>
            </div>

            <div class="form-input">
              <input type="text" name="password" id="password" value="<?php echo $row['password']; ?>"><br><br>
            </div>

            <div class="label">
              <label for="phone">Phone Number:</label>
            </div>

            <div class="form-input">
              <input type="text" name="phone" id="phone" value="<?php echo $row['phone']; ?>"><br><br>
            </div>
          </div>

          <div class="padding"></div>

          <div class="button-container">
            <button type="submit">Submit</button>
          </div>

        </form>

      </div>

    </div>

    <div class="container" id="remove-friend" style="display:none;">
      <div class="card">

        <form method="POST" action="friend_remove.php" id="remove-form">

          <div class="label">
            <label for="friend_id">Friend ID to Delete:</label>
          </div>

          <div class="padding"></div>

          <div class="form-input">
            <input type="number" id="friend_id" name="friend_id" required>
          </div>

          <div class="padding"></div>

          <div class="button-container">
            <button type="submit">Delete Friend</button>
          </div>

        </form>

      </div>

    </div>





    <div class="container" id="add-users" style="display:none;">
      <div class="title">
        <h1>Other Users</h1>
      </div>
      <div class="table">


        <?php
        include 'connection.php';

        $userId = $_SESSION['id'];

        $non_friend_query = "SELECT id, first_name, last_name, email, phone
                     FROM users 
                     WHERE id NOT IN (
                         SELECT IF(id_1 = ?, id_2, id_1) 
                         FROM friends 
                         WHERE ? IN (id_1, id_2)
                     ) 
                     AND id != ?";

        $stmt = $connect->prepare($non_friend_query);
        $stmt->bind_param("iii", $userId, $userId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Display friends list
        if ($result->num_rows > 0) {
          echo "<table>
          <tr>
        <th>User ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        </tr>";
        } else {
          echo "No friends found for this user.";
        }
        ?>

        <?php
        while ($row = $result->fetch_assoc()):
          ?>

          <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["first_name"] ?></td>
            <td><?php echo $row["last_name"] ?></td>
            <td><?php echo $row["email"] ?></td>
            <td><?php echo $row["phone"] ?></td>
          </tr>
        <?php endwhile; ?>
        </table>

      </div>

      <div class="padding"></div>

      <div class="card">

        <form method="POST" action="friend_add.php" id="add-form">

          <div class="label">
            <label for="friend_id">User ID:</label>
          </div>

          <div class="padding"></div>

          <div class="form-input">
            <input type="number" id="friend_id" name="friend_id" required>
          </div>
          <div class="padding"></div>

          <div class="button-container">
            <button type="submit">Add Friend</button>
          </div>

        </form>

      </div>

    </div>

  </div>

  <div class="padding">

  </div>

  </div>

  <footer>
    <div class="container">
      <div class="logo">
        <a href="#"><img src="images/logo.png" alt="Your Company Logo"></a>
      </div>

      <nav class="footer-nav">
        <a href="#">About Us</a>
        <a href="#">Careers</a>
        <a href="#">Support</a>
        <a href="#">Terms of Service</a>
        <a href="#">Privacy Policy</a>
    </div>

    <div class="social-media">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-youtube"></i></a>
      <a href="#"><i class="fab fa-discord"></i></a>
    </div>
    </div>

</body>

<div class="copyright">
  <p>Copyright © 2024 GamerHub. All rights reserved.</p>
</div>
<script>
  function toggleMenu() {
    var navLinks = document.querySelector(".nav-links");
    navLinks.classList.toggle("active");
  }
</script>
<script src="js/profile_controller.js"></script>
<script src="js/file_upload.js"></script>
</footer>

</html>