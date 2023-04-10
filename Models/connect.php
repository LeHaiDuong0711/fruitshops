<?php
class connect
{
    var $db = null;
    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=fruitshop';
        $user = 'root';
        $pass = '';
        try {
            $this->db = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function get_list($select)
    {
        $result = $this->db->query($select);
        return $result;
    }

    //phương thức thực thi trả về 1 object
    // thuoc thuc tra ve ob
    public function get_instance($select)
    {
        $result = $this->db->query($select);
        $result = $result->fetch();
        return $result;
    }

    public function exec($query){
        $result=$this->db->exec($query);
        return $result;
    }

  
}
