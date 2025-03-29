<?php
// logout.php

// Xóa cookie username
setcookie("username", "", time() - 3600, "/");

// Chuyển hướng về login.php
header("Location: login.php");
exit();
?>