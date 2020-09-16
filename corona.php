<?php

	$servername = "localhost";
	$database = "coronovirus";
	$username = "root";
	$password = "";
	$connection = mysqli_connect($servername, $username, $password, $database);
	if(mysqli_connect_error()){

		die("You cannot connect at the moment");

	}

	$data = file_get_contents("https://api.covid19india.org/districts_daily.json");
	$original_data = json_decode($data);
	$i = 0;
	$city = array();
	$date = "2020-07-12";

	foreach ($original_data as $key => $value) {
		
		foreach ($value as $key1 => $value1) {
			
			if ($key1 == "Tamil Nadu") {
				
				foreach ($value1 as $key2 => $value2) {

					if($key2 == "The Nilgiris" or $key2=="Kanniyakumari"){

						continue;

					}

					
					
				foreach ($value2 as $key3 => $value3) {
					
					if($value3->date == $date){

						$city[$i][$key2]=$value3->active ;
						$i++;

					}


				}

			}

		}

	}

}

foreach ($city as $key => $value) {

	foreach ($value as $key1 => $value1) {

		$query = "UPDATE coronocasesintamilnadu SET Count=$value1 WHERE District='$key1'";
		mysqli_query($connection,$query);
		

	}
}




?>