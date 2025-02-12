<?php
session_start();
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $eventDescription = $_POST['eventDescription'];
    $googleFormLink = $_POST['googleFormLink'] ?? '';

    // Prepare the INSERT statement
    $stmt = $conn->prepare('INSERT INTO collegeevents (username, eventName, eventDate, eventDescription, googleFormLink) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssss', $username, $eventName, $eventDate, $eventDescription, $googleFormLink);

    // Execute and check for errors
    if ($stmt->execute()) {
        echo 'Event posted successfully';
    } else {
        echo 'Error: Could not post event';
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
