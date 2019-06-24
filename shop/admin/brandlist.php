<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>
<?php 
$brand = new Brand();
// id ta dorbo delete korar jonno

if(isset($_GET['delbrand'])){
    
    //$id = $_GET['delcat'];
    // id ta k preg replace kore nilam jate _,digit and letter o allow kore, mysqli_real_escape_string
    // use koreo kora jabe
    $id = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['delbrand']);
    $delBrand = $brand->delBrandById($id);
    
    
}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block">  
                    
                    <?php 
                    // show the delete msg
                    if(isset($delBrand)){
                        echo $delBrand;
                    }
                    ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                                            
                                            <?php
                                            // code for show all the category
                                            $getbrand = $brand->getAllbrand();
                                            if($getbrand){
                                                
                                                $i =0;
                                                while($result = $getbrand->fetch_assoc()){
                                                    $i++;
                                            
                                            ?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['brandName'];?></td>
                                                        <td><a href="brandedit.php?brandId=<?php echo $result['brandId']?>">Edit</a> || <a onclick="return confirm('Are you sure to delete!')" href="?delbrand=<?php echo $result['brandId']?>">Delete</a></td>
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
<?php include 'inc/footer.php';?>


