<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../classes/Cart.php');
$ct = new Cart();
$fm = new Format();
?>

<?php
// code for shifted
if(isset($_GET['orderid'])){ 
    $orderid = $_GET['orderid'];
   $shift = $ct->productShifted($orderid);
    
}

// code for delete the order


if(isset($_GET['delorderid'])){ 
    $delorderid = $_GET['delorderid'];
   $delorder = $ct->productDelete($delorderid);
    
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Order Details</h2>
        <?php
        if(isset($shift)){
            echo $shift;
        }
        if(isset($delorder)){
            echo $delorder;
        }
        
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date & Time</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Cust. ID</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   
                    $getorder = $ct->getAllOrderProduct();
                    if ($getorder) {
                        while ($result = $getorder->fetch_assoc()) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $result['id']; ?></td>
                                <td><?php echo $fm->formatDate($result['date']); ?></td>
                                <td><?php echo $result['productName']; ?></td>
                                <td><?php echo $result['quantity']; ?></td>
                                <td><?php echo $result['price']; ?></td>
                                <td><?php echo $result['cmrid']; ?></td>
                                <td>
                                    <a href="viewcustomer.php?custId=<?php echo $result['cmrid']; ?>">View Details</a>
                                </td>
                                <?php
                                if($result['status'] == '0'){ ?>
                                <td><a href="?orderid=<?php echo $result['id']; ?>">Shifted</a></td>
                                    
                                 <?php  } elseif($result['status'] == '1') { ?>
                                <td>Pending</td>
                                 <?php } else{ ?>
                                <td><a href="?delorderid=<?php echo $result['id']; ?>">Remove</a></td>
                                <?php } ?>       
                            </tr>
                        <?php } } ?>
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
<?php include 'inc/footer.php'; ?>
