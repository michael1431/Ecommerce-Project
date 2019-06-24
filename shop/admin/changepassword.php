<?php
session_start();
if(!isset($_SESSION['adminlogin'])){
header("Location: login.php");
}else{
 include 'inc/header.php';
 include 'inc/sidebar.php';
 include '../lib/Database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
       $db = new Database();
       $oldpass = md5($_POST['oldpass']);
       $newpass = md5($_POST['newpass']);
       
       $chkquery = "SELECT * FROM tbl_admin WHERE adminPass ='$oldpass'";
       $result = $db->select($chkquery);
       if($result){
        while($value = $result->fetch_assoc()){
          $adminId = $value['adminId'];
        }
          $query = "UPDATE tbl_admin SET adminPass = '$newpass' WHERE adminId = '$adminId'";
          $pass = $db->update($query);
          if($pass){

            echo"<span style='color:red;font-size:18px;'>Password Updated Successfully !!</span>";

        
          }else{
            echo "<span style='color:red;font-size:18px;'>Password Not Updated!!</span>";


          }


       }else{
        echo "<span style='color:red;font-size:18px;'>Your Entered a Wrong Old Password !!</span>";
        
       }


    }
    

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">

         <?php
            if(isset($updatedPass)){
                echo $updatedPass;
            }
            ?>              
         <form action="" method="post">
            <table class="form">                    
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="oldpass" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="newpass" class="medium" />
                    </td>
                </tr>
                 
                
                 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="save" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; }?>