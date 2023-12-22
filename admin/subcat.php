<?php   include './inc/function.php';?>
<div id = "bodyRight" class="tablecate">
    <h3>Hiển thị tất cả danh mục mở rộng</h3>
    <form action="" method="POST" autocomplete = "off" enctype="multipart/form-data">
        <table >
            <tr>
                <th>Số thứ tự</th>
                <th>Tên danh mục</th>
                <th>Sửa</th>
                <th>Xóa</th>
                <th>Ảnh</th>
            </tr>
                <?php echo view_subcat(); ?>
        </table>
    </form>  
<h3 id="add-cat">Thêm danh mục mở rộng ở đây</h3>
<form action="" method="POST" autocomplete = "off" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Chọn danh mục: </td>
                <td>
                    <select name="main_cat" id="">
                        <option disabled selected>--Chọn danh mục cha--</option>
                        <?php echo fetch_cat(); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nhập tên danh mục mở rộng: </td>
                <td><input type="text" name = "cat_name" Placeholder = "Nhập tên danh mục mở rộng"></td>
            </tr>
            <tr>
                <td>Ảnh danh mục mở rộng: </td>
                <td><input type='file' name = 'imgsc'></td>
            </tr>
        </table>
        <center>
            <button type = "submit" name = "add_subcat">Thêm danh mục mở rộng</button>
        </center>
    </form>
</div>
<?php echo add_sub_cat(); ?>