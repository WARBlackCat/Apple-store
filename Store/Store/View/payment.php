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
				echo "<script>alert('".$lang['alert4']."')</script>";
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
					echo "<script>alert('".$lang['alert5']."')</script>";
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
	<title><?php echo $lang['bill']?></title>
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
.hidden {
	display: none;
}
</style>
</head>
<body>
	<div class="header">
		<a href="../Controller/logout.php"><button class="btn btn3"><?php echo $lang['logout']?></button></a>
		<a href=""><button class="btn btn3"><?php echo $lang['settings']?></button></a>
		<a href="../Controller/sendmsg.php"><button class="btn btn3"><?php echo $lang['sendmsg']?></button></a>
		<a href="../Controller/cart.php"><button class="btn btn3"><?php echo $lang['cart']?></button></a>
		<a href="../View/store.php"><button class="btn btn3"><?php echo $lang['products']?></button></a>
			<span class="right">
				<select class="sel" onchange="location = this.value;">
					<option><?php echo $lang['chooselang']?></option>>
					<option value="../View/payment.php?lang=hu"><?php echo $lang['hun']?></option>
					<option value="../View/payment.php?lang=en"><?php echo $lang['eng']?></option>
					<option value="../View/payment.php?lang=de"><?php echo $lang['ger']?></option>
				</select>
			</span>
	</div>
	<div class="content">
		<?php

			if(!empty($_SESSION["shopping_cart"])) {
				$total = 0;
					foreach($_SESSION["shopping_cart"] as $keys => $values) {
						$total = $total + ($values["item_quantity"] * $values["item_price"]);
					}
				echo "<strong>".$lang['payable']." </strong>";
				echo $total." HUF";
				}

			$name= $_SESSION['name'];
   
     		$query="SELECT * FROM shipping WHERE Buyer='$name'";
     		$result=mysqli_query($conn,$query);
        
        	$row = mysqli_fetch_array($result);


        	echo "<br><br>";
        	echo $lang['ordernum'];
        	echo $row['ID'];
        	echo "<br>";
        	echo $lang['prodname'];
        	echo $row['Product'];
        	echo "<br>";
        	echo $lang['name2'];
        	echo $row['FirstName']." ".$row['LastName'];
        	echo "<br>";
        	echo $lang['emailadd'];
        	echo $row['Email'];
        	echo "<br>";
        	echo $lang['phonenum'];
        	echo $row['Phone'];
        	echo "<br>";
        	echo $lang['deliverycountry'];
        	echo $row['Country'];
        	echo "<br>";
        	echo $lang['streetaddress'];
        	echo $row['Address'];
        	echo "<br>";
        	echo $lang['city2'];
        	echo $row['City'];
        	echo "<br>";
        	echo $lang['zip2'];
        	echo $row['Zip'];
        	echo "<br>";
        	echo $lang['paymeth'];
        	echo $row['Payment'];

		?>

		<br>
		<a href="../View/store.php"><button class="btn btn2">OK</button></a>

		<!-- 
			https://stackoverflow.com/questions/13685263/can-i-save-input-from-form-to-txt-in-html-using-javascript-jquery-and-then-us
		-->
		<script type="text/javascript">
			function download(filename, text) {
  				var pom = document.createElement('a');
  				pom.setAttribute('href', 'data:text/plain;charset=utf-8,' + 

				encodeURIComponent(text));
  				pom.setAttribute('download', filename);

  				pom.style.display = 'none';
  				document.body.appendChild(pom);

  				pom.click();

  				document.body.removeChild(pom);
		}

			function addTextTXT() {
    			document.addtext.name.value = document.addtext.name.value + ".txt"
			}	
		</script>
		<br><br>
		    <form name="addtext" onsubmit="download(this['name'].value, this['text'].value)">
		    	<h5><?php echo $lang['down']?></h5>

    <textarea class="hidden" rows="10" cols="90" name="text"><?php
    		$date = date("Y-m-d H:i"); 
    		echo $lang['ordernum'];
        	echo $row['ID']."\n";
        	echo $lang['prodname'];
        	echo $row['Product']."\n";
        	echo $lang['name2'];
        	echo $row['FirstName']." ".$row['LastName']."\n";
        	echo $lang['emailadd'];
        	echo $row['Email']."\n";
        	echo $lang['phonenum'];
        	echo $row['Phone']."\n";
        	echo $lang['deliverycountry'];
        	echo $row['Country']."\n";
        	echo $lang['streetaddress'];
        	echo $row['Address']."\n";
        	echo $lang['city2'];
        	echo $row['City']."\n";
        	echo $lang['zip2'];
        	echo $row['Zip']."\n";
        	echo $lang['paymeth'];
        	echo $row['Payment']."\n";
        	echo $lang['pdate'].": ";
        	echo $date;
        	?></textarea>
    
    <input type="text" name="name" value="bill" required />.txt <br>
    <input type="submit" class="btn btn2" onClick="addTexttxt();" value="<?php echo $lang['download']?>" />

    </form>

	</div>
</body>
</html>