<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 
    session_start();
    include('function.php');
    if (isset($_GET['status']) && $_GET['status'] == 'completepay') {
        if (isset($_SESSION['user_id'])) {
            place_order($_SESSION['user_id']);
        }
    }
    if (isset($_GET['status']) && $_GET['status'] == 'clearcart') {
        if (isset($_SESSION['user_id'])) {
            clear_cart($_SESSION['user_id']);
        }
    }
    include('db_config.php');
    if(isset($_GET['vnp_Amount'])) {
        $vnp_Amount = $_GET['vnp_Amount'];
        $vnp_BankCode = $_GET['vnp_BankCode'];
        $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
        $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
        $vnp_PayDate = $_GET['vnp_PayDate'];
        $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
    }
?>

<title>Thanh toán thành công</title>
<meta charset="utf-8">
</head>
<body>
<div class="container">
    <form action="successpay.php" method="post">
        <p>Hi</p>
        <p><?php echo $_SESSION['user_id'] ?></p>
        <a href="../index.php">Quay lại trang chủ</a>
    </form> 
</div>
<?php
    echo '<script>
        swal({
            title: "Thanh toán thành công!",
            text: "Bạn có muốn làm trống giỏ hàng ?",
            icon: "success",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                //dung ajax để chèn giữa thẻ<script>
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        swal("Poof! Giỏ hàng của bạn đã bay màu", {
                            icon: "success",
                        });
                    }
                };
                xmlhttp.open("GET", "successpay.php?status=clearcart", true);
                xmlhttp.send();
            }
        });
    </script>';
?>

</body>
</html>