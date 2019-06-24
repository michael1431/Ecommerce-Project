 <?php
 	$filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php
 

class Userhandle{
    
    // property define korbo class er db and fm class k access korar jonno
    private $db;
    private $fm;

    public function __construct() {
        // constructor e oi property gulo assign kore dibo jate onno jaigai agulo access kora jai
        
        $this->db = new Database();
        $this->fm = new Format();
    }

    // code for show all customer information

    public function CustomerInformation(){

        $query = "SELECT p.*,c.cityName,b.countryName
                FROM tbl_customer as p,tbl_city as c,tbl_country as b
                WHERE p.city = c.cityName AND p.country = b.countryName";
              


    	//$query = "SELECT * FROM tbl_customer";
    	$result = $this->db->select($query);
    	return $result;




    } 


public function activeUserRegistration($cmrId){

     $cmrId = $this->fm->validation($cmrId);/// validation
    $cmrId = mysqli_real_escape_string($this->db->link, $cmrId);

     $query = "UPDATE tbl_customer SET status = '1' WHERE id ='$cmrId'";
           $updated_row = $this->db->update($query);
           if($updated_row){
               
           $msg = "<span class='success'>Activate Successfully!!</span>";
               return $msg;
           }else{
               $msg = "<span class='error'> Not Activated.</span>";
               return $msg;
           }

}




}

?>