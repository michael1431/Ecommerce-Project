<?php
ob_start();
?>
<?php include 'inc/header.php' ?>
<?php
//code for delete
if (isset($_GET['delpro'])) {

    $delId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delpro']);
    $delProduct = $ct->delProductById($delId);
}
?>
<?php
// code for cart update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    //cart class er object er maddome dortechi 

    $updateCart = $ct->updateCartQuantity($cartId, $quantity);

    // code for negative value quantity

    if ($quantity <= 0) {
        $delProduct = $ct->delProductById($cartId);
    }
}
?>
<?php
// code for reload the page to get the session
if (!isset($_GET['id'])) {
    // refresh the page, here we can use other value instead of id,it's not compulsory
    echo "<meta http-equiv= 'refresh' content ='0;URL =?id=michael' />";
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
                <h2>Your Cart</h2>
                <?php
                if (isset($updateCart)) {
                    echo $updateCart;
                }
                if (isset($delProduct)) {
                    echo $delProduct;
                }
                ?>
                <table class="tblone">
                    <tr>
                        <th width="5%">Serial No</th>
                        <th width="30%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="10%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="15%">Total Price</th>
                        <th width="5%">Action</th>
                    </tr>
                    <?php
                    // code for show the  order product from cart tablle 
                    $getpro = $ct->getCartProduct();
                    if ($getpro) {
                        $i = 0;
                        // create a variable for sum
                        $sum = 0;
                        $qty = 0;
                        while ($result = $getpro->fetch_assoc()) {
                            $i++;
                            ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
                                <td>$<?php echo $result['price'] ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
                                        <input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
                                        <input type="submit" name="submit" value="Update"/>
                                    </form>
                                </td>
                                <td>$<?php
                                    $total = $result['price'] * $result['quantity'];

                                    echo $total;
                                    ?> 
                                </td>
                                <td>
                                    <a onclick="return confirm('Are You Sure TO Delete?');
                                       " href="?delpro=<?php echo $result['cartId']; ?>">X</a>
                                </td>
                            </tr>
                            <?php
                            $sum = $sum + $total;
                            //show the quantity also to the cart
                            $qty = $qty + $result['quantity'];
                            // code for show the cart with sum value 
                            Session::set("sum", $sum);
                            Session::set("qty", $qty);
                            ?>
                        <?php }
                    } ?>	
                </table>
                <?php
                $getData = $ct->cartCheckTable();
                if ($getData) {
                    ?>   
                    <table style="float:right;text-align:left;" width="40%">
                        <tr>
                            <th>Sub Total : </th>
                            <td>$<?php echo $sum; ?></td>
                        </tr>
                        <tr>
                            <th>VAT : </th>
                            <td>10%</td>
                        </tr>
                        <tr>
                            <th>Grand Total :</th>
                            <td>$
                                <?php
                                $vat = $sum * 0.1;
                                $grandtotal = $sum + $vat;
                                echo $grandtotal;
                                ?>
                            </td>
                        </tr>            
                    </table>
                <?php
                } else {
                    header("Location:index.php");
                    ob_en_fluch();
                }
                ?>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>  	
        <div class="clear"></div>
    </div>
</div>
</div>
<?php include 'inc/footer.php' ?>
  