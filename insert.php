<?php

    //Create connection
	$con = mysqli_connect('localhost', 'root', '', 'test');
	$myid = isset($_POST['myid']);
    if(isset($_POST['name']) && $myid == 1){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$file = $_FILES['file']['name'];
		$allow = array("jpg", "jpeg", "gif", "png");
		$todir = 'uploads/';
		if ( !!$_FILES['file']['tmp_name'] ) 
		{
			move_uploaded_file( $_FILES['file']['tmp_name'], $todir . basename($_FILES['file']['name'] ) );	
		}

		$sql = "INSERT INTO user (name, email, file) VALUES ('$name', '$email', '$file')";
		$query = mysqli_query($con, $sql);
		if($query){
			echo  "Data Inserted Successfully";
		}
		else {
			echo  'Something went wrong';
		 }
	}
	
	$action = isset($_POST['action']);
	if($action =='showrecord'){
	?>
	<table class="table table-bordered">
			<tr>
				<td>Name</td>
				<td>Email</td>
				<td>File</td>
				<td class="text-center">Action</td>
			</tr>
			<?php
				$query = mysqli_query($con,"SELECT * FROM user");
				$rowcount = mysqli_num_rows($query);
				if($rowcount > 0){
					while($row=mysqli_fetch_array($query)){
						$id = $row['id'];
						$name = $row['name'];
						$email = $row['email'];
						$file = $row['file'];
					
			?>
			<tr>
				<td><?= $name ?></td>
				<td><?= $email ?></td>
				<td><img src="uploads/<?= $file ?>" style="width:20%;" /></td>
				<td class="text-center"><button class="btn btn-info" onClick="editrecord('<?= $id; ?>')">Edit</button> <button class="btn btn-danger" onClick="deleterecord('<?= $id; ?>');">Delete</button></td>
			</tr>
			<?php
					}
				}
				else{
			?>
			<tr class="text-center"><td colspan="4">No record found</td></tr>
			<?php
				}
			?>
		</table>
		<script>
		function editrecord(id){
			$.ajax({
				type:"post",
				url:"edit.php",
				data:{id:id},
				success:function(data){
					 $("#editshow").show().html(data);
				}
			});
		}
		
		function deleterecord(id){
		   var r=confirm("Do you want to delete this?")
			if (r==true)
			  $.ajax({
				type:"post",
				url:"delete.php",
				data:{id:id},
				success:function(data){
					 //$("#editshow").show().html(data);
					 alert(data);
				}
			});
			else
			  return false;
			}
	</script>
	<?php
		}
	?>	

	
	
	<?php
		if(isset($_POST['id'])){
			$id= $_POST['id'];
			$name= $_POST['name'];
			$email= $_POST['email'];
			$file = $_FILES['file']['name'];
			$allow = array("jpg", "jpeg", "gif", "png");
			$todir = 'uploads/';
			if ( !!$_FILES['file']['tmp_name'] ) 
			{
				move_uploaded_file( $_FILES['file']['tmp_name'], $todir . basename($_FILES['file']['name'] ) );	
				$query_update = mysqli_query($con,"UPDATE `user` SET `name`='$name', `email`='$email', `file`='$file' WHERE `id` = '$id'");
			}
			else{
				$query_update = mysqli_query($con,"UPDATE `user` SET `name`='$name', `email`='$email' WHERE `id` = '$id'");
			}
			
	?>
	<table class="table table-bordered">
			<tr>
				<td>Name</td>
				<td>Email</td>
				<td>File</td>
				<td class="text-center">Action</td>
			</tr>
			<?php
				$query = mysqli_query($con,"SELECT * FROM user");
				$rowcount = mysqli_num_rows($query);
				if($rowcount > 0){
					while($row=mysqli_fetch_array($query)){
						$id = $row['id'];
						$name = $row['name'];
						$email = $row['email'];
						$file = $row['file'];
					
			?>
			<tr>
				<td><?= $name ?></td>
				<td><?= $email ?></td>
				<td><img src="uploads/<?= $file ?>" style="width:20%;" /></td>
				<td class="text-center"><button class="btn btn-info" onClick="editrecord('<?= $id; ?>')">Edit</button> <button class="btn btn-danger">Delete</button></td>
			</tr>
			<?php
					}
				}
				else{
			?>
			<tr class="text-center"><td colspan="4">No record found</td></tr>
			<?php
				}
			?>
		</table>
	<?php
		}
	?>