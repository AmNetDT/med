<?php

include('../../core/db.php');

$id = $_POST['location_id'];
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$added_by = $_POST['added_by'];




$sql = "UPDATE `locations` SET `name`=?,`address`=?,`phone`=?,`email`=?,`added_by`=? WHERE id=$id";
$sqli = $connection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
if($sqli->execute(array($name, $address, $phone, $email, $added_by))){
	echo "Successfully updated a Location";
}else{
	echo "Failed to update  Location";
}
