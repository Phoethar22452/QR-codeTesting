<?php 
	define('host','localhost');
	define('user','root');
	define('password','');
	define('dbname','qrtesting');
	$connect = mysqli_connect(host,user,password,dbname);
	if($connect){
		//echo "Successfully Connected with database";
	}
 ?>