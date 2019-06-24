<?php
    // file er path ta nite hobe age otherwise load hobe na
    $filepath = realpath(dirname(__FILE__));
    
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');

    ///include_once '../helpers/Format.php';

?>

<?php
class Brand{

       // property define korbo class er db and fm class k access korar jonno
    private $db;
    private $fm;

    public function __construct() {
        // constructor e oi property gulo assign kore dibo jate onno jaigai agulo access kora jai
        
        $this->db = new Database();
        $this->fm = new Format();
    }
    
    
    // code for insert brand
    public function brandInsert($brandName){
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link,$brandName);
        
        if(empty($brandName)){
           
           $msg = "<span class='error'>Brand Field Must Not Be Empty</span>";
           // ata jehetu aikane echo korchi na so return kore dite hobe
           return $msg;
           
       }else{
           
           $query = "INSERT into tbl_brand(brandName) VALUES('$brandName')";
           $brandResult = $this->db->insert($query);
           if($brandResult){
               $msg = "<span class='success'>Brand Name inserted Successfully.</span>";
               return $msg;
           }else{
               $msg = "<span class='error'>Brand Name Not Inserted.</span>";
               return $msg;
           }
       }
    }
    
    
      //code for fetch all the brand name by their brand Id  for show the list of brand
    public function getAllbrand(){
        $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
        $result = $this->db->select($query);
        return $result;
    }
    
    // id dore brand niye astechi edit er jonno
    
    public function getBrandById($id){
        $query = "SELECT * FROM tbl_brand  WHERE brandId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    
    // code for update category
    
    public function brandUpdate($brandName,$id){
         $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link,$brandName);
        $id = mysqli_real_escape_string($this->db->link,$id);
        
        if(empty($brandName)){
           
           $msg = "<span class='error'>Brand Field Must Not Be Empty</span>";
           // ata jehetu aikane echo korchi na so return kore dite hobe
           return $msg;
           
       }else{
           
           $query = "UPDATE tbl_brand SET brandName ='$brandName' WHERE brandId ='$id'";
           $updated_row = $this->db->update($query);
           if($updated_row){
               
           $msg = "<span class='success'>Brand Name Updated Successfully.</span>";
               return $msg;
           }else{
               $msg = "<span class='error'>Brand Name  Not Updated.</span>";
               return $msg;
           }
           
           
       }
    }
    
    
       public function delBrandById($id){
        $query ="DELETE FROM tbl_brand WHERE brandId ='$id'";
        $delete_row = $this->db->delete($query);
        if($delete_row){
            $msg = "<span class='success'>Brand Deleted Successfully.</span>";
               return $msg;
           }else{
               $msg = "<span class='error'>Brand Not Deleted.</span>";
               return $msg;
           }
        
    }
    
    
    

}
?>
