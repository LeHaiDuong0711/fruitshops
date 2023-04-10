<?php


?>

<div class="sectionInfoOrderer">


  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Giỏ Hàng Của Bạn</span>
        <span class="badge badge-secondary badge-pill">3</span>
      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Sản Phẩm</h6>
            <small class="text-muted">Brief description</small>
          </div>
          <span class="text-muted">$12</span>
        </li>


        <li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0">Mã Khuyến Mãi</h6>
            <small>EXAMPLECODE</small>
          </div>
          <span class="text-success">-$5</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Tổng Tiền</span>
          <strong>$20</strong>
        </li>
      </ul>

      <form class="card p-2" method="post">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Promo code">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Thông Tin Đặt Hàng</h4>
      <form class="needs-validation" novalidate method="post" action="index.php?act=order">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Tên</label>
            <input type="text" class="form-control" name="firstName" placeholder="" value="" required>

          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Họ</label>
            <input type="text" class="form-control" name="lastName" placeholder="" value="" required>

          </div>
        </div>



        <div class="mb-3">
          <label for="address">Địa Chỉ</label>
          <input type="text" class="form-control" name="address" placeholder="12 Võ Hoành" required>

        </div>



        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="country">Tỉnh/Thành Phố</label>
            <select class="custom-select d-block w-100" id="country" name="country" required>
              <option value="">Choose...</option>
              <option value="Hồ Chí Minh">Hồ Chí Minh</option>
              <option value="Hà Nội">Hà Nội</option>
              <option value="Hà Tĩnh">Hà Tĩnh</option>
            </select>
          </div>
          <div class="col-md-4 mb-3">
            <label for="district">Quận/Tĩnh</label>
            <select class="custom-select d-block w-100" id="district" name="district" required>
              <option value="">Choose...</option>
              <option value="Tân Phú">Tân Phú</option>
              <option value="Tân Bình">Tân Bình</option>
              <option value="Phú Nhuận">Phú Nhuận</option>

            </select>

          </div>
          <div class="col-md-4 mb-3">
            <label for="commune">Phường/xã</label>
            <select class="custom-select d-block w-100" id="commune" name="commune" required>
              <option value="">Choose...</option>
              <option>Phú Thọ Hòa</option>
              <option>Tân Kỳ, Tân Quý</option>

            </select>

          </div>


        </div>
        <div class="mb-3">
          <label for="phone">Số Điện Thoại</label>
          <input type="number" class="form-control w-50" name="phoneNumber" id="phone" placeholder="0357570455 hoặc 357570455" required>
        </div>
        <div class="mb-3">
          <label for="note">Ghi Chú</label><br>
          <textarea name="note" id="" cols="80" rows="10"></textarea>
        </div>
        <hr class="mb-4">

        <button class="btn btn-danger float-end btn-lg btn-block m-3" type="submit">Tiếp Tục</button>

      </form>
    </div>
  </div>
</div>