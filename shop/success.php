<?php include 'inc/header.php' ?>
<?php
// jodi login na takhe tahole login page e redirect kore dibo

$login = Session::get("customerlogin");

if($login == false){
    header("Location:login.php");
}

?>
<style>
    .psuccess{width: 500px; min-height: 200px; text-align: center; border:1px solid #ddd; margin: 0 auto; padding: 50px;}
    .psuccess h2{border-bottom: 1px solid #ddd; margin-bottom: 20px; padding-bottom: 10px;}
    .psuccess p{ line-height: 25px; text-align: left; font-size: 18px;}
    
</style>   

 <div class="main">
    <div class="content">
        <div class="section group">
          
            <div class ="psuccess">
                <h2>Success</h2>
                <?php
                // customer id from tbl_customer table
                $customerid  = Session::get("customerId"); 
                $amount = $ct->payableAmount($customerid);         
                if($amount){
                       $sum = 0;                     
                        while($result=$amount->fetch_assoc()){
                        $price = $result['price'];
                        $sum   = $sum+$price;
                   }
                ?>               
                <p style="color:red">Total Payable Account(Including Vat) :
                    <?php
                    $vat   = $sum*0.1;
                    $total = $sum+$vat;
                    echo '$'.$total;}                 
                    ?>
                </p>
                <p>Thanks for purchase.Receive your order successfully.We will contact you ASAP
                    with delivery details.Here is your order details...<a href="orderdetails.php">
                    Visit Here..</a>
                </p>
            </div>  
    </div>
 </div>
</div>
 <?php include 'inc/footer.php' ?>
 

