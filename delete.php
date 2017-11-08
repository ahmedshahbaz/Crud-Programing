<?php
	$con = mysqli_connect('localhost', 'root', '', 'test');
	if($_POST['id']){
		$id = $_POST['id'];
		$sql = mysqli_query($con,"DELETE FROM user WHERE id = '$id'");
		echo "Record has been deleted";
	}
?>