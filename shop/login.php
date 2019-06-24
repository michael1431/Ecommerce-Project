<?php ob_start();?>
<?php include 'inc/header.php' ?>
<?php
// jodi login takhe tahole order page e niye jabo login page ta r show korabo na

$login = Session::get("customerlogin");

if($login == true){
    header("Location:order.php");
    ob_end_flush();
}

?>

 <?php
// code for customer login
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
 
    $customerLogin= $cmr->CustomerLogIn($_POST);
    
}
?>


<script type="text/javascript">
        
            function getCountry(val) {
                    $.ajax({
                        
                    type: 'POST',
                     url: 'common.php',
                    data: 'cityId='+val,
                    success: function(data){
                            $("#cities").html(data);                 
                        }
                    });
            } 
    </script>


 <div class="main">
    <div class="content">
    	 <div class="login_panel">
             
             <?php
                if(isset($customerLogin)){
                    echo $customerLogin;
                }
            ?>
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post">
                    <input name="email" placeholder="Email" type="text">
                    <input name="password" placeholder="Password" type="password">
                    <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
                 </form>
               
                    
                    </div>
        <style>
                
  .register_account {
  background: #fff none repeat scroll 0 0;
  border: 1px solid #c0bebe;
  border-radius: 2px;
  float: right;
  height: 350px;
  padding: 20px;
  width: 700px;
}
.register_account form input[type="text"],.register_account form input[type="password"],.register_account form select{
	font-size:12px;
	color:#B3B1B1;
	padding:8px;
	outline:none;
	margin:5px 0;
	width:320px;
}

         </style>
         
  <?php
// code for customer registration and insert into database
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
 
    $customerReg= $cmr->customerRegistration($_POST);
    
}


?>
         
         
    	<div class="register_account">
            
 <style>
         
.success{font-size: 18px; color:green;}
.error{font-size: 18px; color:red;}

</style>

            <h3>Register New Account</h3>
            <?php
                if(isset($customerReg)){
                    echo $customerReg;
                }
              ?>
                <form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
                          <input type="text" name="name" placeholder="Enter Your Name" >
							</div>
							
							<div>


                        <select class="form-control" onChange="getCountry(this.value);" name="c_country">
                                <option>Select Country</option>
                            <?php 
                              
                               $getCountry = $cmr->getAllCountry();
                               if($getCountry){
                                   while ($result = $getCountry->fetch_assoc()){
                            ?>
                            <option value="<?php echo $result['country_id'] ?>"><?php echo $result['countryName']; ?></option>
                               <?php }}?>
                                   
                            </select>
							  
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Enter Your Zip Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="Enter Your Email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Enter Your Address">
						</div>
                                            
                           <div>

                           	<select class="form-control" id="cities" name="c_city">
                                <option>Select City</option>
                              
                            </select>

						   </div>
		    			        
	
		           <div>
		          <input type="text" name="phone" placeholder="Enter Your Phone Number">
		          </div>
				  
				  <div>
                    <input type="password" name ="password" placeholder="Enter Your Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
                    <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
   <?php include 'inc/footer.php' ?>
