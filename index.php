<?php session_start();
// include "./Models/connect.php";
// include "./Models/products.php";
// include "./Models/cart.php";
// include "./Models/users.php";
// include "./Models/page.php";
// include "./Models/bill.php";
include "Models/class.phpmailer.php";
set_include_path(get_include_path() . PATH_SEPARATOR . 'Models/');
spl_autoload_extensions('.php');
spl_autoload_register();
?>


<!DOCTYPE html>
<html lang="en">

<?php if (substr($_SERVER['PHP_SELF'], 17, 5) != "admin") :  include "./Views/head.php";
    include "./Views/header.php" ?>


    <body>


        <?php include "Controllers/user/userCtrl.php" ?>





    </body>
<?php include "./Views/footer.php";
endif ?>


</html>