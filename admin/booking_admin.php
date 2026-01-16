<?php
$conn = new mysqli("localhost", "root", "", "hyrespree");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total count for the metric card
$countResult = $conn->query("SELECT COUNT(*) as total FROM bookings");
$totalBookings = $countResult->fetch_assoc()['total'];

// Fetch all bookings
$result = $conn->query("SELECT * FROM bookings ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HyreSpree Admin - Bookings</title>
    <style>
        :root {
            --bg-dark: #0b111b;
            --sidebar-bg: #111827;
            --card-bg: #1f2937;
            --text-main: #f3f4f6;
            --text-dim: #9ca3af;
            --accent-cyan: #22d3ee;
            --border-color: #374151;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            display: flex;
        }

        /* --- Sidebar Styles --- */
        .sidebar {
            width: 240px;
            background-color: var(--sidebar-bg);
            height: 100vh;
            position: fixed;
            padding: 20px 0;
            border-right: 1px solid var(--border-color);
        }

        .sidebar h2 {
            color: var(--accent-cyan);
            padding: 0 20px;
            font-size: 1.5rem;
            margin-bottom: 30px;
        }

        .sidebar nav a {
            display: block;
            padding: 12px 20px;
            color: var(--text-dim);
            text-decoration: none;
            transition: 0.3s;
            font-size: 0.95rem;
        }

        .sidebar nav a:hover, .sidebar nav a.active {
            background-color: #1f2937;
            color: var(--accent-cyan);
        }

        /* --- Main Content --- */
        .main-content {
            margin-left: 240px;
            padding: 40px;
            width: calc(100% - 240px);
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        /* --- Metric Card --- */
        .stats-card {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 8px;
            width: fit-content;
            min-width: 250px;
            margin-bottom: 40px;
        }

        .stats-card span {
            color: var(--text-dim);
            font-size: 0.85rem;
            display: block;
            margin-bottom: 5px;
        }

        .stats-card h1 {
            color: var(--accent-cyan);
            margin: 0;
            font-size: 2rem;
        }

        /* --- Table Styles --- */
        .table-container {
            background-color: var(--card-bg);
            border-radius: 8px;
            overflow: hidden;
        }

        .table-title {
            padding: 20px;
            font-size: 1.2rem;
            font-weight: bold;
            border-bottom: 1px solid var(--border-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background-color: #111827;
            color: var(--accent-cyan);
            padding: 15px 20px;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            font-size: 0.9rem;
        }

        tr:hover {
            background-color: #2d3748;
        }

        .status-badge {
            background-color: rgba(34, 211, 238, 0.1);
            color: var(--accent-cyan);
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>HyreSpree Admin</h2>
        <nav>
    <a href="admin.php" class="active">Dashboard</a>
    <a href="user.php">Users </a>
    <a href="recruiters.php" > Recruiters</a>
    
    <a href="faq_admin.php">FAQ'S</a>
    <a href="add_testimonial.php">Emp Review</a>
    <a href="booking_admin.php">Booking Request</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="header-row">
            <h1>Dashboard Overview</h1>
            <button style="background: var(--card-bg); color: white; border: 1px solid var(--border-color); padding: 5px 15px; border-radius: 4px;">Admin</button>
        </div>

        <div class="stats-card">
            <span>Total Bookings</span>
            <h1><?php echo $totalBookings; ?></h1>
        </div>

        <div class="table-container">
            <div class="table-title">Recent Booking Requests</div>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                   <?php if ($result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo htmlspecialchars($row['contact']); ?></td>
        <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
        <td>
            <select class="status-select" 
                    onchange="updateStatus(<?php echo $row['id']; ?>, this.value)"
                    style="background: #111827; color: var(--accent-cyan); border: 1px solid var(--border-color); padding: 5px; border-radius: 4px;">
                <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="Confirmed" <?php echo ($row['status'] == 'Confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                <option value="Cancelled" <?php echo ($row['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
            </select>
        </td>
    </tr>
    <?php endwhile; ?>
<?php endif; ?>

<script>
function updateStatus(bookingId, newStatus) {
    // Send data to the server
    fetch('update_status.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${bookingId}&status=${newStatus}`
    })
    .then(response => response.text())
    .then(data => {
        // Optional: Show a small toast notification that it's saved
        console.log('Status updated to: ' + newStatus);
    })
    .catch(error => alert('Error updating status'));
}
</script>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>