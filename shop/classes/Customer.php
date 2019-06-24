<?php
    // file er path ta nite hobe age otherwise load hobe na
    $filepath = realpath(dirname(__FILE__));
    
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');

    ///include_once '../helpers/Format.php';

?>

<?php


class Customer{
    
    private $db;
    private $fm;

    public function __construct() {

        $this->db = new Database(); ///obj create
        $this->fm = new Format();   ///obj create
    }

    // code for show all the country

     public function getAllCountry() {

        $query = "SELECT * FROM tbl_country";
        $result = $this->db->select($query);

        return $result;
    }

    // show all city
     public function getAllCity() {
//        
        $query = "SELECT * FROM tbl_city";
        $result = $this->db->select($query);
        return $result;
    }

    // code for show city by country id 
      public function getallareabycityid($cityId){
        $cityId = $this->fm->validation($cityId);
        $cityId = mysqli_real_escape_string($this->db->link,$cityId);
        $query  = "SELECT * FROM tbl_city WHERE country_id = '$cityId'";
        $result = $this->db->select($query);
       
        return $result;
    }
    
    // code for customer registration
    
    public function customerRegistration($data){
        
          $name        = $this->fm->validation($data['name']);/// validation
          $address        = $this->fm->validation($data['address']);/// validation
          $c_city        = $this->fm->validation($data['c_city']);/// validation
          $c_country       = $this->fm->validation($data['c_country']);/// validation
          $zip        = $this->fm->validation($data['zip']);/// validation
          $phone        = $this->fm->validation($data['phone']);/// validation
          $email        = $this->fm->validation($data['email']);/// validation
          $password        = $this->fm->validation($data['password']);/// validation
          
        $name = mysqli_real_escape_string($this->db->link, $data['name']); 
        $address = mysqli_real_escape_string($this->db->link, $data['address']); 
        $c_city = mysqli_real_escape_string($this->db->link, $data['c_city']); 
        $c_country = mysqli_real_escape_string($this->db->link, $data['c_country']); 
        $zip = mysqli_real_escape_string($this->db->link, $data['zip']); 
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']); 
        $email = mysqli_real_escape_string($this->db->link, $data['email']); 
        $password = mysqli_real_escape_string($this->db->link, md5($data['password'])); 
        
        if($name==""||$address==""||$c_city==""||$c_country==""||$zip==""||$phone==""||$email==""||$password=="")
                 {
                
                  $msg = "<span class = 'error'>Fields must not be empty</span>";
                  return $msg;
               
                 }
            // check email. 1ti email 1 bar insert hobe duibar takle insert nibe na
                 
            $mailquery = "SELECT * FROM tbl_customer WHERE email ='$email' LIMIT 1";
            $chkemail = $this->db->select($mailquery);
            if($chkemail){
                $msg = "<span class = 'error'>Email Already Exist!!!</span>";
                  return $msg;
            }else{
                    $query = "INSERT INTO tbl_customer(name,address,city,country,zip,phone,email,password) VALUES('$name','$address','$c_city','$c_country','$zip','$phone','$email','$password')"; 
                    $result = $this->db->insert($query);
                        if($result){
                          
                           $msg = "<span class='success'>Registration Completed successfully</span>";
                           return $msg;
                       }else{
                           $msg = "<span class = 'error'>Customer Data Not Inserted</span>";
                           return $msg;
                       }   
                     
                 }
        
    }
    
 // code for customer login
  
