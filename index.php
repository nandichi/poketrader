<?php
session_start();

if(isset($_GET['page'])){
  if($_GET['page'] == 'logout'){
    header('location: php/logout.php');
    die();
  }else{
    $page = $_GET['page'];
  }
}
else{
  $page = "login";
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset = "UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php if (isset($page)) { echo $page; } else {echo "Home";}?></title>
  <link href="style/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700&display=swap">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-secondary">
  <?php
    include 'includes/navbar.inc.php';
    include 'includes/'.$page.'.inc.php';
//    echo "<pre>", print_r($_SESSION),"</pre>";
  ?>
</body>
</html>