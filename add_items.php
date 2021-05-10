<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if(!isset($_SESSION['id']))
{
echo'<script>
window.location.href="login.php";
</script>';
}
else
{
    $query=mysqli_query($con,"select max(id) as pid from products");
	$result=mysqli_fetch_array($query);
	 $productid=$result['pid']+1;
	 echo $productid;
	$dir="admin/productimages/$productid";
if(!is_dir($dir)){
		mkdir("admin/productimages/".$productid);
	}
$id = $_SESSION['id'];
$productName = $_REQUEST['productName'];
$category = $_REQUEST['category'];
$price = $_REQUEST['price'];
$productDescription = $_REQUEST['desc'];
$incoming = $_FILES['item_image']['name'];
$ext = pathinfo($incoming, PATHINFO_EXTENSION);
$prodImage = "user_".$id.$productName.".".$ext;
echo $prodImage;
if(move_uploaded_file($_FILES['item_image']['tmp_name'],$dir."/".$prodImage))
{
$sql=$con->query("insert into products (productName,productCompany,productPrice,productDescription,productAvailability,productImage1) 
VALUES ('$productName','User',$price,'$productDescription','In Stock','$prodImage')") or die("product not added");
$last_id = $con->insert_id;
$sql1=$con->query("insert into users_product (user_id, product_id, category) 
VALUES ('$id','$last_id','$category')") or die("product not added");
/* 
echo '<script>
window.history.back();
</script>'; */
$_SESSION['add_product']=1;
}
}
