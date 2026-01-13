
<?php
$conn = new mysqli('localhost','root','','hyrespree');
$result = $conn->query("SELECT * FROM contact_requests ORDER BY id DESC");
while($row = $result->fetch_assoc()){
  echo "<tr>
    <td>{$row['first_name']} {$row['last_name']}</td>
    <td>{$row['email']}</td>
    <td>{$row['phone']}</td>
    <td>{$row['company']}</td>
    <td>{$row['message']}</td>
    <td><a href='delete.php?id={$row['id']}'>Delete</a></td>
  </tr>";
}
?>