<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php'; ?>
<?php include_once '../helpers/Format.php'; ?>
<?php

$pd = new Product();
$fm = new Format();

// code for delete the product

if(isset($_GET['delpro'])){
    
    //$id = $_GET['delcat'];
    // id ta k preg replace kore nilam jate _,digit and letter o allow kore, mysqli_real_escape_string
    // use koreo kora jabe
    $id = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['delpro']);
    $delPro = $pd->delProById($id);
    
    
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">
            
            <?php 
                    // show the delete msg
                    if(isset($delPro)){
                        echo $delPro;
                    }
                    ?>
            <table class="data display datatable" id="example">
			<thead>
                            
				<tr>
					<th>Serial No</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Type</th>
					<th>Action</th>
				</tr>
                                
                           
			</thead>
			<tbody>
                            <?php
                            $getpd = $pd->getAllProduct();
                            if($getpd){
                                $i = 0;
                                while($result = $getpd->fetch_assoc()){
                                   $i++;
                            
                            ?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['productName'] ;?></td>
					<td><?php echo $result['catName'] ;?></td>
                                         <td><?php echo $result['brandName'] ;?></td>
                                         <td><?php 
                                         // short the description.
                                         echo $fm->textShorten($result['body'], 50) ;?>
                                         
                                         </td>
                                         <td>$<?php echo $result['price'] ;?></td>
                                         <td>
                                             <img src="<?php echo $result['image'] ;?>" height="40px" width="60px">
                                             
                                         </td>
                                         <td>
                                             <?php 
                                             
                                             if($result['type'] == 0){
                                                 echo "Featured";
                                             }else{
                                                 echo "General";
                                             }
                                            
                                          ?>
                                             
                                         </td>
                                        
	                 <td>
                             <a href="productedit.php?proId=<?php echo $result['productId']?>">Edit</a> 
                            || <a onclick="return confirm('Are you sure to delete!')"
                             href="?delpro=<?php echo $result['productId']?>">Delete</a>
                         
                         </td>
				
                                
                                
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
<?php include 'inc/footer.php';?>
