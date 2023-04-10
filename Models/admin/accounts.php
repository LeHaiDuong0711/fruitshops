<?php
class accounts
{
   // ham khoi tao
   public function __construct()
   {
   }
   // phương thức insert vào database 
   function InsertUser($first_name, $last_name, $username, $password, $phone,$email, $passwordAgain,$date_create)
   {
      if($password==$passwordAgain){
        $pass = md5($password); 

         $db = new connect();
         $query = "INSERT INTO users (user_id,image,First_name,Last_name,phone,email,username,password,role_id,date_create) VALUES (null,'avatar7.png','$first_name', '$last_name', $phone,'$email','$username', '$pass',1,'$date_create')";
         $db->exec($query);
   
   }}
      //phương thức kiểm tra tên người dùng
      function checkUser($username){
         $db = new connect();
         $query = "SELECT * from users where username= '$username'";
         $result = $db->get_Instance($query);
        return $result;
      }
      function loginUser($us,$pass){
         $db = new connect();
         $select = "select * from users where username = '$us' and password = '$pass' and role_id =1";
         $result = $db->get_Instance($select);
         return $result;
      }

      public function checkRole($username)
      {
        $db = new connect();
        $select = "select * from users where username='$username' and role_id =1";
        $result = $db->get_Instance($select);
        return $result;
      }
      //phương thức kiểm tra email
      function getEmail($email){
         $db=new connect();
         $select = "select * from users where email='$email'";
         $result = $db->get_instance($select);
         return $result;
      }
       function updatePassword($email, $newPass)
       {
           $db=new connect();
           $query="update users set password ='$newPass' where email='$email'";
           $db->exec($query);
       }
       function checkPassword($email,$password){
         $db= new connect();
         $select = "select * from users where email='$email' and password = '$password'";
         $result = $db->get_instance($select);
         return $result;
       }
       function countAllAccounts()
       {
           $db = new connect();
           $select = "SELECT COUNT(*) FROM users";
           $result = $db->get_instance($select);
           return $result[0];
       }
       public function countAccounts($keyword)
       {
           $db = new connect();
           $select = "select count(*) from users";
           if ($keyword != "") {
               $select = "select count(*) from users where  username = $keyword";
           }
           $result = $db->get_instance($select);
           return $result[0];
       }
       public function getAllAccountPage($start, $limit, $keyword)
       {
           // $id_order = (int) $keyword;
           $db = new connect();
           $select = "select * from users order by user_id asc limit " . $start . "," . $limit;
           if ($keyword != "") {
               $select = "select * from users order by user_id asc where  username = $keyword limit " . $start . "," . $limit;
           }
           $result = $db->get_list($select);
           return $result;
       }
       public function getAccountById($id)
       {
   
           //b1 ket noi data
           $db = new connect();
           // b2 truy van
           $select = "SELECT * FROM users WHERE user_id = $id";
           //ai thuc hien select
           $result = $db->get_instance($select);
           return $result; //kết quả được lấy về 12 sản phẩm
       }
       public function updateAccount($id,$idUpdate, $lastName,$firstName, $phone,$email, $username, $role,$created_at)
    {
        $db = new connect();
        $query = "update users set user_id=$idUpdate, First_name='$firstName',  Last_name='$lastName',  phone=$phone,  email='$email',  username='$username',  role_id=$role, date_create='$created_at' where user_id=$id      ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);
    }
    public function removeAccount($id)
    {
        $db = new connect();
        $query = "delete from users where user_id = $id ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);

        
    }

    public function resetPasswordAccount($id)
    {
        $db = new connect();
        $password = md5("Haiduong#2k3");
        $query = "update users set password = '$password' where user_id = $id ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);

        
    }
}
