<?php
    session_start();
    include '../connection.php';
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newUsername = $_POST['username'];
        $newUseremail = $_POST['useremail'];
        $newUserphonenumber = $_POST['userphonenumber'];

        $query = "UPDATE users SET name = ?, email = ?, number_phone = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssi', $newUsername, $newUseremail, $newUserphonenumber, $user_id);
        mysqli_stmt_execute($stmt);

        header("Location: userProfile.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <form method="POST">
        <label for="username">Name: </label>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['name']) ?>"><br>
        
        <label for="useremail">Email: </label>
        <input type="email" id="useremail" name="useremail" value="<?= htmlspecialchars($user['email']) ?>"><br>
        
        <label for="userphonenumber">Number Phone: </label>
        <input type="tel" id="userphonenumber" name="userphonenumber" value="<?= htmlspecialchars($user['number_phone']) ?>"><br><br>
        
        <input type="submit" id="saveBtn" value="Save" style="display: none;">
    </form>
</body>
</html>