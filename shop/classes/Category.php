<?php
    // file er path ta nite hobe age otherwise load hobe na
    $filepath = realpath(dirname(__FILE__));
    
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');

    ///include_once '../helpers/Format.php';

?>

<?php

// category class

class Category {

       // property define korbo class er db and fm class k access korar jonno
    private $db;
    private $fm;

    public function __construct() {
        // constructor e oi property gulo assign kore dibo jate onno jaigai agulo access kora jai
        
        $this->db = new Database();
        $this->fm = new Format();
    }
    
    
    public function categoryInsert($catName){
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link,$catName);
        
        if(empty($catName)){
           
           $msg = "<span class='error'>Category Field Must Not Be Empty</span>";
           // ata jehetu aikane echo korchi na so return kore dite hobe
           return $msg;
           
       }else{
           
           $query = "INSERT into tbl_category(catName) VALUES('$catName')";
           $catResult = $this->db->insert($query);
           if($catResult){
               $msg = "<span class='success'>Category insert Successfully.</span>";
               return $msg;
           }else{
               $msg = "<span class='error'>Category Not Inserted.</span>";
               return $msg;
           }
       }
    }

    //code for show the all category from the db
    public function getAllcat(){
        $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $result = $this->db->select($query);
        return $result;
    }
    
    // id dore category niye astechi
    
    public function getCatById($id){
        $query = "SELECT * FROM tbl_category  WHERE catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    
    // code for update category
    
    public function categoryUpdate($catName,$id){
         $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link,$catName);
        $id = mysqli_real_escape_string($this->db->link,$id);
        
        if(empty($catName)){
           
           $msg = "<span class='error'>Category Field Must Not Be Empty</span>";
           // ata jehetu aikane echo korchi na so return kore dite hobe
           return $msg;
           
       }else{
           
           $query = "UPDATE tbl_category SET catName ='$catName' WHERE catId ='$id'";
           $updated_row = $this->db->update($query);
           if($updated_row){
               
           $msg = "<span class='success'>Category Updated Successfully.</span>";
               return $msg;
           }else{
               $msg = "<span class='error'>Category Not Updated.</span>";
               return $msg;
           }
           
           
       }
    }
    
    public function delCatById($id){
        $query ="DELETE FROM tbl_category WHERE catId ='$id'";
        $delete_row = $this->db->delete($query);
        if($delete_row){
            $msg = "<span class='success'>Category Deleted Successfully.</span>";
               return $msg;
           }else{
               $msg = "<span class='error'>Category Not Deleted.</span>";
               return $msg;
           }
        
    }
}

