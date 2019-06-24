<?php ob_start(); ?>
<?php include 'inc/header.php' ?>
<?php
// jodi login na takhe tahole login page e redirect kore dibo

$login = Session::get("customerlogin");

if($login == false){
    header("Location:login.php");
}

?>

<?php
if(isset($_GET['orderid'])&& $_GET['orderid'] == 'order'){
    $cmrid = Session::get("customerId");
    $insertorder= $ct->orderProduct($cmrid);
    $delData = $ct->delCustomerCart();
    header("Location:success.php");
    ob_end_flush();
}
?>
<style>
 .division{width:50%; float:left;}
 .tblone{width: 450px; margin:0 auto; border: 2px solid #ddd;} 
 .tblone tr td{text-align: justify;} 
 .tbltwo{float:right;text-align:left;width:60%; border: 2px solid #ddd; margin-right: 14px; margin-top: 12px; }
 .tbltwo tr td{text-align: justify; padding: 5px 10px;}
 .ordernow{padding-bottom: 30px;}
 .ordernow a{width:300px; margin: 20px auto 0; text-align: center; padding: 5px; font-size: 30px;display: block;
 background: #ff0000; color:#fff;}
</style>   

 <div class="main">

    <div class="content">
        <div class="section group">
          
            <div class="division">
            
                 <table class="tblone">
							<tr>
                                <th>No</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total Price</th>
							
                             </tr>
                              <?php 
                                                        // code for show the  order product from cart tablle 
                                                        $getpro = $ct->getCartProduct();
                                                        if($getpro){
                                                            $i = 0;
                                                            // create a variable for sum
                                                            $sum = 0;
                                                            $qty = 0;
                                                            while ($result = $getpro->fetch_assoc()){ 
                                                                $i++;
                                                        ?>
                                                        
							<tr>
                                                                <td><?php echo $i; ?></td>
								<td><?php echo $result['productName']?></td>
								<td>$<?php echo $result['price']?></td>
                                                                <td>$<?php echo $result['quantity']?></td>
								<td>$<?php
                                                                
                                                                $total = $result['price'] * $result['quantity'];
                                                                
                                                                echo $total;
                                                                  ?> 
                                                                </td>
							</tr>
                                                        <?php
                                                        $sum = $sum + $total;
                                                        //show the quantity also to the cart
                                                        $qty = $qty + $result['quantity'];
                                                       
                                                        ?>
                                                        <?php } } ?>	
						</table>
                    
                   
                <table class="tbltwo" style="float:right;text-align:left;" width="40%">
                                                       <tr>
								<td>Sub Total</td>
                                                                 <td>:</td>
								<td>$<?php echo $sum; ?></td>
							</tr>
							<tr>
								<td>VAT</td>
                                                                 <td>:</td>
								<td>10%(<?php echo   $vat = $sum * 0.1 ; ?>)</td>
							</tr>
							<tr>
								<td>Grand Total </td>
                                                                <td>:</td>
								<td>$
                                                                <?php
                                                                $vat = $sum * 0.1 ;
                                                                $grandtotal = $sum + $vat ;
                                                                echo $grandtotal;
                                                                 ?>
                                                                </td>
                                                        </tr> 
                                                        <tr>
								<td>Quantity</td>
                                                                 <td>:</td>
								<td><?php echo $qty; ?></td>
							</tr>
					   </table>
            </div>
            
            <div class="division">
                <?php
            // id dore profile show korbo
           $id = Session::get("customerId");
           $getdata = $cmr->customerData($id);
           if($getdata){
               while($result = $getdata->fetch_assoc()){
                  
            
            ?>
            <table class="tblone">
                <tr>
                    <td colspan="3"><h2 style="text-align: center; color:red;">Your Profile Details</h2></td>
                </tr>
                
                <tr>
                    <td width="20%">Name</td>
                    <td width ="5%">:</td>
                    <td><?php echo $result['name']?></td>

                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?php echo $result['phone']?></td>

                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email']?></td>

                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?php echo $result['address']?></td>

                </tr>
                <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><?php echo $result['countryName']?></td>

                </tr>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><?php echo $result['cityName']?></td>

                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td>:</td>
                    <td><?php echo $result['zip']?></td>

                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="editprofile.php">Update Details</a></td>

                </tr>
               
            
            </table>
           <?php } }?>
                
            </div>
            
       </div>
 </div>
     <div class="ordernow">
         <a href="?orderid=order">Order Now</a>
         <a class="btn btn-info" onClick="window.open('invoice.php','SearchTip','width=900,height=630,resizable=yes,scrollbars=yes')">Download Invoice</a>
        
     </div>
     <div>
          
     </div>

</div>
 <?php include 'inc/footer.php' ?>


 

