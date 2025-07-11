<?php
require 'db_config.php';

$type = isset($_GET['type']) ? $_GET['type'] : '';

date_default_timezone_set('UTC'); // Set timezone to UTC
$currentDate = date('Y-m-d H:i:s');

if ($type == 'upcoming') {
    $stmt = $conn->prepare('SELECT eventName, eventDate, eventDescription, googleFormLink FROM collegeevents WHERE eventDate >= ? ORDER BY eventDate ASC');
    $stmt->bind_param('s', $currentDate);
} else if ($type == 'past') {
    $stmt = $conn->prepare('SELECT eventName, eventDate, eventDescription FROM collegeevents WHERE eventDate < ? ORDER BY eventDate DESC');
    $stmt->bind_param('s', $currentDate);
} else {
    echo json_encode([]);
    exit;
}

$stmt->execute();
$result = $stmt->get_result();
$events = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($events);

$stmt->close();
$conn->close();
?>
