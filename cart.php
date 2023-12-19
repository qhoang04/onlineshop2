<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/pe.css">
        <!-- online css -->
    <link rel="stylesheet" href="./assets/boostrap.min.css">
    <link rel="stylesheet" href="./assets/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./assets/fontawesome/scss/_animated.scss">
    <link rel="stylesheet" href="./assets/fontawesome/scss/_icons.scss">

</head>
<body>
    
    <?php
        include './inc/function.php'; 
        include './inc/header.php'; 
        include './inc/navbar.php';
    ?>
    <?php 
        if(isset($_GET['remove'])){
            echo "
            <form id = 'alertForm' method='POST'>
            <center>
            <p>Bạn muốn xóa sản phẩm này ra khỏi giỏ hàng?</p>
            </center>
            <button type='submit'  name='1' id='ok'>Đồng ý</button>
            <button type='submit' name='0' id = 'can'>Hủy</button>
            </form>
            ";
        }
        function cart_details($user_id) {
            require 'inc/db_config.php';
            $ip = getIp();
            $stmt = $con->prepare("SELECT * FROM cart WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                // Hiển thị chi tiết giỏ hàng
                echo "
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá (VND)</th>
                    <th>Tổng cộng (VND)</th>
                    <th>Trạng thái</th>
                    <th>Xóa</th>
                </tr>
                ";
        
                $net_total = 0;
                while ($row = $stmt->fetch()):
                    $pro_id = $row['pro_id'];
                    $cart_pro = $con->prepare("SELECT * FROM products WHERE pro_id = :pro_id");
                    $cart_pro->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);
                    $cart_pro->setFetchMode(PDO::FETCH_ASSOC);
                    $cart_pro->execute();
                    $cart_pro = $cart_pro->fetch();
        
                    echo "<tr>
                        <td><a href='pro_detail.php?pro_id=".$cart_pro['pro_id']."'><img src='./img/products_img/".$cart_pro['img1']."'></a></td>
                        <td>".$cart_pro['product_name']."</td>
                        <td>
                            <a id='sub' href='cart.php?decrease_qty&cart_id=".$row['cart_id']."'>-</a>
                            ".$row['qty']."
                            <a id='add' href='cart.php?increase_qty&cart_id=".$row['cart_id']."'>+</a>
                        </td>
                        <td>".number_format($cart_pro['price'], 0, ',', '.')." <span style='text-decoration: underline; font-size: 1.1rem'>đ</span></td>
                        <td>".number_format(($cart_pro['price'] * $row['qty']), 0, ',','.')." <span style='text-decoration: underline; font-size: 1.1rem'>đ</span></td>
                        <td>Đang xử lý</td>
                        <td><a id='remove' href='cart.php?remove&cart_id=".$row['cart_id']."'>&times</a></td>
                    </tr>";
        
                    $net_total += $cart_pro['price'] * $row['qty'];
                endwhile;
        
                // Hiển thị tổng tiền và nút Đặt hàng
                echo "<tr>
                    <td><button id='shopping'><a href='index.php'>Quay lại mua</a></button></td>
                    <td><form method='post'><button id='checkOut' name='checkout_btn'>Đặt mua ngay</button></form></td>
                    <td></td>
                    <td></td>
                    <td><b><span>Tổng tiền hàng: </span>".number_format($net_total, 0, ',', '.')." VND</b></td>
                    <td></td>
                    <td></td>
                </tr>";
                if (isset($_POST['checkout_btn'])) {
                    echo "<script>window.open('inc/payment.php', '_self')</script>";
                }
        
            } else {
                // Hiển thị thông báo khi giỏ hàng trống
                echo "<center><h5 class='not_found'>Không có sản phẩm trong giỏ hàng.<a href='index.php'> <br>Quay lại mua</a></h5></center>";
            }
        
            // Gọi hàm xử lý giảm/giữ số lượng sản phẩm
            qty_decrease();
            qty_increase();
        }
        
        
        function delete_cart(){
            require 'inc/db_config.php';
            if(isset($_POST['1'])){
                $cart_id = $_GET['cart_id'];
                $stmt = $con->prepare("DELETE FROM cart WHERE cart_id = $cart_id");
                if( $stmt->execute()){
                    echo "<script>window.open('cart.php', '_self')</script>";
                }
            }elseif(isset($_POST['0'])){
                echo "<script>window.open('cart.php', '_self')</script>";
            }
        }
    ?>
    <div class="cart">
        <form method="post" enctype='multipart/form-data' >
            <table cellpadding="0" cellspacing="0">
                <?php cart_details($_SESSION['user_id']);delete_cart(); ?>
            </table>
        </form>
    </div>
    <?php include './inc/footer.php';?>


</body>
</html>