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

    if (empty($errorMessage)) {
        if (updateUserProfile($connect, $userId, $firstName, $lastName, $email, $profilePicture, $phone)) {
            header("Location: profile.php");
            exit();
        } else {
            $errorMessage = "Error updating profile.";
        }
    }
}