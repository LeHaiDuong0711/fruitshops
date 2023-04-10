<?php
class users
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
         $query = "INSERT INTO users (user_id,image,First_name,Last_name,phone,email,username,password,role_id,date_create) VALUES (null,'avatar7.png','$first_name', '$last_name', $phone,'$email','$username', '$pass',2,'$date_create')";
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
         $select = "select * from users where username = '$us' and password = '$pass'";
         $result = $db->get_Instance($select);
         return $result;
      }
      //phương thức kiểm tra email
      function getEmail($email){
         $db=new connect();
         $select = "select * from users where email='$email '";
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
}
