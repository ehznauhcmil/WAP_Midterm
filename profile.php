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
  <link href="css/navbar.css" rel="stylesheet" />
  <link href="css/general.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />

</head>

<?php
include ('session_abort.php');
include ('connection.php');
?>


<body>
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


  <div="container-main">

    <div class="container-profile-picture">

      <div class="profile-picture">
        <?php
        $userId = $_SESSION['id']; // Get the currently logged-in user's ID
        // Fetch user's profile picture filename from database
        $stmt = $connect->prepare("SELECT profile_picture FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $profilePicture = $user['profile_picture']; // Assuming you use 'profile_pictures' column
        ?>
        <img src="profile_pictures/<?php echo $profilePicture; ?>" alt="Profile Picture" width="100">
      </div>

      <div class="button">
        <button id="update-picture-button">Change Profile Picture</button>
      </div>

      <div class="container" id="update-picture" style="display: none;">

        <h2>Change Profile Picture</h2>
        <form method="POST" action="profile_picture_update.php" enctype="multipart/form-data">
          <label for="profile_picture">Profile Picture:</label>
          <input type="file" id="profile_picture" name="profile_picture"><br><br>
          <button type="submit">Save</button>
        </form>
      </div>

    </div>


    <div class="container-profile">
      <div class="profile">
        <?php
        $email = $_SESSION['email'];
        $profile_query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $profile_query);
        $row = mysqli_fetch_assoc($result);

        echo "<h2>" . $row['first_name'] . " " . $row['last_name'] . "</h2>";
        echo "<h2>" . $row['email'] . "</h2>";
        echo "<h2>" . $row['phone'] . "</h2>";
        ?>
      </div>
      <div class="button">
        <button id="edit-profile-button">Edit Profile</button>
      </div>

      <div class="container" id="edit-profile" style="display:none;">
        <form action="profile_edit.php" method="POST" id="update-form">
          <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">

          <label for="profile_picture">Change Profile Picture:</label>
          <input type="file" name="profile_picture" id="profile_picture" value="<?php echo $profilePicture; ?>"><br><br>

          <label for="first_name">First Name:</label>
          <input type="text" name="first_name" id="first_name" value="<?php echo $row['first_name']; ?>"><br><br>

          <label for="last_name">Last Name:</label>
          <input type="text" name="last_name" id="last_name" value="<?php echo $row['last_name']; ?>"><br><br>

          <label for="email">Email:</label>
          <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>"><br><br>

          <label for="phone">Phone Number:</label>
          <input type="tel" name="phone" id="phone" value="<?php echo $row['phone']; ?>"><br><br>

          <input type="submit" value="Update Profile">
        </form>
      </div>
    </div>

    <div class="container-friends">
      <div class="table">
        <?php
        include 'connection.php';

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

        // Display friends list
        if ($result->num_rows > 0) {
          echo "<h3>Friends of User ID $userId:</h3>";
          echo "<table> // Using a table for better presentation
        <tr>
      <th>User ID<th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Phone Number</th>
      </tr>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["first_name"] . "</td>";
            echo "<td>" . $row["last_name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "</tr>";
          }
          echo "</table>";
        } else {
          echo "No friends found for this user.";
        }
        ?>
      </div>
    </div>

    <div class="container-friend-edit">
      <button id="add-friend-button">Add Friend</button>
      <button id="remove-friend-button">Remove Friend</button>
    </div>

    <div class="container" id="remove-friend" style="display:none;">
      <form method="POST" action="friend_remove.php">
        <label for="friend_id">Friend ID to Delete:</label>
        <input type="number" id="friend_id" name="friend_id" required>
        <button type="submit">Delete Friend</button>
      </form>
    </div>

    <div class="container" id="add-users" style="display:none;">
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

        echo "<h3>Other users</h3>";
        // Display friends list
        if ($result->num_rows > 0) {

          echo "
      <table>
      <tr>
      <th>User ID<th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Phone Number</th>
      </tr>";
          // Using a table for better presentation
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["first_name"] . "</td>";
            echo "<td>" . $row["last_name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "</tr>";
          }
          //
          echo "</table>";
        } else {
          echo "No friends found for this user.";
        }

        ?>
      </div>


      <div class="add-friend">
        <form method="POST" action="friend_add.php">
          <label for="friend_id">Friend ID:</label>
          <input type="number" id="friend_id" name="friend_id" required>
          <button type="submit">Add Friend</button>
        </form>
      </div>
    </div>
    </div>
    <footer>
      <script src="profile_controller.js"></script>
    </footer>
</body>



</html>