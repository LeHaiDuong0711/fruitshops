<?php class wishlist{
    function __construct()
    {
        
    }

    function addWishlist($user_id,$pro_id){
        $db = new connect();
        $query = "INSERT INTO wishlists (id,user_id,pro_id) VALUES (null,$user_id,$pro_id)";
        $db->exec($query);
     }


    function getWishlist($user_id,$pro_id){
        $db = new connect();
        $query = "SELECT * from wishlists where user_id= $user_id and pro_id=$pro_id";
        $result = $db->get_Instance($query);
       return $result;

    }

    function getWishlistByUser($user_id){
        $db = new connect();
        $query = "SELECT * from wishlists where user_id= $user_id";
        $result = $db->get_list($query);
       return $result;

    }
    
    function delete($key)
    {
        $db = new connect();
        $query = "DELETE FROM wishlists WHERE id=$key";
        $db->exec($query);
    }
    function sum_total()
    {
        $subtotal = 0;
        foreach ($_SESSION['cart'] as $item) {
            $subtotal += $item['total'];
        }
        return number_format($subtotal, 2);
    }
} ?>