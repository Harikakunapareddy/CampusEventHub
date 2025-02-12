<?php
require 'db_config.php';

// Define coordinator data
$coordinators = [
    ['username' => 'coordinator1', 'password' => 'password111', 'club' => 'happy club'],
    ['username' => 'coordinator2', 'password' => 'password222', 'club' => 'echarts club'],
    ['username' => 'coordinator3', 'password' => 'password333', 'club' => 'photography club'],
    ['username' => 'coordinator4', 'password' => 'password444', 'club' => 'dance club'],
    // Add more coordinators as needed
];

// Prepare SQL statement
$stmt = $conn->prepare('INSERT INTO coordinators (username, password, club) VALUES (?, ?, ?)');

// Insert each coordinator
foreach ($coordinators as $coordinator) {
    $username = $coordinator['username'];
    $hashedPassword = password_hash($coordinator['password'], PASSWORD_BCRYPT);
    $club = $coordinator['club'];
    $stmt->bind_param('sss', $username, $hashedPassword, $club);
    $stmt->execute();
}

echo 'Coordinators inserted successfully';
?>
