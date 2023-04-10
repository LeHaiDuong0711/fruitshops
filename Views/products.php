<?php
$pr = new products();
$p = new page();
//lấy ra toàn bộ sản phẩm

// $count=$result->rowCount();
//giới hạn số lượng hiển thị
$limit = 6;
$type_id = 0;
$keyword = "";
if (isset($_GET['keyword'])) {

	$keyword = $_GET['keyword'];
}
if (isset($_GET['searchCol'])) {
	$type_id = $_GET['searchCol'];
}
$count = $pr->countProducts($type_id, $keyword);
$page = $p->findPage($count, $limit);
$start = $p->findStart($limit);
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
?>

<!-- SECTION -->
<div id="sectionProducts">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- STORE -->
			<div id="store" class="col-lg-12">
				<!-- store products -->
				<div class="row" id="containerProducts">
					<?php

					$pr = new products();

					$result = $pr->getAllProductsPage($start, $limit, $type_id, $keyword);


					while ($set = $result->fetch()) :
					?>
						<!-- product -->
						<div class="col-md-4 col-xs-6">
							<div class="product mb-5">
								<div class="product-img">
									<img src="./Contents/img/<?php echo $set['pro_image'] ?>" alt="">
									<div class="product-label">
										<?php if ($set['quantity'] <= 0) : ?>
											<span class="new">Hết Hàng</span>
										<?php endif ?>
									</div>
								</div>
								<div class="product-body">
									<p class="product-category"></p>
									<h3 class="product-name"><?php echo $set['name'] ?></h3>
									<?php
									if ($set['promotion'] == 0) {
										echo "<h4 class='product-price'>" . number_format($set['price']) . "VND</h4>";
									} else {
										echo "<h4 class='product-price'>" . number_format($set['promotion']) . "VND <del class='text-dark'>" . number_format($set['price']) . "VND </del></h4>";
									}

									?>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
									<div class="product-btns">
										<a href="index.php?act=add_wishlist&id=<?php echo $set['id'] ?>"><button class="add-to-wishlist">
											<i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button></a>
										<a href=""><button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button></a>
										<a href="index.php?act=productDetail&id=<?php echo $set['id'] ?>&type_id=<?php echo $set['type_id'] ?>"><button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button></a>
									</div>
								</div>
								<a href="index.php?act=add_cart&id=<?php echo $set['id'] ?>">
									<div class="add-to-cart">
										<?php if ($set['quantity'] > 0) : ?>
											<button type="submit" name="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i>thêm vào giỏ</button>
										<?php endif ?>
									</div>
								</a>
							</div>
						</div>
						<!-- /product -->
					<?php endwhile ?>
				</div>
				<!-- /store products -->

			</div>
			<!-- /STORE -->

		</div>
		<!-- /row -->

	</div>
	<ul class="pagination justify-content-center">
		<?php if ($current_page > 1 && $page > 1) : ?>
			<li class="page-item"><a class="page-link" href="index.php?act=products<?php if ($type_id != 0 && $keyword != "") {
																						echo "&" . "searchCol=" . "$type_id", "&keyword=" . "$keyword";
																					} else if ($type_id != 0) {
																						echo "&" . "searchCol=" . "$type_id";
																					} else if ($keyword != "") {
																						echo "&" . "keyword=" . "$keyword";
																					} ?>&page=<?php echo $current_page - 1 ?>">Previous</a></li>
		<?php endif ?>

		<?php for ($i = 1; $i <= $page; $i++) : ?>
			<li class="page-item"><a class="page-link" href="index.php?act=products<?php if ($type_id != 0 && $keyword != "") {
																						echo "&" . "searchCol=" . "$type_id", "&keyword=" . "$keyword";
																					} else if ($type_id != 0) {
																						echo "&" . "searchCol=" . "$type_id";
																					} else if ($keyword != "") {
																						echo "&" . "keyword=" . "$keyword";
																					} ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
		<?php endfor ?>






		<?php if ($current_page < $page &&  $page > 1) : ?>
			<li class="page-item"><a class="page-link" href="index.php?act=products<?php if ($type_id != 0 && $keyword != "") {
																						echo "&" . "searchCol=" . "$type_id", "&keyword=" . "$keyword";
																					} else if ($type_id != 0) {
																						echo "&" . "searchCol=" . "$type_id";
																					} else if ($keyword != "") {
																						echo "&" . "keyword=" . "$keyword";
																					} ?>&page=<?php echo $current_page + 1 ?>">Next</a></li>
		<?php endif ?>
	</ul>
	<!-- /container -->
</div>
<!-- /SECTION -->
<script src="./Contents/js/main.js"></script>