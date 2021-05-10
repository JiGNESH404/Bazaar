<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['rent_array']))
{
    echo "Product rented is :  ";
    $usr_id = $_SESSION['user_id'];
   $q =  mysqli_query($con,"Select * from rentee where user_id = $usr_id");

   while ($row = mysqli_fetch_array($q)){

    $p_id = $row['product_id'];
    $res = "select * from products where id = '$p_id'";
         $z = mysqli_query($con,$res) or die("BYE");
        
            while($row2 = mysqli_fetch_array($z))
            {
                echo  $row2['productName']."<br>";
            }
   }

}

{
    echo "Buying Successfull";
}
?>