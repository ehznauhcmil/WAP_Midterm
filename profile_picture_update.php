<?php
session_start();
include_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['id']; // Get logged-in user's ID

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {

        $fileName = $_FILES['profile_picture']['name'];
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];

        $uploadDir = 'profile_pictures/';

        if (move_uploaded_file($fileTmpPath, $uploadDir . $fileName)) {

            // 5. Update the database with the new filename
            $updateQuery = "UPDATE users SET profile_picture = ? WHERE id = ?";
            $stmt = $connect->prepare($updateQuery);
            $stmt->bind_param("si", $fileName, $userId);

            if ($stmt->execute()) {
                // Success: Redirect back to the profile page
                header("Location: profile.php");
                exit();
            } else {
                echo "Error updating database: " . $stmt->error;
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "No file uploaded or error in upload.";
    }
}
?>