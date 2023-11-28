<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  }

  require_once 'private/connection.php';
  session_start();

//   $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];
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
</head>
<body class="bg-secondary">
  <?php
    require_once 'includes/navbar.inc.php';

    // try {
    //   if (isset($page)) {
    //     $file = 'includes/'.$page.'.inc.php';
    //     if (file_exists($file)) {
    //       require_once $file;
    //     } else {
    //       header("Location: index.php?page=404");
    //       exit();
    //     }
    //   } else {
    //     require_once 'includes/homepage.inc.php';
    //   }
    // } catch (\Exception $e) {
    //   echo '<meta http-equiv="refresh" content="0; url=index.php?page=homepage" />';
    // }

    // Debugging: display the contents of the session
    echo "<pre>", print_r($_SESSION),"</pre>";

    // require_once 'includes/error.inc.php';
    // require_once 'includes/info.inc.php';
  ?>
</body>
</html>