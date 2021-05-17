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
	<title><?php echo $lang['ratebtn']?></title>
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
hr {
	width: 300px;
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
					<option value="../View/aboutus.php?lang=hu"><?php echo $lang['hun']?></option>
					<option value="../View/aboutus.php?lang=en"><?php echo $lang['eng']?></option>
					<option value="../View/aboutus.php?lang=de"><?php echo $lang['ger']?></option>
				</select>
			</span>
	</div>
	<div class="content">
		<h5><?php echo $lang['rate']?></h5>
			<hr>
		<form action="" method="POST">
			<?php echo $lang['15']?>
			<select class="sel" name="rate" id="rate" onchange="fetch_select(this.value);">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
			</select><br><br>
			<textarea name="feedback" cols="60" rows="8" placeholder="<?php echo $lang['youropinion']?>"></textarea><br>
			<input type="submit" name="sbmt" class="btn btn2" value="<?php echo $lang['ratebtn']?>" />
		</form><br><br>
		<?php 

			if (isset($_POST['sbmt'])) {
				$rate = $_POST['rate'];
				$feedback = $_POST['feedback'];
				$date = date("Y-m-d H:i");

				$query = "INSERT INTO feedback (Rate, Opinion, CDate) VALUES('$rate', '$feedback', '$date')";
				$result = mysqli_query($conn, $query);

				if ($result) {
					echo "<script>alert('Köszönjük a visszajelzését!')</script>";
				}
			}
		?>
		<?php 

			$qry="SELECT SUM(Rate) AS sum FROM feedback";
			$res = mysqli_query($conn,$qry);

			$qry2="SELECT COUNT(Rate) AS count FROM feedback";
			$res2 = mysqli_query($conn,$qry2);
	
			while ($row = mysqli_fetch_assoc($res)) {
				$s = $row['sum'];
			}

			while ($row = mysqli_fetch_assoc($res2)) {
				$c = $row['count'];
			}
		?>
		<?php echo $lang['sumrate']?> <?php echo $c; ?> <?php echo $lang['rate2']?><br>
		<?php echo $lang['avrate']?> <?php echo $s/$c; ?><br><br><br>
		<h5><?php echo $lang['othersreview']?></h5>
			<hr>
		<table>
		<thead>
			<tr>
				<td>
					<h4><?php echo $lang['ratestar']?> &nbsp;&nbsp;&nbsp;&nbsp;</h4>
				</td>
				<td>
					<h4>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $lang['feedback']?> &nbsp;&nbsp;&nbsp;&nbsp;</h4>
				</td>
				<td>
					<h4>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $lang['date']?></h4>
				</td>
			</tr>
		</thead>
		<tbody>

	<?php 
		$qry3="SELECT * FROM feedback";
    	$res3=mysqli_query($conn,$qry3);

    	while ($row=mysqli_fetch_array($res3)) {
    		 echo "<tr>";
          echo "<td>";
          echo "<p align=center><h6 align=center>".$row['Rate']."</h6></p>";
          echo "</td>";
          echo "<td>";
          echo "<p align=center><h6 align=center>".$row['Opinion']."</h6></p>";
          echo "</td>";
          echo "<td>";
          echo "<p align=center><h6 align=center>".$row['CDate']."</h6></p>";
          echo "</td>";

    	}

	 ?>

</tbody>
</table>
	</div>
</body>
</html>