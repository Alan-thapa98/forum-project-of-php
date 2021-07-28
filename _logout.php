<?php

session_start();

// session_unset();
session_destroy();

header("Location: /forum/index.php");
exit;

echo"Logging out! please wait for some time....";

?>