<?php
class comments{
    function __construct()
    {
        
    }

    function removeComments($userId){
        $db = new connect();
        $query="delete from comments where user_id = $userId";
        $db->exec($query);
    }

    function removeCommentsByProduct($pro_id){
        $db = new connect();
        $query="delete from comments where pro_id = $pro_id";
        $db->exec($query);
    }
    

}


?>