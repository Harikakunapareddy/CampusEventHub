<?php
session_start();
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = urlencode('Fields cannot be empty');
        header("Location: login.html?error=$error");
        exit;
    }
    $stmt = $conn->prepare("SELECT password, club FROM coordinators WHERE username = ?");
    if (!$stmt) {
        $error = urlencode('SQL error');
        header("Location: login.html?error=$error");
        exit;
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashedPassword, $club);
    $stmt->fetch();
    if ($stmt->num_rows > 0 && password_verify($password, $hashedPassword)) {
        $_SESSION['username'] = $username;
        $_SESSION['club'] = $club;
        header('Location: clubSelection.html');
        exit;
    } else {
        $error = urlencode('Invalid username or password');
        header("Location: login.html?error=$error");
        exit;
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: login.html');
    exit;
}
?>
