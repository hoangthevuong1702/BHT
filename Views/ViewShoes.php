<?php
/**
 * Created by PhpStorm.
 * User: MewMew
 * Date: 3/6/2019
 * Time: 7:27
 */

class ViewShoes
{
    public function getPageHome($result, $arr){
        include_once "Templates/Home.php";
    }
    public function getPageContact(){
        include_once "Templates/contact.php";
    }
    public function getPageNews(){
        include_once "Templates/news.php";
    }
    public function getPageMenShoes($result){
        include_once "Templates/MenShoes.php";
    }
    public function getPageWomenShoes($result){
        include_once "Templates/WomenShoes.php";
    }
    public function getPageLogin(){
        include_once "Templates/FormLogin.php";
    }
    public function getPageRegister(){
        include_once "Templates/FormRegister.php";
    }
    public function getPageAdidas($result){
        include_once "Templates/adidas.php";
    }
    public function getPageVans($result){
        include_once "Templates/vans.php";
    }
    public function getPagePuma($result){
        include_once "Templates/puma.php";
    }
    public function getPageBalenciaga($result){
        include_once "Templates/balenciaga.php";
    }
    public function getPageBalance($result){
        include_once "Templates/balance.php";
    }
    public function getPageConverse($result){
        include_once "Templates/converse.php";
    }
    public function getPageSearch($result){
        include_once "Templates/formTimKiem.php";
    }
    // quản lý user
    public function getPageUser($listUser){
        include_once "Templates/pageUser.php";
    }
    // update user
    public function getUpdateUser(){
        include_once "Templates/updateUser.php";
    }
    // quản lý sản phẩm
    public function getPageProduct($listProduct){
        include_once "Templates/pageProduct.php";
    }
    // quản lý hóa đơnt
    public function getPageBill($listBill){
        include_once "Templates/bill.php";
    }
    public function getPageEditProduct($result){
        include_once "Templates/FormEditProduct.php";
    }
    public function getPageDetail($data){
        include_once "Templates/detail_product.php";
    }
    public function getPageCart($data){
        include_once "Templates/cart.php";
    }
    public function getPagePayment(){
        include_once "Templates/payment.php";
    }
    public function getPageUpdateUser($result) {
        include_once "Templates/updateUser.php";
    }
}