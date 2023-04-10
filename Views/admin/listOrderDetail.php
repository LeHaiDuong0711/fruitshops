<?php
$sl = new sales();
$p = new page();
//lấy ra toàn bộ sản phẩm

// $count=$result->rowCount();
//giới hạn số lượng hiển thị
$limit = 10;
?>

<div class="row my-5">
    <div class="d-flex">
        <h3 class="fs-4 mb-3">Danh Sách Chi Tiết Đơn Hàng</h3>
    </div>
</div>



<div class="col">
    <table class="table bg-white rounded shadow-sm  table-hover">
        <thead>
            <tr>
                <th>Mã Đơn Hàng</th>
                <th>Mã Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Tổng Tiền</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sl = new sales();
            $p = new page();
            $order_id = 0;
            if (isset($_GET['orderId'])) {
                $order_id = $_GET['orderId'];
            }
            //lấy ra toàn bộ sản phẩm

            $count = $sl->countAllOrderDetail($order_id);
            //giới hạn số lượng hiển thị
            $limit = 10;
            $page = $p->findPage($count, $limit);
            $start = $p->findStart($limit);
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $result = $sl->getAllOrderDetailPage($order_id, $start, $limit);


            while ($set = $result->fetch()) :
            ?>
                <tr>
                    <td><?php echo ($set['order_id']) ?></td>
                    <td><?php echo ($set['pro_id']) ?></td>
                    <td><?php echo ($set['pro_name']) ?></td>
                    <td><?php echo ($set['quantity']) ?></td>
                    <td><?php echo (number_format($set['total'])) ?></td>
                    <td><a href="admin.php?use=edit-order-detail&id=<?php echo ($set['id']) ?>&orderId=<?php echo ($set['order_id']) ?>"><button type="button" class="btn-edit">Sửa</button></a> <a href="admin.php?use=remove-order-detail&id=<?php echo ($set['id']) ?>"><button type="button" class="btn-remove">Xóa</button></a></td>
                </tr>
            <?php endwhile ?>

        </tbody>
    </table>
</div>
<ul class="pagination justify-content-center mt-5">
    <?php if ($current_page > 1 && $page > 1) : ?>
        <li class="page-item"><a class="page-link" href="admin.php?use=list-order-detail&orderId=<?php
                                                                                                    echo ($set['order_id'])
                                                                                                    ?>&page=<?php echo $current_page - 1 ?>">Previous</a></li>
    <?php endif ?>

    <?php for ($i = 1; $i <= $page; $i++) : ?>
        <li class="page-item"><a class="page-link" href="admin.php?use=list-order-detail&orderId=<?php
                                                                                                    echo ($set['order_id'])  ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
    <?php endfor ?>






    <?php if ($current_page < $page &&  $page > 1) : ?>
        <li class="page-item"><a class="page-link" href="admin.php?use=list-order-detail&orderId=<?php
                                                                                                    echo ($set['order_id'])
                                                                                                    ?>&page=<?php echo $current_page + 1 ?>">Next</a></li>
    <?php endif ?>
</ul>
</div>