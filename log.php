<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $lastnameError = null;
        $firstnameError = null;
        $numberError = null;
        $itemError = null;
         
        // keep track post values
        $LastName = $_POST['LastName'];
        $FirstName = $_POST['FirstName'];
        $ConsignorNumber = $_POST['ConsignorNumber'];
        $ItemCount = $_POST['ItemCount'];
        
        // date/time for Intake Date
        date_default_timezone_set('America/Chicago');
        $IntakeDate = date("Y-m-d H:i:s");   
         
        // validate input
        $valid = true;
        if (empty($LastName)) {
            $lastnameError = 'Please enter Last Name';
            $valid = false;
        }
        
        if (empty($FirstName)) {
            $firstnameError = 'Please enter First Name';
            $valid = false;
        }
        
        if (empty($ConsignorNumber)) {
            $numberError = 'Please enter Consignor Number';
            $valid = false;
        }
        
        if (empty($ItemCount)) {
            $itemError = 'Please enter Item Count';
            $valid = false;
        }
         
        // Retrieve data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT ConsignorNumber,FirstName,LastName FROM Consignors WHERE LastName = ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($ConsignorNumber,$FirstName,$LastName,$ItemCount,$IntakeDate));
            Database::disconnect();
            header("Location: index.php");
        }
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
                    	<img src="img/logo_small.png" alt="Kidz Closet">
                        <h3>Create an Intake Log Entry</h3>
                    </div>
             		<?php
             			$ConsignorNumber = $_REQUEST['ConsignorNumber'];
						$FirstName = $_REQUEST['FirstName'];
						$LastName = $_REQUEST['LastName'];
             		?>
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($numberError)?'error':'';?>">
                        <label class="control-label">Consignor Number</label>
                        <div class="controls">
                            <input name="ConsignorNumber" type="text"  placeholder="Consignor Number" value="<?php echo !empty($ConsignorNumber)?$ConsignorNumber:'';?>">
                            <?php if (!empty($numberError)): ?>
                                <span class="help-inline"><?php echo $numberError;?></span>
                            <?php endif; ?>
                        </div>
                      </div> 
                      <div class="control-group <?php echo !empty($firstnameError)?'error':'';?>">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input name="FirstName" type="text" placeholder="First Name" value="<?php echo !empty($FirstName)?$FirstName:'';?>">
                            <?php if (!empty($firstnameError)): ?>
                                <span class="help-inline"><?php echo $firstnameError;?></span>
                            <?php endif;?>
                        </div>
                      </div>                    
                      <div class="control-group <?php echo !empty($lastnameError)?'error':'';?>">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <input name="LastName" type="text" placeholder="LastName" value="<?php echo !empty($LastName)?$LastName:'';?>">
                            <?php if (!empty($lastnameError)): ?>
                                <span class="help-inline"><?php echo $lastnameError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($itemError)?'error':'';?>">
                        <label class="control-label">Item Count</label>
                        <div class="controls">
                            <input name="ItemCount" type="text"  placeholder="Item Count" value="<?php echo !empty($ItemCount)?$ItemCount:'';?>">
                            <?php if (!empty($itemError)): ?>
                                <span class="help-inline"><?php echo $itemError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success" onclick="window.print();">Create</button>
                          <a class="btn" href="start.php">Back</a>
                          <!--<button type="submit" id="printbutton" onclick="window.print();">Print</button> -->                          
                         </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
