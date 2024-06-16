<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Responsive Navigation Bar with Logo</title>
  <link rel="stylesheet" href="styles/general.css">
  <link rel="stylesheet" href="styles/navbar.css">
  <link rel="stylesheet" href="styles/homepage.css">

</head>

<body>
  <!-- Navbar -->
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
      <div></div>-
      <div></div>
    </div>

  </div>

  <!-- Searchbar -->
  <div class="search-bar">

    <div id="search">
      <input type="text" id="search-input" placeholder="Search store...">
    </div>

  </div>

  <div class="hero-section">

    <div class="main-card">

      <div class="card" id="big-card">
        <div class="big-image">
          <img src="images/fallguys.jpg" alt="">
        </div>

      </div>

    </div>

    <div class="v-card-list-3">

      <div class="card" id="small-horizontal-card">

        <div class="small-image">
          <img src="images/AC-Rogue-Game-Cover.png" alt="">
        </div>

        <div class="small-card-text">
          <h1>Get Assassin's Creed Rogue: Remastered now with a 15% discount!</h1>
        </div>

      </div>

      <div class="card" id="small-horizontal-card">

        <div class="small-image">
          <img src="images/hogwarts-legacy.jpg" alt="">
        </div>

        <div class="small-card-text">
          <h1>Get Hogwarts Legacy + Expansion DLC at RM299!</h1>
        </div>

      </div>

      <div class="card" id="small-horizontal-card">

        <div class="small-image">
          <img src="images/Grand_Theft_Auto_V.png" alt="">
        </div>

        <div class="small-card-text">
          <h1>Class Favourite: "Grand Theft Auto V" is back at RM 159!</h1>
        </div>

      </div>

    </div>

  </div>

  <div class="new-release-title">
    <h1 class="title">Top New Releases</h1>
  </div>

  <div class="others">

    <div class="card" id="small-vertical-card">
      <img src="images/palworld.jpg" alt="">
    </div>

    <div class="card" id="small-vertical-card">
      <img src="images/spiderman.jpg" alt="">
    </div>

    <div class="card" id="small-vertical-card">
      <img src="images\zelda.jpg" alt="">
    </div>
  </div>


</body>

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

  <div class="copyright">
    <p>Copyright © 2024 Your Company Name. All rights reserved.</p>
  </div>
  <script>
    function toggleMenu() {
      var navLinks = document.querySelector(".nav-links");
      navLinks.classList.toggle("active");
    }
  </script>
</footer>

</html>