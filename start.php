	<?php 
//	    if ( !empty($_POST)) {
//	        // keep track validation errors
//	        $lastnameError = null;
//	         
//	        // keep track post values
//	        $LastName = $_POST['LastName'];
//	        echo $LastName;
//	         
//	        // validate input
//	        $valid = true;
//	        if (empty($LastName)) {
//	            $lastnameError = 'Please enter Last Name to search for';
//	            $valid = false;
//	        }
//	    }
	?>
	
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    
	<?php 
	    // keep track post values
	    $LastName = $_GET['LastName'];
	?>

</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                    	<img src="img/logo_small.png" alt="Kidz Closet">
                        <h3>Create an Intake Log Entry</h3>
                    </div>
             
                    <form class="form-horizontal" method="GET" action="lookup.php">
                      <div class="control-group <?php echo !empty($lastnameError)?'error':'';?>">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <input name="LastName" type="text" placeholder="LastName" value="<?php echo !empty($LastName)?$LastName:'';?>"> 
                            <!--<a class="btn" href="lookup.php?id=<?='riggs'?>">Lookup Name</a>-->
                            <?php if (!empty($lastnameError)): ?>
                                <span class="help-inline"><?php echo $lastnameError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                   <div class="form-actions">
                          <button type="submit" class="btn btn-success">Lookup</button>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
