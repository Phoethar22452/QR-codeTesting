
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sample QR Data Center</title>
<!-- 	<link rel="icon" href="demo_icon.gif" type="image/gif" sizes="16x16">
 -->	
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	
</head>
<body>
	<?php 
	ob_start();
	require_once 'phpqrcode/qrlib.php';
	include_once 'db.php';
 ?>
 	

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form action="index.php" method="post">
					<h1 class="text-center text-info">Delivery Item Adding Form</h1>
					<h1 class="text-center text-info"><a href="show_data.php" class="btn btn-info">Data Table</a></h1>
					<div class="form-group input-group-lg mb-3">
	  					<span class="input-group-text" >Online Shop Name</span>
	  					<input type="text" class="form-control" id="online_shop_name" name="online_shop_name">
					</div>
					<div class="form-group input-group-lg mb-3">
	  					<span class="input-group-text" >Customer Name</span>
	  					<input type="text" class="form-control"  id="customer_name" name="customer_name">
					</div>
					<div class="form-group input-group-lg mb-3">
	  					<span class="input-group-text" >Customer Phone Number</span>
	  					<input type="text" class="form-control" id="customer_phone" name="customer_phone">
					</div>
					<div class="form-group input-group-lg mb-3">
	  					<span class="input-group-text" >Customer Address</span>
	  					<input type="text" class="form-control"  id="customer_address" name="customer_address">
					</div>
					<div class="form-group input-group-lg mb-3">
	  					<span class="input-group-text">Deliver Date</span>
	  					<input type="date" class="form-control"  id="deli_date" name="deli_date">
					</div>
					<div class=" mb-3">
						<input type="submit" class="btn btn-primary mb-3" value="Add Item" name="add_item">
  					</div>
				</form>
			</div>
		</div>
	</div>
	<?php 
	
	if(isset($_POST['add_item']))
	{
		$online_shop_name = mysqli_real_escape_string($connect,$_POST['online_shop_name']);
		$customer_name = mysqli_real_escape_string($connect,$_POST['customer_name']);
		$customer_phone = mysqli_real_escape_string($connect,$_POST['customer_phone']);
		$customer_address = mysqli_real_escape_string($connect,$_POST['customer_address']);
		$deli_date = mysqli_real_escape_string($connect,$_POST['deli_date']);
		$deli_data = array('customer_name'=>$customer_name,'customer_phone'=>$customer_phone,'customer_address'=>$customer_address);
			$deli_data = json_encode($deli_data);
			// locallost/qrtesting/role=deli&qrcode={name}
			$text = $deli_data;
			$path = 'images/';
			$name = uniqid().".png";
			$file = $path . $name;
			//Text to output
			//$text = "hello world";
			QRcode::png($text,$file,'L',4);
		$query = "INSERT INTO `posts`(`online_shop_name`, `customer_name`, `customer_phone`, `customer_address`, `deli_date`,`qr_code`) VALUES (
		'$online_shop_name','$customer_name','$customer_phone','$customer_address','$deli_date','$name')";
		$result = mysqli_query($connect,$query);
		if(!$result){
			die("failed".mysqli_error($connect));
		}
		if($result){
			
		    //-------Already make qr photo and showing is no need
			    //sight /size / frame
				//echo "<center><img src='".$file."' alt='image not available'></center>" ;
				//echo "<br>";
				//echo "<center><a class='btn btn-outline-success' href='download.php?file={$name}'>Download The QR Code</a></center>";
				//------------------END
			echo "<center><img src='".$file."' alt='image not available'></center>" ;
			echo "<br>";
			echo "<center><a class='btn btn-outline-success' href='download.php?file={$name}'>Download The QR Code</a></center>";
			}
		}
 ?>
</body>
</html>
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->