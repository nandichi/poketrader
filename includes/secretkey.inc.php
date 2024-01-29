<?php
include 'private/connection.php';
require_once 'vendor/autoload.php';

$ga = new PHPGangsta_GoogleAuthenticator();
$sql1 = "SELECT user_id FROM tbl_user";
$query1 = $conn->prepare($sql1);
$query1->execute();
$result1 = $query1->fetch(PDO::FETCH_ASSOC);
$last_user_id = $result1['user_id'];

$sql2 = "SELECT secret_code FROM tbl_user WHERE user_id = :user_id";
$query2 = $conn->prepare($sql2);
$query2->execute([':user_id' => $last_user_id]);
$result2 = $query2->fetch(PDO::FETCH_ASSOC);
$secret_code = $result2['secret_code'];
?>

<body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('revealButton').addEventListener('click', function() {
            document.getElementById('secretCode').style.display = 'block';
            document.getElementById('secretCode').textContent = '<?php echo $secret_code; ?>';
        });
    });
</script>

<p>Scan de QR code om 2fa te activeren:</p>
<img src="<?php echo $ga->getQRCodeGoogleUrl('poketrader', $secret_code); ?>" alt="QR Code">
<div style="display: flex; align-items: center;">
    <form action="index.php?page=login" method="post">
        <button type="submit" class="btn btn-primary">2FA GEACTIVEERD</button>
    </form>

    <button id="revealButton" class="btn btn-primary" style="margin-left: 10px;">Reveal Secret Code</button>
    <div id="secretCode" style="display: none; margin-left: 10px;"></div>
</div>
</body>
