<!DOCTYPE html>
<html>
	<head>
		<title>Usuarios</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">			
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	
	
		<script type="text/javascript">


			function showUsers(){
				

				var users = new XMLHttpRequest();

				//users.open('GET', 'http://localhost/AlumniFinal/public/index.php/users/usersInactive.json');
				users.open('GET', 'http://h2744356.stratoserver.net/alumni/AlumniFinal/public/index.php/users/usersInactive.json');

				
				users.send();

				users.onreadystatechange = function() {
    				if(users.readyState == 4){
        				
        				var response = JSON.parse(users.responseText);
						
						response.forEach(function(a){
							
							var table = document.createElement('table');
							
							document.getElementById('tableUsers').innerHTML += "<tr><th scope='row'>"+ a["id"] +"</th><td>"+ a["email"] +"</td><td>" + a["id_rol"] + "</td><td>" + a["active"] + "</td><td><button type='button' class='btn btn-danger btn-sm' onclick='deleteUser("+a["id"]+")'>Eliminar</button></td></tr>";
						});
    				}	
				}
			}

			function deleteUser(id){

				var token = localStorage.getItem("token");
				 console.log(token);

				connection = new XMLHttpRequest();
				// Preparar respuesta
				connection.onreadystatechange = response;
				// Petición HTTP con POST
				//connection.open('POST', 'http://localhost/AlumniFinal/public/index.php/users/delete.json');
				connection.open('POST', 'http://h2744356.stratoserver.net/alumni/AlumniFinal/public/index.php/users/delete.json');
				// Cabecera de la petición
				connection.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				connection.setRequestHeader('Authorization', token);
			
				// Envío
				connection.send("id=" + id);
			}
			function response(){
				if (connection.readyState == 4) {
					var response = JSON.parse(connection.responseText);
					console.log(response);
					if (response.code == 200){
						window.location.reload();
						//localStorage.setItem("token", response.data.token);
						
					} else if (response.code == 400 || response.code == 500 ){
						document.getElementById('code').innerHTML = response.code;
						document.getElementById('message').innerHTML = response.message;

					}
				}
			}

		

			function GoPreRegister(){
				//window.location.href = "http://localhost/ClienteAlumni/prerregistro.php";
				window.location.href = "http://h2744356.stratoserver.net/alumni/ClienteAlumni/prerregistro.php";
			}
			function GoLists(){
				//window.location.href = "http://localhost/ClienteAlumni/lists.php";
				window.location.href = "http://h2744356.stratoserver.net/alumni/ClienteAlumni/lists.php";

			}

			showUsers();

		</script>
	
		<style>
			h1{
				margin-left: 20%;
			}
			body
			{
				width: 500px;
				margin-left: 35%;
			}
			p{
				width: 200px;
				margin-bottom: 10px;
			}
			button{
				margin-top: 10px;
			}
		</style>
	</head>
	<body>

		<h1>Lista de usuarios</h1>

		<p id="code"></p>
		<p id="message"></p>

	<table class="table table-striped table-bordered table-dark">
  <thead >
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Email</th>
      <th scope="col">Id_rol</th>
      <th scope="col">Active</th>
    </tr>
  </thead>
  <tbody id="tableUsers">

    
  </tbody>
</table>
		

		<!--<div id="userList">
			
		</div>-->
		

		<button type="button" class="btn btn-primary " onclick="GoPreRegister()">Create user</button>
		
		<button type="button" class="btn btn-primary " onclick="GoLists()">Create list</button>

		<script src="js/jquery.js"></script>
		
	</body>
</html>