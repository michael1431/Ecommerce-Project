<?php include 'inc/header.php' ?>
<?php
// jodi login na takhe tahole login page e redirect kore dibo

$login = Session::get("customerlogin");

if ($login == false) {
    header("Location:login.php");
}
?>
<?php

// code for confirmation order
if(isset($_GET['confirmid'])){ 
    $confirm   =  $_GET['confirmid'];
   $conmsg = $ct->productConfirm($confirm);
    
}

?>
<style>
    .tblone tr td{ text-align: center;}
</style>
<div class="main">
    <div class="content">
        <div class="section group">

            <div class="order">

                <h2>Your Order Details Page</h2>
               
               
                <table class="tblone">
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                    </tr>
                    <?php
                    // code for show the  order product from cart tablle 
                     $customerid  = Session::get("customerId"); 
                    $getorder = $ct->getOrderProduct($customerid);
                    if ($getorder) {
                        $i = 0;
                        while ($result = $getorder->fetch_assoc()) {
                            $i++;
                            ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['id'] ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
                                <td><?php echo $result['quantity']; ?></td>
                                <td><?php echo $result['price'];?></td>
                                <td><?php echo $fm->formatDate($result['date']); ?></td>
                                <td>
                                    <?php
                                    if($result['status'] == '0'){
                                        echo "Pending";
                                    }elseif($result['status'] == '1'){
                                        echo "Shifted";
                                   }else{ 
                                        echo "OK";
                                    } ?>
                                </td>
                                 
                                     <?php
                                       if($result['status']=='1'){ ?>
                                <td><a href="?confirmid=<?php echo $result['id']; ?>">Confirm</a></td>
                                       
                                      <?php } elseif($result['status']=='2'){ ?>
                                        <td>OK</td>
                                      <?php }elseif($result['status']=='0'){  ?>
                                         <td>N/A</td>
                                      <?php } ?>
                                    
                            </tr>
                                     
                        <?php } } ?>	
                </table>

            </div> 

        </div>	
        <div class="clear"></div>
    </div>
</div>
</div>
<?php include 'inc/footer.php' ?>
  

