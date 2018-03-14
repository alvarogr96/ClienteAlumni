<!DOCTYPE html>
<html>
	<head>
		<title>Lists</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">			
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>		
	

		<script type="text/javascript">
		function ajax() {
				var title = document.getElementById('titleText').value;
				//var title = $("#title").val();


				console.log(title);
				
			
				// Instanciar el objeto XMLHttpRequest
				connection = new XMLHttpRequest();
				// Preparar respuesta
				connection.onreadystatechange = response;
				// Petición HTTP con POST
				connection.open('POST', 'http://localhost/AlumniFinal/public/index.php/lists/create.json');
				//connection.open('POST', 'http://h2744356.stratoserver.net/alumni/AlumniFinal/public/index.php/lists/create.json');

				// Cabecera de la petición
				connection.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				// Envío
				connection.send("title=" + title);
			}
			function response(){
				if (connection.readyState == 4) {
					var response = JSON.parse(connection.responseText);
					if (response.code == 200){
					location.href ="http://localhost/ClienteAlumni/users.php";
					//location.href = "http://h2744356.stratoserver.net/alumni/ClienteAlumni/users.php";
					} else if (response.code == 400 || response.code == 500 ){
					document.getElementById('code').innerHTML = response.code;
					document.getElementById('message').innerHTML = response.message;
					}
				}
					
			}
		</script>

		<style>
			body{
				margin-left: 40%;
			}
			.form-control{
				width: 200px;
				margin-bottom: 10px;
			}
		</style>

	</head>
	<body>
		<h1>New list</h1>

		<div id='response'>
			<p id='code'></p>
			<p id='message'></p>
		</div>

		<input type="text" class="form-control" id="titleText" placeholder="New list">
		
		<button onclick='ajax()' class="btn btn-primary active"">Create</button>


		<script src="js/jquery.js"></script>
	</body>
</html>