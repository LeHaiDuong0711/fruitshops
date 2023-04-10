<!-- HEADER -->

<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links">
                <li><a href="tel:0357570455"><i class="fa fa-phone"></i> 035.757.0455</a></li>
                <li><a href="mailto:haiduong07112k3@gmail.com"><i class="fa fa-envelope-o"></i>haiduong07112k3@gmail.com</a></li>
                <li><a href="https://goo.gl/maps/LYfAifHVSHyJGqGPA"><i class="fa fa-map-marker"></i>12 Võ Hoành, Phú Thọ Hòa, Tân Phú, TP.HCM</a></li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li>
                        <div class="dropdown">
                            <button type="button" class="dropdown-toggle text-white" data-bs-toggle="dropdown">
                                <?php echo $_SESSION['username'] ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="index.php?act=profile" class="dropdown-item text-dark"><button type="button" class="btn">Hồ Sơ</button></a></li>
                                <li><a href="index.php?act=setting" class="dropdown-item text-dark"><Button type="button" class="btn">Cài Đặt</Button> </a></li>
                                <li><a href="index.php?act=logout" class="dropdown-item text-dark"><Button type="button" class="btn">Đăng Xuất</Button></a></li>
                            </ul>
                        </div>
                    </li>
                <?php else : ?>
                 
                  
                                <li><a href="index.php?act=login">Đăng nhập</a></li>

                   
                    
                <?php endif ?>
            </ul>

        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-lg-3">
                    <div class="header-logo">
                        <a href="index.php" class="logo">
                            <img src="./Contents/img/logobandoan.jpg" alt="logo">
                        </a>
                    </div>
                </div>
                <?php
                $keyword = "";
                $searchCol = 0;
                if (isset($_GET['keyword'])) {
                    $keyword = $_GET['keyword'];
                }

                if (isset($_GET['searchCol'])) {
                    $searchCol = $_GET['searchCol'];
                }
                ?>



                <div class="col-lg-6">
                    <div class="header-search">
                        <form method="get" action="">
                            <input type="text" name="act" value="products" hidden>
                            <select class="input-select" name="searchCol">
                                <option value="0" <?php if ($searchCol == 0) echo "selected" ?>>Tất cả</option>
                                <option value="1" <?php if ($searchCol == 1) echo "selected" ?>>Trái cây</option>
                                <option value="2" <?php if ($searchCol == 2) echo "selected" ?>>Bánh ngọt</option>
                                <option value="3" <?php if ($searchCol == 3) echo "selected" ?>>Rau củ</option>
                            </select>
                            <input name="keyword" class="input" value="<?php echo  $keyword ?>">
                            <button type="submit" class="search-btn" >Tìm</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="header-ctn">
                        <div>
                        <a href="index.php?act=cart">
                            <i class="fa fa-shopping-bag"></i>
                            <span>Giỏ hàng</span>
                            <div class="qty">
                              <?php $cart = new cart();
                              $count = $cart->countCart();
                                echo $count;
                              ?>
                            </div>
                        </a>
                        </div>
                        
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->

<!-- NAV -->
<nav class="navbar navbar-expand-lg" id="navigation">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <i class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?act=home">Trang Chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?act=products">Sản Phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?act=contact">Liên Hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?act=about">Giới Thiệu</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- /NAV -->
<!-- /NAVIGATION -->