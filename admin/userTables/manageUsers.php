<?php
    session_start();
    include '../../connection.php';
    if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
    }
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>phone number</th>
            <th>password</th>
            <th>role</th>
            <th>created at</th>
            <th>action</th>
        </tr>
        <?php while ($user = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['number_phone'] ?></td>
            <td><?= $user['password'] ?></td>
            <td><?= $user['role'] ?></td>
            <td><?= $user['created_at'] ?></td>
            <td>
                <a href="editUser.php?user_id=<?= $user['id'] ?>">edit</a>
                <a href="deleteUser.php?user_id=<?= $user['id'] ?>" onclick="return confirm('Yakin?')">delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>