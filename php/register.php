<?php
session_start();
include '../private/connection.php';
require_once '../vendor/autoload.php';


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
        $_SESSION['notification'] = 'Password must be at least 6 characters long and contain at least one digit, one uppercase letter, and one special character.';
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

        $user_id = $conn->lastInsertId();


        $ga = new PHPGangsta_GoogleAuthenticator();
        $secret = $ga->createSecret();


        $sqlUpdate = "UPDATE tbl_user SET secret_code = ? WHERE user_id = ?";
        $queryUpdate = $conn->prepare($sqlUpdate);
        $queryUpdate->bindParam(1, $secret);
        $queryUpdate->bindParam(2, $user_id);
        $queryUpdate->execute();


        echo "Secret is: " . $secret . "\n\n";
        $qrCodeUrl = $ga->getQRCodeGoogleUrl('poketrader', $secret);
        echo "Scan the following QR code with Google Authenticator:\n";
        echo '<img src="' . $qrCodeUrl . '" alt="QR Code">';


        $_SESSION['notification'] = 'Registration successful. You can now log in.';
        header('location: ../index.php?page=secretkey');
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
