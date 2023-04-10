<?php

if (isset($_GET['use'])) {
    $use = $_GET['use'];
} else {
    $use = "";
}
switch ($use) {
    case 'register':
        include "../Views/admin/register.php";
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


            $ac = new accounts();
            $exist = $ac->checkUser($username);
            $checkemail = $ac->getEmail($email);
            if ($exist) {
                echo "<script>alert('Tên đăng nhập đã tồn tại 🥲')</script>";
                include '../Views/admin/register.php';
            } else {
                if ($checkemail) {
                    echo "<script>alert('Email Đã Tồn Tại 🥲')</script>";
                    include '../Views/admin/register.php';
                } else {
                    $date = new DateTime("now");
                    $dateCreate = $date->format("Y-m-d");
                    $check = $ac->InsertUser($firstname, $lastname, $username, $password, $phone, $email, $passwordAgain, $dateCreate);
                    if (!isset($check)) {
                        echo '<script>alert("Đăng kí thành công")</script>';
                        echo '<meta http-equiv="refresh"  content="0; url=./admin.php?act=auth&use=login"/>';
                    } else {

                        echo '<script>alert("Đăng kí thất bại")</script>';
                        include '../Views/admin/register.php';
                    }
                }
            }
        }
        break;
    case 'login':
        include "../Views/admin/login.php";
        break;
    case 'login_act':
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $ac = new accounts();
            $result = $ac->loginUser($username, md5($password));
            if ($result) {
                $check = $ac->checkRole($username);
                if ($check) {
                    echo '<script>alert("Đăng nhập thành công")</script>';
                    $_SESSION['user_id'] = $result['user_id'];
                    $_SESSION['first_name'] = $result['First_name'];
                    $_SESSION['last_name'] = $result['Last_name'];
                    $_SESSION['username'] = $result['username'];
                    echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=home"/>';
                } else {
                    echo '<script>alert("Tài Khoản Của Bạn Không Đủ Quyền Truy Cập")</script>';
                    include '../Views/admin/login.php';
                }
                // lưu thông tin vào session 

            } else {
                echo '<script>alert("Đăng nhập không thành công")</script>';
                include '../Views/admin/login.php';
            }
        };

        break;
    case 'logout':
        unset($_SESSION['user_id']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        unset($_SESSION['username']);
        echo '<meta http-equiv="refresh"  content="0; url=./admin.php?act=auth&use=login"/>';

        break;

    case "listProducts":
        include "../Views/admin/listProducts.php";
        break;
    case "edit-product":
        include "../Views/admin/editProduct.php";
        break;
    case "edit-action":
        $date = new DateTime("now");
        $dateCreate = $date->format("Y-m-d");
        $id = 0;
        $idUpdate = 0;
        $name = null;
        $image = null;
        $price = 0;
        $type_id = 0;
        $promotion = 0;
        $quantity = 0;
        $description = null;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (isset($_POST['idUpdate'])) {
                $idUpdate = $_POST['idUpdate'];
            }
            if (isset($_POST['name'])) {
                $name = $_POST['name'];
            }
            if (isset($_FILES['image']['name'])) {
                $image = $_FILES['image']['name'];
            }
            if (isset($_POST['price'])) {
                $price = $_POST['price'];
            }
            if (isset($_POST['type_id'])) {
                $type_id = $_POST['type_id'];
            }
            if (isset($_POST['promotion'])) {
                $promotion = $_POST['promotion'];
            }
            if (isset($_POST['quantity'])) {
                $quantity = $_POST['quantity'];
            }

            if (isset($_POST['description'])) {
                $description = $_POST['description'];
            }
            $pr = new products();
            $pr->updateProduct($id, $idUpdate, $name, $type_id, $image, $price, $promotion, $quantity, $description,  $dateCreate);
            $pr->upLoadImage();

            if (isset($pr)) {
                echo '<script>alert("cập nhật thành công")</script>';
                // include "../Views/admin/listProducts.php";
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listProducts"/>';
            } else {
                echo '<script>alert("cập nhật không thành công")</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listProducts"/>';
            }
        }

        break;
    case "remove-product":
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $pr = new products();
            $cmt = new comments();
            $cmt->removeCommentsByProduct($id);
            $result = $pr->removeProduct($id);
            if (!isset($result)) {
                echo '<script>alert("Xóa Sản Phẩm Thành Công")</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listProducts"/>';
            }
        }

        break;
    case "add-product":
        include "../Views/admin/addProduct.php";

        break;
    case "add-action":
        $date = new DateTime("now");
        $dateCreate = $date->format("Y-m-d");
        $name = null;
        $image = null;
        $price = 0;
        $type_id = 0;
        $promotion = 0;
        $quantity = 0;
        $description = null;

        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        }
        if (isset($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
        }
        if (isset($_POST['price'])) {
            $price = $_POST['price'];
        }
        if (isset($_POST['type_id'])) {
            $type_id = $_POST['type_id'];
        }
        if (isset($_POST['promotion'])) {
            $promotion = $_POST['promotion'];
        }
        if (isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
        }

        if (isset($_POST['description'])) {
            $description = $_POST['description'];
        }



        $pr = new products();
        $pr->insertProduct($name, $type_id, $image, $price, $promotion, $quantity, $description,  $dateCreate);
        $pr->upLoadImage();

        if (isset($pr)) {
            echo '<script>alert("cập nhật thành công")</script>';
            // include "../Views/admin/listProducts.php";
            echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listProducts"/>';
        } else {
            echo '<script>alert("cập nhật không thành công")</script>';
            echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listProducts"/>';
        }

        break;
    case "listOrders":
        include "../Views/admin/listOrders.php";
        break;
    case "edit-order":
        include "../Views/admin/editOrder.php";
        break;
    case "edit-order-action":
        $date = new DateTime("now");
        $dateCreate = $date->format("Y-m-d");
        $id = 0;
        $idUpdate = 0;
        $userId = 0;
        $lastName = "";
        $firstName = "";
        $phone = 0;
        $note = "";
        $status = 0;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (isset($_POST['idUpdate'])) {
                $idUpdate = $_POST['idUpdate'];
            }
            if (isset($_POST['userId'])) {
                $userId  = $_POST['userId'];
            }
            if (isset($_POST['lastName'])) {
                $lastName = $_POST['lastName'];
            }
            if (isset($_POST['firstName'])) {
                $firstName = $_POST['firstName'];
            }
            if (isset($_POST['phone'])) {
                $phone = $_POST['phone'];
            }
            if (isset($_POST['note'])) {
                $note = $_POST['note'];
            }
            if (isset($_POST['status'])) {
                $status = $_POST['status'];
            }
            $sl = new sales();
            $sl->updateOrder($id, $idUpdate, $userId, $lastName, $firstName, $phone, $status, $note, $dateCreate);
            if (isset($sl)) {
                echo '<script>alert("cập nhật thành công")</script>';
                // include "../Views/admin/listProducts.php";
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listOrders"/>';
            } else {
                echo '<script>alert("cập nhật không thành công")</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listOrders"/>';
            }
        }
        break;
    case "remove-order":
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sl = new sales();
            $sl->removeOrder($id);
            if (isset($sl)) {
                echo '<script>alert("Xóa Sản Phẩm Thành Công")</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listOrders"/>';
            }
        }


        break;
    case "update-status":
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $status = $_GET['status'];
            $sl = new sales();
            $sl->updateStatus($id, $status);
            if (isset($sl)) {
                echo '<script>alert("Cập Nhật Trạng Thái Thành Công")</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listOrders"/>';
            }
        }


        break;
    case "list-order-detail":
        include "../Views/admin/listOrderDetail.php";

        break;
    case "edit-order-detail":
        include "../Views/admin/editOrderDetail.php";

        break;

        break;
    case "edit-order-detail-action":
        $id = 0;
        $idUpdate = 0;
        $quantity = 0;
        $total = 0;
        $orderId = 0;
        $proId = 0;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (isset($_GET['orderId'])) {
                $orderId = $_GET['orderId'];
            }
            if (isset($_POST['idUpdate'])) {
                $idUpdate = $_POST['idUpdate'];
            }
            if (isset($_POST['proId'])) {
                $proId = $_POST['proId'];
            }
            if (isset($_POST['quantity'])) {
                $quantity  = $_POST['quantity'];
            }

            $pr = new products();
            $result = $pr->getProductById($proId);
            if ($result['promotion'] == 0) {
                $total = $result['price'] * $quantity;
            } else {
                $total = $result['promotion'] * $quantity;
            }



            $sl = new sales();
            $result0 = $sl->getOrderById($idUpdate);
            if ($result0) {
                $subTotal = 0;
                $subTotal1 = 0;
                $sl->updateOrderDetail($id, $idUpdate, $quantity, $total);

                if (isset($sl)) {
                    $result1 = $sl->getAllOrderDetail($orderId);
                    while ($set = $result1->fetch()) {
                        $subTotal = $subTotal + $set['total'];
                    };
                    $result2 = $sl->getAllOrderDetail($idUpdate);
                    while ($set1 = $result2->fetch()) {
                        $subTotal1 = $subTotal1 + $set1['total'];
                    };
                    $sl->updateTotalOrder($idUpdate, $subTotal1);
                    $sl->updateTotalOrder($orderId, $subTotal);
                    $result3 = $sl->getAllOrders();
                    while ($set2 = $result3->fetch()) {
                        if ($set2['total'] == 0) {
                            $sl->removeOrder($set2['order_id']);
                        }
                    };
                    $result4 = $sl->getAllOrderDetail($idUpdate);
                    for ($i = 0; $i < count(array($result4)); $i++) {
                    }

                    echo '<script>alert("cập nhật thành công")</script>';
                    // include "../Views/admin/listProducts.php";
                    echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=list-order-detail&orderId=' . $orderId . '"/>';
                } else {
                    echo '<script>alert("cập nhật không thành công")</script>';
                    echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=list-order-detail&orderId=' . $orderId . '"/>';
                }
            } else {
                echo '<script>alert("Không Thể Chuyển Sản Phẩm Sang Đơn Hàng Không Tồn Tại")</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=list-order-detail&id=' . $id . '&orderId=' . $orderId . '"/>';
            }
        }

        break;
    case "remove-order-detail":
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sl = new sales();
            $sl->removeOrderDetail($id);

            if (isset($sl)) {
                echo '<script>alert("Xóa Sản Phẩm Thành Công")</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listOrders"/>';
            }
        }


        break;








    case 'forgotPassword':
        include "../Views/admin/veriEmailForgotPassword.php";
        break;
    case 'forgot_action':
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $_SESSION['email'] = array();
            // kiểm tra email có tồn tại không
            $ac = new accounts();
            $checkemail = $ac->getEmail($email);
            if ($checkemail != false) {
                $_SESSION['email'] = $email;
                include "../Views/admin/forgotPassword.php";
            } else {
                echo '<script> alert("Email không tồn tại");</script>';
                include "../Views/admin/veriEmailForgotPassword.php";
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
        include "../Views/admin/resetPassword.php";
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
                $ac = new accounts();
                $ac->updatePassword($email, $newPass);
                echo '<script> alert("Đổi Mật Khẩu Thành Công");</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?act=auth&use=login"/>';
            } else {
                echo '<script> alert("Mã code sai");</script>';
                include "../Views/admin/resetPassword.php";
            }
        }
        break;
    case 'changePassword':
        include "../Views/admin/veriChangePassword.php";
        break;
    case 'change_action':
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $_SESSION['email'] = array();
            // kiểm tra email có tồn tại không
            $ac = new accounts();
            $checkemail = $ac->getEmail($email);
            if ($checkemail != false) {
                $_SESSION['email'] = $email;
                include "../Views/admin/changePassword.php";
            } else {
                echo '<script> alert("Email không tồn tại");</script>';
                include "../Views/admin/veriChangePassword.php";
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
            $ac = new accounts();
            $checkOldPass = $ac->checkPassword($_SESSION['email'], md5($oldPass));
            if ($checkOldPass) {
                if ($newPassAgain ==  $newPass) {
                    $ac->updatePassword($_SESSION['email'], md5($newPass));
                    echo '<script> alert("Đổi Mật Khẩu Thành Công");</script>';
                    include "../Views/admin/login.php";
                } else {
                    echo '<script> alert("Mật Khẩu Lặp Lại Không Chính Xác");</script>';
                    include "../Views/admin/changePassword.php";
                }
            } else {
                echo '<script> alert("Mật Khẩu Củ Không Chính Xác");</script>';
                include "../Views/admin/changePassword.php";
            }
        }
        break;

    case 'listAccounts':
        include "../Views/admin/listAccounts.php";
        break;
    case 'edit-account':
        include "../Views/admin/editAccount.php";
        break;
    case "edit-account-action":
        $id = 0;
        $idUpdate = 0;
        $lastName = "";
        $firstName = "";
        $phone = 0;
        $email = "";
        $username = "";
        $role = 2;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if (isset($_POST['idUpdate'])) {
                $idUpdate = $_POST['idUpdate'];
            }
            if (isset($_POST['lastName'])) {
                $lastName = $_POST['lastName'];
            }
            if (isset($_POST['firstName'])) {
                $firstName = $_POST['firstName'];
            }
            if (isset($_POST['phone'])) {
                $phone = $_POST['phone'];
            }
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
            }
            if (isset($_POST['username'])) {
                $username = $_POST['username'];
            }
            if (isset($_POST['role'])) {
                $role = $_POST['role'];
            }
            $date = new DateTime("now");
            $dateCreate = $date->format("Y-m-d");

            $ac = new accounts();
            $result = $ac->updateAccount($id, $idUpdate, $lastName, $firstName, $phone, $email, $username, $role, $dateCreate);



            if (!isset($result)) {
                echo '<script>alert("cập nhật thành công")</script>';
                // include "../Views/admin/listProducts.php";
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listAccount"/>';
            } else {
                echo '<script>alert("cập nhật không thành công' . $result . '")</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listAccount"/>';
            }
        }



        break;
    case "remove-account":
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $ac = new accounts();
            $sl = new sales();
            $result = $sl->getAllOrderDetail($id);
            while ($set = $result->fetch()) {
                $sl->removeOrderDetailByOrderId($set['order_id']);
            }
            $sl->removeOrderByUser($id);
            $cmt = new comments();
            $result = $cmt->removeComments($id);
            if (!isset($result)) {


                $result = $ac->removeAccount($id);

                if (!isset($result1)) {
                    echo '<script>alert("Xóa Tài Khoản Thành Công")</script>';
                    echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listAccounts"/>';
                }
            }
        }


        break;

    case 'reset-pass-account':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $ac = new accounts();
            $result = $ac->resetPasswordAccount($id);
            if (!isset($result)) {
                echo '<script>alert("Reset Mật Khẩu Thành Công")</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listAccounts"/>';
            } else {
                echo '<script>alert("Reset Mật Khẩu Thất Bại")</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listAccounts"/>';
            }
        }


        break;




    case 'statistical':
        include "../Views/admin/statistical.php";
        break;
    case 'statistical_filed':
        include "../Views/admin/statistical.php";
        break;
    case 'import-file':

        include "../Views/admin/importProducts.php";

        break;

    case 'import-action':

        if (isset($_POST['submit_file'])) {
            $file = $_FILES['file']['tmp_name'];
            file_put_contents($file, str_replace("\xEF\xBB\xBF", "", file_get_contents($file)));
            $file_open = fopen($file, "r");
            while (($csv = fgetcsv($file_open, 1000, ",")) != false) {
                $db = new connect();
                $id = $csv[0];
                $name = $csv[1];
                $type_id = $csv[2];
                $price = $csv[3];
                $promotion = $csv[4];
                $pro_image = $csv[5];
                $quantity = $csv[6];
                $description = $csv[7];
                $dateCreate = $csv[8];
                $date = date("Y-m-d", $dateCreate);
                $query = "INSERT INTO products(id, name, type_id, price, promotion, pro_image, quantity, description, created_at)
                  VALUES ($id,'$name',$type_id,$price,$promotion,'$pro_image',$quantity,'$description','$date')";
                $db->exec($query);
            }
            // fclose($file);
            echo '<script>alert("Import Thành Công")</script>';
            echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listProducts"/>';
        }

        break;

    case 'listType':
        include "../Views/admin/listProtypes.php";
        break;

    case 'edit-type':
        include "../Views/admin/editType.php";
        break;
    case 'edit-type-action':
        $id = 0;
        $idUpdate = 0;
        $typeName = "";


        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if (isset($_POST['idUpdate'])) {
                $idUpdate = $_POST['idUpdate'];
            }
            if (isset($_POST['type_name'])) {
                $typeName = $_POST['type_name'];
            }



            $pr = new products();
            $result = $pr->updateType($id, $idUpdate, $typeName);


            if (!isset($result)) {
                echo '<script>alert("cập nhật thành công")</script>';
                // include "../Views/admin/listProducts.php";
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listType"/>';
            } else {
                echo '<script>alert("cập nhật không thành công' . $result . '")</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listType"/>';
            }
        }
        include "../Views/admin/editType.php";
        break;

    case 'edit-type':
        include "../Views/admin/editType.php";
        break;
    case 'remove-type':
        $id = 0;



        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $pr = new products();
            $cmt = new comments();
            $result = $pr->getProductByType($id);
            while ($set = $result->fetch()) {
                $cmt->removeCommentsByProduct($set['id']);
            }


            $result1 = $pr->removeProductByType($id);





            if (!isset($result1)) {
                echo '<script>alert("cập nhật thành công")</script>';
                // include "../Views/admin/listProducts.php";
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listType"/>';
            } else {
                echo '<script>alert("cập nhật không thành công' . $result . '")</script>';
                echo '<meta http-equiv="refresh"  content="0; url=./admin.php?use=listType"/>';
            }
        }
        include "../Views/admin/editType.php";
        break;
}
