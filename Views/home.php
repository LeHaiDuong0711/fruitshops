<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./Contents/img/slide.jpg" style="width:100%">
        </div>
        <div class="carousel-item">
            <img src="./Contents/img/slide1.jpg" style="width:100%">
        </div>
        <div class="carousel-item">
            <img src="./Contents/img/slide2.jpg" style="width:100%">
        </div>
    </div>

    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>



<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            <div class="col-lg-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./Contents/img/banhngot.jpg" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Bánh ngọt</h3>
                        <a href="index.php?act=products&type_id=2" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-lg-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./Contents/img/traicaytuoi.jpg" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Trái cây tươi</h3>
                        <a href="index.php?act=products&type_id=1" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-lg-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./Contents/img/raucusach.jpg" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Rau củ sạch</h3>
                        <a href="index.php?act=products&type_id=3" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<div class="container-home">
    <div class="newProductsEveryday mb-5">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <h3 class="title">Sản phẩm tươi mới mỗi ngày</h3>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Trái Cây</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Bánh Ngọt</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Rau Củ</button>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0"><!-- tab -->

                <div class="products-slick row" data-nav="#slick-nav-1">
                    <?php

                    $pr = new products();
                    $result = $pr->get3NewProductsByTypeID(1);
                    while ($set = $result->fetch()) : ?>
                        <!-- product -->
                        <div class="col-lg-4">
                            <div class="product">
                                <div class="product-img">
                                    <img style="width=100px" src="./Contents/img/<?php echo $set['pro_image'] ?>" alt="">
                                    <div class="product-label">
                                        <?php if ($set['quantity'] <= 0) : ?>
                                            <span class="new">Hết Hàng</span>
                                        <?php else : ?>
                                            <span class="new">MỚI</span>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category"></p>
                                    <h3 class="product-name"><?php echo $set['name'] ?></h3>
                                    <?php
                                    if ($set['promotion'] == 0) {
                                        echo "<h4 class='product-price'>" . number_format($set['price']) . "VND</h4>";
                                    } else {
                                        echo "<h4 class='product-price'>" . number_format($set['promotion']) . "VND <del class='text-dark'>" . number_format($set['price']) . "VND </del></h4>";
                                    }

                                    ?>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product-btns">
                                        <a href="index.php?act=add_wishlist&id=<?php echo $set['id'] ?>"><button class="add-to-wishlist">
                                                <i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button></a>
                                        <a href=""><button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button></a>
                                        <a href="index.php?act=productDetail&id=<?php echo $set['id'] ?>&type_id=<?php echo $set['type_id'] ?>"><button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button></a>
                                    </div>
                                </div>
                                <a href="index.php?act=add_cart&id=<?php echo $set['id'] ?>">

                                    <div class="add-to-cart">
                                        <?php if ($set['quantity'] > 0) : ?>
                                            <button type="submit" name="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> thêm vào giỏ</button>
                                        <?php endif ?>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <!-- /product -->
                    <?php endwhile ?>
                </div>


            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0"><!-- tab -->

                <div class="products-slick row">
                    <?php


                    $result = $pr->get3NewProductsByTypeID(2);
                    while ($set = $result->fetch()) : ?>
                        <!-- product -->
                        <div class="col-lg-4">
                            <div class="product">
                                <div class="product-img">
                                    <img style="width=100px" src="./Contents/img/<?php echo $set['pro_image'] ?>" alt="">
                                    <div class="product-label">
                                        <?php if ($set['quantity'] <= 0) : ?>
                                            <span class="new">Hết Hàng</span>
                                        <?php else : ?>
                                            <span class="new">MỚI</span>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category"></p>
                                    <h3 class="product-name"><?php echo $set['name'] ?></h3>
                                    <?php
                                    if ($set['promotion'] == 0) {
                                        echo "<h4 class='product-price'>" . number_format($set['price']) . "VND</h4>";
                                    } else {
                                        echo "<h4 class='product-price'>" . number_format($set['promotion']) . "VND <del class='text-dark'>" . number_format($set['price']) . "VND </del></h4>";
                                    }

                                    ?>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product-btns">
                                        <a href="index.php?act=add_wishlist&id=<?php echo $set['id'] ?>"><button class="add-to-wishlist">
                                                <i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button></a>
                                        <a href=""><button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button></a>
                                        <a href="index.php?act=productDetail&id=<?php echo $set['id'] ?>&type_id=<?php echo $set['type_id'] ?>"><button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button></a>
                                    </div>
                                </div>
                                <a href="index.php?act=add_cart&id=<?php echo $set['id'] ?>">

                                    <div class="add-to-cart">
                                        <?php if ($set['quantity'] > 0) : ?>
                                            <button type="submit" name="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> thêm vào giỏ</button>
                                        <?php endif ?>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <!-- /product -->

                    <?php endwhile ?>
                </div>


            </div>
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0"><!-- tab -->

                <div class="products-slick row">
                    <?php


                    $result = $pr->get3NewProductsByTypeID(3);
                    while ($set = $result->fetch()) : ?>
                        <!-- product -->
                        <div class="col-lg-4">
                            <div class="product">
                                <div class="product-img">
                                    <img style="width=100px" src="./Contents/img/<?php echo $set['pro_image'] ?>" alt="">
                                    <div class="product-label">
                                        <?php if ($set['quantity'] <= 0) : ?>
                                            <span class="new">Hết Hàng</span>
                                        <?php else : ?>
                                            <span class="new">MỚI</span>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category"></p>
                                    <h3 class="product-name"><?php echo $set['name'] ?></h3>
                                    <?php
                                    if ($set['promotion'] == 0) {
                                        echo "<h4 class='product-price'>" . number_format($set['price']) . "VND</h4>";
                                    } else {
                                        echo "<h4 class='product-price'>" . number_format($set['promotion']) . "VND <del class='text-dark'>" . number_format($set['price']) . "VND </del></h4>";
                                    }

                                    ?>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product-btns">
                                        <a href="index.php?act=add_wishlist&id=<?php echo $set['id'] ?>"><button class="add-to-wishlist">
                                                <i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button></a>
                                        <a href=""><button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button></a>
                                        <a href="index.php?act=productDetail&id=<?php echo $set['id'] ?>&type_id=<?php echo $set['type_id'] ?>"><button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button></a>
                                    </div>
                                </div>
                                <a href="index.php?act=add_cart&id=<?php echo $set['id'] ?>">

                                    <div class="add-to-cart">
                                        <?php if ($set['quantity'] > 0) : ?>
                                            <button type="submit" name="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> thêm vào giỏ</button>
                                        <?php endif ?>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <!-- /product -->

                    <?php endwhile ?>
                </div>

            </div>
        </div>




    </div>








    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>02</h3>
                                    <span>Ngày</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>10</h3>
                                    <span>Giờ</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>34</h3>
                                    <span>Phút</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>60</h3>
                                    <span>Giây</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">Khuyến mãi trong tuần</h2>
                        <p>Sản phẩm mới giảm tới 50%</p>
                        <a class="primary-btn cta-btn" href="./products.php?type_id=1">Mua ngay</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->


    <div class="sellingProducts mb-5">
        <ul class="nav nav-tabs" id="myTab1" role="tablist">
            <h3 class="title">Sản phẩm bán chạy</h3>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab1" data-bs-toggle="tab" data-bs-target="#home-tab-pane1" type="button" role="tab" aria-controls="home-tab-pane1" aria-selected="true">Trái Cây</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab1" data-bs-toggle="tab" data-bs-target="#profile-tab-pane1" type="button" role="tab" aria-controls="profile-tab-pane1" aria-selected="false">Bánh Ngọt</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab1" data-bs-toggle="tab" data-bs-target="#contact-tab-pane1" type="button" role="tab" aria-controls="contact-tab-pane1" aria-selected="false">Rau Củ</button>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent1">
            <div class="tab-pane fade show active" id="home-tab-pane1" role="tabpanel" aria-labelledby="home-tab1" tabindex="0">
                <div class="products-slick row">
                    <?php

                    $result = $pr->getProductsTopSellingByType(1);
                    while ($set = $result->fetch()) : ?>
                        <!-- product -->
                        <div class="col-lg-4">
                            <div class="product">
                                <div class="product-img">
                                    <img style="width=100px" src="./Contents/img/<?php echo $set['pro_image'] ?>" alt="">
                                    <div class="product-label">
                                        <?php if ($set['quantity'] <= 0) : ?>
                                            <span class="new">Hết Hàng</span>
                                        <?php else : ?>
                                            <span class="new">MỚI</span>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category"></p>
                                    <h3 class="product-name"><?php echo $set['name'] ?></h3>
                                    <?php
                                    if ($set['promotion'] == 0) {
                                        echo "<h4 class='product-price'>" . number_format($set['price']) . "VND</h4>";
                                    } else {
                                        echo "<h4 class='product-price'>" . number_format($set['promotion']) . "VND <del class='text-dark'>" . number_format($set['price']) . "VND </del></h4>";
                                    }

                                    ?>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product-btns">
                                        <a href="index.php?act=add_wishlist&id=<?php echo $set['pro_id'] ?>"><button class="add-to-wishlist">
                                                <i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button></a>
                                        <a href=""><button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button></a>
                                        <a href="index.php?act=productDetail&id=<?php echo $set['pro_id'] ?>&type_id=<?php echo $set['type_id'] ?>"><button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button></a>
                                    </div>
                                </div>
                                <a href="index.php?act=add_cart&id=<?php echo $set['pro_id'] ?>">

                                    <div class="add-to-cart">
                                        <?php if ($set['quantity'] > 0) : ?>
                                            <button type="submit" name="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> thêm vào giỏ</button>
                                        <?php endif ?>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <!-- /product -->
                    <?php endwhile ?>
                </div>
            </div>
            <div class="tab-pane fade" id="profile-tab-pane1" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="products-slick row">
                    <?php

                    $result = $pr->getProductsTopSellingByType(2);
                    while ($set = $result->fetch()) : ?>
                        <!-- product -->
                        <div class="col-lg-4">
                            <div class="product">
                                <div class="product-img">
                                    <img style="width=100px" src="./Contents/img/<?php echo $set['pro_image'] ?>" alt="">
                                    <div class="product-label">
                                        <?php if ($set['quantity'] <= 0) : ?>
                                            <span class="new">Hết Hàng</span>
                                        <?php else : ?>
                                            <span class="new">MỚI</span>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category"></p>
                                    <h3 class="product-name"><?php echo $set['name'] ?></h3>
                                    <?php
                                    if ($set['promotion'] == 0) {
                                        echo "<h4 class='product-price'>" . number_format($set['price']) . "VND</h4>";
                                    } else {
                                        echo "<h4 class='product-price'>" . number_format($set['promotion']) . "VND <del class='text-dark'>" . number_format($set['price']) . "VND </del></h4>";
                                    }

                                    ?>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product-btns">
                                        <a href="index.php?act=add_wishlist&id=<?php echo $set['pro_id'] ?>"><button class="add-to-wishlist">
                                                <i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button></a>
                                        <a href=""><button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button></a>
                                        <a href="index.php?act=productDetail&id=<?php echo $set['pro_id'] ?>&type_id=<?php echo $set['type_id'] ?>"><button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button></a>
                                    </div>
                                </div>
                                <a href="index.php?act=add_cart&id=<?php echo $set['pro_id'] ?>">

                                    <div class="add-to-cart">
                                        <?php if ($set['quantity'] > 0) : ?>
                                            <button type="submit" name="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> thêm vào giỏ</button>
                                        <?php endif ?>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <!-- /product -->
                    <?php endwhile ?>
                </div>
            </div>
            <div class="tab-pane fade" id="contact-tab-pane1" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <div class="products-slick row">
                    <?php

                    $result = $pr->getProductsTopSellingByType(3);
                    while ($set = $result->fetch()) : ?>
                        <!-- product -->
                        <div class="col-lg-4">
                            <div class="product">
                                <div class="product-img">
                                    <img style="width=100px" src="./Contents/img/<?php echo $set['pro_image'] ?>" alt="">
                                    <div class="product-label">
                                        <?php if ($set['quantity'] <= 0) : ?>
                                            <span class="new">Hết Hàng</span>
                                        <?php else : ?>
                                            <span class="new">MỚI</span>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category"></p>
                                    <h3 class="product-name"><?php echo $set['name'] ?></h3>
                                    <?php
                                    if ($set['promotion'] == 0) {
                                        echo "<h4 class='product-price'>" . number_format($set['price']) . "VND</h4>";
                                    } else {
                                        echo "<h4 class='product-price'>" . number_format($set['promotion']) . "VND <del class='text-dark'>" . number_format($set['price']) . "VND </del></h4>";
                                    }

                                    ?>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product-btns">
                                        <a href="index.php?act=add_wishlist&id=<?php echo $set['pro_id'] ?>"><button class="add-to-wishlist">
                                                <i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button></a>
                                        <a href=""><button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button></a>
                                        <a href="index.php?act=productDetail&id=<?php echo $set['pro_id'] ?>&type_id=<?php echo $set['type_id'] ?>"><button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button></a>
                                    </div>
                                </div>
                                <a href="index.php?act=add_cart&id=<?php echo $set['pro_id'] ?>">

                                    <div class="add-to-cart">
                                        <?php if ($set['quantity'] > 0) : ?>
                                            <button type="submit" name="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> thêm vào giỏ</button>
                                        <?php endif ?>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <!-- /product -->
                    <?php endwhile ?>
                </div>
            </div>
        </div>






    </div>

</div>



<?php ?>