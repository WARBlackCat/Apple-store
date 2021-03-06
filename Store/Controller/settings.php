<?php require_once '../Model/dbConnection.php';
	session_start();

	if(!isset($_SESSION['name'])) {
 		header("../Location:Controller/login.php");
	}
 ?>
<?php require_once '../Model/LanguageInc/language.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	<title><?php echo $lang['settings']?></title>
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
.h {
	text-decoration: underline;
	color: #2a2a2a;
	text-align: center;
	padding-bottom: 40px;
}
form {
	color: #2a2a2a;
	padding-bottom: 2px;
}
#text {
	display:none;
	color:red;
	padding-top: 10px;
}
a {
	color: #2a2a2a;
	text-decoration: none;
	padding-top: 10px;
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
.center {
	text-align: center;
}
.tab {
	border: 1px solid gray;
}
.tab th {
	padding: 15px;
	text-align: center;
	font-weight: bold;
	border: 1px solid black;
}
.tab td {
	padding: 15px;
	text-align: center;
	font-style: italic;	
	border: 1px solid black;
}
.tab tr {
	background: #ababab;
}
.tab tbody tr:nth-child(odd) {
    background: #e4e4e4;
}

.tab tbody tr:nth-child(even) {
    background: #d4d4d4;
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
img {
	height: 100px;
	width: 60px;
}
.red {
	color: red;
}
.red:hover {
	color: red;
}
</style>
</head>
<body>
	<?php
    
    	$name= $_SESSION['name'];
   
     	$query="SELECT * FROM users WHERE UserName='$name'";
     	$result=mysqli_query($conn,$query);
        
        $row = mysqli_fetch_array($result);

        $username = $row['UserName'];
        $email = $row['UserEmail'];

	?>
	<div class="header">
		<a href="../Controller/logout.php"><button class="btn btn3"><?php echo $lang['logout']?></button></a>
		<a href="../Controller/settings.php"><button class="btn btn3"><?php echo $lang['settings']?></button></a>
		<a href="../Controller/sendmsg.php"><button class="btn btn3"><?php echo $lang['sendmsg']?></button></a>
		<a href="../Controller/cart.php"><button class="btn btn3"><?php echo $lang['cart']?></button></a>
		<a href="../View/store.php"><button class="btn btn3"><?php echo $lang['products']?></button></a>
			<span class="right">
				<select class="sel" onchange="location = this.value;">
					<option><?php echo $lang['chooselang']?></option>>
					<option value="../Controller/settings.php?lang=hu"><?php echo $lang['hun']?></option>
					<option value="../Controller/settings.php?lang=en"><?php echo $lang['eng']?></option>
					<option value="../Controller/settings.php?lang=de"><?php echo $lang['ger']?></option>
				</select>
			</span>
	</div>
	<div class="content">
		<h5><?php echo $lang['dataedit']?></h5>
		<form action="" method="POST">
			<?php echo $lang['email']?>:<br>
			<input type="email" name="email" value="<?php echo $email ?> " /><br>
			<?php echo $lang['pass']?>:<br>
			<input type="password" name="pass" placeholder="<?php echo $lang['ppass']?>" /> <br>
			<?php echo $lang['cpass']?>:<br>
			<input type="password" name="cpass" placeholder="<?php echo $lang['ppass']?>" /> <br>
			<input type="submit" class="btn btn2" name="sbmt" value="<?php echo $lang['edit']?>">
		</form>
		<?php 

			if (isset($_POST['sbmt'])) {
				$name= $_SESSION['name'];

				$email = $_POST['email'];
				$pass = $_POST['pass'];
				$cpass = $_POST['cpass'];

				if ($pass != $cpass) {
					echo "<script>alert('A megadott jelszavak nem egyeznek!')</script>";
				}else {
					$query = "UPDATE users SET UserEmail='$email', UserPassword='$pass' WHERE UserName='$name'";
					mysqli_query($conn,$query);
					echo "<script>alert('Adatok sikeresen friss??tve!')</script>";
				}
			}

		?>
		<br><br>
		<form action="" method="POST">
		 	<span class="red"><h5><?php echo $lang['adel']?></h5></span>
		 	<small><?php echo $lang['small']?></small><br>
		 	<input type="submit" class="btn btn2 red" name="sbmt2" value="<?php echo $lang['del']?>">
		</form>
		<?php 

			if (isset($_POST['sbmt2'])) {
				$name= $_SESSION['name'];

				$qry = "DELETE FROM users WHERE UserName='$name'";
				mysqli_query($conn,$qry);
				echo '<script>confirm("Biztos, hogy t??rli fi??kj??t? K????bb ez a m??velet nem ??ll??that?? vissza!")</script>';
        		echo '<script>window.location="../Controller/login.php"</script>';
			}

		 ?>
	</div>
</body>
</html>