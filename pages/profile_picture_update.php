<?php
session_start();
include ('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $currentUserId = $_SESSION['id'];
    $file = $_FILES['profile_picture'];


    $profilePicture = 'default.jpg';
    if (isset($_FILES['profile_picture'])) {
        $file = $_FILES['profile_picture'];
        if ($file['error'] === UPLOAD_ERR_OK) {
            $targetDirectory = '../profile_pictures/';
            $newFilename = $file['name'];
            $targetFile = $targetDirectory . $newFilename;
            move_uploaded_file($file['tmp_name'], $targetFile);
            $profilePicture = $newFilename;
        }
    }
    $stmt = $connect->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
    $stmt->bind_param("si", $profilePicture, $currentUserId);

    if ($stmt->execute()) {
        echo "Signup successful!";
        // Redirect the user to login or another page
        header('Location: profile.php');
        exit();
    } else {
        echo "Error during signup: " . $connect->error;
    }
}