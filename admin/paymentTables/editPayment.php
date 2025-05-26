<?php
    include '../../connection.php';
    $payment_id = $_GET['payment_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newAmount = $_POST['amount'];
        $newMethod = $_POST['method'];
        $newStatus = $_POST['status'];
        $newPaidAt = $_POST['paid_at'];

        $query = "UPDATE payments SET amount = ?, method = ?, status = ?, paid_at = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'dsssi', $newAmount, $newMethod, $newStatus, $newPaidAt, $payment_id);
        mysqli_stmt_execute($stmt);

        header("Location: managePayments.php");
        exit;
    }

    $query = "SELECT * FROM payments WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $payment_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $payment = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment</title>
</head>
<body>
    <form method="post">
        <label for="amount">Amount: </label>
        <input type="number" name="amount" step="0.01" value="<?= $payment['amount'] ?>" required><br /><br />
        <label for="method">Method: </label>
        <input type="text" name="method" value="<?= $payment['method'] ?>" required><br /><br />
        <label for="status">Status: </label>
        <select name="status" required>
            <option value="unpaid" <?= $payment['status'] == 'unpaid' ? 'selected' : '' ?>>Unpaid</option>
            <option value="paid" <?= $payment['status'] == 'paid' ? 'selected' : '' ?>>Paid</option>
            <option value="failed" <?= $payment['status'] == 'failed' ? 'selected' : '' ?>>Failed</option>
        </select><br /><br />
        <label for="paid_at">Paid At: </label>
        <input type="date" name="paid_at" value="<?= htmlspecialchars($payment['paid_at']) ?>" required><br /><br />

        <input type="submit" value="Edit!">
    </form>
</body>
</html>