<!DOCTYPE html>

<!---- filename: index.php,Rick Megerle, cis355, 2015-03-31 --->

<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    		<div class="row">
    			<h3>Vehicle Repair</h3>
    		</div>
			<div class="row">
				<p>
					<a href="create.php" class="btn btn-success">Create</a>
				</p>
				
				<!------- Displays the Vehicles table --->				
								
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Id</th>
						  <th>Name</th>
		                  <th>Vehicle</th>
		                  <th>Model</th>
		                  <th>Color</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					  
					  session_start();
					  if ($_SESSION["id"] != "loggedIn")
						  header("Location: login.php");
					  
					  //displays the data from the database to the table
					  
					   include 'database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM Vehicles ORDER BY id ASC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['id'] . '</td>';
							   	echo '<td>'. $row['name'] . '</td>';
							   	echo '<td>'. $row['vehicle'] . '</td>';
								echo '<td>'. $row['model'] . '</td>';
								echo '<td>'. $row['color'] . '</td>';
							   	echo '<td width=250>';
							   	echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
							   	echo '</td>';
							   	echo '</tr>';
								
								
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
					
    	</div>
    </div> <!-- /container -->
	
	<?php
	
	//navigation buttons
	
	echo '<a class="btn" href="customers.php"">Customers Table</a>';
							   	echo '&nbsp;';
								
	echo '<a class="btn" href="services.php"">Services Table</a>';
							   	echo '&nbsp;';
								
								
	echo '<a class="btn" href="logout.php"">Logout</a>';
							   	echo '&nbsp;';							
	?>
	
	
	
  </body>
</html>