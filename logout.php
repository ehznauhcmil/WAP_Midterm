<?php

session_start();

// To stop the session once logged out
if (session_destroy()) {
    header("Location: index.php");
    exit();
}