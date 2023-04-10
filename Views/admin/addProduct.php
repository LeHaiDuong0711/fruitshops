
<div class="sectionEditProduct">
    <div class="my-5">
        <div class="d-flex">
            <h3 class="fs-4 mb-3">Thêm Sản Phẩm</h3>
           
        </div>
        <a href="admin.php?use=import-file" class="float-end "><i class="fa fa-file-import"></i> Import File</a>

    </div>


    <div class="row">
        <form action="admin.php?use=add-action" method="post" enctype="multipart/form-data">
            <div class="row">

                <div class="col-12">
                    <label for="inputProductName" class="form-label">Tên Sản Phẩm</label>
                    <input type="text" name="name" class="form-control" id="inputProductName" value="" />
                </div>
                <div class="col-md-4">
                    <label for="inputProductPrice" class="form-label">Giá Sản Phẩm</label>
                    <input type="number" name="price" class="form-control" id="inputProductPrice" value="" />
                </div>
                <div class="col-md-4">
                    <label for="inputProductPromotion" class="form-label">Giá Khuyến Mãi</label>
                    <input type="number" name="promotion" class="form-control" id="inputProductPromotion" value="" />
                </div>
                <div class="col-md-4">
                    <label for="inputProductQuantity" class="form-label">Số Lượng</label>
                    <input type="number" name="quantity" class="form-control" id="inputProductQuantity" value="" min=1/>
                </div>
                <div class="col-6">
                    <label for="inputImage" class="form-label">Hình Ảnh</label>
                    <input type="file" class="form-control" id="inputImage" name="image" />
                </div>
                <div class="col-6">
                    <label for="inputImage" class="form-label">Phân Loại</label>
                    <select id="inputProductPicture" class="form-select" name="type_id">
                        <option selected>Chọn...</option>
                        <option value="1">Trái Cây</option>
                        <option value="2">Bánh Ngọt</option>
                        <option value="3">Rau củ</option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="inputProductDescription" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="inputProductDescription" rows="10">

      </textarea>
                </div>
            </div>
            <div class="float-end">
                <button class="btn-edit">Thêm</button>
            </div>
        </form>

    </div>

</div>