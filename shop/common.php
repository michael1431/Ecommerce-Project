<?php //include 'inc/header.php' ?>
<?php
require 'classes/Customer.php' ;
$cmr = new Customer();
if(isset($_POST['cityId'])){
    
    $cityId = $_POST['cityId'];
   
    $Area = $cmr->getallareabycityid($cityId);
    ?>    
    <option value="">Select City</option>
    <?php   
    if($Area){
        while($result = $Area->fetch_assoc()){
            ?>
            <option value="<?php echo $result['city_id'] ?>"><?php echo $result['cityName'];?></option>
        <?php
        }
    }
}