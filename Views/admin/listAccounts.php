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

<div class="m-5">
    <div class="d-flex">
        <h3 class="fs-4 mb-3">Danh Sách Tài Khoản</h3>
        <form class="form-group d-flex" id="search" method="post" action="admin.php?use=listAccounts&keyword=<?php echo $keyword; ?>">
            <input type="search" name="keyword" class="form-control" placeholder="Nhập Username">
            <button class="btn""><i class=" fa fa-search aria-hidden="true"></i></button>
        </form>
    </div>

</div>



<div class="">
    <table class="table bg-white rounded shadow-sm  table-hover " id="listAccount">
        <thead>
            <tr>
                <th>Mã Tài Khoản</th>
                <th>Hình Ảnh</th>
                <th>Họ</th>
                <th>Tên</th>
                <th>Số Điện Thoại</th>
                <th>Email</th>
                <th>Tên Người Dùng</th>
                <th>Mật Khẩu</th>
                <th>Vai Trò</th>
                <th>Ngày Tạo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ac = new accounts();
            $p = new page();
            //lấy ra toàn bộ sản phẩm

            // $count=$result->rowCount();
            //giới hạn số lượng hiển thị
            $limit = 10;
            $keyword = "";
            if (isset($_GET['keyword'])) {

                $keyword = $_GET['keyword'];
            }
            $count = $ac->countAccounts($keyword);
            $page = $p->findPage($count, $limit);
            $start = $p->findStart($limit);
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $result = $ac->getAllAccountPage($start, $limit,  $keyword);


            while ($set = $result->fetch()) :
            ?>
                <tr>
                    <td><?php echo ($set['user_id']) ?></td>
                    <td><img src="../Contents/img/<?php echo ($set['image']) ?>" alt="" class="w-100"></td>
                    <td><?php echo ($set['Last_name']) ?></td>
                    <td><?php echo ($set['First_name']) ?></td>
                    <td><?php echo ($set['phone']) ?></td>
                    <td><?php echo ($set['email']) ?></td>
                    <td><?php echo ($set['username']) ?></td>
                    <td><?php echo ($set['password']) ?></td>
                    <?php if ($set['role_id'] == 1) : ?>
                        <td>
                            Quản Trị
                        </td>
                    <?php elseif ($set['role_id'] == 2) : ?>
                        <td>Người Dùng</td>
                    <?php endif ?>
                    <td> <?php echo ($set['date_create']) ?></td>
                    <td>
                        <?php if($_SESSION['user_id']!=$set['user_id']): ?>
                        <a href="admin.php?use=edit-account&id=<?php echo ($set['user_id']) ?>"><button type="button" class="btn-edit">Sửa</button></a> <a href="admin.php?use=remove-account&id=<?php echo ($set['user_id']) ?>"><button type="button" class="btn-remove">Xóa</button></a><a href="admin.php?use=reset-pass-account&id=<?php echo ($set['user_id']) ?>"><button type="button" class="btn-edit">ResetPass</button></a>
                            <?php endif ?>
                    </td>

                </tr>
            <?php endwhile ?>

        </tbody>
    </table>
</div>
<ul class="pagination justify-content-center mt-5">
    <?php if ($current_page > 1 && $page > 1) : ?>
        <li class="page-item"><a class="page-link" href="admin.php?use=listAccounts<?php if ($keyword != "") {
                                                                                        echo "&" . "keyword=" . "$keyword";
                                                                                    } ?>&page=<?php echo $current_page - 1 ?>">Previous</a></li>
    <?php endif ?>

    <?php for ($i = 1; $i <= $page; $i++) : ?>
        <li class="page-item"><a class="page-link" href="admin.php?use=listAccounts<?php if ($keyword != "") {
                                                                                        echo "&" . "keyword=" . "$keyword";
                                                                                    } ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
    <?php endfor ?>






    <?php if ($current_page < $page &&  $page > 1) : ?>
        <li class="page-item"><a class="page-link" href="admin.php?use=listAccounts<?php if ($keyword != "") {
                                                                                        echo "&keyword=" . "$keyword";
                                                                                    }
                                                                                    ?>&page=<?php echo $current_page + 1 ?>">Next</a></li>
    <?php endif ?>
</ul>
</div>