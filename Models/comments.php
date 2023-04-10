<?php
class comments{
    function __construct()
    {
        
    }

    function insertComments($pro_id, $user_id, $content){
        $db=new connect();
        $date=new DateTime("now");
        $dateCreate=$date->format("Y-m-d");
        $query="Insert into comments(id,prod_id,user_id,content,date_cmt) values(Null,$pro_id,$user_id,'$content','$dateCreate')";
        $db->exec($query);
    }
    function countComment($prod_id){
        $db = new connect();
        $select = "select count(id) from comments where prod_id = $prod_id";
        $result = $db->get_instance($select);
        return $result[0];
    }
    function getComments($prodId, $start, $limit){
        $db= new connect();
        $select = "select a.username, b.content, b.date_cmt from users a inner join comments b on a.user_id=b.user_id where b.prod_id=$prodId order by date_cmt DESC limit ".$start.",".$limit;
        $result=$db->get_list($select);
        return $result;
    }

}


?>