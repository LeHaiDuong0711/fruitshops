<?php
$act = 'home';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}


switch ($act) {
    case 'home':
        include "./Views/home.php";
        break;
    case 'products':
        include "./Views/products.php";
        break;
    case 'productDetail':

        include "./Views/productDetail.php";
        break;

    case 'cart':
        include "./Views/cart.php";
        break;

    case 'add_cart':
        if (!isset($_POST['quantity'])) {
            //kiểm tra giỏ hàng có tồn tại hay ko nếu không thì tạo giỏ hàng
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $quantity = 1;

                $ct = new cart();
                $ct->add($id, $quantity);
              
            };
            
            echo '<meta http-equiv="refresh"  content="0; url=./index.php?act=cart"/>';

            break;
        } else {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $quantity = $_POST['quantity'];

                $ct = new cart();
                $ct->add($id, $quantity);
            };
            if (!$ct) {
                echo '<meta http-equiv="refresh"  content="0; url=./index.php?act=cart"/>';
            } else {
                echo '<script>alert("Bạn đã thêm sản phẩm này với số lượng tối đa")</script>';

                echo '<meta http-equiv="refresh"  content="0; url=' . $_SESSION['oldServer'] . '"/>';
            }
            break;
        }



    case 'delete':
        if (isset($_GET['id'])) {
            $key = $_GET['id'];
            $gh = new cart();
            $gh->delete($key);
            echo '<meta http-equiv="refresh"  content="0; url=./index.php?act=cart"/>';
        };
        break;

    case 'update':
        if (isset($_POST['newqty'])) {
            $new_list = $_POST['newqty'];
            foreach ($new_list as $index => $quantity) {
                if ($_SESSION['cart'][$index]['quantity'] != $quantity) {
                    $updateItem = new cart();
                    $updateItem->update($index, $quantity, $_SESSION['cart'][$index]['id']);
                }
            }
        }
        include "./Views/cart.php";
        break;

    case 'login':
        include "./Views/login.php";
        break;
    case 'login_act':
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $us = new users();
            $result = $us->loginUser($username, md5($password));
            if ($result) {
                // lưu thông tin vào session 
                echo '<script>alert("Đăng nhập thành công")</script>';
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['first_name'] = $result['First_name'];
                $_SESSION['last_name'] = $result['Last_name'];
                $_SESSION['username'] = $result['username'];
                echo '<meta http-equiv="refresh"  content="0; url=./index.php?act=home"/>';
            } else {
                echo '<script>alert("Đăng nhập không thành công")</script>';
                include './Views/login.php';
            }
        };

        break;
    case 'logout':
        unset($_SESSION['user_id']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        unset($_SESSION['username']);
        echo '<meta http-equiv="refresh"  content="0; url=./index.php?act=login"/>';

        break;

    case 'register':
        include "./Views/register.php";
        break;
    case 'register_action':


        if (isset($_POST['first_name']) && isset($_POST['email']) && isset($_POST['last_name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['phone'])) {
            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $username = $_POST['username'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordAgain = $_POST['passwordAgain'];


            $ur = new users();
            $exist = $ur->checkUser($username);
            $checkemail = $ur->getEmail($email);
            if ($exist) {
                echo "<script>alert('Tên đăng nhập đã tồn tại 🥲')</script>";
                include './Views/register.php';
            } else {
                if ($checkemail) {
                    echo "<script>alert('Email Đã Tồn Tại 🥲')</script>";
                    include './Views/register.php';
                } else {
                    $date = new DateTime("now");
                    $date_create = $date->format("Y-m-d");
                    $check = $ur->InsertUser($firstname, $lastname, $username, $password, $phone, $email, $passwordAgain, $date_create);
                    if (!isset($check)) {
                        echo '<script>alert("Đăng kí Thành Công")</script>';
                        echo '<meta http-equiv="refresh"  content="0; url=./index.php?act=login"/>';
                    } else {

                        echo '<script>alert("Đăng kí thất bại")</script>';
                        include './Views/register.php';
                    }
                }
            }
        }
        break;
    case 'info':

        include './Views/infoUser.php';
        break;
    case 'order':
        $bill = new bill();
        $_SESSION['order_id_temp'] = $bill->getOrderId();
        if (isset($_SESSION['user_id'])) {
            $_SESSION['lastName'] = "";
            $_SESSION['firstName'] = "";
            $_SESSION['address'] = "";
            $_SESSION['phoneNumber'] = null;

            $_SESSION['createDate'] = "";
            $_SESSION['note'] = "";




            if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['address']) && isset($_POST['commune']) && isset($_POST['district']) && isset($_POST['country']) && isset($_POST['phoneNumber'])) {

                $_SESSION['lastName'] = $_POST['lastName'];
                $_SESSION['firstName'] = $_POST['firstName'];
                $_SESSION['address'] = $_POST['address'] . ", " . $_POST['commune'] . ", " . $_POST['district'] . ", " . $_POST['country'];
                $date = new DateTime('now');
                $dateformat = $date->format('Y-m-d');
                $_SESSION['createDate'] = $dateformat;
                $_SESSION['phoneNumber'] = $_POST['phoneNumber'];
                $_SESSION['note'] = $_POST['note'];
            } else {
                echo "<script>alert('Bạn cần nhập đầy đủ thông tin')</script>";
                include './Views/infoUser.php';
            }
        } else {
            echo "<script>alert('Bạn cần đăng nhập')</script>";
            include './Views/login.php';
        }

        include "./Views/bill.php";
        break;
    case 'order_action':

        $bill = new bill();
        $sum_total = 0;
        $order_id = $bill->insertOrder($_SESSION['order_id_temp'], $_SESSION['user_id'], $_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['phoneNumber'], $_SESSION['note']);
        $_SESSION['order_id'] = $order_id;
        //insert những thông tin còn lại vào chi tiết hóa đơn
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                $bill->insertOrderDetail($order_id, $item['id'], $item['name'], $item['unit_price'], $item['quantity'], $item['total']);
                $sum_total += $item['total'];
                $bill->updateQuantityProducts($item['id'], $item['quantity']);
            }
        }
        //update tổng tiển qua bảng order
        $bill->updateTotal($order_id, $sum_total);

        unset($_SESSION['cart']);
        echo "<script>alert('Đặt Hàng Thành Công')</script>";
        include "./Views/home.php";

        break;
    case 'about':
        include "./Views/about.php";
        break;
    case 'contact':
        include "./Views/contact.php";
        break;
    case 'comment':
        if (isset($_GET['id'])) {
            $userId = $_SESSION['user_id'];
            $proId = $_GET['id'];
            $content = $_POST['comment'];
            $cmt = new comments();
            $cmt->insertComments($proId, $userId, $content);
        };
        include "./Views/productDetail.php";
        break;
    case 'forgotPassword':
        include "./Views/veriEmailForgotPassword.php";
        break;
    case 'forgot_action':
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $_SESSION['email'] = array();
            // kiểm tra email có tồn tại không
            $usr = new users();
            $checkemail = $usr->getEmail($email);
            if ($checkemail != false) {
                $_SESSION['email'] = $email;
                include "./Views/forgotPassword.php";
            } else {
                echo '<script> alert("Email không tồn tại");</script>';
                include "./Views/veriEmailForgotPassword.php";
            }
        }
        break;
    case 'resetPassword':
        // tạo ra code gửi qua mail đó
        $code = random_int(100, 1000);
        // tạo ra và lưu vào Session
        //tạo ra đối tượng

        $_SESSION['code'] = $code;
        $_SESSION['newPass'] = $_POST['password'];
        // tiến hành gửi mail
        $mail = new PHPMailer;
        $mail->IsSMTP();                                //Sets Mailer to send message using SMTP
        $mail->Host = 'smtp.gmail.com';        //Sets the SMTP hosts of your Email hosting, this for Godaddy
        $mail->Port = 587;                                //Sets the default SMTP server port
        $mail->SMTPAuth = true;                            //Sets SMTP authentication. Utilizes the Username and Password variables
        $mail->Username = 'haiduong07112k3@gmail.com';                    //Sets SMTP username
        $mail->Password = 'zmnafekqyizkwrhb'; //Phplytest20@php					//Sets SMTP password				//Sets SMTP password
        $mail->SMTPSecure = 'tls';                            //Sets connection prefix. Options are "", "ssl" or "tls"
        $mail->From = 'haiduong07112k3@gmail.com';            //Sets the From email address for the message
        $mail->FromName = 'HiddenFruitsShop';                //Sets the From name of the message
        $mail->AddAddress($_SESSION['email'], 'Reset password');        //Adds a "To" address
        //$mail->AddCC($_POST["email"], $_POST["name"]);	//Adds a "Cc" address
        $mail->WordWrap = 50;                            //Sets word wrapping on the body of the message to a given number of characters
        $mail->IsHTML(true);                            //Sets message type to HTML				
        $mail->Subject = "Forget Password";                //Sets the Subject of the message
        $mail->Body = 'Vui lòng nhập mã code sau ' . $code;                //An HTML or plain text message body
        if ($mail->Send())                                //Send an Email. Return true on success or false on error
        {
            echo '<script> alert("Gửi mail thành công");</script>';
        } else {
            echo '<script> alert("Lỗi gửi mail");</script>';
        }
        include "./Views/resetPassword.php";
        break;
    case 'updatePassword':
        if (isset($_POST['submit'])) {
            if (isset($_POST['otp'])) {
                $otp = $_POST['otp'];
            }



            if ($_SESSION['code'] == $otp) {
                // cập nhật
                $newPass = md5($_SESSION['newPass']);
                $email = $_SESSION['email'];
                $usr = new users();
                $usr->updatePassword($email, $newPass);
                echo '<script> alert("Đổi Mật Khẩu Thành Công");</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./index.php?act=login"/>';
            } else {
                echo '<script> alert("Mã code sai");</script>';
                include "./Views/resetPassword.php";
            }
        }
        break;
    case 'changePassword':
        include "./Views/veriChangePassword.php";
        break;
    case 'change_action':
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $_SESSION['email'] = array();
            // kiểm tra email có tồn tại không
            $usr = new users();
            $checkemail = $usr->getEmail($email);
            if ($checkemail != false) {
                $_SESSION['email'] = $email;
                include "./Views/changePassword.php";
            } else {
                echo '<script> alert("Email không tồn tại");</script>';
                include "./Views/veriChangePassword.php";
            }
        }
        break;
    case 'change':
        if (isset($_POST['submit'])) {
            if (isset($_POST['oldPassword'])) {
                $oldPass = $_POST['oldPassword'];
            }
            if (isset($_POST['newPassword'])) {
                $newPass = $_POST['newPassword'];
            }
            if (isset($_POST['newPasswordAgain'])) {
                $newPassAgain = $_POST['newPasswordAgain'];
            }
            $usr = new users();
            $checkOldPass = $usr->checkPassword($_SESSION['email'], md5($oldPass));
            if ($checkOldPass) {
                if ($newPassAgain ==  $newPass) {
                    $usr->updatePassword($_SESSION['email'], md5($newPass));
                    echo '<script> alert("Đổi Mật Khẩu Thành Công");</script>';
                    include "./Views/login.php";
                } else {
                    echo '<script> alert("Mật Khẩu Lặp Lại Không Chính Xác");</script>';
                    include "./Views/changePassword.php";
                }
            } else {
                echo '<script> alert("Mật Khẩu Củ Không Chính Xác");</script>';
                include "./Views/changePassword.php";
            }
        }
        break;

    case 'add_wishlist':

        if (isset($_SESSION['user_id'])) {
            if (isset($_GET['id'])) {
                $proId = $_GET['id'];
            }
            $wl = new wishlist();
            $check = $wl->getWishlist($_SESSION['user_id'], $proId);
            if ($check) {
                echo '<script> alert("Bạn Đã Thêm Sản Phẩm Này Trước Đó Rồi");</script>';
                include "./Views/wishlist.php";
            } else {
                $result = $wl->addWishlist($_SESSION['user_id'], $proId);
                if ($result != 'false') {
                    echo '<script> alert("Đã Thêm Vào Danh Sách Yêu Thích");</script>';
                    include "./Views/wishlist.php";
                } else {
                    echo '<script> alert("Thêm Thất Bại");</script>';
                    include "./Views/products.php";
                }
            }
        } else {
            echo '<script> alert("Bạn Cần Phải Đăng Nhập");</script>';
            include "./Views/login.php";
        }
        break;

    case 'delete_wishlist':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $wl = new wishlist();
            $wl->delete($id);
        }
        include "./Views/wishlist.php";




        break;
    case 'wishlist':

        include "./Views/wishlist.php";




        break;
}
