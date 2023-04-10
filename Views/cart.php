<div class="sessionCart m-5">
    
    <?php
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) :?>
        <h4 id="err">Chưa Có Sản Phẩm Trong Giỏ Hàng</h4>
        <a href="index.php?act=products">        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Mua Ngay</button>    
</a>
    <?php else : ?>
        <h1 class="text-success">Thông Tin Giỏ Hàng</h1>
        <form action="index.php?act=update" method="post">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Hình Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                        <th>Thành Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <form method="post">
                        <?php
                        
                        $j = 0;
                        foreach ($_SESSION['cart'] as $key => $item) :
                            $j++;
                        ?>
                            <tr>
                                <td><?php echo $j ?></td>
                                <td><img width="50px" height="50px" src="./Contents/img/<?php echo $item['img']; ?>"></td>
                                <td>
                                    <p><?php echo $item['name'] ?> </p>
                                </td>

                                <td>Đơn Giá: <?php echo number_format($item['unit_price'] ) ?><sup><u>đ</u></sup> <br> Số Lượng: <input type="number" min=1 name="newqty[]" value=<?php echo $item['quantity'] ?>>

                                </td>
                                <td><a href="index.php?act=delete&id=<?php echo $key ?>"><button type="button" class="btn btn-danger">Xóa</button></a>

                                    <button type="submit" class="btn btn-secondary">Sửa</button>

                                </td>
                                <td>
                                    <?php
                                    if (isset($_POST['quantity'])) {
                                        $item['quantity'] = $_POST['quantity'];
                                    }

                                    echo number_format($item['total']) ?> <sup><u>đ</u></sup></p>
                                </td>
                            </tr>
                        <?php
                        endforeach
                        ?>
                    </form>

                </tbody>
                <thead>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th>Tạm Tính: <?php
                                        $ct = new cart();
                                        echo $ct->sum_total();
                                        ?></th>
                    </tr>
                </thead>
            </table>
        </form>

       <a class="m-3" href="index.php?act=info"><button type="button" class="float-end btn btn-danger">Đặt Ngay</button></a> 
    <?php endif ?>
</div>