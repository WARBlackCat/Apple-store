<?php

	session_start(); 

	if (!isset($_SESSION['aname'])) {
		header('Location: ../Controller/adminLogin.php');
	}

 ?>