<?php
session_start();


// if admin have logged in then redirect to admin page
if (isset($_SESSION['email']) && ($_SESSION['email']) == true) {
    header("Location: homepage.php");
    exit();
}