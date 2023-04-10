<div class="sectionEditProduct">
    <div class="my-5">
        <div class="d-flex">
            <h3 class="fs-4 mb-3">Chỉnh Sửa Đơn Hàng</h3>
        </div>

    </div>
    <div class="row">
        <?php
        $sl = new sales();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $result = $sl->getOrderById($id);
        ?>
        <form action="admin.php?use=edit-order-action&id=<?php echo $id ?>" method="post">
            <div class="row">

                <div class="col-lg-2">
                    <label for="orderId" class="form-label">Mã Đơn Hàng</label>
                    <input type="number" name="idUpdate" class="form-control" id="orderId" value="<?php echo $result['order_id'] ?>" />
                </div>
                <div class="col-lg-2">
                    <label for="userId" class="form-label">Mã Người Dùng</label>
                    <input type="number" name="userId" class="form-control" id="userId" value="<?php echo $result['user_id'] ?>" />
                </div>
                <div class="col-lg-4">
                    <label for="lastName" class="form-label">Họ</label>
                    <input type="text" name="lastName" class="form-control" id="lastName" value="<?php echo $result['lastName'] ?>" />
                </div>
                <div class="col-lg-4">
                    <label for="firstName" class="form-label">Tên</label>
                    <input type="text" name="firstName" class="form-control" id="firstName" value="<?php echo $result['firstName'] ?>" />
                </div>
                <div class="col-lg-4">
                    <label for="phone" class="form-label">Số Điện Thoại</label>
                    <input type="number" name="phone" class="form-control" id="phone" value="<?php echo $result['phone'] ?>" />
                </div>
                <div class="col-lg-4">
                    <label for="total" class="form-label">Tổng Tiền</label>
                    <input type="text" name="total" class="form-control" id="total" value="<?php echo number_format($result['total']) ?>" disabled />
                </div>
                <div class="col-4">
                    <label for="status" class="form-label">Trạng Thái</label>
                    <select id="status" class="form-select" name="status" value="<?php echo $result['status'] ?>">
                        <option value="0"  <?php if($result['status']==0){echo "selected" ;} ?>>Chờ Duyệt</option>
                        <option value="1"  <?php if($result['status']==1){echo "selected" ;} ?>>Đang Giao</option>
                        <option value="2"  <?php if($result['status']==2){echo "selected" ;} ?>>Đã Nhận</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="note" class="form-label">Ghi Chú</label>
                    <textarea class="form-control" name="note" id="note" rows="10">
                    <?php echo $result['note'] ?>
      </textarea>
                </div>
            </div>
            <div class="float-end"> 
                <button class="btn-edit">Lưu</button>
            </div>


        </form>

    </div>

</div>