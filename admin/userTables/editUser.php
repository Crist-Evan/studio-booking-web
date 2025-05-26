<?php
    include '../../connection.php';
    $user_id = $_GET['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newUsername = $_POST['username'];
        $newUseremail = $_POST['useremail'];
        $newUserphonenumber = $_POST['userphonenumber'];

        $query = "UPDATE users SET name = ?, email = ?, number_phone = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssi', $newUsername, $newUseremail, $newUserphonenumber, $user_id);
        mysqli_stmt_execute($stmt);

        header("Location: manageUsers.php");
        exit;
    }

    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <form method="post">
        <label for="username">Name: </label>
        <input type="text" name="username" value="<?= $user['name'] ?>" /><br /><br />
        <label for="useremail">Email: </label>
        <input type="email" name="useremail" value="<?= $user['email'] ?>" /><br /><br />
        <label for="userphonenumber">Phone Number: </label>
        <input
            type="tel"
            name="userphonenumber"
            value="<?= $user['number_phone'] ?>"
        /><br /><br />
        <input type="submit" value="Edit!">
    </form>
</body>
</html>