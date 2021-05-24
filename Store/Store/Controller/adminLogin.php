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
	<title><?php echo $lang['login']?></title>
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
.btn4 {
	background-color: #ababab;
	float: left;
}
h3 {
	text-decoration: underline;
	color: #2a2a2a;
}
form {
	color: #2a2a2a;
	padding-bottom: 10px;
}
#text {
	display:none;
	color:red;
	padding-top: 10px;
}
a {
	color: #2a2a2a;
	font-weight: bold;
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
					<option value="../Controller/adminLogin.php?lang=hu"><?php echo $lang['hun']?></option>
					<option value="../Controller/adminLogin.php?lang=en"><?php echo $lang['eng']?></option>
					<option value="../Controller/adminLogin.php?lang=de"><?php echo $lang['ger']?></option>
				</select>
			</span>
	</div>
	<div class="content">
		<h3><?php echo $lang['adminlogin']?></h3><br>
		<form action="" method="POST">
			<div class="form-group">
    			<?php echo $lang['name']?>
    			<input type="text" class="form-control" name="aname" placeholder="<?php echo $lang['name']?>" />
  			</div>
  			<div class="form-group">
  				<?php echo $lang['pass']?>
    			<input type="password" class="form-control" name="apass" id="p" placeholder="<?php echo $lang['pass']?>" />
  			</div>
  			<p id="text"><?php echo $lang['alert']?></p>

			<script>
				var input = document.getElementById("p");
				var text = document.getElementById("text");
				input.addEventListener("keyup", function(event) {

					if (event.getModifierState("CapsLock")) {
    					text.style.display = "block";
  					}else {
    					text.style.display = "none"
  					}
				});
			</script>
				<input type="submit" class="btn btn2" name="submit" value="<?php echo $lang['login']?>">
		</form>
	</div>
</body>
</html>
<?php

	if(isset($_POST['submit'])) {

		$Aname = $_POST['aname'];

		$Apass = $_POST['apass'];

		$query = "SELECT * FROM admin WHERE AdminName = '$Aname' && AdminPassword = '$Apass'";

		$result = mysqli_query($conn, $query);

		$row=mysqli_fetch_array($result);
    
    	if($row['AdminName']==$Aname &&$row['AdminPassword']==$Apass) {
        	session_start();
        	$_SESSION['aname'] = $Aname;
        	$_SESSION['apass'] = $Apass;
        	header("Location: ../View/adminProfile.php");
     	}else {
      		echo "<script>alert('".$lang['alert3']."');</script>";
    	}  

	}
?>