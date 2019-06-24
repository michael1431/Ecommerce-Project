<?php include 'inc/header.php' ?>
<?php include 'inc/slider.php' ?>

 <div class="main">
    
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
                  
                  <?php
                  // code for featured product
                  
                  $getFpd = $pd->getFeatureProduct();
                  
                  if($getFpd){
                      while ($result = $getFpd->fetch_assoc()){
                          
                      
                  
                  
                  ?>
                  
				<div class="grid_1_of_4 images_1_of_4" style="height:25%%; width: 20%;">
                                    <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt=""/></a>
					 <h2> <?php echo $result['productName']; ?> </h2>
					 <p><?php echo $fm->textShorten($result['body'],60); ?></p>
					 <p><span class="price">$<?php echo $result['price'];?> </span></p>
                                         <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
				
                  <?php } } ?>	
				
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
                            
                              <?php
                  // code for New product
                  
                  $getNpd = $pd->getNewProduct();
                  
                  if($getNpd){
                      while ($result = $getNpd->fetch_assoc()){
                          
                      
                  
                  
                  ?>
				<div class="grid_1_of_4 images_1_of_4">
                                    <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					<h2> <?php echo $result['productName']; ?> </h2>
         
					<p><span class="price">$<?php echo $result['price'];?> </span></p>
                                         <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
                            
                            
                            
                  <?php } } ?>
				
				
				
			</div>
    </div>
 </div>   
<?php include 'inc/footer.php' ?>
