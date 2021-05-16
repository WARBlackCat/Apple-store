<?php

	if (!isset($_SESSION['lang'])) {
		$_SESSION['lang'] = "hu";
		}else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
			if ($_GET['lang'] == "hu") {
				$_SESSION['lang'] = "hu";
				}else if ($_GET['lang'] == "en") {
						$_SESSION['lang'] = "en";
					}else if ($_GET['lang'] == "de") {
						$_SESSION['lang'] = "de";
					}
	}

	require_once "../Model/LanguageInc/".$_SESSION['lang'].".php";
?>