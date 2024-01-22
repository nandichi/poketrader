<?php
include 'private/connection.php';

$sql = "SELECT user_id FROM tbl_user";
$query = $conn->prepare($sql);
$query->execute();


$result = $query->fetch(PDO::FETCH_ASSOC);
$last_user_id = $result['user_id'];

$sql2 = "SELECT secret_code FROM tbl_user WHERE user_id = :user_id";
$stmt = $conn->prepare($sql2);
$stmt->execute(array(
    ':user_id' => $last_user_id,
));
$r = $stmt->fetch(PDO::FETCH_ASSOC);
echo ($r['secret_code']);

?>
<form action="index.php?page=login" method="post">
    <button type="submit" class="btn btn-primary">2FA GEACTIVEERD</button>
    dit is jouw secret code!!
</form>
