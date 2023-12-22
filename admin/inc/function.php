<?php
    //QL danhmuc
    function view_cat(){
        require './inc/db_config.php';
        $stmt = $con->prepare("SELECT * FROM main_cat ORDER bY category_name ASC");
        $stmt->setFetchMode(PDO:: FETCH_ASSOC);
        $stmt->execute();
        $i = 1;
        while($row = $stmt->fetch()):
        echo "<tr>
        <td>".$i++."</td>
        <td>".$row['category_name']."</td>
        <td style = 'min-width:200px'><a href = 'index.php?edit_cat&&category_id=".$row['cat_id']."' id = 'edi'>Sửa</a></td>
        <td style = 'min-width:200px'><a href = 'index.php?delete_cat&&category_id=".$row['cat_id']."' id = 'del'>Xóa</a></td>
        </tr>";
        endwhile;
    }
    function view_order() {
        require './inc/db_config.php';
        $stmt = $con->prepare("SELECT * FROM orders order by user_id DESC");
        $stmt->setFetchMode(PDO:: FETCH_ASSOC);
        $stmt->execute();
        $i = 1;
        while($row = $stmt->fetch()):
            echo "<tr>
                <td style='width: 11%;'>".$row['order_id']."</td>
                <td style='width: 13%;'>".$row['user_id']."</td>
                <td style='width: 13%;'>".$row['product_id']."</td>
                <td style='width: 13%;'>".$row['quantity']."</td>
                <td style='width: 12%;'>".number_format($row['total_amount'], 0, ',', '.')." đ</td>
                <td style='width: 13%;'>".$row['order_status']."</td>
                <td style='width: 18%;'>".$row['order_date']."</td>
                <td style='width: 18%;'>".$row['address'].', '.$row['city']."</td>
            </tr>";
            endwhile;
    }


    function view_product(){
        require './inc/db_config.php';
        $stmt = $con->prepare("SELECT * FROM products order by date_added DESC");
        $stmt->setFetchMode(PDO:: FETCH_ASSOC);
        $stmt->execute();
        $i = 1;
        while($row = $stmt->fetch()):
        echo "<tr>
            <td>".$i++."</td>
            <td>
                <a href = 'index.php?edit_product&&product_id=".$row['pro_id']."' id = 'edi'>Sửa</a>
                <a href = 'index.php?delete_product&&product_id=".$row['pro_id']."' id = 'del'>Xóa</a>
            </td>
            <td>".$row['product_name']."</td>
            <td>
            <img src=\"../img/products_img/".$row['img1']."\" alt=\"1\">
            <img src=\"../img/products_img/".$row['img2']."\" alt=\"2\">
            <img src=\"../img/products_img/".$row['img3']."\" alt=\"3\">
            <img src=\"../img/products_img/".$row['img4']."\" alt=\"4\">
            </td>
            <td>".$row['feature1']."</td>
            <td>".$row['feature2']."</td>
            <td>".$row['feature3']."</td>
            <td>".$row['feature4']."</td>
            <td>".number_format($row['price'], 0, ',', '.')." đ</td>
            <td>".$row['pro_model']."</td>
            <td>".$row['warranty']."</td>
            <td>".$row['keyword']."</td>
            <td>".$row['date_added']."</td>
        </tr>";
        endwhile;
    }
    function view_subcat(){
        require './inc/db_config.php';
        $stmt = $con->prepare("SELECT * FROM sub_cat ORDER BY subcat_name ASC");
        $stmt->setFetchMode(PDO:: FETCH_ASSOC);
        $stmt->execute();
        $i = 1;
        while($row = $stmt->fetch()):
        echo "<tr>
        <td style='width: 20%;'>".$i++."</td>
        <td>".$row['subcat_name']."</td>
        <td style = 'min-width:200px'><a href = 'index.php?edit_subcat&&subcategory_id=".$row['subcat_id']."'  id = 'edi'>Sửa</a></td>
        <td style = 'min-width:200px'><a href = 'index.php?delete_subcat&&subcategory_id=".$row['subcat_id']."' id = 'del'>Xóa</a></td>
        <td style='width: 150px;'><img src=\"../img/products_img/".$row['subcat_img']."\" width='50' height='50'></td>
        </tr>";
        endwhile;
    }
    function add_cat() {
        require './inc/db_config.php';
        $error = false;
        if(isset($_POST['add_cat'])){
            $cat_name = $_POST['cat_name'];
            if(empty($cat_name)){
                $error = true;
                echo "<script>alert('Không được để trống tên danh mục sản phẩm!')</script>";
            }
            if(!$error){
                $stmt = $con->prepare("INSERT INTO main_cat(category_name) values(:category_name)");
                $stmt->bindParam(':category_name', $cat_name);
                $inserted = $stmt->execute();
                if($inserted){
                    echo "<script>alert('Thêm danh mục sản phẩm thành công!')</script>";
                    echo "<script>window.open('index.php?add_category', '_self')</script>";
                }else{
                    echo "<script>alert('Thêm danh mục sản phẩm thất bại. Thử lại!')</script>";
                }
            }
        }

    }

    function add_sub_cat(){
        require './inc/db_config.php';
        $error = false;
        if(isset($_POST['add_subcat'])){
            $subcat_name = $_POST['cat_name'];
            // $imgsc = $_FILES['imgsc']['name'];
            // $imgsc_temp = $_FILES['imgsc']['tmp_name'];
            // move_uploaded_file($imgsc_temp, "../img/products_img/$imgsc");
            if(empty($subcat_name)){
                $error = true;
                echo "<script>alert('Không được để trống danh mục mở rộng!')</script>";
                exit;
            }
            if(isset($_POST['main_cat'])){
                $main_cat= $_POST['main_cat'];
            }else{
                $error = true;
                echo "<script>alert('Chọn danh mục cha')</script>";
                exit;
            }

            if(!$error){
                $imgsc = $_FILES['imgsc']['name'];  // Lấy tên file
                $imgsc_temp = $_FILES['imgsc']['tmp_name'];  // Lấy đường dẫn tạm thời của file
                move_uploaded_file($imgsc_temp, "../img/subcat_img/$imgsc");  // Di chuyển file vào đúng thư mục
                
                $stmt = $con->prepare("INSERT INTO sub_cat(subcat_name, maincat_id, subcat_img) VALUES (:subcat_name, :main_cat, :imgsc)");
                $stmt->bindParam(':subcat_name', $subcat_name);
                $stmt->bindParam(':main_cat', $main_cat);
                $stmt->bindParam(':imgsc', $imgsc);
                
                $inserted = $stmt->execute();
                
                if($inserted){
                    echo "<script>alert('Thêm danh mục mở rộng thành công')</script>";
                    echo "<script>window.open('index.php?add_subcat', '_self')</script>";
                } else {
                    echo "<script>alert(' Thêm danh mục mở rộng thất bại')</script>";
                }
            }
            
        }
    }

    function fetch_cat(){
        require './inc/db_config.php';
        $stmt = $con->prepare("SELECT * FROM main_cat");
        $stmt->setFetchMode(PDO:: FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch()):
        echo "<option value=". $row['cat_id'] .">". $row['category_name']."</option>";
        endwhile;
    }
    function fetch_sub_cat(){
        require './inc/db_config.php';
        $stmt = $con->prepare("SELECT * FROM sub_cat");
        $stmt->setFetchMode(PDO:: FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch()):
        echo "<option value=". $row['subcat_id'] .">". $row['subcat_name']."</option>";
        endwhile;
    }

    function add_product(){
        require './inc/db_config.php';
        $error = false;
        if(isset($_POST['add_product'])){
            $product_name = $_POST['pro_name'];
            if(isset($_POST['main_cat'])){
                $cat_id= $_POST['main_cat'];
            }else{
                $error = true;
                echo "<script>alert('Chọn sản phẩm\' Danh mục');</script>";
                exit;
            }
            if(isset($_POST['sub_cat'])){
                $subcat_id= $_POST['sub_cat'];
            }else{
                $error = true;
                echo "<script>alert('Chọn sản phẩm\' Danh mục mở rộng');</script>";
                exit;
            }
            $feature1 = $_POST['feature1'];
            $feature2 = $_POST['feature2'];
            $feature3 = $_POST['feature3'];
            $feature4 = $_POST['feature4'];
            $price = $_POST['price'];
            $waranty = $_POST['warranty'];
            $key = $_POST['key'];
            $model_no = $_POST['model'];

            $img1 = $_FILES['img1']['name'];
            $img1_temp = $_FILES['img1']['tmp_name'];

            $img2 = $_FILES['img2']['name'];
            $img2_temp = $_FILES['img2']['tmp_name'];

            $img3 = $_FILES['img3']['name'];
            $img3_temp = $_FILES['img3']['tmp_name'];

            $img4 = $_FILES['img4']['name'];
            $img4_temp = $_FILES['img4']['tmp_name'];

            move_uploaded_file($img1_temp, "../img/products_img/$img1");
            move_uploaded_file($img2_temp, "../img/products_img/$img2");
            move_uploaded_file($img3_temp, "../img/products_img/$img3");
            move_uploaded_file($img4_temp, "../img/products_img/$img4");


            if(!$error){
                $today = date('y-m-d h:i:s');
                $stmt = $con->prepare(
                    "INSERT INTO products(product_name, cat_id, subcat_id, img1, img2, img3, img4, feature1,feature2, feature3, feature4, price, pro_model, warranty, keyword, date_added) 
                    values('$product_name', ' $cat_id', '$subcat_id', '$img1', '$img2', '$img3', ' $img4', '$feature1', '$feature2', '$feature3', '$feature4', '$price', ' $model_no', ' $waranty', '$key', '$today')"
                );
                if($stmt->execute()){
                    echo "<script>alert('Sản phẩm đã được thêm thành công');</script>";
                    echo "<script>window.open('index.php?add_product', '_self')</script>";
                }else{
                    echo "<script>alert('Thêm sản phẩm thất bại');</script>";
                }
            }
        }
    }

    function edit_cat(){
        require './inc/db_config.php';
        if(isset($_GET['edit_cat'])){
            $cat_id = $_GET['category_id'];
            $stmt = $con->prepare("SELECT * FROM main_cat WHERE cat_id = $cat_id");
            $stmt->setFetchMode(PDO:: FETCH_ASSOC);
            $stmt->execute();
            if($row = $stmt->fetch()){
                
                echo "<form  method=\"POST\" autocomplete = \"off\" enctype=\"multipart/form-data\">
                <table>
                    <tr>
                        <td>Cập nhật tên danh mục: </td>
                        <td><input type=\"text\" name = \"cat_name\" Placeholder = \"Nhập tên danh mục\" value ='". $row['category_name']."'></td>
                    </tr>
                </table>
                <center>
                    <button type = \"submit\" name = \"update_cat\">Cập nhật</button>
                </center>
            </form>";
             
            }
            if(isset($_POST['update_cat'])){
                $new_cat_name = $_POST['cat_name'];
                $stmt = $con->prepare("UPDATE main_cat SET category_name = :updated_name where cat_id = $cat_id");
                $stmt->bindParam(':updated_name', $new_cat_name);
                if( $stmt->execute()){
                    echo "<script>alert('Cập nhật thành công')</script>";
                    echo "<script>window.open('index.php?add_category', '_self')</script>";
                }
            }
        }
    }

    function edit_subcat(){
        require './inc/db_config.php';
    
        if(isset($_GET['edit_subcat'])){
            $subcat_id = $_GET['subcategory_id'];
            $stmt = $con->prepare("SELECT * FROM sub_cat WHERE subcat_id = $subcat_id");
            $stmt->setFetchMode(PDO:: FETCH_ASSOC);
            $stmt->execute();
    
            if($row = $stmt->fetch()){
                $cat = $row['maincat_id'];
                $stmt = $con->prepare("SELECT * FROM main_cat WHERE cat_id = $cat");
                $stmt->setFetchMode(PDO:: FETCH_ASSOC);
                $stmt->execute();
                $fetch = $stmt->fetch();
    
                echo "<form method=\"POST\" enctype=\"multipart/form-data\">
                    <table>
                        <tr>
                            <td>Cập nhật danh mục: </td>
                            <td>
                                <select name=\"main_cat\">
                                    <option value='".$fetch['cat_id']."' selected>".$fetch['category_name']."</option>";
                                    fetch_cat();
                                echo "</select>
                            </td>
                        </tr>
                        <tr>
                            <td>Cập nhật tên danh mục mở rộng: </td>
                            <td><input type=\"text\" name=\"subcat_name\" placeholder=\"Nhập tên danh mục mở rộng\" value ='". $row['subcat_name']."'></td>
                        </tr>
                        <tr>
                            <td>Ảnh danh mục mở rộng hiện tại: </td>
                            <td><img src=\"../img/subcat_img/".$row['subcat_img']."\" style='max-width: 50px; max-height: 50px;'></td>
                        </tr>
                        <tr>
                            <td>Cập nhật ảnh danh mục mở rộng: </td>
                            <td><input type='file' name='imgsc'></td>
                        </tr>
                    </table>
                    <center>
                        <button type=\"submit\" name=\"update_subcat\">Cập nhật</button>
                    </center>
                </form>";
    
                if(isset($_POST['update_subcat'])){
                    if(isset($_POST['main_cat'])){
                        $new_cat_id = $_POST['main_cat'];
                    } else {
                        echo "<script>alert('Chọn danh mục!')</script>";
                        exit;
                    }
    
                    $new_subcat_name = $_POST['subcat_name'];
    
                    // Kiểm tra nếu có file ảnh mới được chọn
                    if (isset($_FILES['imgsc']) && $_FILES['imgsc']['error'] == UPLOAD_ERR_OK) {
                        $imgsc_temp = $_FILES['imgsc']['tmp_name'];
                        $imgsc_name = $_FILES['imgsc']['name'];
                        move_uploaded_file($imgsc_temp, "../img/products_img/$imgsc_name");
                    } else {
                        // Nếu không có ảnh mới, sử dụng ảnh hiện tại
                        $imgsc_name = $row['subcat_img'];
                    }
    
                    $stmt = $con->prepare("UPDATE sub_cat SET maincat_id = :updated_maincat, subcat_name = :updated_subcat, subcat_img = :updated_imgsc WHERE subcat_id = $subcat_id");
                    $stmt->bindParam(':updated_maincat', $new_cat_id);
                    $stmt->bindParam(':updated_subcat', $new_subcat_name);
                    $stmt->bindParam(':updated_imgsc', $imgsc_name);
    
                    if($stmt->execute()){
                        echo "<script>alert('Cập nhật danh mục mở rộng thành công!')</script>";
                        echo "<script>window.open('index.php?add_subcat', '_self')</script>";
                    } else {
                        echo "<script>alert('Cập nhật danh mục mở rộng thất bại!')</script>";
                    }
                }
            }
        }
    }
    

    function edit_product(){
        require './inc/db_config.php';
        if(isset($_GET['edit_product'])){
            $product_id = $_GET['product_id'];
            $stmt = $con->prepare("SELECT * FROM products WHERE pro_id = $product_id");
            $stmt->setFetchMode(PDO:: FETCH_ASSOC);
            $stmt->execute();
            if($row = $stmt->fetch()){
                echo 
                "
                <form action='' method='POST' autocomplete = 'off' enctype='multipart/form-data'>
        
                <table>
                    <tr>
                        <td>Tên sản phẩm: </td>
                        <td><input type='text' name = 'pro_name' value = '".$row['product_name']."' Placeholder = 'Nhập tên sản phẩm'></td>
                    </tr>
                    <tr>
                        <td>Chọn danh mục: </td>
                        <td>
                            <select name='main_cat' id=''>";
                            $maincat_id = $row['cat_id'];
                            $cat = $con->prepare("SELECT * FROM main_cat WHERE cat_id = $maincat_id");
                            $cat->setFetchMode(PDO:: FETCH_ASSOC);
                            $cat->execute();
                            $cat = $cat->fetch();
                                echo " <option value = '".$cat['cat_id']."' selected>".$cat['category_name']."</option>";
                                fetch_cat();
                            echo "</select>
                        </td>
                    </tr>
                    <tr>
                        <td>Chọn danh mục mở rộng: </td>
                        <td>
                            <select name='sub_cat' id=''>";
                            $subcat_id = $row['subcat_id'];
                            $subcat = $con->prepare("SELECT * FROM sub_cat WHERE subcat_id = $subcat_id");
                            $subcat->setFetchMode(PDO:: FETCH_ASSOC);
                            $subcat->execute();
                            $subcat = $subcat->fetch();
                                echo "<option value = '".$subcat['subcat_id']."' selected>".$subcat['subcat_name']."</option>";
                                fetch_sub_cat();
                            echo "</select>
                        </td>
                    </tr>
                    <tr>
                        <td>Ảnh sản phẩm 1: </td>
                        <td>
                        <input type='file' name = 'img1'>
                        <img src = '../img/products_img/".$row['img1']."' width = '35px'>
                        </td>
                    </tr>
                    <tr>
                        <td>Ảnh sản phẩm 2: </td>
                        <td>
                        <input type='file' name = 'img2'>
                        <img src = '../img/products_img/".$row['img2']."' width = '35px'>
                        </td>
                    </tr>
                    <tr>
                        <td>Ảnh sản phẩm 3: </td>
                        <td>
                        <input type='file' name = 'img3'>
                        <img src = '../img/products_img/".$row['img3']."' width = '35px'>
                        </td>
                    </tr>
                    <tr>
                        <td>Ảnh sản phẩm 4: </td>
                        <td>
                        <input type='file' name = 'img4'>
                        <img src = '../img/products_img/".$row['img4']."' width = '35px'>
                        </td>
                    </tr>
                    <tr>
                        <td>Mô tả 1: </td>
                        <td><input type='text' name = 'feature1' value = '".$row['feature1']."' Placeholder = 'Nhập mô tả sản phẩm'></td>
                    </tr>
                    <tr>
                        <td>Mô tả 2: </td>
                        <td><input type='text' name = 'feature2' value = '".$row['feature2']."' Placeholder = 'Nhập mô tả sản phẩm'></td>
                    </tr>
                    <tr>
                        <td>Mô tả 3: </td>
                        <td><input type='text' name = 'feature3' value = '".$row['feature3']."' Placeholder = 'Nhập mô tả sản phẩm'></td>
                    </tr>
                    <tr>
                        <td>Mô tả 4: </td>
                        <td><input type='text' name = 'feature4' value = '".$row['feature4']."' Placeholder = 'Nhập mô tả sản phẩm'></td>
                    </tr>
                    <tr>
                        <td>Nhập giá: </td>
                        <td><input type='text' name = 'price' value = '".$row['price']."' Placeholder = 'Nhập giá></td>
                    </tr>
                    <tr>
                        <td>Nhập mã model.: </td>
                        <td><input type='text' name = 'model' value = '".$row['pro_model']."' Placeholder = 'Nhập mã model'></td>
                    </tr>
                    <tr>
                        <td>Bảo hành: </td>
                        <td><input type='text' name = 'warranty' value = '".$row['warranty']."' Placeholder = 'Nhập thời gian bảo hành'></td>
                    </tr>
                    <tr>
                        <td>Nhập Keyword: </td>
                        <td><input type='text' name = 'key' value = '".$row['keyword']."' Placeholder = 'Nhập keyword'></td>
                    </tr>
                </table>
                <center>
                    <button type = 'submit' name = 'update_product'>Cập nhật sản phẩm</button>
                </center>
            </form>
                ";
            }
            if(isset($_POST['update_product'])){
            $product_name = $_POST['pro_name'];
            $cat_id= $_POST['main_cat'];
            $subcat_id= $_POST['sub_cat'];
            $feature1 = $_POST['feature1'];
            $feature2 = $_POST['feature2'];
            $feature3 = $_POST['feature3'];
            $feature4 = $_POST['feature4'];
            $price = $_POST['price'];
            $waranty = $_POST['warranty'];
            $key = $_POST['key'];
            $model_no = $_POST['model'];

            if($_FILES['img1']['tmp_name'] == ""){}else{
                $img1 = $_FILES['img1']['name'];
                $img1_temp = $_FILES['img1']['tmp_name'];
                move_uploaded_file($img1_temp, "../img/products_img/$img1");
                $stmt = $con->prepare("UPDATE products SET img1 = $img1  WHERE pro_id = $product_id") ;
                $stmt->execute();
            }
            if($_FILES['img2']['tmp_name'] == ""){}else{
                $img2 = $_FILES['img2']['name'];
                $img2_temp = $_FILES['img2']['tmp_name'];
                move_uploaded_file($img2_temp, "../img/products_img/$img2");
                $stmt = $con->prepare("UPDATE products SET img2 = $img2  WHERE pro_id = $product_id") ;
                $stmt->execute();
            }
            if($_FILES['img3']['tmp_name'] == ""){}else{
                $img3 = $_FILES['img3']['name'];
                $img3_temp = $_FILES['img3']['tmp_name'];
                move_uploaded_file($img3_temp, "../img/products_img/$img3");
                $stmt = $con->prepare("UPDATE products SET img3 = $img3  WHERE pro_id = $product_id") ;
                $stmt->execute();
            }
            if($_FILES['img4']['tmp_name'] == ""){}else{
                $img4 = $_FILES['img4']['name'];
                $img4_temp = $_FILES['img4']['tmp_name'];
                move_uploaded_file($img4_temp, "../img/products_img/$img4");
                $stmt = $con->prepare("UPDATE products SET img4 = $img4   WHERE pro_id = $product_id") ;
                $stmt->execute();
            }
                $today = date('y-m-d h:i:s');
                $stmt = $con->prepare(
                    "UPDATE products SET 
                    product_name='$product_name', 
                    cat_id= ' $cat_id', 
                    subcat_id='$subcat_id', 
                    feature1='$feature1',
                    feature2='$feature2', 
                    feature3='$feature3', 
                    feature4='$feature4', 
                    price='$price', 
                    pro_model=' $model_no', 
                    warranty=' $waranty',
                    keyword=' $key', 
                    date_added='$today'
                    WHERE pro_id = $product_id"
                );
                if($stmt->execute()){
                    echo "<script>alert('Sản phẩm cập nhật thành công');</script>";
                    echo "<script>window.open('index.php?view_product', '_self')</script>";
                }else{
                    echo "<script>alert('Cập nhật sản phẩm thất bại!');</script>";
                }

            }
        }
    }


    function delete_cat(){
        require 'db_config.php';
        if(isset($_POST['1'])){
            $cat_id = $_GET['category_id'];
            $stmt = $con->prepare("DELETE FROM main_cat WHERE cat_id = $cat_id");
            $stmt->setFetchMode(PDO:: FETCH_ASSOC);
            if($stmt->execute())
            echo "<script>alert('Xóa danh mục thanh công')</script>";
            echo "<script>window.open('index.php?add_category', '_self')</script>";
        }
        if(isset($_POST['0'])){
            echo "<script>window.open('index.php?add_category', '_self')</script>";
        }
    }
    function delete_subcat(){
        require 'db_config.php';
        if(isset($_POST['1'])){
            $subcat_id = $_GET['subcategory_id'];
            $stmt = $con->prepare("DELETE FROM sub_cat WHERE subcat_id = $subcat_id");
            $stmt->setFetchMode(PDO:: FETCH_ASSOC);
            if($stmt->execute())
            echo "<script>alert('Xóa danh mục mở rộng thành công')</script>";
            echo "<script>window.open('index.php?add_subcat', '_self')</script>";
        }
        if(isset($_POST['0'])){
            echo "<script>window.open('index.php?add_subcat', '_self')</script>";
        }
    }

    function delete_product(){
        require 'db_config.php';
        if(isset($_POST['1'])){
            $prod_id = $_GET['product_id'];
            $stmt = $con->prepare("DELETE FROM products WHERE pro_id = $prod_id");
            $stmt->setFetchMode(PDO:: FETCH_ASSOC);
            if($stmt->execute())
            echo "<script>alert('Xóa sản phẩm thành công')</script>";
            echo "<script>window.open('index.php?view_product', '_self')</script>";
        }
        if(isset($_POST['0'])){
            echo "<script>window.open('index.php?view_product', '_self')</script>";
        }
    }
    function popper($action,$msg, $location){
        echo 
        "
        <form id = 'alertForm' method='POST'>
        <center>
        ";
        if(isset($sucess)){echo $sucess;}
        if(isset($failure)){echo $failure;}
         echo"
        <h4><strong>".$msg."</strong></h4>
        </center>
        <button type=\"submit\"  name=\"return\" id='return'>Ok</button>
        </form>
        ";
    }

?>