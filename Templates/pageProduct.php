<!DOCTYPE html>
<html lang="en">

<link href="bootstrap/bootstrap.css" rel="stylesheet">
<script src="bootstrap/bootstrap.bundle.js"></script>
<script src="bootstrap/bootstrap.js"></script>
<link rel="stylesheet" href="Css/c.css">
<link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/all.css">
<link rel="stylesheet" href="slick/slick-1.8.1/slick/slick.css">
<link rel="stylesheet" href="slick/slick-1.8.1/slick/slick-theme.css">
<head>
    <?php include_once "Templates/Partials/Head.php";?>
</head>
<body>
<div class="bg-light">
    <div class="container">
        <div class="row mt-3" style="min-height: 300px;">
            <div class="col-lg-3">
                <h1>Quản lý</h1>
                <div class="list-group">
                    <a class="list-group-item" href="index.php?task=pageuser">Quản lý thành viên</a>
                    <a class="list-group-item" href="index.php?task=pageproduct">Quản lý sản phẩm</a>
                    <a class="list-group-item" href="index.php?task=pagebill">Quản lý đơn hàng</a>
                </div>
            </div>
            <div class="col-lg-9">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#listproduct">Danh sách sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#addproduct">Thêm sản phẩm</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="listproduct" class="container tab-pane active">
                        <h3 class="text-center">Danh sách sản phẩm</h3><!--Danh sach san pham-->
                        <div class="text-center">
                            <table class="table text-center w-100">
                                <tr>
                                    <th>ID</th>  <!--lam tiep-->
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Thương hiệu</th>
                                    <th>Số lượng </th>
                                    <th>Hình ảnh</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                                <?php foreach($listProduct as $row){ ?>
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['price'] ?></td>
                                    <td><?php echo $row['trandmark'] ?></td>
                                    <td><?php echo $row['quantity'] ?></td>
                                    <td><img width="90px" height="90px" src="<?php echo $row['image']?>" alt=""></td>
                                    <td><a class="text-success" href="index.php?task=editproduct&id=<?php echo $row['id']; ?>"><i class="far fa-edit"></i></a></td>
                                    <td><a class="text-danger" href="index.php?task=deleteproduct&id=<?php echo $row['id'];?>"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>
                                <?php }; ?>
                            </table>
                        </div>
                        <!--code database-->
                    </div>
                    <div id="addproduct" class="container tab-pane fade"> <!--Thêm sản phẩm-->
                        <h3 class="text-center">Thêm sản phẩm</h3>
                        <form method="POST" action="" enctype="multipart/form-data" id="form-add-product">
                            <div class="form-group">
                                <label for="">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="name_product" placeholder="Tên sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="">Giá sản phẩm</label>
                                <input class="form-control" type="number" name="price" placeholder="Giá sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="">Số lượng</label>
                                <input class="form-control" type="number" name="quanity" placeholder="Số lượng">
                            </div>
                            <div class="form-group">
                                <label for="">Loại</label>
                                <select name="trandmark" class="form-control">
                                    <option value="1">Camera</option>
                                    <option value="2">Thiết bị mạng</option>
                                    <option value="3">Thiết bị lưu chữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Ảnh</label>
                                <input type="file" name="imagefile" id="imagefile">
                            </div>
                            <div class="form-group">
                                <ul style="padding:0px">
                                    <label for="">Mô tả sản phẩm</label>
                                    <li style="margin-bottom:32px">
                                    <input class="form-control" type="text" name="mt1">
                                    </li style="margin-bottom:32px">
                                    <li style="margin-bottom:32px">
                                    <input class="form-control" type="text" name="mt2">
                                    </li>
                                    <li style="margin-bottom:32px">
                                    <input class="form-control" type="text" name="mt3">
                                    </li>
                                    <li style="margin-bottom:32px">
                                    <input class="form-control" type="text" name="mt4">
                                    </li>
                                    <li style="margin-bottom:32px">
                                    <input class="form-control" type="text" name="mt5">
                                    </li>
                                </ul>
                            </div>
                            <br>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary btn-add-product" name="add_product" value="Thêm sản phẩm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <?php include_once "Templates/Partials/Footer.php";?>
</footer>
<script src="bootstrap/jquery-3.3.1.min.js"></script>
<script src="bootstrap/popper.min.js"></script>
<script src="bootstrap/bootstrap.min.js"></script>
</body>

</html>