<div class="sectionEditProduct">
    <div class="my-5">
        <div class="d-flex">
            <h3 class="fs-4 mb-3">Chỉnh Sửa Sản Phẩm</h3>
        </div>

    </div>
    <div class="row">
        <?php
        $pr = new products();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $result = $pr->getProductById($id);
        ?>
        <form action="admin.php?use=edit-action&id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
            <div class="row">

                <div class="col-2">
                    <label for="inputProductId" class="form-label">Mã Sản Phẩm</label>
                    <input type="number" name="idUpdate" class="form-control" id="inputProductId" value="<?php echo $result['id'] ?>" />
                </div>
                <div class="col-10">
                    <label for="inputProductName" class="form-label">Tên Sản Phẩm</label>
                    <input type="text" name="name" class="form-control" id="inputProductName" value="<?php echo $result['name'] ?>" />
                </div>
                <div class="col-md-4">
                    <label for="inputProductPrice" class="form-label">Giá Sản Phẩm</label>
                    <input type="number" name="price" class="form-control" id="inputProductPrice" value="<?php echo $result['price'] ?>" />
                </div>
                <div class="col-md-4">
                    <label for="inputProductPromotion" class="form-label">Giá Khuyến Mãi</label>
                    <input type="number" name="promotion" class="form-control" id="inputProductPromotion" value="<?php echo $result['promotion'] ?>" />
                </div>
                <div class="col-md-4">
                    <label for="inputProductQuantity" class="form-label">Số Lượng</label>
                    <input type="number" name="quantity" class="form-control" id="inputProductQuantity" value="<?php echo $result['quantity'] ?>" />
                </div>
                <div class="col-6">
                    <label for="inputImage" class="form-label">Hình Ảnh</label>
                    <input type="file" class="form-control" id="inputImage" name="image" />
                </div>
                <div class="col-6">
                    <label for="inputImage" class="form-label">Phân Loại</label>
                    <select id="inputProductPicture" class="form-select" name="type_id" value="<?php echo $result['type_id'] ?>">
                        <option value="1">Trái Cây</option>
                        <option value="2">Bánh Ngọt</option>
                        <option value="3">Rau củ</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="inputProductDescription" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="inputProductDescription" rows="10">
                    <?php echo $result['description'] ?>
      </textarea>
                </div>
            </div>
            <div class="float-end">
                <button class="btn-edit">Lưu</button>
            </div>


        </form>

    </div>

</div>