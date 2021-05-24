<?php require_once '../Model/dbConnection.php'; ?>
<?php

	session_start(); 

		if (!isset($_SESSION['aname'])) {
			header('Location: ../Controller/adminLogin.php');
		}
	require_once '../Model/LanguageInc/language.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	<title><?php echo $lang['msgs']?></title>
<style type="text/css">
.content {
	position: relative;
	background-color: #fff;
	margin-top: auto;
	margin-left: auto;
	margin-bottom: 50px;
	margin-right: auto;
	border-bottom: 2px solid #2a2a2a;
	border-right: 2px solid #2a2a2a;
	border-left: 2px solid #2a2a2a;
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
	height: 110px;
	border: 2px solid #2a2a2a;
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
.center {
	text-align: center;
}
table {
	border: 1px solid black;
}
th {
	padding: 15px;
	text-align: center;
	font-weight: bold;
	border: 1px solid black;
}
td {
	padding: 15px;
	text-align: center;
	font-style: italic;	
	border: 1px solid black;
	border-bottom: 1.5px solid black;
}
thead tr {
	border: 2px solid black;
	background: #ababab;
}
tr {
	border: 1px solid black;
}
tbody tr:nth-child(odd) {
    background-color: #e4e4e4;
}

tbody tr:nth-child(even) {
    background-color: #d4d4d4;
}
.red {
	color: red;
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
	margin-right: 2px;
}
.hidden {
	display: none;
}
p {
	text-align: justify;
}
.top {
	margin-top: 10px;
}
.top2 {
	margin-top: 8px;
}
.img {
	height: 100px;
	width: 60px;
}
</style>
</head>
<body>
	<div class="header">
		<a href="../Controller/logout.php"><button class="btn btn3"><?php echo $lang['logout']?></button></a>
		<a href="../Controller/deleteUsers.php"><button class="btn btn3"><?php echo $lang['deluser']?></button></a>
		<a href="../View/messages.php"><button class="btn btn3"><?php echo $lang['msgs']?></button></a>
		<a href="../Controller/feedback.php"><button class="btn btn3"><?php echo $lang['feed']?></button></a>
		<select class="sel top2" onchange="location = this.value;">
					<option><?php echo $lang['chooselang']?></option>>
					<option value="../Controller/feedback.php?lang=hu"><?php echo $lang['hun']?></option>
					<option value="../Controller/feedback.php?lang=en"><?php echo $lang['eng']?></option>
					<option value="../Controller/feedback.php?lang=de"><?php echo $lang['ger']?></option>
				</select><br>
		<a href="../Controller/addProduct.php"><button class="btn btn3 top"><?php echo $lang['addprod']?></button></a>
		<a href="../Controller/deleteProducts.php"><button class="btn btn3 top"><?php echo $lang['delprod']?></button></a>		
	</div>
	<div class="content">
		<h5><?php echo $lang['feed']; ?></h5>
		<table>
			<thead>
				<tr>
					<td>
						<?php echo $lang['ratestar']?>
					</td>
					<td>
						<?php echo $lang['feedback']?>
					</td>
					<td>
						<?php echo $lang['date']?>
					</td>
				</tr>
			</thead>
			<thead>
				<?php 

					$query="SELECT * FROM feedback";
    				$result=mysqli_query($conn,$query);

    					while ($row=mysqli_fetch_array($result)) {
    		 				echo "<tr>";
					        echo "<td>";
					        echo $row['Rate'];
					        echo "</td>";
					        echo "<td>";
					        echo $row['Opinion'];
					        echo "</td>";
					        echo "<td>";
					        echo $row['CDate'];
					        echo "</td>";

    					}
				 ?>
			</thead>
		</table>
	</div>
</body>
</html>