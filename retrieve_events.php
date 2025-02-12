<?php
session_start();
require 'db_config.php';

$username = $_SESSION['username'];

// Prepare the SELECT statement
$stmt = $conn->prepare('SELECT id, eventName, eventDate, eventDescription, googleFormLink FROM collegeevents WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

// Return events as JSON
header('Content-Type: application/json');
echo json_encode($events);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
