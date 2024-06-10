<?php
// to check if admin is logged in or not, if not then go back to login
if (!isset($_SESSION['email']) && ($_SESSION['email']) !== true) {
    header("Location: index.php");
    exit();
}
