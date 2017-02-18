<?php
session_start();
session_unset();
session_destroy();
setcookie("ajax_login_user", "", time()-60*3600, "/");
header("Location: index.php");
