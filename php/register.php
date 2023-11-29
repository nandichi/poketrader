<?php
session_start();
include '../private/connection.php';

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

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $user_role = 'user';

    $sql = "INSERT INTO tbl_user (user_email, user_name, user_password, user_role) VALUES (:email, :username, :password, :user_role)";
    $query = $conn->prepare($sql);
    $query->bindParam(':email', $email);
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $hashed_password);
    $query->bindParam(':user_role', $user_role);

    if ($query->execute()) {
        $_SESSION['notification'] = 'Registration successful. You can now log in.';
        header('location: ../index.php?page=signin');
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
