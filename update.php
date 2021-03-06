<?php 
	
	// filename: update.php, Rick Megerle, cis355, 
	
	session_start();
	if ($_SESSION["id"] != "loggedIn")
		header("Location: login.php");	
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$vehicleError = null;
		$ModelError = null;
		$colorError = null;
		
		
		// keep track post values
		$name = $_POST['name'];
		$vehicle = $_POST['vehicle'];
		$model = $_POST['model'];
		$color = $_POST['color'];
		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($vehicle)) {
			$vehicleError = 'Please enter Vehicle';
			$valid = false;
		
		}
		
		if (empty($model)) {
			$ModelError = 'Please enter Model';
			$valid = false;
		
		}
		if (empty($color)) {
			$colorError = 'Please enter Color';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE Vehicles  set name = ?, vehicle = ?, model =?, color =? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$vehicle,$model,$color,$id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Vehicles where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['name'];
		$vehicle = $data['vehicle'];
		$model = $data['model'];
		$color = $data['color'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update A Vehicle</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($vehicleError)?'error':'';?>">
					    <label class="control-label">Vehicle</label>
					    <div class="controls">
					      	<input name="vehicle" type="text" placeholder="Vehicle" value="<?php echo !empty($vehicle)?$vehicle:'';?>">
					      	<?php if (!empty($vehicleError)): ?>
					      		<span class="help-inline"><?php echo $vehicleError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($ModelError)?'error':'';?>">
					    <label class="control-label">Model</label>
					    <div class="controls">
					      	<input name="model" type="text"  placeholder="Model" value="<?php echo !empty($model)?$model:'';?>">
					      	<?php if (!empty($ModelError)): ?>
					      		<span class="help-inline"><?php echo $ModelError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($colorError)?'error':'';?>">
					    <label class="control-label">Color</label>
					    <div class="controls">
					      	<input name="color" type="text"  placeholder="Color" value="<?php echo !empty($color)?$color:'';?>">
					      	<?php if (!empty($colorError)): ?>
					      		<span class="help-inline"><?php echo $colorError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>