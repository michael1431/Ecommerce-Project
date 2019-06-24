<?php include 'inc/header.php' ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $search = $_POST['search'];
    //cart class er object er maddome dortechi 

    $searchproduct = $pd->searchPro($search);
  } ?>

  <?php 

   if($searchproduct){
    while($result = $searchproduct->fetch_assoc()){
      ?>


          
           <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt=""/></a>
           <p style="color: green;  font-weight: bold;"><?php echo $result['productName'];?> </p>
        
           <p><span class="price" style="color: red; font-size: 30px; font-weight: bold;" ><?php echo $result['price'];?></span></p>
                  <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details" style = "font-weight: bold;">Details</a></span></div>
        
       <?php } } ?>



<?php include 'inc/footer.php' ?>
