<?php require_once '../Model/dbConnection.php'; ?>
<?php 

 	session_start();

 	if(!isset($_SESSION['name'])) {
  		header("../Location:Controller/login.php");
 	}

	if(isset($_POST["add"])) {
		if(isset($_SESSION["shopping_cart"])) {
			$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
			if(!in_array($_GET["id"], $item_array_id)) {
				$count = count($_SESSION["shopping_cart"]);
				$item_array = array('item_id' => $_GET["id"], 'item_name' => $_POST["hidden_name"], 'item_price' => $_POST["hidden_price"], 'item_quantity' => $_POST["quantity"]);
				$_SESSION["shopping_cart"][$count] = $item_array;
			}else {
				echo '<script>alert("Ezt a terméket már hozzáadta!")</script>';
			}
		}else {
			$item_array = array('item_id' => $_GET["id"], 'item_name' => $_POST["hidden_name"], 'item_price' =>	$_POST["hidden_price"], 'item_quantity' => $_POST["quantity"]);
			$_SESSION["shopping_cart"][0] = $item_array;
		}
	}

	if(isset($_GET["action"])) {
		if($_GET["action"] == "delete") {
			foreach($_SESSION["shopping_cart"] as $keys => $values) {
				if($values["item_id"] == $_GET["id"]) {
					unset($_SESSION["shopping_cart"][$keys]);
					echo '<script>alert("A terméket sikeresen eltávolította!")</script>';
					echo '<script>window.location="../Controller/cart.php"</script>';
				}
			}
		}
	}
 ?>
 <?php require_once '../Model/LanguageInc/language.php'; ?>
 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	<title><?php echo $lang['cart']?></title>
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
	height: 70px;
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
}
</style>
</head>
<body>
	<div class="header">
		<a href="../Controller/logout.php"><button class="btn btn3"><?php echo $lang['logout']?></button></a>
		<a href="../Controller/settings.php"><button class="btn btn3"><?php echo $lang['settings']?></button></a>
		<a href="../Controller/sendmsg.php"><button class="btn btn3"><?php echo $lang['sendmsg']?></button></a>
		<a href="../Controller/cart.php"><button class="btn btn3"><?php echo $lang['cart']?></button></a>
		<a href="../View/store.php"><button class="btn btn3"><?php echo $lang['products']?></button></a>
			<span class="right">
				<select class="sel" onchange="location = this.value;">
					<option><?php echo $lang['chooselang']?></option>>
					<option value="../Controller/cart.php?lang=hu"><?php echo $lang['hun']?></option>
					<option value="../Controller/cart.php?lang=en"><?php echo $lang['eng']?></option>
					<option value="../Controller/cart.php?lang=de"><?php echo $lang['ger']?></option>
				</select>
			</span>
	</div>
	<div class="content">
		<h3><?php echo $lang['cartdetails']?></h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Modell</th>
							<th>
								<?php echo $lang['qty']?>
							</th>
							<th>
								<?php echo $lang['priceqty']?>
							</th>
							<th colspan="2">
								<?php echo $lang['totalprice']?>
							</th>
						</tr>
					</thead>
					<?php
						if(!empty($_SESSION["shopping_cart"])) {
							$total = 0;
							foreach($_SESSION["shopping_cart"] as $keys => $values) {
					?>
					<tr>
						<td>
							<?php echo $values["item_name"]; ?>
						</td>
						<td>
							<?php echo $values["item_quantity"]; ?>	
						</td>
						<td>
							<?php echo $values["item_price"]; ?> HUF
						</td>
						<td>
							<?php echo $values["item_quantity"] * $values["item_price"];?> HUF
						</td>
						<td>
							<a href="../View/store.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="red"><?php echo $lang['remove']?></span></a>
						</td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right"><?php echo $lang['total']?></td>
						<td align="right"><?php echo $total; ?> HUF</td>
						<td><a href="checkout.php"><?php echo $lang['checkout']?></a></td>
					</tr>
					<?php
					}else {
						echo " $lang[empty] <br>";
					}
					?>
						
				</table>
			</div>
	</div>
</body>
</html>