<?php
  $servername = "localhost";
  $username = "root";
  $password = "";

  try {
    $db = new PDO("mysql:host=$servername;dbname=poketrader", $username, $password);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
  }
?>