<!DOCTYPE html>
<html lang="en">
<?php include_once "Templates/link.php";?>
<head>
    <?php include_once "Templates/Partials/Head.php";?>
</head>
<body>
<div class="bg-light">
    <div class="container">
        <form method="POST" action="" enctype="multipart/form-data">
            <h4 class="rounded" style="border-bottom: solid 3px #F18620; color: #E8E8E8;">
                <div class="mt-2 p-1 bg-main rounded" style="width: 325px;">SỬA THÔNG TIN USER</div>
            </h4>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="hidden" name="idan" value="<?=$result['id_user']?>">
                    <input class="form-control" type="text" name="name" value="<?=$result['name'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control" type="text" name="email" value="<?=$result['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input class="form-control" type="number" name="phone" value="<?=$result['phone']?>">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control" type="number" name="password" value="<?=$result['password']?>">
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input class="form-control" type="text" name="address" value="<?=$result['address']?>">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary infor__main-input-btn " type="submit" name = "update_User" value="Sửa thông tin">
                </div>
        </form>
    </div>
</div>
<footer>
    <?php include_once "Templates/Partials/Footer.php";?>
</footer>
</body>
</html>