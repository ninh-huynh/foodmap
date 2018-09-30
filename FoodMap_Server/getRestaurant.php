<?php 
	//import library
	include "../private/database.php"
	
	//create class Restaurant
	class Restaurant{
		function Restaurant($id, $id_user, $name, $address, $phone_number, $describe_text, $url_image, $time_open, $time_close, $rank){
			$this->id = $id;
			$this->id_user = $id_user;
			$this->name = $name;
			$this->address = $address;
			$this->phone_number = $phone_number;
			$this->describe_text = $describe_text;
			$this->url_image = $url_image;
			$this->time_open = $time_open;
			$this->time_close = $time_close;
			$this->rank = $rank;
		}
	}
	
	//create query string
	$query = "SELECT RST.*, AVG(RNK.STAR) rank FROM RESTAURANT RST JOIN RANK RNK ON RST.ID = RNK.ID_REST GROUP BY RST.ID";
	
	//create connection
	$conn = new database();
	//connect
	$conn->connect();
	//get result
	$listRestaurants = $conn->query($query);
	$response = array();
	foreach ($listRestaurants as $row) {
		array_push($response, new Restaurant($row['id'], $row['id_user'], $row['name'], $row['address'], $row['phone_number'], $row['describe_text'], $row['url_image'], $row['time_open'], $row['time_close'], $row['rank']));
	}
	
	
	//close conn
	$conn->disconnect();
	//response
	echo json_encode($response);
?>