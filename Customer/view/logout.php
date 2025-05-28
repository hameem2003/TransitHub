<?php
include(__DIR__ . "/../model/db.php");
session_start();

session_destroy();
header("location:login.php");
?>
