<?php 
    require './inc/db_config.php' ;
    include './inc/function.php';
?>
<div class = "pro" id = "bodyRight">
<h3 id="scroll">Hiển thị tất cả sản phẩm</h3>
<form id="view_pro" method="POST" autocomplete = "off" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Thứ tự</th>
            <th>Quản lý</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh sản phẩm</th>
            <th>Mô tả 1</th>
            <th>Mô tả 2</th>
            <th>Mô tả 3</th>
            <th>Mô tả 4</th>
            <th>Giá (vnđ)</th>
            <th>Số hiệu sản phẩm</th>
            <th>Bảo hành</th>
            <th>Keyword</th>
            <th>Ngày thêm</th>
        </tr>
            <?php echo view_product(); ?>
    </table>
</form>
</div>