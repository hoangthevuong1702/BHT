<?php
/**
 * Created by PhpStorm.
 * User: MewMew
 * Date: 3/6/2019
 * Time: 7:33
 */
require_once "Controllers/ControllerShoes.php";

session_start();

// controller
$ControllShoe = new ControllerShoes();
$task =isset($_GET['task'])? $_GET['task']:null;

//login

$name = isset($_POST['name'])? $_POST['name']:null;
$email = isset($_POST['email'])? $_POST['email']:null;
$phone = isset($_POST['phone'])? $_POST['phone']:null;
$address = isset($_POST['address'])? $_POST['address']:null;
$password = isset($_POST['password'])? $_POST['password']:null;
$repassword = isset($_POST['repassword'])? $_POST['repassword']:null;
$created = date("Y.m.d");

// product
$name_product = isset($_POST['name_product'])? $_POST['name_product']:null;
$name_product = isset($_POST['name_product'])? $_POST['name_product']:null;
$price = isset($_POST['price'])? $_POST['price']:null;
$quanity = isset($_POST['quanity'])? $_POST['quanity']:null;
$trandmark = isset($_POST['trandmark'])? $_POST['trandmark']:null;
$mt1  = isset($_POST['mt1'])? $_POST['mt1']:null;
$mt2  = isset($_POST['mt2'])? $_POST['mt2']:null;
$mt3  = isset($_POST['mt3'])? $_POST['mt3']:null;
$mt4  = isset($_POST['mt4'])? $_POST['mt4']:null;
$mt5  = isset($_POST['mt5'])? $_POST['mt5']:null;

// thuong hieu
$converse = isset($_POST['converse'])? $_POST['converse']:null;
$adidas = isset($_POST['adidas'])? $_POST['adidas']:null;
$balanciaga = isset($_POST['balanciaga'])? $_POST['balanciaga']:null;
$puma = isset($_POST['puma'])? $_POST['puma']:null;
$blance = isset($_POST['blance'])? $_POST['blance']:null;
$vans = isset($_POST['vans'])? $_POST['vans']:null;
$tim = isset($_POST['tim'])? $_POST['tim']:null;


// gio hang
if (empty($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

// dang nhap
if (isset($_POST['login'])){
    $ControllShoe->doLogin();
}
// dang ky
if (isset($_POST['register'])){
    if (empty($name) || empty($email) || empty($phone || empty($address)  || empty($password) || empty($repassword))){
        $message = "Không được để trống !";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }elseif ($password != $repassword){
        $message = "Mật khẩu không trùng nhau !";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }elseif (isset($name) && isset($email) && isset($phone) && isset($address)  && isset($password) && isset($repassword) && $repassword = $password){
        $ControllShoe->doRegister($name, $email, $phone, $address, $password, $created);
    }
}
if (isset($_POST['register1'])){
    if (empty($name) || empty($email) || empty($phone || empty($address)  || empty($password) || empty($repassword))){
        $message = "Không được để trống !";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }elseif ($password != $repassword){
        $message = "Mật khẩu không trùng nhau !";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }elseif (isset($name) && isset($email) && isset($phone) && isset($address)  && isset($password) && isset($repassword) && $repassword = $password){
        $ControllShoe->doRegister1($name, $email, $phone, $address, $password, $created);
    }
}
// them san pham
if (isset($_POST['add_product'])){
    $ControllShoe->addProduct($name_product, $price, $quanity, $trandmark,$created,$mt1 ,$mt2 ,$mt3 ,$mt4 ,$mt5);
}
// sủa sản phẩm
if (isset($_POST['update_product'])){
    $ControllShoe->doUpdateProduct();
}
// them vao gio hang
if (isset($_POST['btn-cart'])){
    $arr = [];
    $arr['id'] = $_POST['id'];
    $arr['quantity'] = $_POST['quantity'];
    $ControllShoe->add_to_cart($arr);
}
// thanh toan
$payment_method = isset($_POST['payment_method'])? $_POST['payment_method']:null;
if (isset($_POST['payment'])){
    if (isset($_SESSION['username'])){
        header("location:index.php?task=payment");
    }else{
        header("location:index.php?task=pagelogin");
    }
}

// giao hàng
if (isset($_POST['ship'])){
    $ControllShoe->payment();
}
// sửa thông tin user
if (isset($_POST['update_User'])){
    $ControllShoe->doUpdateUser();
}
switch ($task){

    // giay
    case 'pagehome':
        $ControllShoe->getPageHome();
        break;
    case 'pageadidas':
        $ControllShoe->getPageAdidas();
        break;
    case 'pagepuma':
        $ControllShoe->getPagePuma();
        break;
    case 'pagebalance':
        $ControllShoe->getPageBalance();
        break;
    case 'pagelogin':
        $ControllShoe->getPageLogin();
        break;
    case 'pageregister':
        $ControllShoe->getPageRegister();
        break;
    case 'pageuser':
        $ControllShoe->getPageUser();
        break;
    case 'pageproduct':
        $ControllShoe->getPageProduct();
        break;
    case 'pagebill':
        $ControllShoe->getPageBill();
        break;
    case 'deleteuser':
        $ControllShoe->deleteUser();
        break;
    case 'editproduct':
        $ControllShoe->getPageEditProduct();
        break;
    case 'deleteproduct':
        $ControllShoe->delProduct();
        break;
    case 'detail':
        $ControllShoe->getDetailPage($_GET['id']);
        break;
    case 'cart':
        $ControllShoe->getPageCart();
        break;
    case 'del_cart':
        $ControllShoe->remove_from_cart($_GET['id']);
        break;
    case 'payment':
        $ControllShoe->getPagePayment();
        break;
    case 'logout':
        session_destroy();
        header("location:index.php?task=pagehome");
        break;
    // tìm kiếm
    case 'timkiem':
        $ControllShoe->doSearch();
        break;
    case 'updateUser':
        $ControllShoe->getUpdateUser();
        break;   
    case 'excel':
        $ControllShoe->doExcel();
        break; 
    default:
        $ControllShoe->getPageHome();
        break;
}
