<?php
include '../db.php';

// Initialize variables for the form
$update_mode = false;
$id = 0;
$name = '';
$email = '';
$designation = '';

// --- LOGIC: ADD NEW STAFF ---
if (isset($_POST['add_staff'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);

    $insertQuery = "INSERT INTO recruiters (name, email, designation) VALUES ('$name', '$email', '$designation')";
    mysqli_query($conn, $insertQuery);
    header("Location: recruiters.php");
}

// --- LOGIC: DELETE STAFF ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM recruiters WHERE id = $id");
    header("Location: recruiters.php");
}

// --- LOGIC: FETCH DATA FOR EDITING ---
if (isset($_GET['edit'])) {
    $update_mode = true;
    $id = $_GET['edit'];
    $edit_res = mysqli_query($conn, "SELECT * FROM recruiters WHERE id = $id");
    if (mysqli_num_rows($edit_res) == 1) {
        $row = mysqli_fetch_array($edit_res);
        $name = $row['name'];
        $email = $row['email'];
        $designation = $row['designation'];
    }
}

// --- LOGIC: UPDATE EXISTING STAFF ---
if (isset($_POST['update_staff'])) {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);

    mysqli_query($conn, "UPDATE recruiters SET name='$name', email='$email', designation='$designation' WHERE id=$id");
    header("Location: recruiters.php");
}

$result = mysqli_query($conn, "SELECT * FROM recruiters ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recruiter Management - HyreSpree</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* [Existing Styles Kept for Consistency] */
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Inter',sans-serif;}
        body{background:#0b0f14;color:#fff;display:flex}
        .sidebar{width:260px;min-height:100vh;background:#111827;padding:20px}
        .logo{font-size:22px;font-weight:700;color:#22d3ee;margin-bottom:30px}
        .menu a{display:block;padding:12px 14px;margin-bottom:8px;color:#cbd5f5;text-decoration:none;border-radius:8px}
        .menu a:hover, .menu a.active{background:#1f2937;color:#22d3ee}
        .main{flex:1;padding:24px}
        .card{background:#111827;padding:24px;border-radius:12px;margin-bottom:30px;border: 1px solid #1f2937;}
        input, select{background:#1f2937; border:1px solid #374151; color:#fff; padding:10px; border-radius:6px; margin-right:5px}
        .btn{padding:10px 20px; border-radius:6px; cursor:pointer; border:none; font-weight:600}
        .btn-add{background:#22d3ee; color:#000}
        .btn-update{background:#fbbf24; color:#000}
        .btn-edit{color:#22d3ee; text-decoration:none; margin-right:10px; font-size:14px}
        .btn-del{color:#ef4444; text-decoration:none; font-size:14px}
        table{width:100%; border-collapse:collapse; background:#111827; border-radius:12px; overflow:hidden}
        th, td{padding:14px; text-align:left; border-bottom:1px solid #1f2937}
        th{background:#1f2937; color:#22d3ee}
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
    <h1>Recruiter & Staff Management</h1>

    <div class="card">
        <h3><?= $update_mode ? "Edit Staff: $name" : "Add New Staff Member" ?></h3>
        <form method="POST" style="margin-top:15px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="text" name="name" placeholder="Full Name" value="<?= $name ?>" required>
            <input type="email" name="email" placeholder="Email Address" value="<?= $email ?>" required>
            
            <select name="designation">
                <option value="Senior Recruiter" <?= $designation == 'Senior Recruiter' ? 'selected' : '' ?>>Senior Recruiter</option>
                <option value="Talent Acquisition" <?= $designation == 'Talent Acquisition' ? 'selected' : '' ?>>Talent Acquisition</option>
                <option value="HR Manager" <?= $designation == 'HR Manager' ? 'selected' : '' ?>>HR Manager</option>
                <option value="Hiring Coordinator" <?= $designation == 'Hiring Coordinator' ? 'selected' : '' ?>>Hiring Coordinator</option>
            </select>

            <?php if ($update_mode): ?>
                <button type="submit" name="update_staff" class="btn btn-update">Update Staff</button>
                <a href="recruiters.php" style="color:#94a3b8; margin-left:10px; text-decoration:none;">Cancel</a>
            <?php else: ?>
                <button type="submit" name="add_staff" class="btn btn-add">Add Staff</button>
            <?php endif; ?>
        </form>
    </div>

    <div class="section">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><span style="color:#22d3ee"><?= $row['designation'] ?></span></td>
                    <td>
                        <a href="recruiters.php?edit=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                        <a href="recruiters.php?delete=<?= $row['id'] ?>" class="btn-del" onclick="return confirm('Delete staff member?')">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>