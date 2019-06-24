
<?php 
require 'inc/header.php';
?>
<?php
// code for show the details of product

if (!isset($_GET['proid']) OR $_GET['proid'] == NULL) {
    echo "<script>window.location = 'NotFound.php';</script>";
} else {

    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
}
// code for add to card
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $quantity = $_POST['quantity'];
    //cart class er object er maddome dortechi 

    $addCart = $ct->addToCart($quantity, $id);
}
?>

 <?php
// code for product compare 
 $cmrid = Session::get("customerId");
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])){
    $productId = $_POST['productId'];
    $insertCompare= $pd->insertCompareData( $cmrid,$productId);
    
}
?>
 <?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])){
    // product id uporer code hote and cmr id header file hote niye asbo
    $insertwishlist= $pd->insertWishlistData($customerid ,$id);
    
}
?>

   <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css"/>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="jquery-bar-rating-master/dist/themes/fontawesome-stars.css" rel="stylesheet" type="text/css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="jquery-bar-rating-master/dist/jquery.barrating.min.js" type="text/javascript"></script>

    <script type="text/javascript">
    $(function(){
            $('.rating').barrating({
                theme: 'fontawesome-stars',
                onSelect: function(value, text, event){
                    // Get element id by data-id attribute
                    var el = this;
                    var el_id = el.$elem.data('id');
                    // rating was selected by a user
                    if(typeof(event)!=='undefined'){
                        
                        var split_id  = el_id.split("_");
                        
                        var productId = split_id[1];  // productId
                        // AJAX Request
                        $.ajax({
                             url: 'rating_ajaxData.php',
                            type: 'post',
                            data: {productId:productId,rating:value},
                            dataType: 'json',
                            success: function(data){
                                // Update average
                                var average=data['averageRating'];
                                $('#avgrating_'+productId).text(average);
                            }
                        });
                    }
                }
            });
        });
</script>

<style>
  .success{font-size: 22px; color:green;}
  .error{font-size: 22px; color:red;}
  .mybutton{width:100px; float:left; margin-right: 30px;}
</style>





<div class="main">
    <div class="content">
        <div class="section group">
            <div class="cont-desc span_1_of_2">

<?php
// id dore product show korbo details e
$getPd = $pd->getSingleProduct($id);

if ($getPd) {
    while ($result = $getPd->fetch_assoc()) {
        ?>
                        <div class="grid images_3_of_2">
                            <img src="admin/<?php echo $result ['image'] ?>" alt="" />
                        </div>
                        <div class="desc span_3_of_2">
                            <h2><?php echo $result ['productName'] ?> </h2>

                            <div class="price">
                                <p>Price: <span>$<?php echo $result ['price'] ?></span></p>
                                <p>Category: <span><?php echo $result ['catName'] ?></span></p>
                                <p>Brand:<span><?php echo $result ['brandName'] ?></span></p>
                            </div>


                              <?php
                               // User rating part start
                               $login = Session::get("customerId");                              
                               // if user is logged in,then rating will visible using session
                               if($login==TRUE){
                               $productId  = $result['productId'];
                               // get rating
                               $rating = $cmr->getRating($productId,$login); // fetch rating data
                                      
                               // get average
                               $averageRating = $cmr->avgRating($productId); // fetch avg rating data
                               if($averageRating <= 0){
                                  $averageRating = "No rating yet.";
                                  }
                                  
                               // check rating
                                 $checkQuery = $cmr->checkUserRating($productId,$login); // chech if user already rated
                                  
                                    ?>
                                  <div class="rate">
                                     <!-- Rating -->
                                    <select class="rating" id="rating_<?php echo $result['productId']; ?>" data-id="rating_<?php echo $result['productId']; ?>">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                   
                                 
                                     Average Rating : <span id="avgrating_<?php echo $result['productId']; ?>"><?php echo $averageRating;?></span><br>
                                    
                                     <?php if(isset($checkQuery)){?>
                                    <span class="" style="color: red; font-size: 18px;"><?php echo $checkQuery;
                                    }?></span>
                                    <!-- Set rating -->
                                    <script type='text/javascript'>
                                    $(document).ready(function(){
                                    $('#rating_<?php echo $result['productId'];?>').barrating('set',<?php echo $rating;?>);
                                   });
                            
                                    </script>
                                  </div>
                                  <?php }?>
                          
                               
                        <?php
                                $login = Session::get("customerlogin");
                             if($login == true){ ?>
                            <div class="add-cart">
                                <form action="" method="post">
                                    <input type="number" class="buyfield" name="quantity" value="1"/>
                                    <input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
                                </form>             
                            </div>
                           <?php }  ?>
                             

                            <span style="color:red; font-size: 18px;">
                              <?php
        // show the msg if product already added
                        if (isset($addCart)) {
                        echo $addCart;
                           }
    
                        ?>

                            </span>
                            
                            <?php
                          
                            if(isset($insertCompare)){
                                echo $insertCompare;
                            }
                            if(isset($insertwishlist)){
                                echo $insertwishlist;
                            }
                            
                            ?>
                           <?php

                             $login = Session::get("customerlogin");
                             if($login == true){ ?>

                            <div class="add-cart">
                                <div class="mybutton">
                                <form action="" method="post">
                                     <input type="hidden" class="buysubmit" name="productId" value="<?php echo $result['productId'];?>"/>
                                    <input type="submit" class="buysubmit" name="compare" value="Add to compare"/>
                                    
                                </form>
                                </div>
                                <div class="mybutton">
                                <form action="" method="post">
                                     
                                    <input type="submit" class="buysubmit" name="wishlist" value="Save To Wishlist"/>
                                    
                                </form>
                                </div>

                            </div>
                        <?php } ?>
                           
                        </div>
                        <div class="product-desc">
                            <h2>Product Details</h2>
                            <?php echo $result ['body']; ?>

                        </div>

    <?php } } ?>

            </div>
            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul>
<?php
// code for show the categories
$getCategory = $cat->getAllcat();
if ($getCategory) {
    while ($result = $getCategory->fetch_assoc()) {
        ?>

                            <li><a href="productbycat.php?catid=<?php echo $result['catId']; ?>"><?php echo $result['catName'] ?></a></li>

    <?php }
} ?>


                </ul>

            </div>
        </div>
    </div>
</div>
<?php include 'inc/footer.php' ?>
