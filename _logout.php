<?php
session_start();
echo 'Logging you out. Please Wait........';
session_unset();
session_destroy();
header("Location: /phpprac/FORUM/index.php")
?>
