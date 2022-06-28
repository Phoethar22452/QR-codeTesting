<?php 	
	ob_start();
	$filename = "images/";
	if(isset($_GET['file'])){
		$name = $_GET['file'];
		$filename .= $name;
		if(file_exists($filename)){
			$mime_type = mime_content_type($filename);
			header("Content-type:".$mime_type);
			header('Content-Length: ' . filesize($filename));
			header("Content-Disposition: attachment; filename=myImage.jpg");
			readfile($filename);
		}else{
			echo "File Not Found";
		}
	}
	
		// header("Content-type: image/jpeg");
		// header("Content-Disposition: attachment; filename=myImage.jpg");
		// readfile("images/ph.jpg");	
?>