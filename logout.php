<?php
session_start();           // Mulai session
session_unset();           // Menghapus semua variabel session
session_destroy();         // Mengakhiri session

// Redirect ke halaman login atau homepage
header("Location: index.html");
exit;
?>
