<?php 
class products{
    function __construct()
    {
        
    }

    public function  getAllProducts(){
     
        //b1 kết nối database
        $db= new connect();
        //b2 viết truy vấn;
        $select="SELECT *FROM products ";
        $result=$db->get_list($select);
        return $result;
        
    }

    public function get3NewProductsByTypeID($type_id)
    {
        

         //b1 ket noi data
        $db = new connect();
        // b2 truy van
        $select="SELECT * FROM products WHERE $type_id = type_id ORDER BY created_at DESC LIMIT 0,3";
        //ai thuc hien select
        $result=$db->get_list($select);
        return $result;

    }

    public function getAllNewProducts()
    {
        
         //b1 ket noi data
         $db = new connect();
         // b2 truy van
         $select="SELECT * FROM products ORDER BY id DESC LIMIT 0,9";
         //ai thuc hien select
         $result=$db->get_list($select);
         return $result;
 
  
    }

    public function getProductsTopSellingByType($type_id)
    {
    
         //b1 ket noi data
         $db = new connect();
         // b2 truy van
         $select="select a.pro_id, b.name, b.type_id,b.price,b.promotion,b.pro_image,b.quantity,b.description,b.created_at, sum(a.quantity) as subquantity from orderdetails a, products b WHERE a.pro_id = b.id and type_id = $type_id GROUP BY a.pro_id ASC  limit 3;" ;
         //ai thuc hien select
         $result=$db->get_list($select);
         return $result;
    }

    public function getProductById($id)
    {
       
         //b1 ket noi data
         $db = new connect();
         // b2 truy van
         $select="SELECT * FROM products WHERE $id = id";
         //ai thuc hien select
         $result=$db->get_instance($select);
         return $result;
    }
    public function getProductsByType($type_id)
    {
       

        //b1 ket noi data
        $db = new connect();
        // b2 truy van
        $select="SELECT * FROM products WHERE $type_id = type_id ";
        //ai thuc hien select
        $result=$db->get_list($select);
        return $result; //kết quả được lấy về 12 sản phẩm

    }

    public function getFeaturedFruit()
    {
        
         //b1 ket noi data
         $db = new connect();
         // b2 truy van
         $select="SELECT * FROM products WHERE feature = 1 AND type_id = 1 LIMIT 3";
         //ai thuc hien select
         $result=$db->get_list($select);
         return $result; //kết quả được lấy về 12 sản phẩm
    }
  
    public function getFeaturedCake()
    {
        //b1 ket noi data
        $db = new connect();
        // b2 truy van
        $select="SELECT * FROM products WHERE feature = 1 AND type_id = 2 LIMIT 3";
        //ai thuc hien select
        $result=$db->get_list($select);
        return $result; //kết quả được lấy về 12 sản phẩm
    }
    public function getFeaturedVegetable()
    {
       //b1 ket noi data
       $db = new connect();
       // b2 truy van
       $select="SELECT * FROM products WHERE feature = 1 AND type_id = 3 LIMIT 3";
       //ai thuc hien select
       $result=$db->get_list($select);
       return $result; //kết quả được lấy về 12 sản phẩm
    }
  

  

    //phương thức đếm số lượng sản phẩm để phân trang
   public function countProducts($type_id,$keyword){
        $db=new connect();
        $select="select count(*) from products";
        if($type_id!=0&&$keyword!=""){
            $select="select count(*) from products where type_id=$type_id and name like '%$keyword%'";
        }
        else if ($type_id!=0){
            $select="select count(*) from products where type_id=$type_id";
        }
        else if($keyword!=""){
            $select="select count(*) from products where  name like '%$keyword%'";
        }
        else if($type_id==0&&$keyword==""){

        }
        $result=$db->get_instance($select);
        return $result[0];

    }

    //phương thức phân trang
    public function getAllProductsPage($start,$limit,$type_id,$keyword){
        $db=new connect();
        $select="select * from products limit ".$start.",".$limit;
        if($type_id!=0 && $keyword!=""){
            $select="select * from products where type_id=$type_id and name like '%$keyword%' limit ".$start.",".$limit;
        }
        else if($type_id!=0){
            $select="select * from products where type_id=$type_id  limit ".$start.",".$limit;
        }
        else if($keyword!=""){
            $select="select * from products where  name like '%$keyword%' limit ".$start.",".$limit;
        }
        $result=$db->get_list($select);
        return $result;

    }

    public function getSupplier($id)
    {
        $db= new connect();
        $select = "select b.id, b.name, b.address, b.phone from products a,suppliers b where a.id = $id and a.sup_id = b.id";
        $result = $db->get_instance($select);
        return $result; 
    }


}
