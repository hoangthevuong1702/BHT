<!DOCTYPE html>
<html lang="en">

<link href="bootstrap/bootstrap.css" rel="stylesheet">
<script src="bootstrap/bootstrap.bundle.js"></script>
<script src="bootstrap/bootstrap.js"></script>
<link rel="stylesheet" href="Css/c.css">
<link rel="stylesheet" href="fontawesome/css/all.css">
<link rel="stylesheet" href="slick/slick-1.8.1/slick/slick.css">
<link rel="stylesheet" href="slick/slick-1.8.1/slick/slick-theme.css">
<head>
    <?php include_once "Templates/Partials/Head.php";?>
</head>
<body>
<div class="bg-light">
    <div class="container">
        <form method="POST" action="" enctype="multipart/form-data">
            <h4 class="rounded" style="border-bottom: solid 3px #F18620; color: #E8E8E8;">
                <div class="mt-2 p-1 bg-main rounded" style="width: 325px;">SỬA THÔNG TIN SẢN PHẨM</div>
            </h4>
            <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input type="hidden" name="idan" value="<?=$result['id_product']?>">
                <input class="form-control" type="text" name="name_product" value="<?=$result['name_product'] ?>">
            </div>
            <div class="form-group">
                <label for="">Giá sản phẩm</label>
                <input class="form-control" type="number" name="price" value="<?=$result['price'] ?>">
            </div>
            <div class="form-group">
                <label for="">Số lượng</label>
                <input class="form-control" type="number" name="quantity" value="<?=$result['quanity']?>">
            </div>
            <div class="form-group">
                <label for="">Loại</label>
                <select name="trandmark" class="form-control">
                    <option value="1">Camera</option>
                    <option value="2">Mạng</option>
                    <option value="3">Thiết bị lưu chữ</option>
                </select>
            </div>
            <div class="form-group">
                <ul style="padding:0px">
                    <label for="">Mô tả sản phẩm</label>
                    <li style="margin-bottom:32px">
                    <input class="form-control" type="text" name="mt1" value="<?=$result['a']?>">
                    </li style="margin-bottom:32px">
                    <li style="margin-bottom:32px">
                    <input class="form-control" type="text" name="mt2" value="<?=$result['b']?>">
                    </li>
                    <li style="margin-bottom:32px">
                    <input class="form-control" type="text" name="mt3" value="<?=$result['c']?>">
                    </li>
                    <li style="margin-bottom:32px">
                    <input class="form-control" type="text" name="mt4" value="<?=$result['d']?>">
                    </li>
                    <li style="margin-bottom:32px">
                    <input class="form-control" type="text" name="mt5" value="<?=$result['e']?>">
                    </li>
                </ul>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name = "update_product" value="Cập nhật sản phẩm">
            </div>
        </form>
    </div>
</div>
<footer>
    <?php include_once "Templates/Partials/Footer.php";?>
</footer>
</body>

</html>