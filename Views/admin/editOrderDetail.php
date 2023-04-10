<div class="sectionEditProduct">
    <div class="my-5">
        <div class="d-flex">
            <h3 class="fs-4 mb-3">Chỉnh Sửa Chi Tiết Đơn Hàng</h3>
        </div>

    </div>
    <div class="row">
        <?php
        $sl = new sales();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $result = $sl->getOrderDetailById($id);
        ?>
        <form action="admin.php?use=edit-order-detail-action&id=<?php echo $id ?>&orderId=<?php echo $result['order_id'] ?>" method="post">
            <div class="row">

                <div class="col-lg-2">
                    <label for="orderId" class="form-label">Mã Đơn Hàng</label>
                    <input type="number" name="idUpdate" class="form-control" id="orderId" value="<?php echo $result['order_id'] ?>" />
                </div>
                <div class="col-lg-2">
                    <label for="proId" class="form-label">Mã Sản Phẩm</label>
                    <input type="number" name="proId" class="form-control" id="proId" value="<?php echo $result['pro_id'] ?>" />
                </div>
                <div class="col-lg-4 ">
                    <label for="proName" class="form-label">Tên Sản Phẩm</label>
                    <input type="text" name="proName" class="form-control" id="proName" value="<?php echo $result['pro_name'] ?>" disabled />
                </div>
                <div class="col-lg-2">
                    <label for="quantity" class="form-label">Số Lượng</label>
                    <input type="number" name="quantity" class="form-control" id="quantity" value="<?php echo $result['quantity'] ?>" />
                </div>
                <div class="col-lg-2">
                    <label for="total" class="form-label">Tổng Tiền</label>
                    <input type="text" name="total" class="form-control" id="total" value="<?php echo number_format($result['total']) ?>" disabled />
                </div>


            </div>
            <div class="float-end">
                <button class="btn-edit">Lưu</button>
            </div>


        </form>

    </div>

</div>