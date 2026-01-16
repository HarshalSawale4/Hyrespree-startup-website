<?php
// Database Connection
$conn = new mysqli("localhost", "root", "", "hyrespree");

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "INSERT INTO bookings (name, contact, email, status) VALUES ('$name', '$contact', '$email', 'Pending')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "success";
    } else {
        $message = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an Appointment | HyreSpree</title>
    <style>
        :root {
            --bg-dark: #0b111b;
            --card-bg: #111827;
            --input-bg: #1f2937;
            --accent-cyan: #22d3ee;
            --text-main: #f3f4f6;
            --text-dim: #9ca3af;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
        }

        .booking-container {
            background-color: var(--card-bg);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            border: 1px solid #374151;
        }

        .booking-container h2 {
            margin-top: 0;
            font-size: 1.8rem;
            color: var(--accent-cyan);
            text-align: center;
        }

        .booking-container p {
            text-align: center;
            color: var(--text-dim);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: var(--text-dim);
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #374151;
            background-color: var(--input-bg);
            color: white;
            font-size: 1rem;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: var(--accent-cyan);
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background-color: var(--accent-cyan);
            color: #0b111b;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s, opacity 0.2s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        /* Success Message Styling */
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 0.9rem;
        }
        .alert-success { background: rgba(34, 211, 238, 0.1); color: var(--accent-cyan); border: 1px solid var(--accent-cyan); }
        .alert-error { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid #ef4444; }
    </style>
</head>
<body>

    <div class="booking-container">
        <h2>HyreSpree Booking</h2>
        <p>Please enter your details to schedule a call.</p>

        <?php if($message == "success"): ?>
            <div class="alert alert-success">Booking successful! We'll contact you shortly.</div>
        <?php elseif($message == "error"): ?>
            <div class="alert alert-error">Something went wrong. Please try again.</div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label>Contact Number</label>
                <input type="text" name="contact" placeholder="+91 00000 00000" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="john@example.com" required>
            </div>
            <button type="submit" class="btn-submit">Confirm Booking</button>
        </form>
    </div>

</body>
</html>