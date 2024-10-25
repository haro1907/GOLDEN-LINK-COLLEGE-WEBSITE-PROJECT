<?php
session_start();
session_destroy();
header("Location: glc_home.html");
exit();
?>
