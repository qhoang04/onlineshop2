<?php include './inc/function.php'; ?>
<div id = "bodyRight" class="tablecate">
<h3>Hiển thị tất cả danh mục</h3>
<form action="" method="POST" autocomplete = "off" enctype="multipart/form-data">
    <table >
        <tr>
            <th>Thứ tự</th>
            <th>Tên danh mục</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
            <?php echo view_cat(); ?>
    </table>
</form>
<h3 id="add-cat">Thêm danh mục ở đây</h3>
    <form  method="POST" autocomplete = "off" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Tên danh mục: </td>
                <td><input type="text" name = "cat_name" Placeholder = "Nhập tên danh mục"></td>
            </tr>
        </table>
        <center>
            <button type = "submit" name = "add_cat">Thêm danh mục</button>
        </center>
    </form>
</div>

<?php echo add_cat(); ?>