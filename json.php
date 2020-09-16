<?php



    header('Content-Type: text/javascript; charset=utf8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Max-Age: 3628800');	
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
 
	$servername = "localhost";
	$database = "coronovirus";
	$username = "root";
	$password = "";
	$connection = mysqli_connect($servername, $username, $password, $database);
	if(mysqli_connect_error()){

		die("You cannot connect at the moment");

	}

	$json = array();
	$query = "SELECT District,Count from coronocasesintamilnadu";
	$result = mysqli_query($connection,$query);

	while($row = mysqli_fetch_array($result)){

		$json[$row[0]] = $row[1];



	}

	$json["date"] = "12-07-2020";

	echo json_encode($json);




?>