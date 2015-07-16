<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
        <div class="row">
            <img src="img/logo_small.png" alt="Kidz Closet">
            <h3>Consignor Lookup</h3>
        </div>    
         <div class="row">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Consignor Number</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                </tr>
              </thead>
            <tbody>
			<?php
			    require 'database.php';
			    //$id = null;
			    //if ( !empty($_GET['id'])) {
			    //    $id = $_REQUEST['id'];
			    //}
			    $id = '%'.$_REQUEST['LastName'].'%';
			    echo 'Results For: '.$id; 
			    if ( null==$id ) {
			        //header("Location: index.php");
			        echo 'Parameter: IS NULL'; 
			    } 
			    else {
			        $pdo = Database::connect();
			        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			        $sql = "SELECT ConsignorNumber,FirstName,LastName FROM Consignors where LastName LIKE ?";
					$stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
					$stmt->execute(array($id));
					while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                        echo '<tr>';
                        echo '<td>'. $row[0] . '</td>'; //Consignor Number
                        echo '<td>'. $row[1] . '</td>'; //First Name
                        echo '<td>'. $row[2] . '</td>'; //Last Name
                        echo '<td><a class="btn btn-success" href="log.php?ConsignorNumber='.$row[0].'&FirstName='.$row[1].'&LastName='.$row[2].'">Select</a></td>';
                        echo '</tr>';
					}
					$stmt = null;
			        Database::disconnect();
			    }
			?>
			</tbody>           
        </table>
		</div>
            <div class="form-actions">
			<h4>Go Back to search again.  Add New to create a new Consignor Record.</h3>            
              <a class="btn" href="start.php">Back</a>
              <a class="btn" href="create.php">Add New</a>
            </div>        
        </div>       
	</div> <!--container-->
</body>
</html>