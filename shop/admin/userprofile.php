<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
//include_once ($filepath . '/../lib/Database.php');
include_once ($filepath . '/../classes/Customer.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php
$cmr = new Customer();
$db  = new Database();
$fm  = new Format();
?>
<?php
if(isset($_POST['cust_active'])){
    $cust_active = $_POST['cust_active'];
     $query = "UPDATE tbl_customer
               SET    
               status    = 1 
               WHERE id  = '$cust_active'";
     $customerupdate = $db->update($query);
}

if(isset($_POST['cust_deactive'])){
     
    $cust_deactive = $_POST['cust_deactive'];
     $query = "UPDATE tbl_customer
               SET    
               status    = 0
               WHERE id  = '$cust_deactive'";
     $customerupdate = $db->update($query);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Customer Records</h2>
        <div class="block"> 
            <?php
           
            ?>
            <table class="data display datatable table table-striped table-condensed table-bordered" id="example">
                        <thead>
                               <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Addess</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>Zip</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                        </thead>
                            <tbody>
                                <?php
                                $getAllCust = $cmr->getAllCustomers();
                                if($getAllCust){
                                        $i=0;
                                    while($result = $getAllCust->fetch_assoc()){
                                            $i++;
                                            ?>
                                    <tr class="">
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $result['name'];?></td>
                                            <td><?php echo $result['address'];?></td>
                                            <td><?php echo $result['countryName'];?></td>
                                            <td><?php echo $result['cityName'];?></td>
                                            <td><?php echo $result['zip'];?></td>
                                            <td><?php echo $result['phone'];?></td>
                                            <td><?php echo $result['email'];?></td>
                                            <?php if($result['status']==0){ ?>
                                            
                                            <td><form action="userprofile.php" method="post">
                                                   <input type="hidden" value="<?php echo $result['id'] ; ?> " name="cust_active"/>
                                                   <input type="submit" class="btn btn-primary" value="DeActive"/>
                                               </form></td>
                                            
                                            <?php } else{?>    
                                            
                                               <td><form action="userprofile.php" method="post">
                                                      <input type="hidden" value="<?php echo $result['id']; ?> " name="cust_deactive"/>
                                                      <input type="submit" class="btn btn-success" value="Active"/>
                                                  </form></td>
                                                  
                                              <?php } ?>

                                    </tr>
                                <?php } }?>
                            </tbody>
                        </table>
       </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';


