<?php
/**
 * Created by PhpStorm.
 * User: MewMew
 * Date: 3/6/2019
 * Time: 7:27
 */
require_once "Models/ModelShoes.php";
require_once "Views/ViewShoes.php";

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ControllerShoes
{
    var $model, $view;
    public function __construct()
    {
        $this->view = new ViewShoes();
        $this->model = new ModelShoes();
    }
    // trang chu
    public function getPageHome(){
        $result = $this->model->phanTrang();
        $row = mysqli_fetch_assoc($result);
        $total_record = $row['total'];
        // tìm số lượng trang và số sản phẩm trên 1 trang
        $current_page = isset($_GET['page'])? $_GET['page']:1;
        $limit = 15;
        // tổng trang
        $total_page = ceil($total_record/$limit);
        //
        if ($current_page > $total_page){
            $current_page = $total_page;
        }else if ($current_page < 1){
            $current_page = 1;
        }
        //trang bắt đầu
        $start = ($current_page - 1) * $limit;
        $result = $this->model->getDataHome($start,$limit);
        $arr = [];
        $temp = [];
        $temp['current_page'] = $current_page;
        $temp['total_page'] = $total_page;
        array_push($arr, $temp);

        $this->view->getPageHome($result, $arr);
    }
    // adidas
    public function getPageAdidas(){
        $result = $this->model->getDataAdidas();
        $this->view->getPageAdidas($result);
    }
    //balance
    public function getPageBalance(){
        $result = $this->model->getDataBalance();
        $this->view->getPageBalance($result);
    }
    //puma
    public function getPagePuma(){
        $result = $this->model->getDataPuma();
        $this->view->getPagePuma($result);
    }
    //trang dang nhap
    public function getPageLogin(){
        $this->view->getPageLogin();
    }
    //trang dang ky
    public function getPageRegister(){
        $this->view->getPageRegister('');
    }
    //trang chi tiet
    public function getDetailPage($product_id)
    {
        $data = [];
        $products = $this->model->detailProduct($product_id);
        while($row = mysqli_fetch_assoc($products)) {
            $temp = [];
            $temp['id'] = $row['id_product'];
            $temp['name'] = $row['name_product'];
            $temp['price'] = $row['price'];
            $temp['trandmark'] = $row['name_trandmark'];
            $temp['quantity'] = $row['quanity'];
            $temp['image'] = $row['image'];
            $temp['a'] = $row['a'];
            $temp['b'] = $row['b'];
            $temp['c'] = $row['c'];
            $temp['d'] = $row['d'];
            $temp['e'] = $row['e'];
            array_push($data, $temp);
        }
        $this->view->getPageDetail($data);
    }
    // trang quản lý user
    public function getPageUser(){
        $listUser = $this->model->getDataUser();
        $this->view->getPageUser($listUser);
    }
    // quản lý sản phẩm
    public function getPageProduct(){
        $listProduct = $this->model->getDataProduct();
        $productsBySize = [];
        while($row = mysqli_fetch_assoc($listProduct)) {
            $temp = [];
            $temp['id'] = $row['id_product'];
            $temp['name'] = $row['name_product'];
            $temp['price'] = $row['price'];
            $temp['trandmark'] = $row['name_trandmark'];
            $temp['quantity'] = $row['quanity'];
            $temp['image'] = $row['image'];
            array_push($productsBySize, $temp);
        }
        $this->view->getPageProduct($productsBySize);
    }
    // lấy tranng quản lý đơn hàng
    public function getPageBill(){
        $listBill = $this->model->getDataBill();
        $this->view->getPageBill($listBill);
    }
    // Xóa thành viên
    public function deleteUser(){
        $this->model->deleteUser();
        header("location:index.php?task=pagemanager");
    }
    // dang nhap
    public function doLogin(){
        $result = $this->model->doLogin();
        if($result!==false){
            $_SESSION['id_user'] = $result['id_user'];
            $_SESSION['username'] = $result['name'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['phone'] = $result['phone'];
            $_SESSION['address'] = $result['address'];
            $_SESSION['level'] = $result['level'];

            if ($result['level'] == 2){
                header("location:index.php?task=pageuser");
            }elseif ($result['level'] == 1){
                header("location:index.php?task=pagehome");
            }
        }
    }
    // dang ky
    public function doRegister($name, $email, $phone,$address, $password, $created){
        $result =  $this->model->doRegister($name, $email, $phone,$address, $password, $created);
        $message = "Đăng ký thành công !";
        echo "<script type='text/javascript'>alert('$message');</script>";
        $this->view->getPageRegister();
    }
    public function doRegister1($name, $email, $phone,$address, $password, $created){
        $result =  $this->model->doRegister($name, $email, $phone,$address, $password, $created);
        $message = "Đăng ký thành công !";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header("location:index.php?task=pageuser");
    }
    // Tìm kiếm
    public function doSearch(){
        // tìm kiếm
        $key = isset($_POST['text_search'])? $_POST['text_search']:null;
        $result = $this->model->doSearch($key);
        $this->view->getPageSearch($result);
    }
    // Thêm sản phẩm
    public function addProduct($name_product, $price, $quanity, $trandmark,$created, $mt1 ,$mt2 ,$mt3 ,$mt4 ,$mt5){
        if (isset($_FILES['imagefile']['name'])){
            $path = "Image/thietBi/".$trandmark."/";
            $image = $_FILES['imagefile']['name'];
            move_uploaded_file($_FILES['imagefile']['tmp_name'], $path.$image);
            // them anh
            if (empty($name_product) || empty($price) || empty($quanity) || empty($trandmark)){
                header("location:".$_SERVER['REQUEST_URI']."");
            }else {
                $this->model->addProduct($name_product,$price,$quanity, $trandmark,$path . $image, $created,$mt1,$mt2,$mt3,$mt4,$mt5);
            }
        }else{
            echo "<div class='container mt-4' style='width: 380px;'><div class='alert alert-success text-center'>Vui lòng chọn ảnh!</div></div>";
        }
    }
    // trang sửa sản phẩm
    public function getPageEditProduct(){
        $result = $this->model->getPageEditProduct();
        $this->view->getPageEditProduct($result);
    }
    public function doUpdateProduct(){
        $result = $this->model->editProduct();
        if ($result == true){
            header("location:index.php?task=pageproduct");
        }else{
            var_dump($result);
        }
    }
    // Xóa sản phẩm
    public function delProduct(){
        $result = $this->model->delProduct();
        if ($result == true){

            header("location:index.php?task=pageproduct");
        }else{
            var_dump($result);
        }
    }
    // gio hang
    function add_to_cart($info)
    {
        if (count($_SESSION['cart']) > 0) {
            $this->merge($info);
        } else {
            array_push($_SESSION['cart'], $info);
        }
        //header('Location: '.$_SERVER["REQUEST_URI"].'');
    }
    // Xóa khỏi giỏ hàng
    function remove_from_cart($product_id)
    {
        $ids = array_column($_SESSION['cart'], 'id');
        if(in_array($product_id, $ids)) {
            $key = array_search($product_id, $ids);
            print_r($key);
            if($key !== false) {
                unset($_SESSION['cart'][$key]);
                Sort($_SESSION['cart']);
                header('Location: '.$_SERVER["HTTP_REFERER"].'');
            }
        }
    }
    // Tăng số lượng sản phẩm nếu sản phẩm bị trùng
    function merge($new_added)
    {
        $ids = array_column($_SESSION['cart'], 'id');
        if(in_array($new_added['id'], $ids)) {
            for($i = 0; $i < count($_SESSION['cart']); $i++) {
                if($_SESSION['cart'][$i]['id'] == $new_added['id']) {
                    $total_quantity = $_SESSION['cart'][$i]['quantity'] + $new_added['quantity'];
                    if($total_quantity < 11) {
                        $_SESSION['cart'][$i]['quantity'] = $total_quantity;
                    } else {
                        $_SESSION['cart'][$i]['quantity'] = 10;
                    }
                }
            }
        } else {
            array_push($_SESSION['cart'], $new_added);
        }
    }
    // lấy dữ liệu giỏ hàng
    public function getPageCart(){
        $product_info = [];
        for ($i=0; $i < count($_SESSION['cart']); $i++) {
            $data['quantity'] = $_SESSION['cart'][$i]['quantity'];
            $data['product_info'] = $this->model->getProductDetails($_SESSION['cart'][$i]['id']);
            array_push($product_info, $data);
        }
        $data = $product_info;
        $this->view->getPageCart($data);
    }
    public function getPagePayment(){
        $this->view->getPagePayment();
    }
    public function payment(){
        include('Email.php');
        $Email = new Email();
        $Email->sendEmail();
        $this->model->creatDetailOrder();
    }
    public function getUpdateUser() {
        $result = $this->model->getUpdateUser();
        $this->view->getPageUpdateUser($result);
    }
    public function doUpdateUser() {
        $result = $this->model->editUser();
    }
    public function doExcel() {
        $result = $this->model->getExcel(); // Lấy dữ liệu từ mô hình của bạn

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setTitle('thông tin mua hàng');

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(65);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(70);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);

        $spreadsheet->getActiveSheet()->setCellValue('A1','name product');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'name');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'email');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'phone');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'address');

        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Company name');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'Company email');
        $spreadsheet->getActiveSheet()->setCellValue('H1', 'Company SDT');
        $spreadsheet->getActiveSheet()->setCellValue('I1', 'Company address');

        $spreadsheet->getActiveSheet()->setCellValue('J1', 'payment_method');
        $spreadsheet->getActiveSheet()->setCellValue('K1', 'total');
        $spreadsheet->getActiveSheet()->setCellValue('L1','created' );
        
        
        $numRow = 2;
        foreach ($result as $row) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $numRow, $row['name_product']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $numRow, $row['name']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $numRow, $row['email']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $numRow, $row['phone']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $numRow, $row['address']);

            $spreadsheet->getActiveSheet()->setCellValue('F' . $numRow, 'BHT');
            $spreadsheet->getActiveSheet()->setCellValue('G' . $numRow, 'BHT@gmail.com');
            $spreadsheet->getActiveSheet()->setCellValue('H' . $numRow, '0948023888');
            $spreadsheet->getActiveSheet()->setCellValue('I' . $numRow, 'Số nhà 99, đường quang vinh, P.quang vinh, TP.thái nguyên, Thái nguyên');

            $spreadsheet->getActiveSheet()->setCellValue('J' . $numRow, $row['payment_method']);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $numRow, $row['total']);
            $spreadsheet->getActiveSheet()->setCellValue('L' . $numRow, $row['created']);

            $numRow++;
        }

        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="BHT_' . time() . '.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}