<?php
session_start();  // Start the session to access it
session_destroy(); // Destroy all session data

header('Location: login.php');
exit;  // Stop script execution after redirect
?>
