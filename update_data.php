
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
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
	 <?php  

	if(isset($_GET['update_id'])){
		$update_id = $_GET['update_id'];
		$show_query = "SELECT * FROM posts WHERE id=$update_id";
		$show_result = mysqli_query($connect,$show_query);
		$show_row=mysqli_fetch_assoc($show_result);

		if(isset($_POST['update_item'])){
			$qr_query = "SELECT * FROM posts WHERE id=$update_id";
			$qr_result = mysqli_query($connect,$qr_query);
			$qr_row = mysqli_fetch_assoc($qr_result);
			$qr_image = $qr_row['qr_code'];
			$path = 'images/';
			$qr_path=$path.$qr_image;
			if(file_exists($qr_path)){
				unlink($qr_path);
			}
			$online_shop_name = mysqli_real_escape_string($connect,$_POST['online_shop_name']);
			$customer_name = mysqli_real_escape_string($connect,$_POST['customer_name']);
			$customer_phone = mysqli_real_escape_string($connect,$_POST['customer_phone']);
			$customer_address = mysqli_real_escape_string($connect,$_POST['customer_address']);
			$deli_date = mysqli_real_escape_string($connect,$_POST['deli_date']);
			$deli_data = array('customer_name'=>$customer_name,'customer_phone'=>$customer_phone,'customer_address'=>$customer_address);
				$deli_data = json_encode($deli_data);
				$text = $deli_data;
				$path = 'images/';
				$name = uniqid().".png";
				$file = $path . $name;
				QRcode::png($text,$file,'L',10);
			$update_query = "UPDATE `posts` SET `online_shop_name`='$online_shop_name',`customer_name`='$customer_name',`customer_phone`='$customer_phone',`customer_address`='$customer_address',`deli_date`='$deli_date',`qr_code`='$name' WHERE id=$update_id";
			$update_result = mysqli_query($connect,$update_query);
			if(!$update_result){
				die("failed".mysqli_error($connect));
			}
			if($update_result){
				header('location:show_data.php');
				}
		}
	
?>
<?php } ?>
 <div class="container">
		<div class="row">
			<div class="col-md-12">
				<form action="" method="post">
					<h1 class="text-center text-success">Delivery Item Updating Form</h1>
					<form action="index.php" method="post">
					<div class="form-group input-group-lg mb-3">
	  					<span class="input-group-text" >Online Shop Name</span>
	  					<input type="text" class="form-control" id="online_shop_name" name="online_shop_name" value="<?php echo $show_row['online_shop_name']?>">
					</div>
					<div class="form-group input-group-lg mb-3">
	  					<span class="input-group-text" >Customer Name</span>
	  					<input type="text" class="form-control"  id="customer_name" name="customer_name" value="<?php echo $show_row['customer_name']?>">
					</div>
					<div class="form-group input-group-lg mb-3">
	  					<span class="input-group-text" >Customer Phone Number</span>
	  					<input type="text" class="form-control" id="customer_phone" name="customer_phone" value="<?php echo $show_row['customer_phone']?>">
					</div>
					<div class="form-group input-group-lg mb-3">
	  					<span class="input-group-text" >Customer Address</span>
	  					<input type="text" class="form-control"  id="customer_address" name="customer_address" value="<?php echo $show_row['customer_address']?>">
					</div>
					<div class="form-group input-group-lg mb-3">
	  					<span class="input-group-text">Deliver Date</span>
	  					<input type="date" class="form-control"  id="deli_date" name="deli_date" value="<?php echo $show_row['deli_date']?>">
					</div>
					<div class=" mb-3">
						<input type="submit" class="btn btn-success mb-3" value="Update Item" name="update_item">
  					</div>
				</form>
				</form>
			</div>
		</div>
	</div>
 <br><br><br>


</body>
</html>