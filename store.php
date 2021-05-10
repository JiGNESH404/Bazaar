<?php
session_start();
//error_reporting(0);
if(isset($_SESSION['user_id']))
$id = $_SESSION['user_id'];
include('includes/config.php');
if(isset($_SESSION['add_product']))
{
if($_SESSION['add_product']==1)
{
	echo'<script>
	alert("Product added!")</script>';

	$_SESSION['add_product']=0;
}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>Bazaar-Sell Product</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">

	</head>
    <body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>
</header>
<div class="info-boxes wow fadeInUp">
	<div class="info-boxes-inner">
<button style="margin-left:10%" id="display_button" onclick="displayModal()" type="button"><a style="color:black; text-decoration:solid">Add Item</a></button>
<div id="add_item" style="display: none;" role="dialog">
  <div  class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #84B943;" class="modal-title">Add Your Item</h5>
        <button onclick="dismiss()" type="button" class="close" data-dismiss="modal" aria-label="Close">

        </button>
      </div>
      <div class="modal-body">
        <form action="add_items.php" method="POST" enctype="multipart/form-data">
        <label>Product Name</label>
        <input required style="width: 100%;" name="productName" type="text" placeholder="Enter Name of Product">
        <br>
        <input type="radio" onclick="f1(1)" name="category" value="sell"><label style="margin-right: 20%;">Sell</label>
        <input type="radio" onclick="f1(0)" style="margin-left: 20%;" name="category" value="rent"><label>Rent</label>
        <br>
        <label>Add Image</label>
        <input required accept="image/*" type="file" name="item_image">
        <br>
        <label>Product Description</label><br>
		<textarea name="desc"  cols="70" rows="6"></textarea>
        <br>
        <label>Asking Price</label><br>
        <input required type="number" placeholder="INR" name="price" style="width: 50%"> <span id="pmonth" style="display: none; color:red">*per month</span>
        
      </div>
      <div class="modal-footer">
        <button type="button" onclick="dismiss()" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<br><hr>
<?php	

$pid = mysqli_query($con,"Select * from users_product where user_id = $id");

if(!mysqli_num_rows($pid) > 0)
{
echo "<p style=\"margin-left:50%\">No Products</p>";
}
else{
while($pro_id = mysqli_fetch_array($pid))
{
  $product_id = $pro_id['product_id'];
$ret=mysqli_query($con,"select * from products where id = $product_id");

while ($row=mysqli_fetch_array($ret)) 
{



?>
		<div style="margin-left:10%" class="item">
					<div class="products">
						<div class="product">
							<div class="product-micro">
								<div class="row product-micro-row">
									<div class="col col-xs-6">
										<div class="product-image">
											<div class="image">
												<a href="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']);?>">
													<img data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" width="170" height="174" alt="">
													<div class="zoom-overlay"></div>
												</a>					
											</div><!-- /.image -->

										</div><!-- /.product-image -->
									</div><!-- /.col -->
									<div class="col-2">
										<div class="product-info">
											<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
											
											<div class="product-price">	
												<span class="price">
													Rs. <?php echo htmlentities($row['productPrice']);?>
												</span>

												</div><!-- /.product-price -->
												<?php if($row['productAvailability']=='In Stock'){?>
												<div class="action"><a href="remove_product.php?product=<?= $row['id']?>" class="lnk btn btn-primary">Remove</a></div>
												<?php } else {?>
												<div class="action" style="color:red">Out of Stock</div>
												<?php } ?>
															</div>
														</div><!-- /.col -->
													</div><!-- /.product-micro-row -->
												</div><!-- /.product-micro -->
												</div><hr>


																		</div>
															</div><?php }}} ?>
<script>
function displayModal()
{
document.getElementById("add_item").style.display="block";
}
function dismiss(){
    document.getElementById("add_item").style.display="none";
}
function f1(n)
{
	var x = n;
	if(n==0)
	document.getElementById("pmonth").style.display="block";
	else
	document.getElementById("pmonth").style.display="none";
}


</script>
<?php include('includes/footer.php');?>
	
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	<!-- For demo purposes – can be removed on production -->
	
	<script src="switchstylesheet/switchstylesheet.js"></script>
	
	


   
	<!-- For demo purposes – can be removed on production : End -->

	
	</div>
</div>

</body>
</html>