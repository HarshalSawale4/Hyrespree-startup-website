<?php
include '../db.php';

// Handle Add/Update
if (isset($_POST['save_faq'])) {
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer = mysqli_real_escape_string($conn, $_POST['answer']);
    
    if (!empty($_POST['faq_id'])) {
        $id = $_POST['faq_id'];
        mysqli_query($conn, "UPDATE faqs SET question='$question', answer='$answer' WHERE id=$id");
    } else {
        mysqli_query($conn, "INSERT INTO faqs (question, answer) VALUES ('$question', '$answer')");
    }
    header("Location: faq_admin.php");
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM faqs WHERE id=$id");
    header("Location: faq_admin.php");
}

$faqs = mysqli_query($conn, "SELECT * FROM faqs ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage FAQ - HyreSpree</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Inter',sans-serif;}
        body{background:#0b0f14;color:#fff;display:flex}
        .sidebar{width:260px;min-height:100vh;background:#111827;padding:20px}
        .menu a{display:block;padding:12px;color:#cbd5f5;text-decoration:none;border-radius:8px;margin-bottom:5px}
        .menu a.active{background:#1f2937;color:#22d3ee}
        .main{flex:1;padding:24px}
        .card{background:#111827;padding:20px;border-radius:12px;border:1px solid #1f2937;margin-bottom:20px}
        input, textarea{width:100%; background:#1f2937; border:1px solid #374151; color:#fff; padding:12px; border-radius:6px; margin-bottom:10px}
        .btn{padding:10px 20px; border-radius:6px; cursor:pointer; border:none; font-weight:600; background:#22d3ee; color:#000}
        table{width:100%; border-collapse:collapse; background:#111827;}
        th, td{padding:15px; text-align:left; border-bottom:1px solid #1f2937}
        th{color:#22d3ee}
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="logo" style="font-weight:700; color:#22d3ee; margin-bottom:30px">HyreSpree Admin</div>
        <nav class="menu">
            <a href="admin.php">Dashboard</a>
            <a href="user.php">Users</a>
            <a href="recruiters.php">Recruiters</a>
            <a href="faq_admin.php" class="active">Manage FAQ</a>
        </nav>
    </aside>

    <main class="main">
        <h1>FAQ Management</h1>
        <div class="card">
            <h3>Add / Edit FAQ</h3>
            <form method="POST">
                <input type="hidden" name="faq_id" id="faq_id">
                <input type="text" name="question" id="question" placeholder="Enter Question" required>
                <textarea name="answer" id="answer" rows="4" placeholder="Enter Answer" required></textarea>
                <button type="submit" name="save_faq" class="btn">Save FAQ</button>
            </form>
        </div>

        <table>
            <thead><tr><th>Question</th><th>Answer</th><th>Action</th></tr></thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($faqs)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['question']) ?></td>
                    <td><?= substr(htmlspecialchars($row['answer']), 0, 50) ?>...</td>
                    <td>
                        <button onclick="editFaq(<?= $row['id'] ?>, '<?= addslashes($row['question']) ?>', '<?= addslashes($row['answer']) ?>')" style="color:#22d3ee; background:none; border:none; cursor:pointer">Edit</button> | 
                        <a href="faq_admin.php?delete=<?= $row['id'] ?>" style="color:#ef4444; text-decoration:none">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <script>
        function editFaq(id, q, a) {
            document.getElementById('faq_id').value = id;
            document.getElementById('question').value = q;
            document.getElementById('answer').value = a;
            window.scrollTo(0,0);
        }
    </script>
</body>
</html>