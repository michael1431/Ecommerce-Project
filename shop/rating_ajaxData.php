<?php
require 'inc/header.php';


$cmrId =  Session::get("customerId"); 
if(isset($_POST['productId']) && isset($_POST['rating'])){
  $productid = $_POST['productId'];
  $rating    = $_POST['rating'];
  $ratingProcess = $cmr->processRatingByUser($cmrId,$productid,$rating);
  
  //get average
  $avgratingquery = "SELECT ROUND(AVG(rating),1) as averageRating FROM tbl_rating WHERE productId='$productid'";
  $avgresult = $db->select($avgratingquery)->fetch_assoc();
  $averageRating = $avgresult['averageRating'];

  $return_arr = array("averageRating"=>$averageRating);

  echo json_encode($return_arr);  
}                    
?>