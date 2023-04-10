<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer">
                        <h3 class="footer-title">Chúng tôi</h3>
                        <p><strong>Đồ án CNTT xây dựng website bán đồ ăn trực tuyến</strong></p>
                        <ul class="footer-links">
                            <li><i class="fa fa-map-marker"></i>12 Võ Hoành, Phú Thọ Hòa, Tân Phú, TP.HCM</li>
                            <li><i class="fa fa-phone"></i>035.757.0455</li>
                            <li><i class="fa fa-envelope-o"></i>@stu.itc.edu.vn</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="footer">
                        <h3 class="footer-title">thể loại</h3>
                        <ul class="footer-links">
                            <li><a href="products.php?type_id=1"><strong>Trái cây</strong></a></li>
                            <li><a href="products.php?type_id=2"><strong>Bánh ngọt</strong></a></li>
                            <li><a href="products.php?type_id=3"><strong>Rau củ</strong></a></li>
                        </ul>
                    </div>
                </div>


                <div class="col-lg-3">
                    <div class="footer">
                        <h3 class="footer-title">thông tin</h3>
                        <ul class="footer-links">
                            <li><strong>Lê Hải Dương</strong> - <strong> 501210803 </strong>501210803@stu.itc.edu.vn</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="footer">
                        <h3 class="footer-title">Dịch vụ</h3>
                        <ul class="footer-links">
                            <li><a href="login/index.php">Tài Khoản Của Tôi</a></li>
                            <li><a href="#">Xem Giỏ Hàng</a></li>
                            <li><a href="#">Yêu Thích</a></li>
                            <li><a href="#">Xem Đơn Hàng</a></li>
                            <li><a href="#">Giúp Đỡ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="footer-payments">
                        <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                        <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                    </ul>
                    <span class="copyright">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> Bản quyền giao diện thuộc <strong> Lê Hải Dương </strong> </a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </span>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
        el.classList.toggle("toggled");
    };
</script>
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization', '1.0', {
        'packages': ['corechart']
    });
    google.setOnLoadCallback(drawStatistical);
</script>


</html>