<?php
// logout.php
session_start();

// Destroy all sessions
session_destroy();

// Redirect to login page
header("Location: login_admin.php");
exit();
?>
