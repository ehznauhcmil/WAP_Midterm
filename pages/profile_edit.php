<?php
require 'connection.php';

function updateUserProfile($connect, $userId, $firstName, $lastName, $email, $phone)
{
    $stmt = $connect->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $firstName, $lastName, $email, $phone, $userId);
    return $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Input Sanitization and Validation (Important - Implement as needed)
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    session_start();
    $userId = $_SESSION['id'];

    // ... (Your validation code here)
    if (empty($errorMessage)) {
        if (updateUserProfile($connect, $userId, $firstName, $lastName, $email, $phone)) {
            header("Location: profile.php");
            exit();
        } else {
            $errorMessage = "Error updating profile.";
        }
    }
}