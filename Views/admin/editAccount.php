<div class="sectionEditProduct">
    <div class="my-5">
        <div class="d-flex">
            <h3 class="fs-4 mb-3">Chỉnh Sửa Tài Khoản</h3>
        </div>

    </div>
    <div class="row">
        <?php
        $ac = new accounts();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $result = $ac->getAccountById($id);
        ?>
        <form action="admin.php?use=edit-account-action&id=<?php echo $id ?>" method="post">
            <div class="row">

                <div class="col-lg-3">
                    <label for="orderId" class="form-label">Mã Tài Khoản</label>
                    <input type="number" name="idUpdate" class="form-control" id="orderId" value="<?php echo $result['user_id'] ?>" />
                </div>
                <div class="col-lg-3">
                    <label for="lastName" class="form-label">Họ</label>
                    <input type="text" name="lastName" class="form-control" id="lastName" value="<?php echo $result['Last_name'] ?>" />
                </div>
                <div class="col-lg-3">
                    <label for="firstName" class="form-label">Tên</label>
                    <input type="text" name="firstName" class="form-control" id="firstName" value="<?php echo $result['First_name'] ?>" />
                </div>
                <div class="col-lg-3">
                    <label for="username" class="form-label">Tên Người Dùng</label>
                    <input type="text" name="username" class="form-control" id="username" value="<?php echo $result['username'] ?>"/>
                </div>
                <div class="col-lg-4">
                    <label for="phone" class="form-label">Số Điện Thoại</label>
                    <input type="number" name="phone" class="form-control" id="phone" value="<?php echo $result['phone'] ?>" />
                </div>
                <div class="col-lg-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?php echo $result['email'] ?>"/>
                </div>
                <div class="col-lg-4">
                    <label for="inputRole" class="form-label">Vai Trò</label>
                    <select id="inputRole" class="form-select" name="role">
                        <option value="1" <?php if($result['role_id']==1){echo "selected" ;} ?>>Admin</option>
                        <option value="2"  <?php if($result['role_id']==2){echo "selected" ;} ?>>Customer</option>
                    </select>
                </div>
        
               
            </div>
            <div class="float-end"> 
                <button class="btn-edit">Lưu</button>
            </div>


        </form>

    </div>

</div>