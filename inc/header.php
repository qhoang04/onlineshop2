<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="././css/modal.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</style>
<div class="header">
    <div id="logo">
        <a href="index.php">
            <img src="./img/hdecor.png" alt="Logo">
        </a>
    </div>
    <div id="links">
        <div id="logoutModal" class="modal">
            <span class="closeBtn" onclick="closeModal('logoutModal')">&times;</span>
            <h3>Xác nhận Đăng xuất</h3>
            <p>Bạn có chắc chắn muốn đăng xuất?</p>
            <center>
                <button onclick="logout()">Đăng xuất</button>
                <button onclick="closeModal('logoutModal')">Hủy</button>
            </center>
        </div>
    <?php
        if (isset($_SESSION['user_id'])) {
            echo '<span>Xin chào, ' . $_SESSION['username'] . '</span>';
            echo '<button onclick="openLogoutModal()">Đăng xuất</button>';
        } else {
            echo '<ul>
                    <li id="registerModalBtn">
                        <a>Đăng ký</a>
                    </li>
                    <li id="loginModalBtn">
                        <a>Đăng nhập</a>
                    </li>
                </ul>';
        }
        if (isset($_GET['logout']) && $_GET['logout'] == true) {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['username']);
            echo "<script>window.location.href = 'index.php';</script>";
            exit();
        }
        ?>
    </div>
    <div id="registerModal" class="modal">
    <span class="closeBtn" onclick="closeModal('registerModal')">&times;</span>
        <form method="post" enctype="multipart/form-data" autocomplete="off">
            <h3>Đăng ký</h3>
            <hr>
            <div class="leftRegis">
                <table style="padding-top: 2%;">
                    <tr>
                        <td id='text'>Họ và tên:</td>
                        <td><input type="text" name="u_name" placeholder="Nhập họ và tên" required></td>
                    </tr>
                    <tr>
                        <td id='text'>E-mail:</td>
                        <td><input type="email" name="u_email" placeholder="Nhập Email" required></td>
                    </tr>
                    <tr>
                        <td id="text">Mật khẩu:</td>
                        <td><input type="password" name="u_password" placeholder="Nhập mật khẩu" required></td>
                    </tr>
                    <tr>
                        <td id="text">Nhập lại mật khẩu:</td>
                        <td><input type="password" name="u_confirm_password" placeholder="Nhập lại mật khẩu" required></td>
                    </tr>
                    <tr>
                        <td id='text'>Địa chỉ:</td>
                        <td><input type="text" name="u_address" placeholder="Nhập địa chỉ" required></td>
                    </tr>
                    <tr>
                        <td id='text'>Ngày sinh:</td>
                        <td><input type="date" name="u_dob" placeholder="Nhập ngày sinh" required></td>
                    </tr>
                    <tr>
                        <td id='text'>Số điện thoại:</td>
                        <td><input type="text" name="u_phone" placeholder="Nhập số điện thoại" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="display: -webkit-box;">
                            <input type="checkbox" id="agreeCheckbox">
                            <p style="font-size: 55%; width: 70%;">Tôi đã đọc, hiểu rõ và tự nguyện đồng ý các điều khoản về việc thu thập, xử lý dữ liệu cá nhân, quyền và nghĩa vụ của tôi được quy định tại Chính sách bảo mật và Thỏa thuận sử dụng, và các chính sách khác được ban hành bởi</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="rightRegis">
                <i class="fa-brands fa-facebook"></i>
                <a href="">Đăng nhập qua Google</a>
                <br>
                <i class="fa-brands fa-google"></i>
                <a href="">Đăng nhập qua Facebook</a>
            </div>
            <center>
                <input type="submit" name="u_signup" value="Đăng ký" id="registerButton" disabled>
            </center>
            <?php user_signup(); ?>
        </form>
    </div>
    <div id="loginModal" class="modal">
        <h3>Đăng nhập</h3>
        <hr>
        <div id="bodyloginModal">
            <span class="closeBtn" onclick="closeModal('loginModal')">&times;</span>
            <form method="post" enctype="multipart/form-data" autocomplete="off">
                <table>
                    <div class="txt_field">
                        <tr>
                            <td id='logText'>Email:</td>
                            <td><input type="email" name="email" placeholder="Nhập Email"></td>
                        </tr>
                    </div>
                    <div class="txt_field">
                        <tr style="margin-top: 2%;">
                            <td id='logText'>Mật khẩu:</td>
                            <td><input type="password" name="password" placeholder="Nhập mật khẩu"></td>
                        </tr>
                    </div>
                </table>
                <center>
                    <input type="submit" class="loginBtn" name="login" value="Đăng nhập">
                    <div class="forgetpass">
                        <a href="">Quên mật khẩu</a>
                    </div>
                </center>
            </form>
            <?php 
            user_login(); ?>
        </div>
        <div class="rightRegis">
                <i class="fa-brands fa-facebook"></i>
                <a href="">Đăng nhập qua Google</a>
                <br>
                <i class="fa-brands fa-google"></i>
                <a href="">Đăng nhập qua Facebook</a>
            </div>
    </div>
    <div class="overlay"></div>
    <div id="search">
        <form action="search.php" method='GET' enctype='multipart/form-data' autocomplete='off'>
            <input type="text" name='user_search' placeholder="nhập tên sản phẩm cần tìm kiếm.....">
            <button name="btn_search" id="btn-search">Tìm kiếm</button>
            <button type="button" id="btn-Cart" onclick="checkLoginAndOpenCart()">Giỏ hàng <span id='cart_count'><?php echo isset($_SESSION['user_id']) ? cart_count($_SESSION['user_id']) : '0'; ?></span></button>

        </form>
    </div>
</div>
<script>
    function checkLoginAndOpenCart() {
        <?php
        if (!isset($_SESSION['user_id'])) {
            echo "openModal('loginModal');";
        } else {
            echo "window.location.href = 'cart.php';";
        }
        ?>
    }
    document.getElementById('agreeCheckbox').addEventListener('change', function () {
    document.getElementById('registerButton').disabled = !this.checked;
    });

    function logout() {
        window.location.href = 'index.php?logout=true';
    }
    function openLogoutModal() {
        openModal('logoutModal');
    }
    document.getElementById('registerModalBtn').addEventListener('click', function() {
        openModal('registerModal');
    });

    document.getElementById('loginModalBtn').addEventListener('click', function() {
        openModal('loginModal');
    });

    function openModal(modalId) {
        document.getElementById(modalId).style.display = 'block';
        document.querySelector('.overlay').style.display = 'block';
        document.querySelector('.slider').classList.add('blurred');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
        document.querySelector('.overlay').style.display = 'none';
        document.querySelector('.slider').classList.remove('blurred');
        document.querySelector('.product_by_cate').classList.remove('blurred');
    }

</script>