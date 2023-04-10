<div class="sectionOrder m-5">


    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <h3 class="text-center text-danger">HÓA ĐƠN</h3>
                            <form method="post" action="index.php?act=order_action">
                                <table cellspacing="0" class="table">
                                    <?php
                                     $last_name ="";
                                     $first_name ="";
                                         $address="";
                                     $phoneNumber="";
                                     $create_date="";
                                       $sum_total="";
                                    // $bill = new bill();
                                    // $result = $bill->getOrder($_SESSION['order_id']);
                                    $order_id = $_SESSION['order_id_temp'];

                                    $last_name = $_SESSION['lastName'];
                                    $first_name = $_SESSION['firstName'];
                                    $address=$_SESSION['address'];
                                    $phoneNumber=$_SESSION['phoneNumber'];
                                    $create_date=$_SESSION['createDate'];
                                    $sum_total=0;
                                    // $phone = $result['phone'];
                                    // $create_date = $result['date_create'];
                                    // $day = new DateTime($create_date);
                                    // $status=0;
                                    // $total=0;


                                    ?>
                                    <thead>
                                        <tr>
                                            <th>Mã Hóa Đơn</th>
                                            <td><?php echo $order_id ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Họ Và Tên</th>
                                            <td><?php echo $last_name." ".$first_name; ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Địa Chỉ</th>
                                            <td><?php echo $address; ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Số Điện Thoại</th>
                                            <td><?php echo $phoneNumber; ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Ngày Đặt</th>
                                            <td><?php echo $create_date; ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </thead>

                                    <body>
                                        <tr>
                                            <th>Mã Sản Phẩm</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Giá</th>
                                            <th>Số Lượng</th>
                                        </tr>
                                       <?php if(isset($_SESSION['cart'])):
                                       foreach($_SESSION['cart'] as $key=>$item):$sum_total+=$item['total'] ?>
                                        <tr>
                                            <td>
                                            <?php echo $item['id']; ?>
                                            </td>
                                            <td><?php echo $item['name'] ?></td>
                                            <td><?php echo number_format($item['unit_price'])  ?></td>
                                            <td><?php echo $item['quantity'] ?></td>
                                            
                                        </tr>
                                        <?php endforeach;endif?>
                                    </body>


                                </table>
                                <div class="float-end"><h6 >Tổng Tiền: <?php echo number_format($sum_total)  ?></h6><button class="btn btn-danger">Thanh Toán</button></div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>