
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/Session.php');
Session::init();
include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../helpers/Format.php');

spl_autoload_register(function($class) {
     include_once "classes/" . $class . ".php";   
});

// creat object of all classes

$db = new Database();
$fm = new Format();
$pd = new Product();
$cat = new Category();
$ct = new Cart();
$cmr = new Customer();


?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>
<head>
<title>Store Website</title>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css"/>

<link rel="stylesheet"  href="../css/bootstrap.css">




<script src="../js/jquery-3.2.1.min.js"></script>


<script src="../js/bootstrap.js"></script>


<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>

<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>




</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
                            <img src="images/logo_e.png" alt="" />
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="post">
				    	<input type="text" name="search" placeholder="Enter Product Name">
              <input type="submit" name="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
                                                                    <?php
                                                                    
                                                                    // cart empty kina seta check korte hobe 
                                                                    $getData = $ct->cartCheckTable();
                                                                    
                                                                  // code for show the sum value to cart
                                                                    if($getData){
                                                                    $sum = Session::get("sum");
                                                                    $qty = Session::get("qty");
                                                                    echo "$ ".$sum . " | Qty: ".$qty;
                                                                    }else{
                                                                        echo "(Empty)";
                                                                    }
                                                                  
                                                                    
                                                                    ?>
                                                                    
                                                                    
                                                                 </span>
							</a>
						</div>
			      </div>
                              
                              <?php
                              // code  for logout
                              if(isset($_GET['cmrid'])){
                                  $customerid  = Session::get("customerId"); 
                                  //log out korar sathe sathe amra cart table hote custmer er data gulo muche dibo
                                  $delData = $ct->delCustomerCart();
                                  // log out hole compare table hote sob data delete hoye jabe
                                  $delComp = $pd->delCompareData($customerid);
                                  Session::destroy();
                              }
                              
                              ?>
                              <div class="">
                                  <?php
                                    // jodi login takle logout show korbe otherwise login

                                    $login = Session::get("customerlogin");

                                    if($login == false){ ?>
                                        <a href="login.php" class="btn btn-primary" style="margin-left: 5px;">Login</a>
                                    <?php } else{ ?>
                                         <a href="?cmrid<?php Session::get("customerId");?>" class="btn btn-primary" style="margin-left: 5px;">Logout</a>
                                    <?php } ?>

            
                              </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<!--<div class="">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="topbrands.php">Top Brands</a></li>
	  <li><a href="cart.php">Cart</a></li>
	  <li><a href="contact.php">Contact</a> </li>
	
	</ul>
</div>-->
      <nav class="navbar navbar-inverse">
  <div class="container-fluid">
   
    <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
	  <li><a href="topbrands.php">Top Brands</a></li>
          <?php
          // jodi card e kichu takhe oi customer er tahole cart menu ta show korbe otherwise korbe na
          $checkCart = $ct->cartCheckTable();
          if($checkCart){ ?>
              <li><a href="cart.php">Cart</a></li>
               <li><a href="payment.php">Payment</a></li>
          <?php } ?>
               
               <?php
               // code for order table
               $customerid  = Session::get("customerId"); 
               $chkordertable = $ct->CheckOrderTable($customerid);
               if($chkordertable){ ?>
                       <li><a href="orderdetails.php">Order Details</a></li>
               <?php } ?>
       
           <?php
           // customer login takle show korbe otherwise show korbe na menu ta
           $login = Session::get("customerlogin");
            if($login == true){ ?>
                <li><a href="profile.php">Profile</a></li>
            <?php } ?>
                
                <?php
                // compare table e data takle ata show korbe otherwise korbe na
                    $cmrId  = Session::get("customerId"); 
                    $getpd = $pd->getComparedProduct($cmrId);
                    if ($getpd) {
                    $login = Session::get("customerlogin");
                    if($login == true){
                      ?>
             <li><a href="compare.php">Compare</a> </li>
             
                    <?php } }?>
               <?php
                // wishlist table e data takle ata show korbe otherwise korbe na
                    $cmrId  = Session::get("customerId"); 
                    $getwishlist = $pd->getWishlistData($cmrId);
                    if ($getwishlist) {
                   $login = Session::get("customerlogin");
                    if($login == true){
                      ?>
             <li><a href="wishlist.php">Wishlist</a> </li>
             
                    <?php } } ?>
             <li><a href="contact.php">Contact</a></li>
    </ul>
  </div>
</nav>

      