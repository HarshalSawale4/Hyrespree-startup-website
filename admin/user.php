<?php
include '../db.php';

if (!$conn) {
    die("Database connection failed");
}

// Fetch only the specific columns requested
$result = mysqli_query($conn, "SELECT first_name, last_name, email, company FROM contact_requests");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users - HyreSpree Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reusing your dashboard styles */
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Inter',sans-serif;}
        body{background:#0b0f14;color:#fff;display:flex}
        .sidebar{width:260px;min-height:100vh;background:#111827;padding:20px}
        .logo{font-size:22px;font-weight:700;color:#22d3ee;margin-bottom:30px}
        .menu a{display:block;padding:12px 14px;margin-bottom:8px;color:#cbd5f5;text-decoration:none;border-radius:8px}
        .menu a:hover, .menu a.active{background:#1f2937;color:#22d3ee}
        .main{flex:1;padding:24px}
        table{width:100%;border-collapse:collapse;background:#111827;border-radius:12px;margin-top:20px;overflow:hidden}
        th,td{padding:14px;text-align:left}
        th{background:#1f2937;color:#22d3ee}
        tr{border-bottom:1px solid #1f2937}
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="logo">HyreSpree Admin</div>
    <nav class="menu">
    <a href="admin.php" class="active">Dashboard</a>
    <a href="user.php">Users </a>
    <a href="recruiters.php" > Recruiters</a>
    
    <a href="faq_admin.php">FAQ'S</a>
    <a href="add_testimonial.php">Emp Review</a>
    <a href="booking_admin.php">Booking Request</a>
    </nav>
</aside>

<main class="main">
    <h1>User Management</h1>
    
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0) { 
                while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['first_name'] . " " . $row['last_name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['company']) ?></td>
                </tr>
                <?php } 
            } else { ?>
                <tr><td colspan="3" style="text-align:center;">No users found</td></tr>
            <?php } ?>
        </tbody>
    </table>
</main>

</body>
</html>