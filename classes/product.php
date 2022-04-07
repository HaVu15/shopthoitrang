<?php 
  
  
  include_once '../lib/database.php';
  include_once '../helpers/fomat.php';
?>

<?php 
  class product
  {
      private $db;
      private $fm;

      public function __construct()
      {
          $this->db = new Database();
          $this->fm = new Format();
      }
      public function insert_product($data,$files)
      {
          
          $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
          $category = mysqli_real_escape_string($this->db->link, $data['category']);
          $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
          $price = mysqli_real_escape_string($this->db->link, $data['price']);
          $type = mysqli_real_escape_string($this->db->link, $data['type']);
          // Kiem tra hình ảnh và lấy hình ảnh cho vào forder upload
          $permited = array('jpg','jpeg','png','gif');
          $file_name = $_FILES['image']['name'];
          $file_size = $_FILES['image']['size'];
          $file_temp = $_FILES['image']['tmp_name'];

          $div = explode('.',$file_name);
          $file_ext = strtolower(end($div));
          $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
          $uploaded_image = "uploads/".$unique_image;


          if($productName==""|| $category==""||$product_desc==""||$price==""||$type=="" ||$file_name =="" )
          {
              $alert = "<span class='error' style='font-size: 15px;
              color: red;'>Không được bỏ trống</span>";
              return $alert;
          }
          else{
              move_uploaded_file($file_temp,$uploaded_image);
              $query = "INSERT INTO tbl_product (productName,catId,product_desc,price,type,image) VALUES ('$productName','$category','$product_desc','$price','$type','$unique_image')";
              $result = $this->db->insert($query);
              if($result){
                  $alert = "<span class='success' style='font-size: 15px;
                  color: green;'>Thêm sản phẩm thành công</span>";
                  return $alert;
                
              }else{
                $alert = "<span class='error' style='font-size: 15px;
                color: red;'>Thêm sản phẩm không thành công</span>";
                return $alert;

              }

              
              
          }
      }
       public function show_product()
       {
         $query = "SELECT tbl_product.*, tbl_category.catName
          FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
          order by tbl_product.productId desc";

         $result = $this->db->select($query);
        return $result;
       }
      public function getproductbyId($id)
       {
         $query = "SELECT * FROM tbl_product WHERE productId ='$id'";
         $result = $this->db->select($query);
         return $result;
       }
       public function update_product($data,$files,$id)
       {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        // Kiem tra hình ảnh và lấy hình ảnh cho vào forder upload
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if($productName==""|| $category==""||$product_desc==""||$price==""||$type=="" )
        {
            $alert = "<span class='error' style='font-size: 15px;
            color: red;'>Không được bỏ trống</span>";
            return $alert;
        }else{
            if(!empty($file_name)){
 
            if($file_size > 200048){
              $alert = "<span class='success'>Image Size should be less then 2MB</span>";
              return $alert;
            }
            elseif(in_array($file_ext,$permited)===false)
            {
              $alert= "<span class='success'>You can upload only:".implode(',',$permited)."</span>";
              return $alert;
            }
            $query = "UPDATE tbl_product SET 

            productName = '$productName',
            catId = '$category',
            type = '$type',
            price = '$price',
            image = '$unique_image',
            product_desc = '$product_desc'
            WHERE productId ='$id' ";

          }else{
            $query = "UPDATE tbl_product SET 

            productName = '$productName',
            catId = '$category',
            type = '$type',
            price = '$price',
            product_desc = '$product_desc'
            
            WHERE productId ='$id' ";
          }

               $result = $this->db->update($query);
               if($result){
                   $alert = "<span class='success' style='font-size: 15px;
                   color: green;'>Sửa Sản phẩm thành công</span>";
                   return $alert;
                
               }else{
                 $alert = "<span class='error' style='font-size: 15px;
                 color: red;'>SỬa Sản phẩm không thành công</span>";
                 return $alert;

               }

        }
              
           
       }
       public function del_product($id)
       {
         $query = "DELETE  FROM tbl_product WHERE productId ='$id'";
         $result = $this->db->delete($query);
         if($result){
           $alert = "<span class='success' style='font-size: 15px;
           color: green;'>Xóa Sản phẩm thành công</span>";
           return $alert;
        
       }else{
         $alert = "<span class='error' style='font-size: 15px;
         color: red;'>Xóa Sản phẩm không thành công</span>";
         return $alert;

       }
       }
       // end
       public function getproduct_feathered(){
        $query = "SELECT * FROM tbl_product WHERE type ='1' AND catId ='23'";
        $result = $this->db->select($query);
        return $result;
       }
       public function getproduct_feathered1(){
        $query = "SELECT * FROM tbl_product WHERE type ='0' AND catId ='23'";
        $result = $this->db->select($query);
        return $result;
       }
       public function getproduct_feathered2(){
        $query = "SELECT * FROM tbl_product WHERE  catId ='24'";
        $result = $this->db->select($query);
        return $result;
       }
       public function getproduct_feathered3(){
        $query = "SELECT * FROM tbl_product WHERE  catId ='25'";
        $result = $this->db->select($query);
        return $result;
       }
   }

?>