<div class="sessionCart m-5">

    <?php
    $wl = new wishlist();
    $result = $wl->getWishlistByUser($_SESSION['user_id']);
    if (!$result) : ?>
        <h4 id="err" class="text-danger">Chưa Có Sản Phẩm Yêu Thích</h4>
        <a href="index.php?act=products"> <button class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Thêm Ngay</button>
        </a>
    <?php else : ?>
        <h1 class="text-success">Danh Sách Sản Phẩm Yêu Thích</h1>
        <form action="index.php?act=update" method="post">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Hình Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <form method="post">
                        <?php
                        $j = 0;

                        while ($set = $result->fetch()) :
                            $pr = new products();
                            $item = $pr->getProductById($set['pro_id']);


                            $j++;
                        ?>
                            <tr>
                                <td><?php echo $j ?></td>
                                <td><img width="50px" height="50px" src="./Contents/img/<?php echo $item['pro_image']; ?>"></td>
                                <td>
                                    <p><?php echo $item['name'] ?> </p>
                                </td>

                                <td>Đơn Giá: <?php echo $item['price'] ?> </td>

                                </td>
                                <td><a href="index.php?act=delete_wishlist&id=<?php echo $set['id'] ?>"><button type="button" class="btn btn-danger">Xóa</button></a>
                                <a href="index.php?act=productDetail&id=<?php echo $set['pro_id'] ?>&type_id=<?php echo $item['type_id'] ?>"><button type="button" class="btn btn-success">Mua</button></a>

                                </td>

                            </tr>
                        <?php

                        endwhile
                        ?>
                    </form>

                </tbody>

            </table>
        </form>

    <?php endif ?>
</div>