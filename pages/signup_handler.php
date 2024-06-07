<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Handle profile picture upload
    $profilePicture = 'default.jpg'; // Set the default picture

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profile_picture'];
        $targetDirectory = 'profile_pictures/';
        $newFilename = uniqid() . '_' . $file['name'];
        $targetFile = $targetDirectory . $newFilename;
        move_uploaded_file($file['tmp_name'], $targetFile);
        $profilePicture = $newFilename;
    }

    // Insert user data into database
    $stmt = $connect->prepare("INSERT INTO users (first_name, last_name, email, profile_picture, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $profilePicture, $hashedPassword);

    if ($stmt->execute()) {
        echo "Signup successful!";
        // Redirect the user to login or another page
        // header('Location: login.php'); 
        // exit;
    } else {
        echo "Error during signup: " . $connect->error;
    }
}
?>