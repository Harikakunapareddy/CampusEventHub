<?php
require 'db_config.php';

$result = $conn->query('SELECT * FROM collegeevents ORDER BY eventDate DESC');
$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

echo json_encode($events);
?>
