<?php
$sl = new sales();
$p = new page();
//lấy ra toàn bộ sản phẩm

// $count=$result->rowCount();
//giới hạn số lượng hiển thị
$limit = 10;
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
} else {
    $keyword = 0;
}; ?>

<div class="row my-5">
    <div class="d-flex">
        <h3 class="fs-4 mb-3">Danh Sách Đơn Hàng</h3>
        <form class="form-group d-flex" id="search" method="post" action="admin.php?use=listOrders&keyword=<?php echo $keyword; ?>">

            <input type="search" name="keyword" class="form-control" placeholder="Nhập Mã Đơn Hàng">
            <button class=" btn""><i class=" fa fa-search aria-hidden="true"></i></button>
        </form>
    </div>

</div>



<div class="col">
    <table class="table bg-white rounded shadow-sm  table-hover">
        <thead>
            <tr>
                <th>Mã Đơn Hàng</th>
                <th>Mã Người Dùng</th>
                <th>Họ</th>
                <th>Tên</th>
                <th>Số Điện Thoại</th>
                <th>Tổng Tiền</th>
                <th>Ghi Chú</th>
                <th>Ngày Đặt</th>
                <th>Trạng Thái</th>
                <th>Cập Nhật Trạng Thái</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sl = new sales();
            $p = new page();
            //lấy ra toàn bộ sản phẩm

            // $count=$result->rowCount();
            //giới hạn số lượng hiển thị
            $limit = 10;
            $keyword = "";
            if (isset($_GET['keyword'])) {

                $keyword = $_GET['keyword'];
            }
            $count = $sl->countOrders($keyword);
            $page = $p->findPage($count, $limit);
            $start = $p->findStart($limit);
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $result = $sl->getAllOrdersPage($start, $limit,  $keyword);


            while ($set = $result->fetch()) :
            ?>
                <tr>
                    <td><?php echo ($set['order_id']) ?></td>
                    <td><?php echo ($set['user_id']) ?></td>
                    <td><?php echo ($set['lastName']) ?></td>
                    <td><?php echo ($set['firstName']) ?></td>
                    <td><?php echo ($set['phone']) ?></td>
                    <td><?php echo (number_format($set['total'])) ?></td>
                    <td><?php echo ($set['note']) ?></td>
                    <td><?php echo ($set['date_create']) ?></td>
                    <?php if ($set['status'] == 0) : ?>
                        <td>
                            Chờ Duyệt
                        </td>
                    <?php elseif ($set['status'] == 1) : ?>
                        <td>Đang Giao</td>
                    <?php elseif ($set['status'] == 2) : ?>
                        <td>Đã Nhận</td>
                    <?php endif ?>
                    <?php if ($set['status'] == 0) : ?>
                        <td>
                            <a href="admin.php?use=update-status&id=<?php echo ($set['order_id']) ?>&status=1"><button class="btn-edit" type="button">Đang Giao</button></a>
                            <a href="admin.php?use=update-status&id=<?php echo ($set['order_id']) ?>&status=2"><button class="btn-remove" type="button">Đã Nhận</button></a>
                        </td>
                    <?php elseif ($set['status'] == 1) : ?>
                        <td>
                        <a href="admin.php?use=update-status&id=<?php echo ($set['order_id']) ?>&status=2"><button class="btn-remove" type="button">Đã Nhận</button></a>
                        </td>
                    <?php elseif ($set['status'] == 2) : ?>
                        <td>

                        </td>
                    <?php endif ?>
                    <td><a href="admin.php?use=edit-order&id=<?php echo ($set['order_id']) ?>"><button type="button" class="btn-edit">Sửa</button></a> <a href="admin.php?use=remove-order&id=<?php echo ($set['order_id']) ?>"><button type="button" class="btn-remove">Xóa</button></a></td>
                    <td><a href="admin.php?use=list-order-detail&orderId=<?php echo ($set['order_id']) ?>"><button class="btn-edit">Chi Tiết Đơn Hàng</button></a></td>
                </tr>
            <?php endwhile ?>

        </tbody>
    </table>
</div>
<ul class="pagination justify-content-center mt-5">
    <?php if ($current_page > 1 && $page > 1) : ?>
        <li class="page-item"><a class="page-link" href="admin.php?use=listOrders&orderId=<?php echo ($set['order_id']); if ($keyword != "") {
                                                                                        echo "&" . "keyword=" . "$keyword";
                                                                                    } ?>&page=<?php echo $current_page - 1 ?>">Previous</a></li>
    <?php endif ?>

    <?php for ($i = 1; $i <= $page; $i++) : ?>
        <li class="page-item"><a class="page-link" href="admin.php?use=listOrders&orderId=<?php echo ($set['order_id']); if ($keyword != "") {
                                                                                        echo "&" . "keyword=" . "$keyword";
                                                                                    } ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
    <?php endfor ?>






    <?php if ($current_page < $page &&  $page > 1) : ?>
        <li class="page-item"><a class="page-link" href="admin.php?use=listOrders&orderId=<?php echo ($set['order_id']); if ($keyword != "") {
                                                                                        echo "&keyword=" . "$keyword";
                                                                                    }
                                                                                    ?>&page=<?php echo $current_page + 1 ?>">Next</a></li>
    <?php endif ?>
</ul>
</div>