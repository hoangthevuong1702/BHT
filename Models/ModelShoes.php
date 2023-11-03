<?php
/**
 * Created by PhpStorm.
 * User: MewMew
 * Date: 3/6/2019
 * Time: 7:27
 */

class ModelShoes
{
    public function __construct()
    {
        $db = mysqli_connect("localhost", "root","","BHT");
        mysqli_set_charset($db, "utf8");
        $this->db = $db;
    }
    // đăng nhập
    public function doLogin(){
        $query = "SELECT * 
                  FROM users 
                  WHERE email = '".$_POST['email']."' AND password = '".$_POST['password']."'";
        $result = mysqli_query($this->db, $query);
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            return $row;
        }else {
            echo "<script type='text/javascript'>alert('sai tài khoản hoặc mật khẩu');</script>";
        }
        return false;
    }
    // đăng kí
    public function doRegister($name, $email, $phone,$address, $password, $created){
        $query = "INSERT INTO users (name, email, phone,address, password, level, created)
                  VALUES ('".$name."','".$email."', '".$phone."', '".$address."', '".$password."', '1', '".$created."')";
        $result = mysqli_query($this->db, $query);
        return $result;
    }
    // lay du lieu trang chu
    public function getDataHome($start, $limit){
        $query = "SELECT *
                  FROM product
                  LIMIT $start, $limit";
        $result = mysqli_query($this->db, $query);
        return $result;
    }
    // adidas
    public function getDataAdidas(){
        $query = "SELECT *
                  FROM product, trandmark
                  WHERE product.id_trandmark = trandmark.id_trandmark 
                  AND product.id_trandmark = '1'";
        $result = mysqli_query($this->db, $query);
        return $result;
    }
    // puma
    public function getDataPuma(){
        $query = "SELECT *
                  FROM product, trandmark
                  WHERE product.id_trandmark = trandmark.id_trandmark 
                  AND product.id_trandmark = '3'";
        $result = mysqli_query($this->db, $query);
        return $result;
    }
    //balance
    public function getDataBalance(){
        $query = "SELECT *
                  FROM product, trandmark
                  WHERE product.id_trandmark = trandmark.id_trandmark 
                  AND product.id_trandmark = '2'";
        $result = mysqli_query($this->db, $query);
        return $result;
    }
    // them thanh vien
    public function addMember($name, $email, $phone, $password, $created){
        $query = "INSERT INTO users (name, email, phone, password, level, created)
                  VALUES ('".$name."','".$email."', '".$phone."', '".$password."', '1', '".$created."')";
        $result = mysqli_query($this->db, $query);
        return $result;
    }
    // Xóa thành viên
    public function deleteUser(){
        $query = "DELETE FROM users
                  WHERE id_user = '{$_GET['iduser']}'";
        $result = mysqli_query($this->db, $query);
        return $result;
    }
    // lay du lieu user
    public function getDataUser(){
        $query = "SELECT * 
                  FROM users
                  WHERE level = '1'";
        $listUser = mysqli_query($this->db, $query);
        return $listUser;
    }
    // lay du lieu san pham
    public function getDataProduct(){
        $query = "SELECT *
                  FROM product, trandmark
                  WHERE product.id_trandmark = trandmark.id_trandmark";
        $listProduct = mysqli_query($this->db,$query);
        return $listProduct;
    }
    // lấy dữ liệu đơn hàng
    public function getDataBill(){
        $query = "SELECT *
                  FROM bill, users, detailorder, product
                  WHERE bill.id_user   = users.id_user
                  AND bill.id_bill = detailorder.id_bill
                  AND detailorder.id_product = product.id_product";
        $listBill = mysqli_query($this->db, $query);
        return $listBill;
    }
    // lấy dữ liệu trang sửa sản phẩm
    public function getPageEditProduct(){
        $query = "SELECT *
                  FROM product, trandmark
                  WHERE id_product = '{$_GET['id']}'
                  AND product.id_trandmark = trandmark.id_trandmark";
        $result = mysqli_query($this->db, $query);
        return $result->fetch_assoc();
    }
    // Sửa sản phẩm
    public function editProduct(){
        $query = "UPDATE product
                  SET name_product = '{$_POST['name_product']}',
                  price = '{$_POST['price']}',
                  quanity = '{$_POST['quantity']}',
                  id_trandmark = '{$_POST['trandmark']}',
                  a = '{$_POST['mt1']}',
                  b = '{$_POST['mt2']}',
                  c = '{$_POST['mt3']}',
                  d = '{$_POST['mt4']}',
                  e = '{$_POST['mt5']}'
                  WHERE id_product = '{$_POST['idan']}'";
        if (mysqli_query($this->db, $query)){
            $message = "Cập nhật thành công!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }else{
            $message = "Cập nhật thất bại!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }

    }
    // xóa sản phẩm
    public function delProductSize(){
        $query = "DELETE FROM product_size
                  WHERE product_size.id_product = '{$_GET['id']}'";
        if (mysqli_query($this->db, $query)){
            return mysqli_insert_id($this->db);
        };
        return false;
    }
    public function delProduct(){
            $query = "DELETE FROM product
                      WHERE id_product = '{$_GET['id']}'";
            $result = mysqli_query($this->db, $query);
            return $result;
            $message = "Xóa sản phẩm".$_GET['id']." thành công!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        return false;
    }

    // du lieu san pham de them
    public function dataProduct(){
        $query = "SELECT *
                  FROM product, trandmark, type
                  WHERE product.id_trandmark = trandmark.id_trandmark
                  AND product.id_type = type.id_type";
        $dataProduct = mysqli_fetch_assoc($this->db, $query);
        return $dataProduct;
    }
    // tìm kiếm sản phẩm
    public function doSearch(string $key){
        $query = "SELECT *
                  FROM product, trandmark
                  WHERE product.id_trandmark = trandmark.id_trandmark
                  AND (name_trandmark LIKE '%$key%'OR name_product LIKE '%$key%' )";
        $result = mysqli_query($this->db, $query);
        return $result;
    }
    // Thêm sản phẩm
    public function addProduct($name_product, $price, $quanity, $trandmark,$image, $created, $mt1, $mt2, $mt3, $mt4, $mt5){
        $query = "INSERT INTO product(name_product, price, quanity, id_trandmark,image, created, a, b, c, d, e)
                  VALUES ('{$name_product}','{$price}','{$quanity}','{$trandmark}','{$image}', '{$created}','{$mt1}','{$mt2}','{$mt3}','{$mt4}','{$mt5}')";
        mysqli_query($this->db, $query);
        return mysqli_insert_id($this->db);
    }
    public function product_size($product_id)
    {
        $query = "SELECT * FROM product_size, size
                  WHERE id_product = {$product_id} 
                  AND size_id = size.id";
        $result = mysqli_query($this->db, $query);
        $arr = [];
        while($row = mysqli_fetch_assoc($result)) {
            $temp = [];
            $temp['id']   = $row['id'];
            $temp['name'] = $row['name'];
            array_push($arr, $temp);
        }
        return $arr;
    }
    // xem chi tiet sản phẩm
    public function detailProduct($product_id){
        $query = "SELECT *
                  FROM product, trandmark
                  WHERE product.id_trandmark = trandmark.id_trandmark 
                  AND id_product = {$product_id}";
        $listProduct = mysqli_query($this->db,$query);

        return $listProduct;
    }
    // lấy chi tiết sản phẩm
    public function getProductDetails($product_id){
        $query = "SELECT *
                  FROM product, trandmark
                  WHERE product.id_trandmark = trandmark.id_trandmark
                  AND id_product = {$product_id}";
        $result = mysqli_query($this->db,$query);
        $arr = [];
        while($row = mysqli_fetch_assoc($result)){
            $temp = [];
            $temp['id'] = $row['id_product'];
            $temp['name'] = $row['name_product'];
            $temp['price'] = $row['price'];
            $temp['image'] = $row['image'];
            array_push($arr, $temp);
        }
        return $arr;
    }
    //phân trang
    public function phanTrang(){
        // tìm số bản ghi
        $result = mysqli_query($this->db, "SELECT count(id_product) as total FROM product");
        return $result;
    }
    // Thanh toán
    public function creatBill(){
        $created = date("Y.m.d");
        $query = "INSERT INTO bill(payment_method, id_user, total, created)
                  VALUES ('{$_POST['payment_method']}', '{$_SESSION['id_user']}', '{$_SESSION['total']}', '{$created}')";

        if (mysqli_query($this->db, $query)){
            return mysqli_insert_id($this->db);
        };
        return false;
    }
    public function creatDetailOrder(){
        $bill_id = $this->creatBill();
        for($i=0; $i < count($_SESSION['cart']); $i++) {
            $query = "INSERT INTO detailorder(id_product, id_bill, quanity_order, sub_total)
                      VALUES ('{$_SESSION['cart'][$i]['id']}','{$bill_id}','{$_SESSION['cart'][$i]['quantity']}','{$_SESSION['sub_total']}')";
            if (mysqli_query($this->db, $query)){
                $message = "Thanh toán thành công!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                unset($_SESSION['cart']);
                header("refresh:0; url=index.php?task=pagehome");
            }

        }
    }
    public function getUpdateUser() {
        $query = "SELECT *
                  FROM users
                  WHERE id_user = '{$_GET['id']}'";
        $result = mysqli_query($this->db, $query);
        return $result->fetch_assoc();
    }
    public function editUser() {
        $query = "UPDATE users
                  SET name = '{$_POST['name']}',
                  email = '{$_POST['email']}',
                  phone = '{$_POST['phone']}',
                  password = '{$_POST['password']}',
                  address = '{$_POST['address']}'
                  WHERE id_user = '{$_POST['idan']}'";
        if (mysqli_query($this->db, $query)){
            $message = "Cập nhật thành công!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }else{
            $message = "Cập nhật thất bại!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
    public function getExcel() {
        $query = "SELECT * FROM bill
          JOIN users ON bill.id_user = users.id_user
          WHERE bill.id_bill = '{$_GET['id']}'";
        $result = mysqli_query($this->db, $query);

        $data = array(); // Khởi tạo mảng để lưu trữ dữ liệu

        while ($row = $result->fetch_assoc()) {
            $data[] = $row; // Thêm hàng dữ liệu vào mảng
        }

        return $data;
    }
}