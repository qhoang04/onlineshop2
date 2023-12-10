<div id="bodyLeft">
    <h3>Quản Lý Cửa Hàng</h3>
    <ul>
        <li><a href="index.php">Trang chủ</a></li>
        <li><a href="index.php?add_category">Quản lý danh mục</a></li>
        <li><a href="index.php?add_subcat">Quản lý danh mục mở rộng</a></li>
        <li><a href="index.php?add_product">Thêm sản phẩm</a></li>
        <li><a href="index.php?view_product">Quản lý sản phẩm</a></li>
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
?>