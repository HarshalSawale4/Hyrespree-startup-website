<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first  = $_POST['first_name'];
    $last   = $_POST['last_name'];
    $email  = $_POST['email'];
    $phone  = $_POST['phone'];
    $job    = $_POST['job_title'];
    $company= $_POST['company'];
    $msg    = $_POST['message'];

    $query = "INSERT INTO contact_requestss 
              (first_name, last_name, email, phone, job_title, company, message)
              VALUES
              ('$first','$last','$email','$phone','$job','$company','$msg')";

    mysqli_query($conn, $query);

    header("Location: thank-you.html");
}
?>
