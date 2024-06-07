<?php
require 'connection.php';

function updateUserProfile($connect, $userId, $firstName, $lastName, $email, $profilePicture, $phone)
{
    $stmt = $connect->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, profile_picture = ?, phone = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $firstName, $lastName, $email, $profilePicture, $phone, $userId);
    return $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    session_start();
    $userId = $_SESSION['id'];

    $currentProfilePicture = $_POST['current_profile_picture'];

    // Handle profile picture upload
    $profilePicture = $currentProfilePicture; // Default to the existing picture
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profile_picture'];

        // Get file extension
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // Allowed extensions (you can customize this list)
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Check if file type is allowed
        if (in_array($fileExt, $allowedExtensions)) {
            $targetDirectory = 'profile_pictures/';

            // Create a unique filename
            $newFilename = $fileExt;
            $targetFile = $targetDirectory . $newFilename;

            // Try to upload the file
            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                $profilePicture = $newFilename; // Update $profilePicture if upload is successful
            } else {
                // Handle upload error
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            // Handle invalid file type
            echo "Invalid file type. Allowed types are: " . implode(", ", $allowedExtensions);
        }
    }


    if (empty($errorMessage)) {
        if (updateUserProfile($connect, $userId, $firstName, $lastName, $email, $profilePicture, $phone)) {
            header("Location: profile.php");
            exit();
        } else {
            $errorMessage = "Error updating profile.";
        }
    }
}