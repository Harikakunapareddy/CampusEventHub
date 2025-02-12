<?php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM student WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    
    if ($stmt->num_rows > 0 && password_verify($password, $hashedPassword)) {
        $_SESSION['username'] = $username;
        header('Location: cluborcollege.html');
        exit;
    } else {
        header('Location: loginerror.html?error=faculty');
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>
