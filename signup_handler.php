<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $fileName = 'default.jpg';

    if (isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] === UPLOAD_ERR_OK) {

        $fileName = $_FILES['file-upload']['name'];
        $fileTmpPath = $_FILES['file-upload']['tmp_name'];

        $uploadDir = 'profile_pictures/';

        if (move_uploaded_file($_FILES['file-upload']['tmp_name'], $uploadDir . $fileName)) {
            // File uploaded successfully
        } else {
            echo "Failed to move uploaded file.";
        }
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