<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TEST</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript">
		/* $(document).ready(function(){
			$("form").submit(function(e){
				e.preventDefault();
				var name = $('#name').val();
				var email = $('#email').val();
				var file = $('#file').val();
				console.log(file);
				  $.ajax({
					url: "./insert.php",
					type: "post",
					data: { name: name, email: email, file:file },
					success: function (data) {
					  var dataParsed = JSON.parse(data);
					  $("form").reset();
					  alert(dataParsed);
					}
				  }); 
			});
		}); */
		
			$(document).ready(function (e){
				showrecord();
				function showrecord(){
				  $.ajax({
					type:"post",
					url:"insert.php",
					data:"action=showrecord",
					success:function(data){
						 $("#show").html(data);
					}
				  });
				}
				
				
				
				$("#add_record").on('submit',(function(e){
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
							//var dataParsed = JSON.parse(data);
							$("#add_record")[0].reset();
							alert(data);
							showrecord();
						},
						error: function(){} 	        
					});
				}));
				
				
				
				
			});

		</script>
	</head>
<body>
	<h2 class="text-center">Crud Functionality</h2>
	<div class="col-md-8">
		<form method="POST" id="add_record" enctype="multipart/form-data">
			<table class="table table-bordered">
				<tr>
					<td>Name</td>
					<td><input type="text" class="form-control" id="name" name="name" /><input type="hidden" class="form-control" id="myid" name="myid" value="1" /></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" class="form-control" id="email" name="email" /></td>
				</tr>
				<tr>
					<td>File</td>
					<td><input type="file" class="form-control" id="file" name="file" /></td>
				</tr>
				<tr class="text-right">
					<td></td>
					<td><input type="submit" value="Submit" class="btn btn-primary" /></td>
				</tr>
			</table>
		</form>
		<div id="show"></div>
		<div id="editshow"></div>
		
	</div>
	
</body>
</html>