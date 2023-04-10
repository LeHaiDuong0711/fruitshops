<div class="container-fluid px-4">
    <div class="row g-3 my-2">
        <div class="col-md-3">
            <a href="admin.php?use=listProducts">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">

                    <div>
                        <?php
                        $pr = new products();
                        $countPr = $pr->countAllProducts();
                        ?>
                        <h3 class="fs-2"><?php echo ($countPr); ?></h3>
                        <p class="fs-5">Sản Phẩm</p>
                    </div>
                    <i class="fas fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </a>

        </div>

        <div class="col-md-3">
            <!-- <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2">4920</h3>
                    <p class="fs-5">Sales</p>
                </div>
                <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
            </div> -->
            <a href="admin.php?use=listOrders">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">

                    <div>
                        <?php
                        $sl = new sales();
                        $countOrder = $sl->countAllOrders();
                        ?>
                        <h3 class="fs-2"><?php echo ($countOrder); ?></h3>
                        <p class="fs-5">Đơn Hàng</p>
                    </div>
                    <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>

                </div>
            </a>

        </div>

        <div class="col-md-3">
            <a href="admin.php?use=listAccounts">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <?php
                        $ac = new accounts();
                        $countAccounts = $ac->countAllAccounts();
                        ?>
                        <h3 class="fs-2"><?php echo ($countAccounts); ?></h3>
                        <p class="fs-5">Tài Khoản</p>
                    </div>
                    <i class="fa fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </a>


        </div>

        <div class="col-md-3">
            <a href="admin.php?use=statistical">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">%</h3>
                        <p class="fs-5">Thống Kê</p>
                    </div>
                    <i class="fas fa-chart-line fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </a>

        </div>
    </div>

    <?php include "../Controllers/admin/useCtrl.php" ?>


</div>