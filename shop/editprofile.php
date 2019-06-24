<?php include 'inc/header.php' ?>
<?php

$login = Session::get("customerlogin");
if($login == false){
    header("Location:login.php");
}
?>
<?php 

// code for update customer profile 
 $cmrid = Session::get("customerId");
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
 
    $updateCustomer= $cmr->CustomerUpdate($_POST,$cmrid);
  
} 
?>
<style>
   .tblone{width: 550px; margin:0 auto; border: 2px solid #ddd;} 
   .tblone tr td{text-align: justify;}
   .tblone input[type="text"]{width:400px; padding: 5px; font-size: 15px;}
   .success{font-size: 22px; color:green;}
   .error{font-size: 22px; color:red;}
    
</style>    

 <div class="main">
    <div class="content">
        <div class="section group">
            <?php
            // id dore profile show korbo
           $id = Session::get("customerId");
           $getdata = $cmr->customerData($id);
           if($getdata){
               while($result = $getdata->fetch_assoc()){
               
            ?>
            <form action="" method="post">
       
            <table class="tblone">
                
                <?php 
                if(isset($updateCustomer)){
                    echo" <tr>
                    <td colspan='2'><h2 style='text-align: center;'>".$updateCustomer."</h2></td>
                </tr>";
                }
                ?>
                <tr>
                    <td colspan="2"><h2 style="text-align: center; color:violet;">Update Your Profile Details</h2></td>
                </tr>
                
                <tr>
                    <td width="20%">Name</td>
                    <td><input type="text" name="name" value="<?php echo $result['name']?>"></td>

                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input type="text" name="phone" value="<?php echo $result['phone']?>"></td>

                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" value="<?php echo $result['email']?>"></td>

                </tr>
                <tr>
                    <td>Address</td>
                    <td><input type="text" name="address" value="<?php echo $result['address']?>"></td>

                </tr>

                <tr>

                    <td class="text-right"><b>Country :</b></td>
                                        <td><b> <select class="form-control" name="country">
                                                    <option>Select Country</option>
                                                    <?php
                                                    $getCountry = $cmr->getAllCountry();
                                                    if ($getCountry) {
                                                        while ($value = $getCountry->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $value['country_id'] ?>"<?php if ($value['country_id'] == $result['country']) {
                                                echo 'selected';
                                            } ?>><?php echo $value['countryName']; ?></option>
                                                <?php }
                                            } ?>

                                                </select></b></td>

                   

                </tr>
                


                <tr>
                    <td>Zipcode</td>
                    <td><input type="text" name="zip" value="<?php echo $result['zip']?>"></td>

                </tr>

                <tr>

                     <td class="text-right"><b>City :</b></td>
                                        <td><b> 
                                                <select class="form-control"  name="city">
                                                    <option value="">Select City</option>
                                                    <?php
                                                    $getCity = $cmr->getAllCity();
                                                    if ($getCity) {
                                                        while ($value = $getCity->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $value['city_id'] ?>"<?php if ($value['city_id'] == $result['city']) {
                                                echo 'selected';
                                            } ?>><?php echo $value['cityName']; ?></option>
                                            <?php }
                                        } ?>
                                                </select></b></td> 

                    

                </tr>
                
                <tr>
                    <td></td>
                    <td><input type="submit" name="update" value="Update"></td>

                </tr>
               
            
            </table>
        </form>
           <?php } }?>
        </div>	
       <div class="clear"></div>
    </div>
 </div>
</div>

 <?php include 'inc/footer.php' ?>
  



