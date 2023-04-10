<?php
class sales
{

    public function __construct()
    {
    }
    // public function insertOrder($order_id, $user_id, $firstName, $lastName, $phone, $note)
    // {

    //     $db = new connect();
    //     $date = new DateTime('now');
    //     $dateformat = $date->format('Y-m-d');
    //     $insert = "INSERT INTO orders(order_id,user_id,lastName,firstName,phone,total,note,date_create,status ) values($order_id,$user_id,'$lastName','$firstName','$phone',0,'$note','$dateformat',0)";
    //     $db->exec($insert);
    //     //sau khi insert đc mã hóa đơn rồi lấy ra mã hóa đơn vừa insert vào
    //     // $bill = $db->get_instance("select order_id from orders order by order_id desc limit 1");
    //     // return $bill[0];
    // }
    function countAllOrders()
    {
        $db = new connect();
        $select = "SELECT COUNT(*) FROM orders";
        $result = $db->get_instance($select);
        return $result[0];
    }
    public function getAllOrders()
    {
        // $id_order = (int) $keyword;
        $db = new connect();
        $select = "select * from orders ";
        $result = $db->get_list($select);
        return $result;
    }
    public function getAllOrdersPage($start, $limit, $keyword)
    {
        // $id_order = (int) $keyword;
        $db = new connect();
        $select = "select * from orders order by order_id asc limit " . $start . "," . $limit;
        if ($keyword != "") {
            $select = "select * from orders order by order_id asc where  order_id = $keyword limit " . $start . "," . $limit;
        }
        $result = $db->get_list($select);
        return $result;
    }
    //phương thức đếm số lượng sản phẩm để phân trang
    public function countOrders($keyword)
    {
        $db = new connect();
        $select = "select count(*) from orders";
        if ($keyword != "") {
            $select = "select count(*) from orders where  order_id = $keyword";
        }
        $result = $db->get_instance($select);
        return $result[0];
    }
    public function getOrderById($id)
    {

        //b1 ket noi data
        $db = new connect();
        // b2 truy van
        $select = "SELECT * FROM orders WHERE  order_id = $id";
        //ai thuc hien select
        $result = $db->get_instance($select);
        return $result; 
    }
    public function updateOrder($id, $idUpdate, $userId, $lastName, $firstName, $phone, $status, $note, $created_at)
    {
        $db = new connect();
        $query = "update orders set order_id=$idUpdate, user_id = $userId,  lastName='$lastName', firstName='$firstName',  phone=$phone,  note='$note',  date_create='$created_at',status =$status where order_id=$id     ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);
        $query = "update orderdetails set order_id=$idUpdate where order_id=$id      ";
        $db->exec($query);
    }
    public function updateTotalOrder($orderId, $subTotal)
    {
        $db = new connect();
        $query = "update orders set total=$subTotal where order_id=$orderId     ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);
    }

    public function removeOrder($id)
    {
        $db = new connect();
        $query = "delete from orderdetails where order_id = $id ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);
        $query = "delete from orders where order_id = $id ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);
    }

    public function removeOrderByUser($user_id)
    {
        $db = new connect();
        $query = "delete from orders where user_id = $user_id ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);
    }
    public function updateStatus($id, $status)
    {
        $db = new connect();
        $query = "update orders set status =$status where order_id=$id ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);
    }






    function countAllOrderDetail($orderId)
    {
        $db = new connect();
        $select = "SELECT COUNT(*) FROM orderdetails where order_id =$orderId";
        $result = $db->get_instance($select);
        return $result[0];
    }
    public function getAllOrderDetail($orderId)
    {
        // $id_order = (int) $keyword;
        $db = new connect();
        $select = "select * from orderdetails where order_id =$orderId  order by order_id asc";
        $result = $db->get_list($select);
        return $result;
    }
    public function getAllOrderDetailPage($orderId, $start, $limit)
    {
        // $id_order = (int) $keyword;
        $db = new connect();
        $select = "select * from orderdetails where order_id =$orderId  order by order_id asc limit " . $start . "," . $limit;
        $result = $db->get_list($select);
        return $result;
    }

    public function getOrderDetailById($id)
    {

        //b1 ket noi data
        $db = new connect();
        // b2 truy van
        $select = "SELECT * FROM orderdetails WHERE  id = $id";
        //ai thuc hien select
        $result = $db->get_instance($select);
        return $result; //kết quả được lấy về 12 sản phẩm
    }
    public function updateOrderDetail($id,$idUpdate, $quantity, $total)
    {
        $db = new connect();
        $query = "update orderdetails set order_id=$idUpdate, quantity = $quantity,  total=$total where id=$id     ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);
    } 

    public function removeOrderDetail($id)
    {
        $db = new connect();
        $query = "delete from orderdetails where id = $id ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);
    }

    public function removeOrderDetailByOrderId($order_id)
    {
        $db = new connect();
        $query = "delete from orderdetails where order_id = $order_id ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);
    }


    
}
