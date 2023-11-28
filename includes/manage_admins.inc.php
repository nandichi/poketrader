<?php

require 'private/connection.php';

$sql = "SELECT * FROM tbl_user WHERE user_role = 'owner'";
$stmt = $db->prepare($sql); 
$stmt->execute();

?>


<div class="container">
  <div class="row">
    <div class="col-sm">
    </div>
    <div class="col-sm">
    <table class="table">
        <br>
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($stmt as $r){ ?>
    <tr>
      <th scope="row"><?= $r['user_name'] ?></th>
      <td><?= $r['user_email'] ?></td>
      <td>  
        <form action="index.php?page=admin_edit" method="POST">
            <input type="hidden" value="<?php $r['user_id'] ?>">
            <button class="btn btn=success" type="submit">Edit</button>
        </form>
      </td>
      <td>
        <form action="php/delete_admin.php" method="POST">
            <input type="hidden" value="<?php $r['user_id'] ?>">
            <button class="btn btn=danger" type="submit">Delete</button>
        </form>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
    </div>
    <div class="col-sm">
        <br>
        <form action="index.php?page=add_admin" method="POST">
            <button class="btn btn-info" type="submit">Add admin</button>
        </form>
    </div>
  </div>
</div>