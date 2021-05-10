<?php
session_start();
//error_reporting(0);
$id = $_SESSION['id'];
include('includes/config.php');
if(isset($_GET['product']))
{
    $pid = $_GET['product'];

    $dir1 = "admin/productimages/$pid";
    function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }
    
        if (!is_dir($dir)) {
            return unlink($dir);
        }
    
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
    
            if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
    
        }
    
        return rmdir($dir);
    }
   if(deleteDirectory($dir1))
   {
    $rem_users_prod = mysqli_query($con,"delete from users_product where user_id = $id and product_id=$pid");
    if($rem_users_prod)
    {
        $rem_prods = mysqli_query($con,"delete from products where id = $pid");
    }
}
    
}
else
{
    echo '<script>
window.history.back();
</script>';
}
?>