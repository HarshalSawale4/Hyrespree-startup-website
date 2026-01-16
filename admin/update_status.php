<?php
// update_status.php
$conn = new mysqli("localhost", "root", "", "hyrespree");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Using prepared statement for security
    $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    
    if ($stmt->execute()) {
        echo "Success";
    } else {
        http_response_code(500);
        echo "Error";
    }
    $stmt->close();
}
?>