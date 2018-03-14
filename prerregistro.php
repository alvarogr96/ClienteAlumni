<!DOCTYPE html>
<html>
	<head>
		<title>Gestor</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">			
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>		
	

		<script type="text/javascript">
			function ajax() {
				var email = document.getElementById('email').value;
				var token = localStorage.getItem("token");
				//var username = document.getElementById('username').value;
				var idList = document.getElementById('dropdownList').value;
				var idRole = document.getElementById('dropdownRole').value;
				console.log(email);
				console.log(token);
				//console.log(username);
			
				
				// Instanciar el objeto XMLHttpRequest
				connection = new XMLHttpRequest();
				// Preparar respuesta
				connection.onreadystatechange = response;
				// Petición HTTP con POST
				connection.open('POST', 'http://localhost/AlumniFinal/public/index.php/users/preCreate.json');
				//connection.open('POST', 'http://h2744356.stratoserver.net/alumni/AlumniFinal/public/index.php/users/preCreate.json');
				// Cabecera de la petición
				connection.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

				connection.setRequestHeader('Authorization', token);
				
				// Envío
				connection.send("email=" + email + "&id_rol=" + idRole + "&id_list=" + idList);
			}
			function response(){
				if (connection.readyState == 4) {
					var response = JSON.parse(connection.responseText);
					console.log(response);
					if (response.code == 200){
						location.href ="http://localhost/ClienteAlumni/users.php";
						//location.href = "http://h2744356.stratoserver.net/alumni/ClienteAlumni/users.php";
						
					} else if (response.code == 400 || response.code == 500 ){
						document.getElementById('code').innerHTML = response.code;
						document.getElementById('message').innerHTML = response.message;

					}
				}
			}

			function showGroups(){
				var users = new XMLHttpRequest();

				users.open('GET', 'http://localhost/AlumniFinal/public/index.php/lists/lists.json');
				//users.open('GET', 'http://h2744356.stratoserver.net/alumni/AlumniFinal/public/index.php/users/users.json');
				users.send();

				users.onreadystatechange = function() {
    				if(users.readyState == 4){
        				console.log("connection  == 4 ");
        				var response = JSON.parse(users.responseText);
						console.log(response);
						response.forEach(function(a){
							console.log("Element " + a["title"]);
							var table = document.createElement('table');
							document.getElementById('dropdownList').innerHTML += "<option value="+ a["id"] +">"+ a["title"] +"</option>";
						});
    				}	
				}
			}

			function showRoles(){
				var users = new XMLHttpRequest();

				users.open('GET', 'http://localhost/AlumniFinal/public/index.php/roles/roles.json');
				//users.open('GET', 'http://h2744356.stratoserver.net/alumni/AlumniFinal/public/index.php/users/users.json');
				users.send();

				users.onreadystatechange = function() {
    				if(users.readyState == 4){
        				console.log("connection  == 4 ");
        				var response = JSON.parse(users.responseText);
						console.log(response);
						response.forEach(function(a){
							console.log("Element " + a["type"]); 
							var table = document.createElement('table');
			
							document.getElementById('dropdownRole').innerHTML += "<option value="+ a["id"] +">"+ a["type"] +"</option>";
						});
    				}	
				}
			}

			showGroups();
			showRoles();
		</script>

		<style>
			.form-control{
				width: 500px;
				margin-bottom: 10px;
			}
			#btnCreate{
				margin-top: 10px;
			}
			h1{
				margin-left: 32%;
			}
			body
			{
				width: 500px;
				margin-left: 35%;
			}
	
			
		</style>

	</head>
	<body>
		<h1>Pre register</h1>

		<div id='response'>
			<p id='code'></p>
			<p id='message'></p>
		</div>

		<input type="text" class="form-control" id="email" placeholder="Email">

		<div class="input-group mb-3">
  			<select class="custom-select" id="dropdownRole">
  			</select>
  			<div class="input-group-append">
    			<label class="input-group-text" for="inputGroupSelect02">Roles</label>
  			</div>
		</div>

		<div class="input-group mb-3" >
			<select class='custom-select' id="dropdownList">

			</select>	
  			
  			<div class="input-group-append">
    			<label class="input-group-text" for="inputGroupSelect02">Groups</label>
  			</div>
		</div>

		<!-- <input type="text" class="form-control" id="username" placeholder="Username"> -->
		<button onclick='ajax()' class="btn btn-primary active" id="btnCreate">Create</button>


		<script src="js/jquery.js"></script>
		
	</body>
</html>