<?php
session_start();
session_unset();
session_destroy();
header('location:C:\xampp\htdocs\event_project1\index.php');

?>