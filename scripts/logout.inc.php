<?php // Logout script
session_start();
session_unset();
session_destroy();
header('location: ../index.php?logoutSuccessful');
exit();
?>
