<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
<div id="bodyLeft">
    <h3>Quản Lý Cửa Hàng</h3>
    <ul>
        <li><a href="index.php"><i class="fa-solid fa-house"></i>   Trang chủ</a></li>
        <li><a href="index.php?add_category"><i class="fa-solid fa-list"></i>  Quản lý danh mục</a></li>
        <li><a href="index.php?add_subcat"><i class="fa-solid fa-layer-group"></i>  Quản lý danh mục mở rộng</a></li>
        <li><a href="index.php?add_product"><i class="fa-solid fa-square-plus"></i>  Thêm sản phẩm</a></li>
        <li><a href="index.php?view_product"><i class="fa-solid fa-box"></i>  Quản lý sản phẩm</a></li>
        <li><a href="index.php?view_order"><i class="fa-solid fa-file-invoice"></i>  Quản lý đơn hàng</a></li>
        <!-- <li><a href="#">Home</a></li> -->
    </ul>
</div><!--End of body left-->

<?php 
    if(isset($_GET['add_category'])){
        require 'cat.php';
    }
    if(isset($_GET['add_subcat'])){
        require 'subcat.php';
    }
    if(isset($_GET['add_product'])){
        require 'add_products.php';
    }
    if(isset($_GET['view_product'])){
        require 'view_product.php';
    }
    if(isset($_GET['view_order'])){
        require 'view_order.php';
    }
?>