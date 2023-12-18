<?php
session_start();
include '../private/connection.php';

function is_valid_password($password) {
    return preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[!@#$%^&*()-_=+{};:,<.>]).{6,}$/', $password);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    if ($password !== $confirm_password) {
        $_SESSION['notification'] = 'Passwords do not match.';
        header('location: ../index.php?page=register');
        exit();
    }
    if (!is_valid_password($password)) {
        $_SESSION['notification'] = 'Password does not meet security requirements.';
        header('location: ../index.php?page=register');
        exit();
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $user_role = 'user';
    $sql = "INSERT INTO tbl_user (user_email, user_name, user_password, user_role) VALUES (?, ?, ?, ?)";
    $query = $conn->prepare($sql);

    $query->bindParam(1, $email);
    $query->bindParam(2, $username);
    $query->bindParam(3, $hashed_password);
    $query->bindParam(4, $user_role);

    if ($query->execute()) {
        $_SESSION['notification'] = 'Registration successful. You can now log in.';
        header('location: ../index.php?page=login');
        exit();
    } else {
        $_SESSION['notification'] = 'Registration failed. Please try again.';
        header('location: ../index.php?page=register');
        exit();
    }
} else {
    header('location: ../index.php');
    exit();
}
?>
