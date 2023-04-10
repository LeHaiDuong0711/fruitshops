<div class="sectionProductsDetail mt-5">


    <div class="row"><?php 
    $_SESSION['oldServer']= $_SERVER['REQUEST_URI'];
    if (isset($_GET['id'])) :
                            $id = $_GET['id'];

                            $pr = new products();
                            $result = $pr->getProductById($id);
                            $img = $result['pro_image'];
                            $name = $result['name'];
                            $pro_quantity = $result['quantity'];
                            $price = $result['price'];
                            $promotion = $result['promotion'];
                            $type_id = $result['type_id'];
                            $description = $result['description'];


                        ?>
            <div class="col-lg-6">
                <div class="product-images">
                    <div class="product-main-img">
                        <img src="./Contents/img/<?php echo $img ?>" alt="" width="70%">
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="product-details">

                    <h2 class="product-name"><?php echo $name; ?></h2>

                    <div class="product-price">
                        <?php
                            if ($promotion == 0) {
                                echo "<h4 class='product-price'>" . number_format($price) . "VND</h4>";
                            } else {
                                echo "<h4 class='product-price'>" . number_format($promotion) . "VND <del class='text-dark'>" . number_format($price) . "VND </del></h4>";
                            }

                        ?>
                    </div>

                    <form action="index.php?act=add_cart&id=<?php echo $id ?>" class="cart" method="post">
                        <div class="quantity">
                            <input type="number" size="4" name="quantity" min="1" value=1>
                            <span>Trong Kho:<?php echo $pro_quantity ?> </span>
                        </div>
                        <!-- <button class="" type="submit">Add to cart</button> -->
                        <?php if ($pro_quantity > 0) : ?>
                            <button type="submit" name="submit" class="add-to-cart-btn mt-3 mb-5"><i class="fa fa-shopping-cart" aria-hidden="true"></i> thêm vào giỏ</button>
                        <?php else : ?>
                            <button name="submit" disabled class="btn-out-of-stock">Hết Hàng</button>
                        <?php endif ?>
                        <a href="index.php?act=add_wishlist&id=<?php echo $set['id'] ?>"> <button type="button" name="add_wishlist" class="add-to-cart-btn mt-3 mb-5"><i class="fa fa-heart-o"></i>Yêu Thích</button>

                    </form>
                    </a>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active " id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Chi Tiết Sản Phẩm</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">Đánh Giá</button>
                        </li>


                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0"><!-- tab -->

                        <?php
                        $pr = new products();
                        $result = $pr->getSupplier($_GET['id'])
                        ?>

                            <p><?php echo $description ?></p>
                            <p><b>Nhà Cung Cấp: </b><?php echo $result['name'] ?></p>
                            <p><b>Địa chỉ nhà Cung Cấp: </b><?php echo $result['address'] ?></p>
                            <p><b>Số điện thoại nhà Cung Cấp: </b><?php echo $result['phone'] ?></p>


                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="1"><!-- tab -->


                            <div class="comment">
                                <b>
                                    Đã có: <?php
                                            if (isset($_GET['id'])) {
                                                $prod_id = $_GET['id'];
                                                $cmt = new comments();
                                                $countCmt = $cmt->countComment($prod_id);
                                                echo $countCmt;
                                            }
                                            ?> đánh giá về sản phẩm này
                                </b>
                                <form action="index.php?act=comment&id=<?php echo $_GET['id'] ?>&type_id=<?php echo $_GET['type_id'] ?>" method="post" class="mt-5">
                                    <div class="row">
                                        <div class="col-lg-2"><img src="./Contents/img/admin.jpg" alt="" class="w-100"></div>
                                        <div class="col-lg-10">
                                            <textarea name="comment" id="" cols="50" rows="3" placeholder="Enter your comment"></textarea>
                                            <br>
                                            <input type="submit" value="Gửi">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="showComments mt-5">
                                <?php if ($countCmt != 0) : ?>
                                    <table class="table">
                                        <thead>
                                            <td>Avatar</td>
                                            <td>Nội dung</td>
                                            <td>Ngày bình luận</td>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_GET['id'])) :
                                                $start = 0;
                                                if (isset($_GET['limit'])) {
                                                    $limit = $_GET['limit'];
                                                } else {
                                                    $limit = 5;
                                                }

                                                $count = 0;
                                                $cmt = new comments();
                                                $result = $cmt->getComments($_GET['id'], $start, $limit);
                                                while ($set = $result->fetch()) :

                                            ?>
                                                    <tr>
                                                        <td><img class="w-25" src="./Contents/img/admin.jpg" alt="" /></td>
                                                        <td><?php $count++;
                                                            echo $set['content'] ?></td>
                                                        <td><?php echo $set['date_cmt'] ?></td>
                                                    </tr>
                                            <?php endwhile;
                                            endif; ?>
                                            <?php if ($count != $cmt->countComment($_GET['id'])) {
                                                echo '<tr>
                                                                <td><a href=index.php?act=productDetail&id=' . $_GET['id'] . '&type_id=' . $_GET['type_id'] . '&limit=' . ($limit += 5) . '>
                                                                Hiển Thị Thêm</a></td>
                                                            </tr>';
                                            }
                                            if ($count > 5) {
                                                echo '<tr>
                                                            <td><a href=index.php?act=productDetail&id=' . $_GET['id'] . '&type_id=' . $_GET['type_id'] . '&limit=' . ($limit -= 5) . '>
                                                            Ẩn bớt</a></td>
                                                    </tr>';
                                            } ?>
                                        </tbody>
                                    </table>
                                <?php endif ?>

                            </div>






                        </div>

                    </div>

                </div>
            </div>

        <?php endif ?>
    </div>
    <hr size="5px" align="center" color=#e6e9ee />
    <div class="col-md-12 mb-5">

        <h2>Có Thế Bạn Sẽ Thích</h2>
        <div class="products-slick row">
            <?php
            if (isset($_GET['type_id'])) :
                $type_id = $_GET['type_id'];
                $pr = new products();
                $result = $pr->get3NewProductsByTypeID($type_id);
                while ($set = $result->fetch()) :
            ?>

                    <!-- product -->
                    <div class="product col-lg-4">
                        <div class="product-img">
                            <img style="width=100px" src="./Contents/img/<?php echo $set['pro_image'] ?>" alt="">
                            <div class="product-label">
                                <span class="new">MỚI</span>
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
                                <button class="add-to-cart-btn" type="submit" name="add"><i class="fa fa-shopping-cart"></i> THÊM VÀO GIỎ</button>
                            </div>
                        </a>
                    </div>
                    <!-- /product -->
                <?php endwhile ?>
            <?php endif ?>


        </div>

    </div>
    <!-- /tab -->

</div>
<?php ?>