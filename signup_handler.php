<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];


    // Handle profile picture upload
    $profilePicture = 'default.jpg'; // Set  default picture

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

    // Insert user data into database
    $stmt = $connect->prepare("INSERT INTO users (first_name, last_name, email, password, profile_picture, phone) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $password, $profilePicture, $phone);

    if ($stmt->execute()) {
        echo "Signup successful!";
        // Redirect the user to login or another page
        header('Location: index.php');
        exit();
    } else {
        echo "Error during signup: " . $connect->error;
    }
}