<?php 

session_destroy();
session_unset();
unset($_SESSION['name']);
unset($_SESSION['aname']);

header('Location: login.php');

 ?>