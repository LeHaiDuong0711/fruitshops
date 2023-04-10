<?php
class products
{
    function __construct()
    {
    }

    function countAllProducts()
    {
        $db = new connect();
        $select = "SELECT COUNT(*) FROM products";
        $result = $db->get_instance($select);
        return $result[0];
    }
    //phương thức phân trang
    public function getAllProductsPage($start, $limit, $keyword)
    {
        $db = new connect();
        $select = "select * from products order by id asc limit " . $start . "," . $limit;
        if ($keyword != "") {
            $select = "select * from products  order by id asc where  name like '%$keyword%' limit " . $start . "," . $limit;
        }
        $result = $db->get_list($select);
        return $result;
    }
    //phương thức đếm số lượng sản phẩm để phân trang
    public function countProducts($keyword)
    {
        $db = new connect();
        $select = "select count(*) from products";
        if ($keyword != "") {
            $select = "select count(*) from products where  name like '%$keyword%'";
        }
        $result = $db->get_instance($select);
        return $result[0];
    }
    public function getProductById($id)
    {

        //b1 ket noi data
        $db = new connect();
        // b2 truy van
        $select = "SELECT * FROM products WHERE $id = id";
        //ai thuc hien select
        $result = $db->get_instance($select);
        return $result; //kết quả được lấy về 12 sản phẩm
    }

    public function getProductByType($id)
    {

        //b1 ket noi data
        $db = new connect();
        // b2 truy van
        $select = "SELECT * FROM products WHERE type_id = $id";
        //ai thuc hien select
        $result = $db->get_list($select);
        return $result; //kết quả được lấy về 12 sản phẩm
    }
   

    public function upLoadImage()
    {
        //tạo dường dẫn lưu hình
        $dir = "../Contents/img/";
        //lấy tên hình
        $file = $dir . basename($_FILES['image']['name']);
        //kiểm tra định dạng file
        $imageType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        //kiểm tra up load thành công không
        $uploadImage = 1;
        if (isset($_POST['submit'])) {
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check != false) {
                $uploadImage = 1;
            } else {
                $uploadImage = 0;
                echo '<script>alert("ảnh không tồn tại")</script>';
            }
        }
        if (file_exists($file)) {
            $uploadImage = 0;
            echo '<script>alert("ảnh đã tồn tại")</script>';
        }
        //kiểm tra size ảnh
        if ($_FILES['image']['size'] > 500000) {
            $uploadImage = 0;
            echo '<script>alert("ảnh vượt quá 500kb")</script>';
        }
        //kiểm tra dduuoi mở rộng
        if ($imageType !== "jpg" && $imageType !== "jpeg" && $imageType !== "png" && $imageType !== "gif") {
            $uploadImage = 0;
            echo '<script>alert("Không Phải file Ảnh")</script>';
        }
        //tiến hành đưa ảnh về thư mục
        if ($uploadImage == 1) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                echo '<script>alert("upload thành công")</script>';
            } else {
                echo '<script>alert("upload không thành công")</script>';
            }
        }
    }
    public function updateProduct($id,$idUpdate, $name, $type_id, $image, $price, $promotion, $quantity, $description, $created_at)
    {
        $db = new connect();
        $query = "update products set id=$idUpdate, name='$name',  type_id=$type_id,  price=$price,  promotion=$promotion,  pro_image='$image',  quantity=$quantity,  description='$description',  created_at='$created_at' where id=$id      ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);
    }

    public function removeProduct($id)
    {
        $db = new connect();
        $query = "delete from products where id = $id ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);

        
    }

    public function removeProductByType($type_id)
    {
        $db = new connect();
        $query = "delete from products where type_id = $type_id ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);

        
    }

    public function insertProduct($name, $type_id, $image, $price, $promotion, $quantity, $description, $created_at)
    {
        $db = new connect();
        $query = "INSERT INTO products(id, name, type_id, price, promotion, pro_image, quantity, description, created_at)
         VALUES (null,'$name',$type_id,$price,$promotion,'$image',$quantity,'$description','$created_at')";
        $db->exec($query);
    }

    public function getStatistical($month, $year)
    {
        $db=new connect();
        $select = "SELECT a.name, sum(b.quantity) as quantity from products a, orderdetails b , orders c WHERE a.id=b.pro_id and month(c.date_create)=$month and  year(c.date_create)= $year GROUP BY a.name";
        $result = $db->get_list($select);
        return $result;
    }





    function countAllType()
    {
        $db = new connect();
        $select = "SELECT COUNT(*) FROM protypes";
        $result = $db->get_instance($select);
        return $result[0];
    }
    //phương thức phân trang
    public function getAllType($start, $limit, $keyword)
    {
        $db = new connect();
        $select = "select * from protypes order by type_id asc limit " . $start . "," . $limit;
        if ($keyword != "") {
            $select = "select * from protypes order by type_id asc where  name like '%$keyword%' limit " . $start . "," . $limit;
        }
        $result = $db->get_list($select);
        return $result;
    }
    //phương thức đếm số lượng sản phẩm để phân trang
    public function countType($keyword)
    {
        $db = new connect();
        $select = "select count(*) from protypes";
        if ($keyword != "") {
            $select = "select count(*) from protypes where  type_name like '%$keyword%'";
        }
        $result = $db->get_instance($select);
        return $result[0];
    }
    public function getTypeById($id)
    {

        //b1 ket noi data
        $db = new connect();
        // b2 truy van
        $select = "SELECT * FROM protypes WHERE type_id =$id";
        //ai thuc hien select
        $result = $db->get_instance($select);
        return $result; //kết quả được lấy về 12 sản phẩm
    }

   

    
    public function updateType($id,$idUpdate, $name)
    {
        $db = new connect();
        $query = "update protypes set type_id=$idUpdate, type_name='$name'";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);
    }

    public function removeType($id)
    {
        $db = new connect();
        $query = "delete from protypes where type_id = $id ";
        // $query="UPDATE `products` SET `id`=$idUpdate,`name`='$name',`type_id`=$type_id,`price`=$price,`promotion`=$promotion,`pro_image`='$image',`quantity`=$quantity,`description`='$description',`created_at`='$created_at' WHERE `id` = $id";
        $db->exec($query);

        
    }

    public function insertType($type_name)
    {
        $db = new connect();
        $query = "INSERT INTO protypes(type_id, type_name)
         VALUES (null,'$type_name')";
        $db->exec($query);
    }
}
