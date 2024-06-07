<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['friend_id'])) {
    $friendId = $_POST['friend_id'];
    $currentUserId = $_SESSION['id'];

    // 110X form - arrange IDs correctly
    if ($currentUserId > $friendId) {
        list($currentUserId, $friendId) = array($friendId, $currentUserId);
    }

    $stmt = $connect->prepare("DELETE FROM friends WHERE id_1 = ? AND id_2 = ?");
    $stmt->execute([$currentUserId, $friendId]);

}
header('Location: profile.php');
