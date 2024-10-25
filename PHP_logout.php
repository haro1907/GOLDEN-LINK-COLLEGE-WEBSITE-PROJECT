<?php
session_start();
session_destroy();
header("Location: HTML_glc_home.html");
exit();
?>
