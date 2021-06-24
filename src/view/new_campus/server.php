<?php

include('../../core/db.php');
	
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$added_by = $_POST['added_by'];




$sql = $connection->prepare("INSERT INTO `locations`(`name`, `address`, `phone`, `email`, `added_by`) VALUES (?,?,?,?,?)");
if($sql->execute(array($name, $address, $phone, $email, $added_by))){
	echo "Successfully added a new Location";
}else{
	echo "Failed to add a new Location";
}

	
?>