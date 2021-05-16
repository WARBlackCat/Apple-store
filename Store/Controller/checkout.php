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
	<title><?php echo $lang['shipping']?></title>
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
.hidden {
	display: none;
}
p {
	text-align: justify;
}
</style>
</head>
<body>
	<?php 

		if (isset($_POST['sbmt'])) {
			$prod = $_POST['prod'];
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$country = $_POST['country'];
			$street = $_POST['street'];
			$city = $_POST['city'];
			$zip = $_POST['zip'];
			$bstreet = $_POST['bstreet'];
			$bcity = $_POST['bcity'];
			$bzip = $_POST['bzip'];
			$payment = $_POST['payment'];
			$buyer = $_POST['buyer'];

			$query = "INSERT INTO shipping (Buyer, Product, FirstName, LastName, Email, Phone, Country, Address, City, Zip, Payment, Baddress, Bcity, Bzip) VALUES('$buyer', '$prod', '$fname', '$lname', '$email', '$phone', '$country', '$street', '$city', '$zip', '$payment', '$bstreet', '$bcity', '$bzip')";
			$result = mysqli_query($conn, $query);
			header('Location: ../View/payment.php');
			if (!$result) {
					echo "<script>Hiba</script>";
				}
		}

	 ?>
	<div class="header">
		<a href="../Controller/logout.php"><button class="btn btn3"><?php echo $lang['logout']?></button></a>
		<a href=""><button class="btn btn3"><?php echo $lang['settings']?></button></a>
		<a href="../Controller/sendmsg.php"><button class="btn btn3"><?php echo $lang['sendmsg']?></button></a>
		<a href="../Controller/cart.php"><button class="btn btn3"><?php echo $lang['cart']?></button></a>
		<a href="../View/store.php"><button class="btn btn3"><?php echo $lang['products']?></button></a>
			<span class="right">
				<select class="sel" onchange="location = this.value;">
					<option><?php echo $lang['chooselang']?></option>>
					<option value="../Controller/checkout.php?lang=hu"><?php echo $lang['hun']?></option>
					<option value="../Controller/checkout.php?lang=en"><?php echo $lang['eng']?></option>
					<option value="../Controller/checkout.php?lang=de"><?php echo $lang['ger']?></option>
				</select>
			</span>
	</div>
	<div class="content">
		<h3><?php echo $lang['shipping']?></h3>
			<form action="" method="POST">
			<?php

				if(!empty($_SESSION["shopping_cart"])) {
					$total = 0;
					echo $lang['products'].": <br>";
						foreach($_SESSION["shopping_cart"] as $keys => $values) {
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
							echo $values["item_name"]."&nbsp;";
							echo $values["item_quantity"]."&nbsp";
							echo $lang['piece'];
							echo "&nbsp;";
							echo "<br>";
						}
					echo "<p><strong>".$lang['total']."&nbsp;";
					echo $total." HUF </strong></p>";
				}
			?>

			<?php

				$name= $_SESSION['name'];
   
     			$query="SELECT * FROM users WHERE UserName='$name'";
     			$result=mysqli_query($conn,$query);
     			$row = mysqli_fetch_array($result);

     		 ?>
     		 	<input type="hidden" name="buyer" value="<?php echo $name ?>">
				<textarea class="hidden" name="prod"><?php foreach($_SESSION["shopping_cart"] as $keys => $values) { 
				echo $values['item_name']."&nbsp;";
				echo $values['item_quantity']." x ";
	 			} ?></textarea><br>
	 			<?php echo $lang['fname']?> <br>
	 			<input type="text" name="fname" required /><br>
	 			<?php echo $lang['lname']?> <br>
	 			<input type="text" name="lname" required /><br>
	 			<?php echo $lang['email']?> <br>
	 			<input type="email" name="email" required /><br>
	 			<?php echo $lang['phone']?> <br>
	 			<input type="tel" name="phone" minlength="7" maxlength="15" required /><br>
	 			<?php echo $lang['delivery']?> <br>
	 			<input type="text" name="country" list="c" required />
	 			<datalist id="c" onchange="fetch_select(this.value);">
			 		<option><?php echo $lang['us']?></option>
				    <option><?php echo $lang['ca']?></option>
				    <option><?php echo $lang['uk']?></option>
				    <option><?php echo $lang['de']?></option>
				    <option><?php echo $lang['hu']?></option>
				    <option><?php echo $lang['af']?></option>
				    <option><?php echo $lang['al']?></option>
				    <option><?php echo $lang['dz']?></option>
				    <option><?php echo $lang['ad']?></option>
				    <option><?php echo $lang['ao']?></option>
				    <option><?php echo $lang['ag']?></option>
				    <option><?php echo $lang['ar']?></option>
				    <option><?php echo $lang['am']?></option>
				    <option><?php echo $lang['au']?></option>
				    <option><?php echo $lang['at']?></option>
				    <option><?php echo $lang['az']?></option>
				    <option><?php echo $lang['bs']?></option>
				    <option><?php echo $lang['bh']?></option>
				    <option><?php echo $lang['bd']?></option>
				    <option><?php echo $lang['bb']?></option>
				    <option><?php echo $lang['by']?></option>
				    <option><?php echo $lang['be']?></option>
				    <option><?php echo $lang['bz']?></option>
				    <option><?php echo $lang['bj']?></option>
				    <option><?php echo $lang['bt']?></option>
				    <option><?php echo $lang['ba']?></option>
				    <option><?php echo $lang['bw']?></option>
				    <option><?php echo $lang['br']?></option>
				    <option><?php echo $lang['bn']?></option>
				    <option><?php echo $lang['bg']?></option>
				    <option><?php echo $lang['bf']?></option>
				    <option><?php echo $lang['bi']?></option>
				    <option><?php echo $lang['cv']?></option>
				    <option><?php echo $lang['kh']?></option>
				    <option><?php echo $lang['cm']?></option>
				    <option><?php echo $lang['cf']?></option>
				    <option><?php echo $lang['td']?></option>
				    <option><?php echo $lang['cl']?></option>
				    <option><?php echo $lang['cn']?></option>
				    <option><?php echo $lang['co']?></option>
				    <option><?php echo $lang['km']?></option>
				    <option><?php echo $lang['cg']?></option>
				    <option><?php echo $lang['ck']?></option>
				    <option><?php echo $lang['cr']?></option>
				    <option><?php echo $lang['hr']?></option>
				    <option><?php echo $lang['cu']?></option>
				    <option><?php echo $lang['cy']?></option>
				    <option><?php echo $lang['cz']?></option>
				    <option><?php echo $lang['dk']?></option>
				    <option><?php echo $lang['dm']?></option>
				    <option><?php echo $lang['ec']?></option>
				    <option><?php echo $lang['eg']?></option>
				    <option><?php echo $lang['sv']?></option>
				    <option><?php echo $lang['gq']?></option>
				    <option><?php echo $lang['er']?></option>
				    <option><?php echo $lang['ee']?></option>
				    <option><?php echo $lang['sz']?></option>
				    <option><?php echo $lang['et']?></option>
				    <option><?php echo $lang['fo']?></option>
				    <option><?php echo $lang['fj']?></option>
				    <option><?php echo $lang['fi']?></option>
				    <option><?php echo $lang['fr']?></option>
				    <option><?php echo $lang['ga']?></option>
				    <option><?php echo $lang['gm']?></option>
				    <option><?php echo $lang['ge']?></option>
				    <option><?php echo $lang['gh']?></option>
				    <option><?php echo $lang['gr']?></option>
				    <option><?php echo $lang['gd']?></option>
				    <option><?php echo $lang['gt']?></option>
				    <option><?php echo $lang['gn']?></option>
				    <option><?php echo $lang['gy']?></option>
				    <option><?php echo $lang['ht']?></option>
				    <option><?php echo $lang['hn']?></option>
				    <option><?php echo $lang['is']?></option>
				    <option><?php echo $lang['in']?></option>
				    <option><?php echo $lang['id']?></option>
				    <option><?php echo $lang['ir']?></option>
				    <option><?php echo $lang['us']?></option>
				    <option><?php echo $lang['iq']?></option>
				    <option><?php echo $lang['ie']?></option>
				    <option><?php echo $lang['il']?></option>
				    <option><?php echo $lang['it']?></option>
				    <option><?php echo $lang['jm']?></option>
				    <option><?php echo $lang['jp']?></option>
				    <option><?php echo $lang['jo']?></option>
				    <option><?php echo $lang['kz']?></option>
				    <option><?php echo $lang['ke']?></option>
				    <option><?php echo $lang['ki']?></option>
				    <option><?php echo $lang['kw']?></option>
				    <option><?php echo $lang['kg']?></option>
				    <option><?php echo $lang['lv']?></option>
				    <option><?php echo $lang['lb']?></option>
				    <option><?php echo $lang['ls']?></option>
				    <option><?php echo $lang['lr']?></option>
				    <option><?php echo $lang['ly']?></option>
				    <option><?php echo $lang['lt']?></option>
				    <option><?php echo $lang['lu']?></option>
				    <option><?php echo $lang['mg']?></option>
				    <option><?php echo $lang['mw']?></option>
				    <option><?php echo $lang['my']?></option>
				    <option><?php echo $lang['mv']?></option>
				    <option><?php echo $lang['ml']?></option>
				    <option><?php echo $lang['mt']?></option>
				    <option><?php echo $lang['mh']?></option>
				    <option><?php echo $lang['mr']?></option>
				    <option><?php echo $lang['mu']?></option>
				    <option><?php echo $lang['mx']?></option>
				    <option><?php echo $lang['fm']?></option>
				    <option><?php echo $lang['mc']?></option>
				    <option><?php echo $lang['mn']?></option>
				    <option><?php echo $lang['me']?></option>
				    <option><?php echo $lang['ma']?></option>
				    <option><?php echo $lang['mz']?></option>
				    <option><?php echo $lang['mm']?></option>
				    <option><?php echo $lang['na']?></option>
				    <option><?php echo $lang['nr']?></option>
				    <option><?php echo $lang['nl']?></option>
				    <option><?php echo $lang['nz']?></option>
				    <option><?php echo $lang['ni']?></option>
				    <option><?php echo $lang['ne']?></option>
				    <option><?php echo $lang['nu']?></option>
				    <option><?php echo $lang['no']?></option>
				    <option><?php echo $lang['om']?></option>
				    <option><?php echo $lang['pk']?></option>
				    <option><?php echo $lang['pw']?></option>
				    <option><?php echo $lang['pa']?></option>
				    <option><?php echo $lang['py']?></option>
				    <option><?php echo $lang['pe']?></option>
				    <option><?php echo $lang['ph']?></option>
				    <option><?php echo $lang['pl']?></option>
				    <option><?php echo $lang['pt']?></option>
				    <option><?php echo $lang['qa']?></option>
				    <option><?php echo $lang['kr']?></option>
				    <option><?php echo $lang['md']?></option>
				    <option><?php echo $lang['ro']?></option>
				    <option><?php echo $lang['ru']?></option>
				    <option><?php echo $lang['rw']?></option>
				    <option><?php echo $lang['kn']?></option>
				    <option><?php echo $lang['lc']?></option>
				    <option><?php echo $lang['vc']?></option>
				    <option><?php echo $lang['ws']?></option>
				    <option><?php echo $lang['sm']?></option>
				    <option><?php echo $lang['st']?></option>
				    <option><?php echo $lang['sa']?></option>
				    <option><?php echo $lang['sn']?></option>
				    <option><?php echo $lang['rs']?></option>
				    <option><?php echo $lang['sc']?></option>
				    <option><?php echo $lang['sl']?></option>
				    <option><?php echo $lang['sg']?></option>
				    <option><?php echo $lang['sk']?></option>
				    <option><?php echo $lang['si']?></option>
				    <option><?php echo $lang['sb']?></option>
				    <option><?php echo $lang['so']?></option>
				    <option><?php echo $lang['es']?></option>
				    <option><?php echo $lang['lk']?></option>
				    <option><?php echo $lang['sd']?></option>
				    <option><?php echo $lang['sr']?></option>
				    <option><?php echo $lang['se']?></option>
				    <option><?php echo $lang['ch']?></option>
				    <option><?php echo $lang['sy']?></option>
				    <option><?php echo $lang['tj']?></option>
				    <option><?php echo $lang['th']?></option>
				    <option><?php echo $lang['tl']?></option>
				    <option><?php echo $lang['tg']?></option>
				    <option><?php echo $lang['tk']?></option>
				    <option><?php echo $lang['to']?></option>
				    <option><?php echo $lang['tt']?></option>
				    <option><?php echo $lang['tn']?></option>
				    <option><?php echo $lang['tr']?></option>
				    <option><?php echo $lang['ug']?></option>
				    <option><?php echo $lang['ua']?></option>
				    <option><?php echo $lang['ae']?></option>
				    <option><?php echo $lang['tz']?></option>
				    <option><?php echo $lang['uy']?></option>
				    <option><?php echo $lang['uz']?></option>
				    <option><?php echo $lang['ve']?></option>
				    <option><?php echo $lang['vn']?></option>
				    <option><?php echo $lang['ye']?></option>
				    <option><?php echo $lang['zm']?></option>
				    <option><?php echo $lang['zw']?></option>
	 			</datalist><br>
	 			<?php echo $lang['street']?> <br>
	 			<input type="text" name="street" required /><br>
	 			<?php echo $lang['city']?> <br>
	 			<input type="text" name="city" required /><br>
	 			<?php echo $lang['zip']?> <br>
	 			<input type="number" name="zip" max="10000000" min="1000" required /><br><br>
	 			<h6><?php echo $lang['billinginfo'] ?></h6>
	 			<?php echo $lang['street']?> <br>
	 			<input type="text" name="bstreet" /><br>
	 			<?php echo $lang['city']?> <br>
	 			<input type="text" name="bcity" /><br>
	 			<?php echo $lang['zip']?> <br>
	 			<input type="number" name="bzip" max="10000000" min="1000" /><br><br>
	 			<h6><?php echo $lang['payment']?></h6>
	 			<p><input type="radio" name="payment" value="cash_on_delivery" required /> <strong><?php echo $lang['cod']?></strong> <?php echo $lang['cod2']?></p>
	 			<p><input type="radio" name="payment" value="advance_payment" required /> <strong><?php echo $lang['ap']?></strong> <?php echo $lang['ap2']?></p>
	 			<p><input type="radio" name="payment" value="cash" required /> <strong><?php echo $lang['cash']?></strong> <?php echo $lang['cash2']?></p>
	 			<input class="btn btn-default btn2" type="submit" name="sbmt" value="<?php echo $lang['next'] ?>" />
	 		</form>
	</div>
</body>
</html>