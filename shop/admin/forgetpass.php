
<?php
include '../classes/Adminlogin.php';
?>
<?php
 $al=new Adminlogin();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $adminEmail = $_POST['adminEmail'];
    $changepass = $al->adminforgotPass($adminEmail);
    
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container bg-warning">
       <div class="row">
                
                <div class="col-sm-4 col-sm-offset-4">
                
                    <form action="" method="POST">
                        <h2 class="text-center alert alert-success">Password Recovery</h2>
                        <?php
                        if(isset($changepass)){
                        	echo $changepass;
                        }
                        ?>
                    	<br>
                    	<br>
                         <div>
                             <input type="text" name="adminEmail" placeholder="Enter Your Email" class="form-control">
                            
                        </div>
                        <br>
                        
                        <div>
                            
                           <input type="submit" value="Sent Email" name="submit" class="btn btn-info col-sm-offset-2">

                        </div>
                        <br>
                         <a  href="login.php" class=" text-primary col-sm-4 col-sm-offset-2">Login Now?</a>
                       
                    </form>  
       
                </div>
                
        </div>
       </div>

</body>
</html>

