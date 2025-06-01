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
    <title>User Profile</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="../adminlte.css" />
    <style>
        .form-control:focus {
            box-shadow: none;
        }
        .inactive-btn {
            opacity: 0.4;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .active-btn {
            opacity: 1;
            pointer-events: auto;
            transition: opacity 0.3s ease;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper p-4">
        <div class="container">
            <div class="mb-3">
                <a href="../index.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-body text-center">
                    <img src="../assets/user-photo-profile.jpg" alt="Profile Picture" class="profile-img">
                    <h3 class="mb-4">Edit Profile</h3>
                    <form method="POST" class="text-left" style="max-width: 500px; margin: 0 auto;">
                        <div class="form-group">
                            <label for="username" class="form-label">Name</label>
                            <input type="text" id="username" name="username" class="form-control border-0 bg-light" value="<?= htmlspecialchars($user['name']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="useremail" class="form-label">Email</label>
                            <input type="email" id="useremail" name="useremail" class="form-control border-0 bg-light" value="<?= htmlspecialchars($user['email']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="userphonenumber" class="form-label">Phone Number</label>
                            <input type="tel" id="userphonenumber" name="userphonenumber" class="form-control border-0 bg-light" value="<?= htmlspecialchars($user['number_phone']) ?>">
                        </div>
                        <div class="mt-5 text-end">
                            <button type="submit" id="saveBtn" class="btn btn-success mr-2 inactive-btn">Save Changes</button>
                            <button type="button" id="resetBtn" class="btn btn-secondary inactive-btn">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../adminlte.js"></script>
<script>
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('useremail');
    const phoneInput = document.getElementById('userphonenumber');

    const saveBtn = document.getElementById('saveBtn');
    const resetBtn = document.getElementById('resetBtn');

    const originalData = {
        username: usernameInput.value,
        useremail: emailInput.value,
        userphonenumber: phoneInput.value
    };

    function checkForChanges() {
        const isChanged =
            usernameInput.value !== originalData.username ||
            emailInput.value !== originalData.useremail ||
            phoneInput.value !== originalData.userphonenumber;

        if (isChanged) {
            saveBtn.classList.remove('inactive-btn');
            saveBtn.classList.add('active-btn');

            resetBtn.classList.remove('inactive-btn');
            resetBtn.classList.add('active-btn');
        } else {
            saveBtn.classList.remove('active-btn');
            saveBtn.classList.add('inactive-btn');

            resetBtn.classList.remove('active-btn');
            resetBtn.classList.add('inactive-btn');
        }
    }

    usernameInput.addEventListener('input', checkForChanges);
    emailInput.addEventListener('input', checkForChanges);
    phoneInput.addEventListener('input', checkForChanges);

    resetBtn.addEventListener('click', () => {
        usernameInput.value = originalData.username;
        emailInput.value = originalData.useremail;
        phoneInput.value = originalData.userphonenumber;
        checkForChanges();
    });
</script>
</body>
</html>
