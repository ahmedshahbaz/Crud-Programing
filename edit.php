<?php
	$con = mysqli_connect('localhost', 'root', '', 'test');
	if($_POST['id']){
		$id = $_POST['id'];
		$sql = mysqli_query($con,"SELECT * FROM user WHERE id = '$id'");
		while($rows=mysqli_fetch_array($sql)){
			$id = $rows['id'];
			$name = $rows['name'];
			$email = $rows['email'];
			$file = $rows['file'];
?>  
	<form method="POST" id="edit_record" enctype="multipart/form-data">
		<table class="table table-bordered">
			<tr>
				<td>Name</td>
				<td><input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" /></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" class="form-control" id="email" name="email" value="<?= $email ?>" /></td>
			</tr>
			<tr>
				<td>File</td>
				<td><input type="file" class="form-control" id="file" name="file" value="<?= $file ?>" /></td>
			</tr>
			<tr class="text-right">
				<td><input type="hidden" value="<?= $id ?>" name="id" /></td>
				<td><input type="submit" value="Update" class="btn btn-primary" /></td>
			</tr>
		</table>
	</form>
	<script>
		$("#edit_record").on('submit',(function(e){
			e.preventDefault();
			$.ajax({
				url: "insert.php",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success: function(data){
					$("#show").html(data);
					$("#editshow").hide();
				},
				error: function(){} 	        
			}); 
		}));
	</script>
<?php
	}
	}
?>