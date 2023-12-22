<?php 
    require './inc/db_config.php' ;
    include './inc/function.php';
?>

<div class = "pro" id = "bodyRight">
<h3 id="scroll">Hiển thị tất cả đơn hàng</h3>
<form id="" method="POST" autocomplete = "off" enctype="multipart/form-data">
    <table>
        <tr>
            <th>ID Đặt hàng</th>
            <th>ID Khách hàng</th>
            <th>ID Sản phẩm</th>
            <th>Số lượng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Ngày đặt</th>
            <th>Địa chỉ</th>
        </tr>
            <?php echo view_order(); ?>
    </table>
</form>
</div>