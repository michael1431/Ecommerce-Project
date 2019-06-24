<?php
    // file er path ta nite hobe age otherwise load hobe na
    $filepath = realpath(dirname(__FILE__));
    
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');

    ///include_once '../helpers/Format.php';

?>

<?php

class Cart{
    
    private $db;
    private $fm;

    public function __construct() {

        $this->db = new Database(); ///obj create
        $this->fm = new Format();   ///obj create
    }
    
    // code for add to cart
    
    public function addToCart($quantity,$id){
        
        $quantity = $this->fm->validation($quantity);/// validation
        $quantity = mysqli_real_escape_string($this->db->link, $quantity); // sanitise the quantity
        $productId = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();
        
        // baki field gulo product table hote niye asbo
        
      $squery = " SELECT * FROM tbl_product WHERE productId = '$productId' ";
      $result = $this->db->select($squery)->fetch_assoc();
    
     
      $productName = $result['productName'];
      $price = $result['price'];
      $image = $result['image'];
      
      // kono product jate duibar insert na hoi tar jonno insert er age akta query chalabo
      
      $checkQuery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sessionId = '$sId' ";
      $checkpro = $this->db->select($checkQuery);
      if($checkpro){
          $msg = "Product already added!!";
          return $msg;
      }else{
      
    
      // Then insert all the field
   
    $query = "INSERT INTO tbl_cart(sessionId, productId, productName, price, quantity, image) VALUES('$sId', '$productId', '$productName', '$price', '$quantity', '$image')"; 
                    $pdinsert = $this->db->insert($query);
                        if($pdinsert){
                          
                          header("Location:cart.php");
                       }else{
                         header("Location:NotFound.php");
                       }
      }
        
    }
    
    
    // show all the order product from cart table
    
    public function getCartProduct(){
        
         $sId = session_id();
         
      // sessionid unique so ata dore baki gulo niye asbo
      // browser er ak akta session id binno takhe
         
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sId'";
        $result = $this->db->select($query);
        return $result;
        
    }

    
    
    // code for update cart
    
   public function  updateCartQuantity($cartId,$quantity){
        $cartId = $this->fm->validation($cartId);
        $quantity = $this->fm->validation($quantity);
        $cartId = mysqli_real_escape_string($this->db->link,$cartId);
        $quantity = mysqli_real_escape_string($this->db->link,$quantity);
        
          $query = "UPDATE tbl_cart SET quantity ='$quantity' WHERE cartId ='$cartId'";
           $updated_row = $this->db->update($query);
           if($updated_row){
               
                header("Location:cart.php");
          
           }else{
               $msg = "<span class='error'>Quantity Not Updated.</span>";
               return $msg;
           }
           
        
       
   }
   
   // code for delete cart
   
   public function delProductById($delId){
       
        $delId = mysqli_real_escape_string($this->db->link,$delId);
       
       $query ="DELETE FROM tbl_cart WHERE cartId ='$delId'";
        $delete_row = $this->db->delete($query);
        if($delete_row){
           echo "<script>window.location = 'cart.php';</script>";
           }else{
               $msg = "<span class='error'>Product Not Deleted.</span>";
               return $msg;
           }
        
   }
   
   // code for check card empty or not
   public function cartCheckTable(){
       
         $sId = session_id();
         
      // sessionid unique so ata dore baki gulo niye asbo
      // browser er ak akta session id binno takhe
         
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sId'";
        $result = $this->db->select($query);
        return $result;
       
   }
   
   // code for delete card data individual users
   public function  delCustomerCart(){
        $sId = session_id();
        $query = "DELETE  FROM tbl_cart WHERE sessionId = '$sId'";
        $this->db->delete($query);
   }
   
   // code for insert the product to order table
   
   public function orderProduct($cmrid){
      
         $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sId'";
        $getpro = $this->db->select($query);
        if($getpro){
            while($result = $getpro->fetch_assoc()){
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $result['quantity'];
                $image = $result['image'];
                $query = "INSERT INTO tbl_order(cmrid, productId, productName,quantity,price,image) VALUES('$cmrid', '$productId', '$productName','$quantity','$price','$image')"; 
                $inserted_row = $this->db->insert($query);
            }
        }
        
   }
   
   // code for payable amount 
   public function payableAmount($customerid){
       // select queryr maddome just individaul customer er price ta  niye asbo
         $query = "SELECT price FROM tbl_order WHERE cmrid = '$customerid' AND date = now()";
        $result = $this->db->select($query);
        return $result;
        
   }
   
   // code for show the order details
   
   public function getOrderProduct($customerid){
        $query = "SELECT * FROM tbl_order WHERE cmrid = '$customerid' ORDER BY date DESC";
        $result = $this->db->select($query);
        return $result;
        
   }
   
   // code for check order table 
   public function CheckOrderTable($customerid){
        $query = "SELECT * FROM tbl_order WHERE cmrid = '$customerid'";
        $result = $this->db->select($query);
        return $result;
   }
    
    // show all ordererd product to admin 
   public function getAllOrderProduct(){
       // sob ordered data niye asbo
         $query = "SELECT * FROM tbl_order ";
        $result = $this->db->select($query);
        return $result;
   }
   
   // code for shift the product
  public function productShifted($orderid){
       
        $orderid = mysqli_real_escape_string($this->db->link,$orderid);
     
        $query = "UPDATE tbl_order SET status = '1' WHERE id ='$orderid'";
           $updated_row = $this->db->update($query);
           if($updated_row){
               
           $msg = "<span class='success'>Updated Successfully.</span>";
               return $msg;
           }else{
               $msg = "<span class='error'> Not Updated.</span>";
               return $msg;
           }
  }
  // code for remove  the order
  public function productDelete($delorderid){
      
       $delorderid = mysqli_real_escape_string($this->db->link,$delorderid);
     
        $query ="DELETE FROM tbl_order WHERE id ='$delorderid'";
        $delete_row = $this->db->delete($query);
        if($delete_row){
           $msg = "<span class='success'>Data Deleted Successfully.</span>";
               return $msg;
           }else{
               $msg = "<span class='error'>Data Not Deleted.</span>";
               return $msg;
           }
        
  }
  
  // code for confirm order by user
  public function productConfirm($confirm){
  
       
        $confirmid = mysqli_real_escape_string($this->db->link,$confirm);
     
        $query = "UPDATE tbl_order SET status = '2' WHERE id ='$confirmid'";
           $updated_row = $this->db->update($query);
           if($updated_row){
               
           //$msg = "<span class='success'>Updated Successfully.</span>";
             //  return $msg;
           }else{
               $msg = "<span class='error'> Not Updated.</span>";
               return $msg;
           }
  }
}
