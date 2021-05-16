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
			$item_array = array('item_id' => $_GET["id"], 'item_name' => $_POST["hidden_name"], 'item_price' => $_POST["hidden_price"], 'item_quantity' => $_POST["quantity"]);
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
	<title><?php echo $lang['store']?></title>
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
	border: 2px solid black;
}
.tab tbody tr:nth-child(odd) {
    background-color: #e4e4e4;
}

.tab tbody tr:nth-child(even) {
    background-color: #d4d4d4;
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
					<option value="../View/store.php?lang=hu"><?php echo $lang['hun']?></option>
					<option value="../View/store.php?lang=en"><?php echo $lang['eng']?></option>
					<option value="../View/store.php?lang=de"><?php echo $lang['ger']?></option>
				</select>
			</span>
	</div>
	<div class="content">
		<?php
    
    		$name= $_SESSION['name'];
   
     		$query="SELECT * FROM users WHERE UserName='$name'";
     		$result=mysqli_query($conn,$query);
        
        	$row = mysqli_fetch_array($result);
				echo "<h3 class='h'> $lang[welcome] ".$row['UserName']."!</h3>"
		?>

		<h2><?php echo $lang['appleprod']?></h2>
		<table>
			<tr>
				<td>
					<a href="#7">iPhone 7 &nbsp;&nbsp;</a>
				</td>
				<td>
					<a href="#8">iPhone 8 &nbsp;&nbsp;</a>
				</td>
				<td>
					<a href="#se2">iPhone SE 2 &nbsp;&nbsp;</a>
				</td>
				<td>
					<a href="#xs">iPhone XS &nbsp;&nbsp;</a>
				</td>
				<td>
					<a href="#xr">iPhone XR &nbsp;&nbsp;</a>
				</td>
				<td>
					<a href="#11">iPhone 11 &nbsp;&nbsp;</a>
				</td>
			</tr>
			<tr>
				<td>
					<a href="">tab1</a>
				</td>
				<td>
					<a href="">tab2</a>
				</td>
			</tr>
		</table>
		<br>
			<h4><a name="7">iPhone 7</a></h4>
				<table class="tab">
					<thead>
						<tr>
							<th>
								<?php echo $lang['image']?>
							</th>
							<th>
								Modell
							</th>
							<th>
								<?php echo $lang['price']?>
							</th>
							<th colspan="2">
								<?php echo $lang['qty']?>
							</th>
						</tr>
					</thead>
					<tbody>
					<?php

						$query = "SELECT * FROM products WHERE name LIKE '%iPhone 7%'";
						$result = mysqli_query($conn, $query);
							if(mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_array($result)) {
					?>
					<form action="../View/store.php?action=add&id=<?php echo $row["ID"]; ?>" method="POST">
						<tr>
							<td>
								<a target="_blank" href="../Model/Images/<?php echo $row["Image"]; ?>"><img onmouseover="opImg(this)" onmouseout="Img(this)" src="../Model/Images/<?php echo $row["Image"]; ?>" /></a>
							</td>
							<td>
								<p><?php echo $row["Name"]; ?></p>
							</td>
							<td>
								<p><?php echo $row["Price"]; ?> HUF</p>
							</td>
							<td>
								<input type="number" name="quantity" value="1" maxlength="1" max="9" min="1" />
							</td>
								<input type="hidden" name="hidden_name" value="<?php echo $row["Name"]; ?>" />
								<input type="hidden" name="hidden_price" value="<?php echo $row["Price"]; ?>" />
							<td>
								<input type="submit" name="add" class="btn btn-default" value="<?php echo $lang['addtocart']?>" />
							</td>
						</tr>
					</form>
			
					<?php
								}
							}
					?>
					</tbody>
				</table>
		<br><br>
			<h4><a name="8">iPhone 8</a></h4>
				<table class="tab">
					<thead>
						<tr>
							<th>
								<?php echo $lang['image']?>
							</th>
							<th>
								Modell
							</th>
							<th>
								<?php echo $lang['price']?>
							</th>
							<th colspan="2">
								<?php echo $lang['qty']?>
							</th>
						</tr>
					</thead>
					<tbody>
					<?php
						
						$query = "SELECT * FROM products WHERE name LIKE '%iPhone 8%'";
						$result = mysqli_query($conn, $query);
							if(mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_array($result)) {
					?>
					<form action="../View/store.php?action=add&id=<?php echo $row["ID"]; ?>" method="POST">
						<tr>
							<td>
								<a target="_blank" href="../Model/Images/<?php echo $row["Image"]; ?>"><img onmouseover="opImg(this)" onmouseout="Img(this)" src="../Model/Images/<?php echo $row["Image"]; ?>" /></a>
							</td>
							<td>
								<p><?php echo $row["Name"]; ?></p>
							</td>
							<td>
								<p><?php echo $row["Price"]; ?> HUF</p>
							</td>
							<td>
								<input type="number" name="quantity" maxlength="1" max="9" min="1" value="1" />
							</td>
								<input type="hidden" name="hidden_name" value="<?php echo $row["Name"]; ?>" />
								<input type="hidden" name="hidden_price" value="<?php echo $row["Price"]; ?>" />
							<td>
								<input type="submit" name="add" class="btn btn-default" value="<?php echo $lang['addtocart']?>" />
							</td>
						</tr>
					</form>
			
					<?php
							}
						}
					?>
					</tbody>
				</table>
		<br><br>
			<h4><a name="se2">iPhone SE 2</a></h4>
				<table class="tab">
					<thead>
						<tr>
							<th>
								<?php echo $lang['image']?>
							</th>
							<th>
								Modell
							</th>
							<th>
								<?php echo $lang['price']?>
							</th>
							<th colspan="2">
								<?php echo $lang['qty']?>
							</th>
						</tr>
					</thead>
					<tbody>
					<?php

						$query = "SELECT * FROM products WHERE name LIKE '%iPhone SE%'";
						$result = mysqli_query($conn, $query);
							if(mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_array($result)) {
					?>
					<form action="../View/store.php?action=add&id=<?php echo $row["ID"]; ?>" method="POST">
						<tr>
							<td>
								<a target="_blank" href="../Model/Images/<?php echo $row["Image"]; ?>"><img onmouseover="opImg(this)" onmouseout="Img(this)" src="../Model/Images/<?php echo $row["Image"]; ?>" /></a>
							</td>
							<td>
								<p><?php echo $row["Name"]; ?></p>
							</td>
							<td>
								<p><?php echo $row["Price"]; ?> HUF</p>
							</td>
							<td>
								<input type="number" name="quantity" maxlength="1" max="9" min="1" value="1" />
							</td>
								<input type="hidden" name="hidden_name" value="<?php echo $row["Name"]; ?>" />
								<input type="hidden" name="hidden_price" value="<?php echo $row["Price"]; ?>" />
							<td>
								<input type="submit" name="add" class="btn btn-default" value="<?php echo $lang['addtocart']?>" />
							</td>
						</tr>
					</form>

					<?php
							}
						}
					?>
					</tbody>
				</table>
				<br><br>
				<h4><a name="xs">iPhone XS</a></h4>
				<table class="tab">
					<thead>
						<tr>
							<th>
								<?php echo $lang['image']?>
							</th>
							<th>
								Modell
							</th>
							<th>
								<?php echo $lang['price']?>
							</th>
							<th colspan="2">
								<?php echo $lang['qty']?>
							</th>
						</tr>
					</thead>
					<tbody>
					<?php

						$query = "SELECT * FROM products WHERE name LIKE '%iPhone XS%'";
						$result = mysqli_query($conn, $query);
							if(mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_array($result)) {
					?>
					<form action="../View/store.php?action=add&id=<?php echo $row["ID"]; ?>" method="POST">
						<tr>
							<td>
								<a target="_blank" href="../Model/Images/<?php echo $row["Image"]; ?>"><img onmouseover="opImg(this)" onmouseout="Img(this)" src="../Model/Images/<?php echo $row["Image"]; ?>" /></a>
							</td>
							<td>
								<p><?php echo $row["Name"]; ?></p>
							</td>
							<td>
								<p><?php echo $row["Price"]; ?> HUF</p>
							</td>
							<td>
								<input type="number" name="quantity" value="1" maxlength="1" max="9" min="1" />
							</td>
								<input type="hidden" name="hidden_name" value="<?php echo $row["Name"]; ?>" />
								<input type="hidden" name="hidden_price" value="<?php echo $row["Price"]; ?>" />
							<td>
								<input type="submit" name="add" class="btn btn-default" value="<?php echo $lang['addtocart']?>" />
							</td>
						</tr>
					</form>
			
					<?php
								}
							}
					?>
					</tbody>
				</table>
				<br><br>
				<h4><a name="xr">iPhone XR</a></h4>
				<table class="tab">
					<thead>
						<tr>
							<th>
								<?php echo $lang['image']?>
							</th>
							<th>
								Modell
							</th>
							<th>
								<?php echo $lang['price']?>
							</th>
							<th colspan="2">
								<?php echo $lang['qty']?>
							</th>
						</tr>
					</thead>
					<tbody>
					<?php

						$query = "SELECT * FROM products WHERE name LIKE '%iPhone XR%'";
						$result = mysqli_query($conn, $query);
							if(mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_array($result)) {
					?>
					<form action="../View/store.php?action=add&id=<?php echo $row["ID"]; ?>" method="POST">
						<tr>
							<td>
								<a target="_blank" href="../Model/Images/<?php echo $row["Image"]; ?>"><img onmouseover="opImg(this)" onmouseout="Img(this)" src="../Model/Images/<?php echo $row["Image"]; ?>" /></a>
							</td>
							<td>
								<p><?php echo $row["Name"]; ?></p>
							</td>
							<td>
								<p><?php echo $row["Price"]; ?> HUF</p>
							</td>
							<td>
								<input type="number" name="quantity" value="1" maxlength="1" max="9" min="1" />
							</td>
								<input type="hidden" name="hidden_name" value="<?php echo $row["Name"]; ?>" />
								<input type="hidden" name="hidden_price" value="<?php echo $row["Price"]; ?>" />
							<td>
								<input type="submit" name="add" class="btn btn-default" value="<?php echo $lang['addtocart']?>" />
							</td>
						</tr>
					</form>
			
					<?php
								}
							}
					?>
					</tbody>
				</table>
				<br><br>
				<h4><a name="11">iPhone 11</a></h4>
				<table class="tab">
					<thead>
						<tr>
							<th>
								<?php echo $lang['image']?>
							</th>
							<th>
								Modell
							</th>
							<th>
								<?php echo $lang['price']?>
							</th>
							<th colspan="2">
								<?php echo $lang['qty']?>
							</th>
						</tr>
					</thead>
					<tbody>
					<?php

						$query = "SELECT * FROM products WHERE name LIKE '%iPhone 11%'";
						$result = mysqli_query($conn, $query);
							if(mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_array($result)) {
					?>
					<form action="../View/store.php?action=add&id=<?php echo $row["ID"]; ?>" method="POST">
						<tr>
							<td>
								<a target="_blank" href="../Model/Images/<?php echo $row["Image"]; ?>"><img onmouseover="opImg(this)" onmouseout="Img(this)" src="../Model/Images/<?php echo $row["Image"]; ?>" /></a>
							</td>
							<td>
								<p><?php echo $row["Name"]; ?></p>
							</td>
							<td>
								<p><?php echo $row["Price"]; ?> HUF</p>
							</td>
							<td>
								<input type="number" name="quantity" value="1" maxlength="1" max="9" min="1" />
							</td>
								<input type="hidden" name="hidden_name" value="<?php echo $row["Name"]; ?>" />
								<input type="hidden" name="hidden_price" value="<?php echo $row["Price"]; ?>" />
							<td>
								<input type="submit" name="add" class="btn btn-default" value="<?php echo $lang['addtocart']?>" />
							</td>
						</tr>
					</form>
			
					<?php
								}
							}
					?>
					</tbody>
				</table>
	</div>
	<script type="text/javascript">
		function opImg(img) {
    		img.style.opacity = "0.7";
		}

		function Img(img) {
    		img.style.opacity = "1";
		}
	</script>
</body>
</html>