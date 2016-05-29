<?php
session_start();
$_SESSION['valid'] = false;
session_destroy();
header('Location: ../index.php');