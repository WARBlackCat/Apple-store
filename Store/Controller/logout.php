<?php 

session_destroy();
session_unset();
unset($_SESSION['name']);

header('Location: login.php');

 ?>