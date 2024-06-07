<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Responsive Navigation Bar with Logo</title>
  <link href="styles.css" rel="stylesheet" />
</head>

<body>
  <div class="navbar">
    <div class="logo">
      <a href="#home"><img src="/images/logo.png" alt="Logo" /></a>
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

  <div class="container">
    <div class="big-card">
      <img src="/images/fallguys.jpg" alt="Big Card Image" class="big-card-image" />
      <div class="button-container">
        <button>BUY NOW</button>
        <span>Get Fall Guys At RM179!!!</span>
      </div>
    </div>
    <div class="small-card">
      <img src="../images/fallguys.jpg" alt="Small Card Image 1" class="small-card-image" />
      <div class="textbox-container">
        <input type="text" placeholder="Description" />
      </div>
    </div>
    <div class="small-card">
      <img src="../images/gta.jpg" alt="Small Card Image 2" class="small-card-image" />
      <div class="textbox-container">
        <input type="text" placeholder="Description" />
      </div>
    </div>
    <div class="small-card">
      <img src="/images/hogwarts.jpg" alt="Small Card Image 3" class="small-card-image" />
      <div class="textbox-container">
        <input type="text" placeholder="Description" />
      </div>
    </div>
  </div>

  <script>
    function toggleMenu() {
      var navLinks = document.querySelector(".nav-links");
      navLinks.classList.toggle("active");
    }
  </script>
</body>

</html>