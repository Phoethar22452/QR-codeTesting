<?php 

ob_start(); ?>
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
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center text-info">Data Table</h1>
				<h1 class="text-left text-info"><a href="index.php" class="btn btn-info">Add Data</a></h1>
				<table id="dtable" class="table table-bordered table-hover" >
					<thead>
						<tr>
						<th>No</th>
						<th>Online Shop Name</th>
						<th>Customer Name</th>
						<th>Customer Phone Number</th>
						<th>Customer Address</th>
						<th>Deliver Date</th>
						<th>QR CODE</th>
						<th>Status</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>
					</thead>
					<tbody>
						<?php 
						include_once('db.php');
						$no =0;
						$query = "SELECT * FROM posts";
						$result = mysqli_query($connect,$query);
						while($row = mysqli_fetch_assoc($result)){
					?>
					<tr>
						<td><?php echo ++$no; ?></td>
						<td><?php echo $row['online_shop_name']; ?></td>
						<td><?php echo $row['customer_name']; ?></td>
						<td><?php echo $row['customer_phone']; ?></td>
						<td><?php echo $row['customer_address']; ?></td>
						<td><?php echo $row['deli_date']; ?></td>
						<td><img src="images/<?php echo $row['qr_code'] ?>" alt="" width="100px" height="100px"></td>
							<?php 
								if($row['status']=='show'){
									echo "<td><a href='show_data.php?status_id={$row['id']}' class='btn btn-primary'>Hidden</a></td>";
								}else{
									echo "<td><a href='show_data.php?status_id={$row['id']}' class='btn btn-info'>Show</a></td>";
								}
							 ?>
						<td><a href="update_data.php?update_id=<?php echo $row['id']?>" class="btn btn-success">Update</a></td>
						<td><a href="show_data.php?delete_id=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
					</tr><?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php 
	if(isset($_GET['delete_id'])){
		$delete_id = $_GET['delete_id'];
		$qr_query = "SELECT * FROM posts WHERE id=$delete_id";
			$qr_result = mysqli_query($connect,$qr_query);
			$qr_row = mysqli_fetch_assoc($qr_result);
			$qr_image = $qr_row['qr_code'];
			$path = 'images/';
			$qr_path=$path.$qr_image;
			if(file_exists($qr_path)){
				unlink($qr_path);
			}
		$delete_query = "DELETE FROM posts WHERE id=$delete_id";
		$delete_result = mysqli_query($connect,$delete_query);
		if(!$delete_result){
			die("failed".mysqli_error($connect));
		}
		if($delete_result){
			header('location:show_data.php');
			}
	}

 ?>
 <?php 
 	if(isset($_GET['status_id'])){

		$status_id = $_GET['status_id'];
		$status_query = "SELECT status from posts WHERE id=$status_id";
		$status_result = mysqli_query($connect,$status_query);
		$status_row = mysqli_fetch_assoc($status_result);
		if($status_row['status']=='show'){
			$update_status_query = "UPDATE `posts` SET `status`='hidden' WHERE id=$status_id";
			$update_status_result = mysqli_query($connect,$update_status_query);
			header('location:show_data.php');
		}else{
			$update_status_query = "UPDATE `posts` SET `status`='show' WHERE id=$status_id";
			$update_status_result = mysqli_query($connect,$update_status_query);
			header('location:show_data.php');
		}
	}
  ?>
	<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<!-- <script>
        var dTable = $('#dtable');
        dTable.DataTable({
            'order': [[ 0, 'desc' ]],
            'aoColumns': [
                null,
                {
                    'bSortable': false
                }
            ]
        });
</script> -->
<script>//error here
//1.bootstrap version and jquery cdn
//2.script calling way
//3.too many query and http requests
//4.th!=td
	$(document).ready( function () {
    $('#dtable').DataTable();
} );
</script>

</body>
</html>