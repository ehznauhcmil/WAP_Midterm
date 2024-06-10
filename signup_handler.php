<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];


    // Handle profile picture upload
    $fileName = 'default.jpg'; // Set  default picture

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {

        $fileName = $_FILES['profile_picture']['name'];
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];

        $uploadDir = 'profile_pictures/';

        move_uploaded_file($fileTmpPath, $uploadDir . $fileName);
    }
    // Insert user data into database
    $stmt = $connect->prepare("INSERT INTO users (first_name, last_name, email, password, profile_picture, phone) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $password, $fileName, $phone);

    if ($stmt->execute()) {
        echo "Signup successful!";
        // Redirect the user to login or another page
        header('Location: index.php');
        exit();
    } else {
        echo "Error during signup: " . $connect->error;
    }
}