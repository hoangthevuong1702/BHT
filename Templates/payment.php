<!DOCTYPE html>
<html lang="en">

<link href="bootstrap/bootstrap.css" rel="stylesheet">
<script src="bootstrap/bootstrap.bundle.js"></script>
<script src="bootstrap/bootstrap.js"></script>
<link rel="stylesheet" href="Css/css.css">
<link rel="stylesheet" href="fontawesome/css/all.css">
<link rel="stylesheet" href="slick/slick-1.8.1/slick/slick.css">
<link rel="stylesheet" href="slick/slick-1.8.1/slick/slick-theme.css">
<head>
    <?php include_once "Templates/Partials/Head.php";?>
</head>
<body>
<div class="bg-light mb-5">
    <div class="container" style="height: 100%; min-height: 400px;">
        <h4 class="rounded" style="border-bottom: solid 3px #F18620; color: #E8E8E8;">
            <div class="mt-2 p-1 bg-main rounded" style="width: 170px;">THANH TOÁN</div>
        </h4>
        <form method="POST" enctype="application/x-www-form-urlencoded">
            <table>
                <tr class="form-group">
                    <td>Họ tên</td>
                    <td><input class="form-control" name="username" type="text" value="<?php echo $_SESSION['username']; ?>"></td>
                </tr>
                <tr class="form-group">
                    <td>Địa chỉ email</td>
                    <td><input class="form-control" name="email" type="text" value="<?php echo $_SESSION['email']; ?>"></td>
                </tr>
                <tr class="form-group">
                    <td>Số điện thoại</td>
                    <td><input class="form-control" name = "phone" type="text" value="<?php echo $_SESSION['phone'];?>"></td>
                </tr>
                <tr class="form-group">
                    <td>Địa chỉ</td>
                    <td><input class="form-control" name = "address" type="text" value="<?php echo $_SESSION['address'];?>"></td>
                </tr>
                <tr class="form-group">
                    <td>Tổng tiền</td>
                    <td><input class="form-control" name= "total"type="text" name="total" value="<?php echo ($_SESSION['total']);?>"></td>
                </tr>
                <tr class="form-group">
                    <td>Phương thức thanh toán</td>
                    <td>
                        <input type="radio" name="payment_method" value="Ship COD" checked>Giao hàng tại nhà(COD) <br>
                    </td>
                </tr>

            </table>
            <div><input class="btn btn-danger" type="submit" name="ship" value="Giao hàng"></div>
        </form>
    </div>
</div>
<?php include_once "Templates/link.php";?>
<footer>
    <?php include_once "Templates/Partials/Footer.php";?>
</footer>
</body>

</html>