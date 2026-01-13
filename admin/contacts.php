<?php
include '../db.php';
$data = mysqli_query($conn, "SELECT * FROM contact_requestss ORDER BY id DESC");
?>

<table border="1" width="100%">
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Company</th>
    <th>Message</th>
    <th>Status</th>
  </tr>

  <?php while($row = mysqli_fetch_assoc($data)) { ?>
  <tr>
    <td><?= $row['first_name'].' '.$row['last_name']; ?></td>
    <td><?= $row['email']; ?></td>
    <td><?= $row['company']; ?></td>
    <td><?= $row['message']; ?></td>
    <td><?= $row['status']; ?></td>
  </tr>
  <?php } ?>
</table>
