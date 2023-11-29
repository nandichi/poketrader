<?php
session_start();
include '../private/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT user_role, user_id, user_password FROM tbl_user WHERE user_email = :email";
    $query = $conn->prepare($sql);
    $query->bindParam(':email', $email);
    $query->execute();

    if ($query->rowCount() == 1) {
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $result['user_password'])) {
            $_SESSION['role'] = $result['user_role'];
            $_SESSION['userid'] = $result['user_id'];
            header('location: ../index.php?page=homepage');
            exit();
        } else {
            $_SESSION['notification'] = 'Combinatie gebruikersnaam en Wachtwoord onjuist.';
        }
    } else {
        $_SESSION['notification'] = 'Combinatie gebruikersnaam en Wachtwoord onjuist.';
    }
    header('location: ../index.php?page=signin');
    exit();
} else {
    header('location: ../index.php');
    exit();
}
?>
