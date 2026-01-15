<?php
require_once('../db.php'); 

// Handle Deletion
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM testimonials WHERE id = $id");
    header("Location: add_testimonial.php");
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $review = mysqli_real_escape_string($conn, $_POST['review']);

    $sql = "INSERT INTO testimonials (name, role, review) VALUES ('$name', '$role', '$review')";
    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HyreSpree Admin | Testimonials</title>
    <link rel="stylesheet" href="admin-dark.css">
</head>
<style>
    :root {
    --bg-main: #0b1120;
    --bg-card: #111827;
    --text-white: #f8fafc;
    --text-muted: #94a3b8;
    --cyan: #22d3ee;
    --red: #ef4444;
}

body {
    background-color: var(--bg-main);
    color: var(--text-white);
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    display: flex;
}

/* Sidebar Styling */
.sidebar {
    width: 260px;
    height: 100vh;
    padding: 20px;
}

.brand {
    color: var(--cyan);
    font-size: 1.5rem;
    margin-bottom: 40px;
}

.sidebar nav a {
    display: block;
    color: var(--text-muted);
    text-decoration: none;
    padding: 12px 15px;
    border-radius: 8px;
    margin-bottom: 5px;
}

.sidebar nav a.active {
    background: rgba(34, 211, 238, 0.1);
    color: var(--cyan);
}

/* Content Layout */
.content {
    flex-grow: 1;
    padding: 40px;
}

h1 { font-size: 1.8rem; margin-bottom: 30px; }

/* Card Form */
.card-section {
    background: var(--bg-card);
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 30px;
    border: 1px solid rgba(255,255,255,0.05);
}

.inline-form {
    display: flex;
    gap: 15px;
    align-items: flex-start;
}

.inline-form input, .inline-form textarea {
    background: #1f2937;
    border: 1px solid #374151;
    color: white;
    padding: 10px 15px;
    border-radius: 6px;
    flex: 1;
}

.btn-primary {
    background: var(--cyan);
    color: #000;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
}

/* Table Styling */
.table-container {
    background: var(--bg-card);
    border-radius: 12px;
    overflow: hidden;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    text-align: left;
    color: var(--cyan);
    padding: 15px 20px;
    background: rgba(255,255,255,0.02);
}

td {
    padding: 15px 20px;
    border-top: 1px solid rgba(255,255,255,0.05);
}

.text-cyan { color: var(--cyan); }
.text-muted { color: var(--text-muted); font-size: 0.9rem; }

.action-edit { color: var(--cyan); text-decoration: none; margin-right: 15px; font-size: 0.9rem; }
.action-delete { color: var(--red); text-decoration: none; font-size: 0.9rem; }
</style>
<body class="admin-layout">

    <aside class="sidebar">
        <h1 class="brand">HyreSpree Admin</h1>
        <nav>
            <a href="#">Dashboard</a>
            <a href="#">Users</a>
            <a href="#" class="active">Testimonials</a>
        </nav>
    </aside>

    <main class="content">
        <h1>Review & Testimonial Management</h1>

        <section class="card-section">
            <h3>Add New Employee Review</h3>
            <form method="POST" class="inline-form">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="text" name="role" placeholder="Designation (e.g. Recruiter)" required>
                <textarea name="review" placeholder="Review Content..." required></textarea>
                <button type="submit" class="btn-primary">Add Review</button>
            </form>
        </section>

        <section class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Review Snippet</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM testimonials ORDER BY id DESC");
                    while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td class="text-cyan"><?php echo $row['role']; ?></td>
                        <td class="text-muted"><?php echo substr($row['review'], 0, 50); ?>...</td>
                        <td>
                            <a href="#" class="action-edit">Edit</a>
                            <a href="?delete=<?php echo $row['id']; ?>" class="action-delete" onclick="return confirm('Delete this review?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>

</body>
</html>