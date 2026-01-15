<?php
include '../db.php';

// Safety check
if (!$conn) {
  die("Database connection failed");
}

/* Fetch contact requests */
$result = mysqli_query($conn, "SELECT * FROM contact_requests");

/* Count contact requests */
$countQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM contact_requests");
$countData = mysqli_fetch_assoc($countQuery);
$totalContacts = $countData['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HyreSpree Admin Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Inter',sans-serif;}
body{background:#0b0f14;color:#fff;display:flex}

/* SIDEBAR */
.sidebar{width:260px;min-height:100vh;background:#111827;padding:20px}
.logo{font-size:22px;font-weight:700;color:#22d3ee;margin-bottom:30px}
.menu a{display:block;padding:12px 14px;margin-bottom:8px;color:#cbd5f5;text-decoration:none;border-radius:8px}
.menu a:hover,.menu a.active{background:#1f2937;color:#22d3ee}

/* MAIN */
.main{flex:1;padding:24px}
.topbar{display:flex;justify-content:space-between;margin-bottom:24px}
.admin{background:#1f2937;padding:10px 14px;border-radius:8px}

/* STATS */
.stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px}
.stat-card{background:#111827;padding:20px;border-radius:16px}
.stat-card h3{font-size:14px;color:#94a3b8}
.stat-card p{font-size:28px;font-weight:700;color:#22d3ee}

/* TABLE */
.section{margin-top:40px}
table{width:100%;border-collapse:collapse;background:#111827;border-radius:12px}
th,td{padding:14px}
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
    <a>Recruiters</a>
    <a href="contacts.php">Jobs</a>
    <a>Contact Leads</a>
    <a>Blog</a>
    <a href="faq_admin.php">FAQ'S</a>
    <a href="add_testimonial.php">Emp Review</a>
  </nav>
</aside>

<main class="main">
  <div class="topbar">
    <h1>Dashboard Overview</h1>
    <div class="admin">Admin</div>
  </div>

  <!-- STATS -->
  <div class="stats">
    <div class="stat-card">
      <h3>Contact Requests</h3>
      <p><?= $totalContacts ?></p>
    </div>
  </div>

  <!-- TABLE -->
  <div class="section">
    <h2>Recent Contact Requests</h2>

    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Company</th>
          <th>Message</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>

      <?php if (mysqli_num_rows($result) > 0) { ?>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?= $row['first_name']." ".$row['last_name'] ?></td>
          <td><?= $row['email'] ?></td>
          <td><?= $row['company'] ?></td>
          <td><?= $row['message'] ?></td>
          <td><?= $row['status'] ?></td>
        </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="5" style="text-align:center;">No records found</td>
        </tr>
      <?php } ?>

      </tbody>
    </table>
  </div>

</main>

</body>
</html>
