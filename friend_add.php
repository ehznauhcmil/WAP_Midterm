<?php
session_start();
include ("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['friend_id'])) {
    $friendId = $_POST['friend_id']; // No input validation
    $currentUserId = $_SESSION['id'];

    $checkStmt = $connect->prepare("SELECT * FROM friends WHERE id_1 = ? AND id_2 = ? OR id_1 = ? AND id_2 = ?");
    $checkStmt->bind_param("iiii", $currentUserId, $friendId, $friendId, $currentUserId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo "Friendship already exists.";
        header('Location: profile.php');
    }

    if ($currentUserId > $friendId) {
        list($currentUserId, $friendId) = array($friendId, $currentUserId);
    }

    // Insert into friends table (no duplicate error handling)
    $stmt = $connect->prepare("INSERT INTO friends (id_1, id_2) VALUES (?, ?)");
    $stmt->bind_param("ii", $currentUserId, $friendId);
    $stmt->execute();

    echo "Friend added successfully!";
}
header('Location: profile.php');
?>