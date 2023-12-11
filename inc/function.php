<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php 
    function user_login() {
        require 'db_config.php';
    
        if (isset($_POST['login'])) {
            $formError = false;
    
            $u_email = strip_tags($_POST['email']);
            $u_email = htmlspecialchars($u_email);
    
            $u_password = strip_tags($_POST['password']);
            $u_password = htmlspecialchars($u_password);
    
            // Fetch user data from the database
            $stmt = $con->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $u_email);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                $hashed_password_from_db = $row['password'];
    

                if (password_verify($u_password, $hashed_password_from_db)) {
                    session_start();
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_email'] = $u_email;
                    $_SESSION['username'] = $row['user_name'];
    
                    echo "<script>alert('Xin chào " .$row['user_name']."')</script>";
                    echo "<script>window.open('index.php', '_self')</script>";
                } else {
                    // Password is incorrect
                    echo "<script>alert('Incorrect password')</script>";
                    // Handle the error, maybe redirect back to the login form
                }
            } else {
                // User with the given email does not exist
                echo "<script>alert('Email not registered')</script>";
                // Handle the error, maybe redirect back to the login form
            }
        }
    }
    
    
    

    function user_signup(){
        require 'db_config.php';
        if(isset($_POST['u_signup'])){
        $formError = false;
        $u_name = strip_tags($_POST['u_name']);
        $u_name = htmlspecialchars($u_name);

        $u_email = strip_tags($_POST['u_email']);
        $u_email = htmlspecialchars($u_email);

        if ($_POST['u_password'] !== $_POST['u_confirm_password']) {
            $u_password = strip_tags($_POST['u_password']);
            echo "<script>alert('Password and confirmation do not match')</script>";
            exit;
        }

        $u_address = strip_tags($_POST['u_address']);
        $u_address = htmlspecialchars($u_address);

        $u_dob = strip_tags($_POST['u_dob']);
        $u_dob = htmlspecialchars($u_dob);

        $u_phone = strip_tags($_POST['u_phone']);
        $u_phone = htmlspecialchars($u_phone);
        $today = date('y-m-d h:i:s');
        // inser into db
        $stmt = $con->prepare("SELECT * FROM users where email = '$u_email' ");
        $stmt->setFetchMode(PDO:: FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            echo "<script>alert('Email này đã được sử dụng')</script>";
        }else{
            $stmt = $con->prepare( "INSERT INTO users (user_name, email, address, dob, phone, password, reg_date) values(:name, :email, :address, :dob, :phone, :pass, :regdate)" );
            $stmt->bindParam(':name', $u_name);
            $stmt->bindParam(':email', $u_email);
            $stmt->bindParam(':address', $u_address);
            $stmt->bindParam(':dob', $u_dob);
            $stmt->bindParam(':phone', $u_phone);
            $hashed_password = password_hash($_POST['u_password'], PASSWORD_DEFAULT);
            $stmt->bindParam(':pass', $hashed_password);
            $stmt->bindParam(':regdate', $today);
            if($stmt->execute()){  
                echo "<script>alert('Tài khoản đăng kí thành công!')</script>";
                echo "<script>window.open('index.php', '_self')</script>";
            }else{
                echo "<script>alert('Xin lỗi, hãy thử lại!')</script>";
            }
        }

        }
    }

    function products_by_cat(){
        require 'db_config.php';
        $stmt = $con->prepare("SELECT * FROM main_cat");
        $stmt->setFetchMode(PDO:: FETCH_ASSOC);
        $stmt->execute();
        $rows = $stmt->fetch();
        foreach ($rows as $row ) {
            $cat_id = $rows['cat_id'];

            $pro = $con->prepare("SELECT * FROM products WHERE cat_id = $cat_id ");
            $pro->setFetchMode(PDO:: FETCH_ASSOC);
            $pro->execute();
            $result = $pro->fetch();
            if($pro->rowCount()> 0){
                while($result):
                echo "<ul><h3>".$rows['category_name']."</h3>";
                echo "<li>
                <a href = 'pro_detail.php?&pro_id=".$result['pro_id']."'>
                <h4>".$result['product_name']."</h4>
                <img src = './img/products_img/".$result['img1']."' alt = 'img'>
                <h4 id = 'c_price'><small>".number_format($result['price'], 0, ',', '.')."<span style='text-decoration: underline; font-size: 1.1rem'>đ</span></small></h4>
                <center>
                    <a href='#' id='cart' class='add-to-cart-btn'>
                        <i class='fas fa-shopping-cart'></i>
                    </a>
                    <button class = 'p_btn'id = 'wish'><a href = '#'>Danh sách yêu thích</a></button>
                </center>
                </a>
                </li>";
                echo "</ul><br clear = 'All'>";
                endwhile;
        }
        }
    }

    function pro_details($user_id){
        require 'db_config.php';
        if(isset($_GET['pro_id'])){
            $product_id = $_GET['pro_id'];
            $stmt = $con->prepare("SELECT * FROM products where pro_id = $product_id");
            $stmt->setFetchMode(PDO:: FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            echo
            "
            <div id = 'pro_img'>
                <img src = './img/products_img/".$row['img1']."'>
                <ul>
                    <li><img src = './img/products_img/".$row['img1']."'></li>
                    <li><img src = './img/products_img/".$row['img2']."'></li>
                    <li><img src = './img/products_img/".$row['img3']."'></li>
                    <li><img src = './img/products_img/".$row['img4']."'></li>
                </ul>
            </div>
            <div id = 'pro_feature'>
                <h3>".$row['product_name']."</h3><hr/>
                <p>Mô tả sản phẩm</p>
                <ul>
                    <li>".$row['feature1']."</li>
                    <li>".$row['feature2']."</li>
                    <li>".$row['feature3']."</li>
                    <li>".$row['feature4']."</li>
                </ul>
                <ul>
                    <li><span>Mẫu mã: </span>".$row['pro_model']."</li>
                    <li><span>Bảo hành: </span>".$row['warranty']."</li>

                </ul><br clear = 'all'>
                <center>
                <h3>Giá bán: ".number_format($row['price'], 0, ',', '.')." <span style='text-decoration: underline; font-size: 1.1rem'>đ</span></h3>
                <form method = 'POST'>
                    <input type = 'hidden' value = '".$row['pro_id']."' name='pro_id'>
                    <button type = 'Submit' name = 'buy' id = 'buy'>Mua ngay</button>
                    <button type = 'Submit' name = 'cart_btn'id = 'cart' class='add-to-cart-btn'><i class = \"pe-7s-cart\"></i>Thêm giỏ hàng</button>
                </form>
                </center>
            </div><br clear = 'all'>
            <div id = 'sim_pro'>
            <h3>Các sản phẩm tương tự</h3>
            <ul>
            ";
            add_cart($user_id);
            $cat_id = $row['cat_id'];
            $pro_id = $row['pro_id'];
            $stmt = $con->prepare("SELECT * FROM products where pro_id <> $pro_id AND  cat_id =  $cat_id order by pro_id DESC");
            $stmt->setFetchMode(PDO:: FETCH_ASSOC);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch()):
                    echo 
                    "<li>
                    <a href = 'pro_detail.php?&pro_id=".$row['pro_id']."'>
                            <img src = 'img/products_img/".$row['img1']."'>
                            <p>".$row['product_name']."</p>
                            <p><span>Giá: </span>".number_format($row['price'], 0, ',', '.')."</p>
                        </a>
                    </li>";
                endwhile;
            }else{
                echo "<br clear = 'all'><center><h5 class = 'not_found'>Sản phẩm nổi bật sẽ hiển thị ở đây.....</h5></center>";
            }
            echo " </ul></div>
            ";
        }

    }
    function displayProductsByCategory($catId) {
        require 'db_config.php';
    
        // Lấy sản phẩm của danh mục
        $stmt = $con->prepare("SELECT * FROM products WHERE cat_id = :catId");
        $stmt->bindParam(':catId', $catId, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
    
        // Hiển thị sản phẩm
        while ($row = $stmt->fetch()) {
            echo "<li>
                    <form method='POST' enctype='multipart/form-data'>
                        <a href='pro_detail.php?&pro_id=".$row['pro_id']."'>
                            <div class='image-container'>
                                <img src='./img/products_img/".$row['img1']."' alt='img'>
                            </div>
                            <h4>".$row['product_name']."</h4>
                            <div id='c_price'>
                                <small>" . number_format($row['price'], 0, ',', '.') ."</small>
                                <span style='text-decoration: underline; font-size: 1.1rem'>đ</span>
                            </div>
                            <center>
                                <input type='hidden' value='".$row['pro_id']."' name='pro_id'>
                                <a href='#' id='cart' class='add-to-cart-btn'>
                                    <i class='fas fa-shopping-cart'></i>
                                </a>
                                <a href='#' id='wish'>
                                    <i class='fa-solid fa-heart'></i>
                                </a>
                            </center>
                        </a>
                    </form>
                </li>";
        }
    }
    
    
    
    function displayAllCategories() {
        require 'db_config.php';
    
        // Lấy tất cả các danh mục
        $stmt = $con->prepare("SELECT * FROM main_cat");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            echo "<div id='bodyRight' style='width:100%;'>
                    <h2>".$row['category_name']."</h2>
                    <ul>";
            
            displayProductsByCategory($row['cat_id']);
            
            echo "</ul><br clear='All'>
                </div><!--End of body left-->";
        }
    }

    function all_cat(){
        require 'db_config.php';
        $stmt = $con->prepare("SELECT * FROM main_cat ORDER BY category_name ASC");
        $stmt->setFetchMode(PDO:: FETCH_ASSOC);
        $stmt->execute();
        while ($row = $stmt->fetch()):
            echo  " <li><a href = 'cat_products.php?cat_id=".$row['cat_id']."'>".$row['category_name']."</a></li>";
        endwhile;
    }

    // function cat_products(){
    //     require 'db_config.php';
    //     if(isset($_GET['cat_id'])){
    //         $cat_id = $_GET['cat_id'];
    //         $stmt = $con->prepare("SELECT count(*) FROM products WHERE cat_id = $cat_id ");
    //         $stmt->execute();
    //         $count = $stmt->fetchColumn();
    //         // Fetch category name
    //         $maincat = $con->prepare("SELECT * FROM main_cat WHERE cat_id = $cat_id ");
    //         $maincat ->setFetchMode(PDO:: FETCH_ASSOC);
    //         $maincat ->execute();
    //         $result  = $maincat->fetch();
    //         echo"<h3>".$result['category_name']."</h3>";
    //         // Check for product in category
    //         if($count > 0){
    //             $stmt = $con->prepare("SELECT * FROM products WHERE cat_id = $cat_id ");
    //             $stmt->setFetchMode(PDO:: FETCH_ASSOC);
    //             $stmt->execute();

    //             while($row = $stmt->fetch()):
    //                 echo "<li>
    //                         <form method='POST' enctype='multipart/form-data'>
    //                             <a href = 'pro_detail.php?&pro_id=".$row['pro_id']."'>
    //                             <h4>".$row['product_name']."</h4>
    //                             <img src = './img/products_img/".$row['img1']."' alt = 'img'>
    //                             <h4 id = 'c_price'><small>GHC".$row['price']."</small></h4>
    //                             <center>
    //                                 <button class = 'p_btn' id = 'view'><a href = 'pro_detail.php?&pro_id=".$row['pro_id']."'>View</a></button>
    //                                 <input type = 'hidden' value = '".$row['pro_id']."' name='pro_id'>
    //                                 <button name = 'cart_btn' class = 'p_btn'id = 'cart'>Cart</button>
    //                                 <button class = 'p_btn'id = 'wish'><a href = '#'>Wishlist</a></button>
    //                             </center>
    //                             </a>
    //                         </form>
    //                         </li>";
    //                 echo "";
    //             endwhile;
    //         }else{
    //             echo "<br clear = 'all'><center><h5 class = 'not_found'>No Products From This Category</h5></center>";
    //         }
    //     }
    // }

    function view_all_subcat(){
        require 'db_config.php';
        if(isset($_GET['cat_id'])){
            $cat_id = $_GET['cat_id'];
            $stmt = $con->prepare("SELECT * FROM sub_cat where maincat_id = $cat_id");
            $stmt->setFetchMode(PDO:: FETCH_ASSOC);
            $stmt->execute();
            echo "<h3>Danh mục mở rộng</h3>";
            if($stmt->rowCount() > 0){
                while ($row = $stmt->fetch()){
                    $subcat = $row['subcat_id'];
                    $sub = $con->prepare("SELECT count(*) FROM products WHERE subcat_id = $subcat");
                    $sub->execute();
                    $count = $sub->fetchColumn();
    
                    echo "<li>
                            <a href='cat_products.php?subcat_id=".$row['subcat_id']."'>
                                <img src = './img/subcat_img/".$row['subcat_img']."' alt='Subcategory Image' >
                                ".$row['subcat_name']."(".$count.")
                            </a>
                          </li>";
                }
            } else {
                echo "<center><h5 class='not_found'>Không có danh mục sản phẩm mở rộng nào</h5></center>";
            }
        }
    }
    

    // function subcat_products(){
    //     require 'db_config.php';
    //     if(isset($_GET['subcat_id'])){
    //         $subcat_id = $_GET['subcat_id'];
    //         // Fetch category name
    //         $maincat = $con->prepare("SELECT * FROM sub_cat WHERE subcat_id = $subcat_id ");
    //         $maincat ->setFetchMode(PDO:: FETCH_ASSOC);
    //         $maincat ->execute();
    //         $result  = $maincat->fetch();
    //         echo"<h3>".$result['subcat_name']."</h3>";
    //         // Check for product in category
    //             $stmt = $con->prepare("SELECT * FROM products WHERE subcat_id = $subcat_id ");
    //             $stmt->setFetchMode(PDO:: FETCH_ASSOC);
    //             $stmt->execute();
    //             if( $stmt->rowCount() > 0){
    //             while($row = $stmt->fetch()):
    //                 echo "<li>
    //                         <form method='POST' enctype='multipart/form-data'>
    //                             <a href = 'pro_detail.php?&pro_id=".$row['pro_id']."'>
    //                             <h4>".$row['product_name']."</h4>
    //                             <img src = './img/products_img/".$row['img1']."' alt = 'img'>
    //                             <h4 id = 'c_price'><small>GHC".$row['price']."</small></h4>
    //                             <center>
    //                                 <button class = 'p_btn' id = 'view'><a href = 'pro_detail.php?&pro_id=".$row['pro_id']."'>View</a></button>
    //                                 <input type = 'hidden' value = '".$row['pro_id']."' name='pro_id'>
    //                                 <button name = 'cart_btn' class = 'p_btn'id = 'cart'>Cart</button>
    //                                 <button class = 'p_btn'id = 'wish'><a href = '#'>Wishlist</a></button>
    //                             </center>
    //                             </a>
    //                         </form>
    //                         </li>";
    //                 echo "";
    //             endwhile;
    //         }else{
    //             echo "<br clear = 'all'><center><h5 class = 'not_found'>No Products From This Sub Category</h5></center>";
    //         }
    //     }
    // }

    function view_all_cat(){
        require 'db_config.php';
        if(isset($_GET['subcat_id'])){
            $subcat_id = $_GET['subcat_id'];
            $stmt = $con->prepare("SELECT * FROM main_cat");
            $stmt->setFetchMode(PDO:: FETCH_ASSOC);
            $stmt->execute();
            echo "<h3>Sản phẩm</h3>";
            if($stmt->rowCount() > 0){
            while ($row = $stmt->fetch()):
                $cat = $row['cat_id'];
                $main = $con->prepare("SELECT count(*) FROM products WHERE cat_id = $cat");
                $main->execute();
                $count = $main->fetchColumn();

                echo" <li><a href = 'cat_products.php?cat_id=".$row['cat_id']."'>".$row['category_name']."(".$count.")</a></li>";
            endwhile;
            }else{
                echo "<center><h5 class = 'not_found'>Không có danh mục sản phẩm nào</h5></center>";
            }
        }
    }
    function search(){
        require 'db_config.php';
        if(isset($_GET['btn_search'])){

            $search_item = $_GET['user_search'];
            $stmt = $con->prepare("SELECT * FROM products where keyword like '%$search_item%' or product_name like '%$search_item%'");
            $stmt->setFetchMode(PDO:: FETCH_ASSOC);
            $stmt->execute();
            echo "<div id = 'bodyRight'> <ul>
            <h3>Kết quả tìm kiếm của <i><small>'".$search_item."'</small></i></h3>";
            if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()):
                echo "<li>
                        <form method='POST' enctype='multipart/form-data'>
                            <a href = 'pro_detail.php?&pro_id=".$row['pro_id']."'>
                            <img src = './img/products_img/".$row['img1']."' alt = 'img'>
                            <h4>".$row['product_name']."</h4>
                            <h4 id = 'c_price'><small>".number_format($row['price'], 0, ',', '.')."</small> <span style='text-decoration: underline; font-size: 1.1rem'>đ</span></h4>
                            <center>
                                <input type = 'hidden' value = '".$row['pro_id']."' name='pro_id'>
                                <button name = 'cart_btn' class = 'add-to-cart-btn'id = 'cart'>Thêm giỏ hàng</button>
                                <button class = 'p_btn'id = 'wish'><a href = '#'>Yêu thích</a></button>
                            </center>
                            </a>
                        </form>
                        </li>";
                echo "";
            endwhile;
            }else{
                echo "<center><h5 class = 'not_found'>Không tìm thấy sản phẩm <a href = 'index.php'> Quay lại trang chủ</a></h5></center>";
            }
            echo "</ul></div>";
        }
    }


    // get ip address
    function getIp(){
        $ip = $_SERVER['REMOTE_ADDR'];
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $ip;
    }
    function add_cart($user_id) {
        require 'db_config.php';
    
        if (isset($_POST['cart_btn'])) {
            $pro_id = $_POST['pro_id'];
            $ip = getIp();
    
            // Kiểm tra sự tồn tại của sản phẩm trong giỏ hàng
            $stmt = $con->prepare("SELECT * FROM cart WHERE pro_id = :pro_id AND user_id = :user_id");
            $stmt->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
    
            if (!$stmt->rowCount() > 0) {
                // Sản phẩm chưa tồn tại trong giỏ hàng, thêm mới vào giỏ hàng
                $stmt = $con->prepare("INSERT INTO cart (pro_id, qty, ip_address, user_id) VALUES (:pro_id, 1, :ip, :user_id)");
                $stmt->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);
                $stmt->bindParam(':ip', $ip);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
                if ($stmt->execute()) {
                    // Trả về một JSON để xử lý ở phía client (trình duyệt)
                    echo json_encode(array('status' => 'success'));
                    exit;
                } else {
                    echo json_encode(array('status' => 'error'));
                    exit;
                }
            } else {
                $updateStmt = $con->prepare("UPDATE cart SET qty = qty + 1 WHERE pro_id = :pro_id AND user_id = :user_id");
                $updateStmt->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);
                $updateStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
                if ($updateStmt->execute()) {
                    echo json_encode(array('status' => 'success'));
                    exit;
                } else {
                    echo json_encode(array('status' => 'error'));
                    exit;
                }
            }
        }
    }
    
    function cart_count($user_id){
        require 'db_config.php';
        $stmt = $con->prepare("SELECT * FROM cart WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $count_cart = $stmt->rowCount();
        echo $count_cart;
    }
    
    function qty_increase(){
        if(isset($_GET['increase_qty'])){
            require 'db_config.php';
            $cart_id = $_GET['cart_id'];
            $stmt = $con->prepare("SELECT * FROM cart WHERE cart_id = $cart_id");
            $stmt->setFetchMode(PDO:: FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            $qty = $row['qty'];
            $add = $con->prepare("UPDATE cart set qty = ($qty + 1) where cart_id = $cart_id");
            if($add->execute()){
                echo "<script>window.open('cart.php', '_self')</script>";
            }
        }
    }
    function qty_decrease(){
        if(isset($_GET['decrease_qty'])){
            require 'db_config.php';
            $cart_id = $_GET['cart_id'];
            $stmt = $con->prepare("SELECT * FROM cart WHERE cart_id = $cart_id");
            $stmt->setFetchMode(PDO:: FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            $qty = $row['qty'];
            if($qty > 1){
                $subtract = $con->prepare("UPDATE cart set qty = ($qty - 1) where cart_id = $cart_id");
                if($subtract->execute()){
                    echo "<script>window.open('cart.php', '_self')</script>";
                }
            }
        }
    }
    function cart_details($user_id) {
        require 'db_config.php';
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
                // Gọi hàm xử lý đặt hàng
                place_order($user_id);
            }
    
        } else {
            // Hiển thị thông báo khi giỏ hàng trống
            echo "<center><h5 class='not_found'>Không có sản phẩm trong giỏ hàng.<a href='index.php'> <br>Quay lại mua</a></h5></center>";
        }
    
        // Gọi hàm xử lý giảm/giữ số lượng sản phẩm
        qty_decrease();
        qty_increase();
    }
    
    function place_order($user_id) {
        require 'db_config.php';
        $stmt = $con->prepare("INSERT INTO orders (user_id, product_id, quantity, total_amount, order_status) SELECT :user_id, cart.pro_id, cart.qty, (products.price * cart.qty), 'Đang xử lý' FROM cart JOIN products ON cart.pro_id = products.pro_id WHERE cart.user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    
    function delete_cart(){
        require 'db_config.php';
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