    public function CustomerLogIn($data){
        
         $email        = $this->fm->validation($data['email']);
         $password    = $this->fm->validation($data['password']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']); 
        $password = mysqli_real_escape_string($this->db->link, md5($data['password'])); 
        if(empty($email)|| empty($password)){
            $msg = "<span class = 'error'>Fields must not be empty</span>";
                  return $msg;
        }
        
        $query ="SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
        $result = $this->db->select($query);
        if($result != false){
                $value = $result->fetch_assoc();
                if($value['status']==0){
                $msg = "<span style='color:red;font-weight:bold'>Currently Your Account has been disabled!!!</span>";
                return $msg;
                }else{


            // session diye dorbo next kaj e agulo lagbe tai
            Session::set("customerlogin",true);
            Session::set("customerId", $value['id']);
            Session::set("customerName", $value['name']);
            header("Location:orderdetails.php");
            
        }
      }else{
            $msg = "<span class = 'error'>Email Or Password Not Matched!!</span>";
                  return $msg; 
        }
         
          
    }


     public function getAllCustomers(){
        
     $query = "SELECT cust.*,c.countryName,a.cityName
               FROM tbl_customer as cust,tbl_country as c,tbl_city as a
               WHERE cust.country = c.country_id AND cust.city = a.city_id";
        // merge two more table in customer table
        $result = $this->db->select($query);
        return $result;   
        
    }
    
    // show customer profile individually
    public function customerData($id){
        $query = "SELECT cust.*,c.countryName,ci.cityName
                  FROM tbl_customer as cust,tbl_country as c,tbl_city as ci
                  WHERE cust.country = c.country_id AND cust.city = ci.city_id
                  AND id = '$id'";
        // merge two more table in customer table by id
        $result = $this->db->select($query);
        return $result;
    }
    
    // code for updating customer profile
    public function CustomerUpdate($data,$cmrid){
          $name        = $this->fm->validation($data['name']);/// validation
          $phone        = $this->fm->validation($data['phone']);
          $email        = $this->fm->validation($data['email']);
          $address        = $this->fm->validation($data['address']);/// validation
          $city        = $this->fm->validation($data['city']);
          $zip        = $this->fm->validation($data['zip']);
          $country        = $this->fm->validation($data['country']);/// validation
         
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']); 
        $email = mysqli_real_escape_string($this->db->link, $data['email']);  
        $address = mysqli_real_escape_string($this->db->link, $data['address']); 
        $city = mysqli_real_escape_string($this->db->link, $data['city']); 
        $zip = mysqli_real_escape_string($this->db->link, $data['zip']); 
       $country = mysqli_real_escape_string($this->db->link, $data['country']);
        
     
        
         if($name==""||$address==""||$city==""||$country==""||$zip==""||$phone==""||$email=="")
                 {
                
                  $msg = "<span class = 'error'>Fields must not be empty</span>";
                  return $msg;
               
                 }else{
                    $query = "UPDATE tbl_customer SET
                            name ='$name',
                            address='$address',
                            city ='$city',
                            country ='$country',
                            zip ='$zip',
                            phone ='$phone',
                            email ='$email'
                            WHERE id ='$cmrid'";
           $updated_row = $this->db->update($query);
           if($updated_row){
               
           $msg = "<span class='success'>Profile Updated Successfully.</span>";
               return $msg;
           }else{
               $msg = "<span class='error'>Profile Not Updated.</span>";
               return $msg;
           }
             
                     
                     
                 }
    }



     public function processRatingByUser($cmrId,$productid,$rating){
     
        $cmrId     = $this->fm->validation($cmrId);     // validation
        $productid = $this->fm->validation($productid); // validation
        $rating    = $this->fm->validation($rating);    // validation
        
        $cmrId     = mysqli_real_escape_string($this->db->link, $cmrId);
        $productid = mysqli_real_escape_string($this->db->link, $productid);
        $rating    = mysqli_real_escape_string($this->db->link, $rating);
        
        $query     = "SELECT COUNT(*) AS cntproduct FROM tbl_rating WHERE cmrid = '$cmrId' AND productId = '$productid'";
        $result    =  $this->db->select($query)->fetch_assoc();
           
        $count = $result['cntproduct'];
       
        if($count==0){
            $insertquery  = "INSERT INTO tbl_rating(cmrid,productId,rating) VALUES('$cmrId','$productid','$rating')";
            $ratingInsert = $this->db->insert($insertquery);
                       
            }else{
                $updtquery    = "UPDATE tbl_rating
                                 SET    
                                 rating       = '$rating' 
                                 WHERE cmrid  = '$cmrId' AND productId = '$productid'";
                $ratingupdate = $this->db->update($updtquery);
             
            }                   
    }
    
    public function getRating($productId,$login){
        $query      = "SELECT * FROM tbl_rating WHERE productId='$productId' AND cmrid='$login'";
        $result = $this->db->select($query);       
        if($result){
            while($getresult = $result->fetch_assoc()){ 
               $rating = $getresult['rating'];
               return $rating;
            }
        }        
    }
    public function avgRating($productId){
           $query      = "SELECT ROUND(AVG(rating),1) as averageRating FROM tbl_rating WHERE productId='$productId'";
           $getresult  = $this->db->select($query);
            if($getresult){
                    while($result = $getresult->fetch_assoc()){
                        $averageRating = $result['averageRating'];
                        return $averageRating;

                    } 
            }
          
    }
    
    public function checkUserRating($productId,$login) {
        $query      = "SELECT * FROM tbl_rating WHERE productId='$productId' AND cmrid='$login'";
        $check = $this->db->select($query);
        if($check){
            $msg = 'You have already rated this product !';
            return $msg;
        }
    }

    

  

  
    
}
