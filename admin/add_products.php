<?php 
    require './inc/db_config.php' ;
    include './inc/function.php';
?>
<div id = "bodyRight">
    <h3>Thêm sản phẩm</h3>
    <form action='' method='POST' autocomplete = 'off' enctype='multipart/form-data'>
        
        <table>
            <tr>
                <td>Tên sản phẩm: </td>
                <td><input type='text' name = 'pro_name' Placeholder = 'Nhập tên sản phẩm'></td>
            </tr>
            <tr>
                <td>Chọn danh mục: </td>
                <td>
                    <select name='main_cat' id=''>
                        <option disabled selected>--Chọn danh mục cha--</option>
                        <?php echo fetch_cat(); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Chọn danh mục mở rộng: </td>
                <td>
                    <select name='sub_cat' id=''>
                        <option disabled selected>--Chọn danh mục mở rộng--</option>
                        <?php echo fetch_sub_cat(); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Ảnh sản phẩm 1: </td>
                <td><input type='file' name = 'img1'></td>
            </tr>
            <tr>
                <td>Ảnh sản phẩm 2: </td>
                <td><input type='file' name = 'img2'></td>
            </tr>
            <tr>
                <td>Ảnh sản phẩm 3: </td>
                <td><input type='file' name = 'img3'></td>
            </tr>
            <tr>
                <td>Ảnh sản phẩm 4: </td>
                <td><input type='file' name = 'img4'></td>
            </tr>
            <tr>
                <td>Mô tả 1: </td>
                <td><input type='text' name = 'feature1' Placeholder = 'Nhập mô tả sản phẩm'></td>
            </tr>
            <tr>
                <td>Mô tả 2: </td>
                <td><input type='text' name = 'feature2' Placeholder = 'Nhập mô tả sản phẩm'></td>
            </tr>
            <tr>
                <td>Mô tả 3: </td>
                <td><input type='text' name = 'feature3' Placeholder = 'Nhập mô tả sản phẩm'></td>
            </tr>
            <tr>
                <td>Mô tả 4: </td>
                <td><input type='text' name = 'feature4' Placeholder = 'Nhập mô tả sản phẩm'></td>
            </tr>
            <tr>
                <td>Nhập giá: </td>
                <td><input type='text' name = 'price' Placeholder = 'Nhập giá sản phẩm'></td>
            </tr>
            <tr>
                <td>Nhập mã model: </td>
                <td><input type='text' name = 'model' Placeholder = 'Nhập mã model'></td>
            </tr>
            <tr>
                <td>Bảo hành: </td>
                <td><input type='text' name = 'warranty' Placeholder = 'Nhập thời gian bảo hành'></td>
            </tr>
            <tr>
                <td>Nhập keyword: </td>
                <td><input type='text' name = 'key' Placeholder = 'Nhập keyword'></td>
            </tr>
        </table>
        <center>
            <button type = 'submit' name = 'add_product'>Thêm sản phẩm</button>
        </center>
    </form>
</div>

    <?php echo add_product(); ?>
