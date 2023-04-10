<?php
class bill{
    public function __construct(){
      
    }
    // phương thức insert vào bảng hóa đơn
    public function insertOrder($order_id,$user_id,$firstName,$lastName,$phone,$note){
       $db = new connect();
       $date = new DateTime('now');
       $dateformat = $date ->format('Y-m-d');
       $insert = "INSERT INTO orders(order_id,user_id,lastName,firstName,phone,total,note,date_create,status ) values($order_id,$user_id,'$lastName','$firstName','$phone',0,'$note','$dateformat',0)";
       $db->exec($insert);
       //sau khi insert đc mã hóa đơn rồi lấy ra mã hóa đơn vừa insert vào
       $bill= $db -> get_instance("select order_id from orders order by order_id desc limit 1");
       return $bill[0];
    }
    public function insertOrderDetail($order_id,$pro_id,$pro_name,$price,$quantity,$total){
       $db = new connect();
       $insert = "INSERT INTO orderdetails(id,order_id,pro_id,pro_name,price,quantity,total)
       values(null,$order_id,$pro_id,'$pro_name',$price,$quantity,$total)";
       $db -> exec($insert);
    }
    public function updateTotal($order_id,$sum_total){
       $db = new connect();
       $select = "UPDATE orders set total = $sum_total where $order_id = order_id";
       $db ->exec($select);
    }
    public function getOrderId(){
      $db=new connect();
      $order_id_temp=$db->get_instance("select order_id from orders ORDER BY order_id DESC LIMIT 1");
      
      $order_id=1;
      if(isset($order_id_temp[0])){
         $order_id=(int)$order_id_temp[0]+1;
      }
     
      return $order_id;
    }

    public function updateQuantityProducts($pro_id,$quantity){
      $db = new connect();
      $select = "UPDATE products set quantity = quantity-$quantity where id = $pro_id and quantity>=$quantity";
      $db ->exec($select);
   }
  
}

?>