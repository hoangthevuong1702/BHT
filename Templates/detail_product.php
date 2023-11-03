<!DOCTYPE html>
<html lang="en">
<?php include_once "Templates/link.php";?>
<head>
    <?php include_once "Templates/Partials/Head.php";?>
</head>
<body>
<div class="bg-light">
    <?php foreach ($data as $product) {?>
    <div class="container">
        <div class="row mx-auto mt-2 mb-2">
            <div class="col-4">
                <img width="300px" height="300px" src="<?php echo $product['image']?>" alt="">
            </div>
            <div class="col-8">
                <form action="" method="post">
                <ul class="space">
                    <label for="">Tên sản phẩm:</label>
                       <?php echo $product['name']; ?>
                    </li>
                    <?php $count=0; $skip = 6;
                    foreach ($product as $key => $value) { 
                        if($count< $skip) {
                            $count++;
                            continue;
                        }?>
                        <?php if(!empty($value)) { ?>
                            <li>
                                <i class="fa-solid fa-check"></i>   
                                <?php echo $value; ?>
                            </li>
                       <?php } ?>
                    <?php } ?>
                    <li>
                        <h5 style="margin:10px 0px">Bảo hành 24 tháng</h5>
                    </li>
                    <li>
                        <span>Chưa tính chi phi lắp đặt tại nơi</span>
                    </li>
                    <li class="oVuong">
                        <div class="ovuong1">
                            <label for="">Giá:</label>
                            <?php echo $product['price']?>
                        </div>
                    </li>
                    
                </ul>
                    
                <div>
                    <input type="hidden" value="<?php echo $product['id'] ?>" name="id">
                    <input id="quantity" type="text" value="" name="quantity">
                    <input class="btn btn-danger" type="submit" name="btn-cart" value="THÊM VÀO GIỎ HÀNG">
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<footer>
    <?php include_once "Templates/Partials/Footer.php";?>
</footer>
<script>
    $("input[name='quantity']").TouchSpin({
        initval: 1,
        min: 1,
        max: 20
    });
</script>
</body>

</html>