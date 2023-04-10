<?php session_start();
// include "./Models/connect.php";
// include "./Models/products.php";
// include "./Models/cart.php";
// include "./Models/users.php";
// include "./Models/page.php";
// include "./Models/bill.php";
include "../Models/class.phpmailer.php";
set_include_path(get_include_path() . PATH_SEPARATOR . '../Models/admin/');
spl_autoload_extensions('.php');
spl_autoload_register();
?>
<?php if (strcmp(substr($_SERVER['PHP_SELF'], 17, 5), "admin") == 0) :
    include "../Views/admin/head.php";
    $act = "";
    if (isset($_GET['act'])) {
        $act = $_GET['act'];
    }
?>


    <body>
        <?php if ($act != "auth") : ?>

            <div class="d-flex" id="wrapper">

                <?php include "../Views/admin/navLeft.php"; ?>
                <div id="page-content-wrapper">
                    <?php include "../Views/admin/navTop.php"; ?>
                    <?php if (isset($_SESSION['user_id'])) : ?>
                    
                        <?php
                        include  "../Controllers/admin/adminCtrl.php" ?>
         
                    <?php else : echo '<script>alert("Bạn Cần Phải Đăng Nhập Mới Có Quyền Xem")</script>';
                    endif ?>
                </div>




            </div>

        <?php else : ?>

            <div id="containerAuth">
                <?php include  "../Controllers/admin/adminCtrl.php"; ?>

            </div>


        <?php endif; ?>


    </body>
    <?php include "../Views/admin/footer.php"; ?>

<?php endif ?>