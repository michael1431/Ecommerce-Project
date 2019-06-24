<?php
include '../classes/Adminlogin.php';
?>
<?php
// create a object of adminlogin class to access this class
$al=new Adminlogin();

// user j name and pass ta patacche post method diye oita dorbo 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $adminUser = $_POST['adminUser'];
    $adminPass = md5($_POST['adminPass']);
    $loginChk = $al->adminLogin($adminUser,$adminPass);
    
}


?>



<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title> Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />


</head>
<body>
<div class="container">
	<section id="content">
            <form action="login.php" method="post">
			<h1>Admin Login</h1>
                        <span style="color: red; font-size: 18px;">
                           <?php
                           
                            if(isset($loginChk)){
                                // error msg ta show koranor jonno
                                echo $loginChk;
                            }
                             ?> 
                        
                            </span>   
                        
			<div>
				<input type="text" placeholder="Enter Your Username"  name="adminUser" value="<?php if(isset($_COOKIE['adminUser'])){echo $_COOKIE['adminUser'];}?>" />
			</div>
			<div>
				<input type="password" placeholder="Enter Your Password"  name="adminPass" value="<?php if(isset($_COOKIE['adminPass'])){echo $_COOKIE['adminPass'];}?>"/>
			</div>

			<div style="float: left; font-size: 18px">

            <input type="checkbox" name="remember" value="<?php if(isset($_COOKIE['adminUser'])){?> checked <?php }?>">
            <label > Remember Me</label>

            </div>

			<div>

				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
                <div class="button">
			   <a href="forgetpass.php">Forgot Password ?</a>
		       </div>

                
		<div class="button">
			<a href="#">Web Developers BD</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>