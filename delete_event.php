<?php
session_start();
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decode the JSON payload
    $data = json_decode(file_get_contents('php://input'), true);
    $eventId = $data['id'];
    $username = $_SESSION['username'];

    // Prepare and execute the delete statement
    $stmt = $conn->prepare('DELETE FROM collegeevents WHERE id = ? AND username = ?');
    $stmt->bind_param('is', $eventId, $username);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo 'Event deleted successfully';
    } else {
        echo 'Error deleting event';
    }

    $stmt->close();
    $conn->close();
}
?>
