<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $first_name = $_POST['first_name'];
  $last_name  = $_POST['last_name'];
  $email      = $_POST['email'];
  $phone      = $_POST['phone'];
  $company    = $_POST['company'];
  $message    = $_POST['message'];

  $stmt = $conn->prepare("
    INSERT INTO contact_requests 
    (first_name, last_name, email, phone, company, message, status)
    VALUES (?, ?, ?, ?, ?, ?, 'Pending')
  ");

  $stmt->bind_param(
    "ssssss",
    $first_name,
    $last_name,
    $email,
    $phone,
    $company,
    $message
  );

  $stmt->execute();

  header("Location: thankyou.html");
  exit();
}
?>
