<?php
setcookie ("threed_id", "", 0, "/");
setcookie ("threed_password", "", 0, "/");
header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/");
exit;
?>
