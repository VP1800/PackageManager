<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['us'];
    $password = $_POST['pwd'];

    // Dummy validation, replace with actual DB query
    if ($username == 'admin' && $password == 'admin123') {
        $_SESSION['user_logged_in'] = 1;
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
