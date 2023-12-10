<?php include './inc/function.php' ?>
<form id = 'alertForm' method='POST'>
    <center>
    <h4><i>Chú ý: </i><strong>Nếu xóa sẽ không thể khôi phục</strong></h4>
    <p>Chắn chắn muốn xóa ?</p>
    </center>
    <button type="submit"  name="1" id='ok'>Đồng ý</button>
    <button type="submit" name="0" id = 'can'>Hủy</button>
</form>
<?php delete_cat(); ?>