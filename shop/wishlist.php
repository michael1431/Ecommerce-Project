<?php include 'inc/header.php' ?>
<?php

$login = Session::get("customerlogin");
if($login == false){
    header("Location:login.php");
}

?>
<?php
// Code For Delete Wishlist
if(isset($_GET['delwishlist'])){
    $productId = $_GET['delwishlist'];
    $delwishlist = $pd->delWishlistData($customerid,$productId);
    
}

?>
<div class="main">
    <style>       
        .success{font-size: 18px; color:green;}
        .error{font-size: 18px; color:red;}
    </style>  
    <div class="content">
        <div class="cartoption">		
            <div class="cartpage">
                <h2>Wishlist</h2>
                <table class="tblone">
                    <tr>
                        <th>Serial No</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    // code for show the wishlist product from wislist table 
                    $cmrId  = Session::get("customerId"); 
                    $getwish = $pd->getWishlistData($cmrId);
                    if ($getwish) {
                        $i = 0;
                        while ($result = $getwish->fetch_assoc()) {
                            $i++;
                            ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                 <td>$<?php echo $result['price'] ?></td>
                                 <td><img style="height:90px; width: 100px;" src="admin/<?php echo $result['image']; ?>"  alt=""/></td>
                                <td>
                                    <a href="details.php?proid=<?php echo $result['productId']; ?>">Buy Now</a> ||
                                    <a href="?delwishlist=<?php echo $result['productId']; ?>">Remove</a>
                                </td>
                               
                               
                            </tr>
                           
                        <?php }  } ?>	
                </table>
            </div>
            <div class="shopping">
                <div class="shopleft" style="width:100%; text-align: center;">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                
            </div>
        </div>  	
        <div class="clear"></div>
    </div>
</div>
</div>
<?php include 'inc/footer.php' ?>
  
