<?php
session_start();
include '../private/connection.php';
require_once '../vendor/autoload.php';

use PHPGangsta\GoogleAuthenticator\GoogleAuthenticator;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $otp = $_POST['otp'];

    $sql = "SELECT user_role, user_id, user_password, secret_code FROM tbl_user WHERE user_email = :email";
    $query = $conn->prepare($sql);
    $query->bindParam(':email', $email);
    $query->execute();

    if ($query->rowCount() == 1) {
        $result = $query->fetch(PDO::FETCH_ASSOC);


        if (password_verify($password, $result['user_password'])) {
            $ga = new PHPGangsta_GoogleAuthenticator();
            $secret = $result['secret_code'];

            if ($ga->verifyCode($secret, $otp)) {
                $_SESSION['role'] = $result['user_role'];
                $_SESSION['userid'] = $result['user_id'];
                header('location: ../index.php?page=homepage');
                exit();
            } else {
                $_SESSION['notification'] = 'One-time password is incorrect.';
                header('location: ../index.php?page=login');
                exit();
            }
        } else {
            $_SESSION['notification'] = 'Combination of username and password is incorrect.';
            header('location: ../index.php?page=login');
            exit();
        }
    } else {
        $_SESSION['notification'] = 'Combination of username and password is incorrect.';
        header('location: ../index.php?page=login');
        exit();
    }
} else {
    header('location: ../index.php');
    exit();
}
?>
