<?php require_once '../Model/dbConnection.php'; ?>
<?php
	session_start();
	require_once '../Model/LanguageInc/language.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	<title><?php echo $lang['reg']?></title>
<style type="text/css">
.content {
	position: relative;
	background-color: #fff;
	margin-top: auto;
	margin-left: auto;
	margin-bottom: 50px;
	margin-right: auto;
	border: 2px solid #2a2a2a;
	border-radius: 0px 0px 10px 10px;
	width: 775px;
	padding: 30px 20px 30px;
}
#text {
	display:none;
	color:red;
	padding-top: 10px;
}
.btn2 {
	background-color: #ababab;
	margin-top: 10px;
}
.header {
	position: relative;
	background-color: #fff;
	margin-top: 50px;
	margin-left: auto;
	margin-bottom: auto;
	margin-right: auto;
	height: 70px;
	border-top: 2px solid #2a2a2a;
	border-right: 2px solid #2a2a2a;
	border-left: 2px solid #2a2a2a;
	border-radius: 10px 10px 0px 0px;
	width: 775px;
	padding: 12px 20px 20px;
}
.btn3 {
	float: right;
	background-color: #ababab;
	margin-right: 7.5px;
}
h3 {
	text-decoration: underline;
	color: #2a2a2a;
}
form {
	color: #2a2a2a;
	padding-bottom: 10px;
}
a {
	color: #2a2a2a;
	font-weight: bold;
	text-decoration: none;
}
a:hover {
	color: #2a2a2a;
}
a:visited {
	color: #2a2a2a;
}
body {
	background-color: black;
}
.right {
	float: right;
	margin-right: 7.5px;
	margin-top: 5px;
}
.sel select {
  display: none; 
}
.sel {
	background-color: #ababab;
}
option {
	color: #2a2a2a;
}
select {
	color: #2a2a2a;
	height: 30px;
}
</style>
</head>
<body>
	<div class="header">
		<a href="../Controller/login.php"><button class="btn btn3"><?php echo $lang['login']?></button></a>
		<a href="../Controller/registration.php"><button class="btn btn3"><?php echo $lang['reg']?></button></a>
		<a href="../View/aboutus.php"><button class="btn btn3"><?php echo $lang['about']?></button></a>
		<span class="right">
				<select class="sel" onchange="location = this.value;">
					<option><?php echo $lang['chooselang']?></option>>
					<option value="../Controller/registration.php?lang=hu"><?php echo $lang['hun']?></option>
					<option value="../Controller/registration.php?lang=en"><?php echo $lang['eng']?></option>
					<option value="../Controller/registration.php?lang=de"><?php echo $lang['ger']?></option>
				</select>
			</span>
	</div>
	<div class="content">
		<h3><?php echo $lang['reg']?></h3><br>
		<form action="" method="POST">
			<div class="form-group">
    			<?php echo $lang['name']?>
    			<input type="text" class="form-control" name="name" placeholder="<?php echo $lang['name']?>" />
  			</div>
  			<div class="form-group">
  				<?php echo $lang['email']?>
    			<input type="email" class="form-control" name="email" placeholder="E-mail" />
  			</div>
  			<div class="form-group">
    			<?php echo $lang['pass']?>
    			<input type="password" class="form-control" name="pass" id="p1" placeholder="<?php echo $lang['pass']?>" />
  			</div>
  			<div class="form-group">
  				<?php echo $lang['cpass']?>
    			<input type="password" class="form-control" name="confpass" id="p2" placeholder="<?php echo $lang['cpass']?>" />
  			</div>
  			<p id="text"><?php echo $lang['alert']?></p>

  			<!--
				https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_detect_capslock
  			-->
			<script>
				var input = document.getElementById("p1");
				var text = document.getElementById("text");
				input.addEventListener("keyup", function(event) {

					if (event.getModifierState("CapsLock")) {
    					text.style.display = "block";
  					} else {
    					text.style.display = "none"
  					}
				});

				var input = document.getElementById("p2");
				var text = document.getElementById("text");
				input.addEventListener("keyup", function(event) {

					if (event.getModifierState("CapsLock")) {
    					text.style.display = "block";
 				    } else {
    					text.style.display = "none"
  					}
				});
			</script>
			<input type="submit" class="btn btn2" name="submit" value="<?php echo $lang['reg']?>">
		</form>
		<a href="login.php"><?php echo $lang['regalready']?></a>
	</div>
</body>
</html>
<?php

	session_start();

 if(isset($_POST['submit'])) {

 		$name = $_POST['name'];

	$email = $_POST['email'];

	$pass = $_POST['pass'];

	$cpass = $_POST['confpass'];


	$query = "SELECT * FROM users WHERE UserName = '$name'";

	$result = mysqli_query($conn, $query);

	$num = mysqli_num_rows($result);

	if ($num == 1) {
		echo '<script>alert("Ez a név már használatban van! Kérem adjon meg egy másikat!")</script>'; 
	}else if ($pass != $cpass) {
		echo '<script>alert("A megadott két jelszó nem egyezik")</script>'; 
	}else {
		$reg = "INSERT INTO users(UserName, UserPassword, UserEmail) VALUES ('$name','$pass','$email')";
		mysqli_query($conn, $reg);
        echo '<script>alert("Sikeresen regisztrált! Mostantól be tud lépni!")</script>';
        echo '<script>window.location="../Controller/login.php"</script>';



        		$to = $email;
	$subject = "Üdvözöljük áruházunkban!";
	$message = "<p>Ön sikeresen regisztrált ekkor: " . date("j M Y H:i:s") . "</p>";
	$from = "resotamas011211@gmail.com";
	$headers = "From: $from";
	mail($to,$subject,$message,$headers);

	}
}


?>