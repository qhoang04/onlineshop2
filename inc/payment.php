<?php
require_once('config_vnpay.php');
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');


function getCartData($user_id)
{
    require 'db_config.php'; // Đảm bảo đã kết nối đến cơ sở dữ liệu
    $stmt = $con->prepare("SELECT * FROM cart WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $cartData = array();

    while ($row = $stmt->fetch()) {
        $pro_id = $row['pro_id'];
        $cart_pro = $con->prepare("SELECT * FROM products WHERE pro_id = :pro_id");
        $cart_pro->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);
        $cart_pro->setFetchMode(PDO::FETCH_ASSOC);
        $cart_pro->execute();
        $cart_pro = $cart_pro->fetch();

        // Thêm thông tin sản phẩm vào mảng $cartData
        $cartData[] = array(
            'product_name' => $cart_pro['product_name'],
            'quantity' => $row['qty'],
            'price' => $cart_pro['price'],
            'total' => $cart_pro['price'] * $row['qty'],
        );
    }

    return $cartData;
}
function getCustomerInfo($user_id)
{
    require 'db_config.php'; // Đảm bảo đã kết nối đến cơ sở dữ liệu
    $stmt = $con->prepare("SELECT * FROM users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    return $stmt->fetch();
}

// Lấy thông tin giỏ hàng của người dùng hiện tại
$user_id = $_SESSION['user_id'];
$cartData = getCartData($user_id);
$customerInfo = getCustomerInfo($user_id);
$totalAmount = array_sum(array_column($cartData, 'total'));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $paymentMethod = $_POST['payment-method'];
  echo "Payment Method: " . $paymentMethod;

  if ($paymentMethod == 'cod') {
    echo "<script>window.location.href = 'successpay.php';</script>";
    exit();
}
  else if ($paymentMethod == 'vnpay') {
    $vnp_TxnRef = time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    $vnp_OrderInfo = 'Thanh toan vnpay';
    $vnp_OrderType = 'other';
    $vnp_Amount = $totalAmount * 100;
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    $vnp_ExpireDate = $expire;
    //Add Params of 2.0.1 Version
    // $vnp_ExpireDate = $_POST['txtexpire'];
    //Billing
    // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
    // $vnp_Bill_Email = $_POST['txt_billing_email'];
    // $fullName = trim($_POST['txt_billing_fullname']);
    // if (isset($fullName) && trim($fullName) != '') {
    //     $name = explode(' ', $fullName);
    //     $vnp_Bill_FirstName = array_shift($name);
    //     $vnp_Bill_LastName = array_pop($name);
    // }
    // $vnp_Bill_Address=$_POST['txt_inv_addr1'];
    // $vnp_Bill_City=$_POST['txt_bill_city'];
    // $vnp_Bill_Country=$_POST['txt_bill_country'];
    // $vnp_Bill_State=$_POST['txt_bill_state'];
    // Invoice
    // $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
    // $vnp_Inv_Email=$_POST['txt_inv_email'];
    // $vnp_Inv_Customer=$_POST['txt_inv_customer'];
    // $vnp_Inv_Address=$_POST['txt_inv_addr1'];
    // $vnp_Inv_Company=$_POST['txt_inv_company'];
    // $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
    // $vnp_Inv_Type=$_POST['cbo_inv_type'];
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_ExpireDate"=>$vnp_ExpireDate
        // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
        // "vnp_Bill_Email"=>$vnp_Bill_Email,
        // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
        // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
        // "vnp_Bill_Address"=>$vnp_Bill_Address,
        // "vnp_Bill_City"=>$vnp_Bill_City,
        // "vnp_Bill_Country"=>$vnp_Bill_Country,
        // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
        // "vnp_Inv_Email"=>$vnp_Inv_Email,
        // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
        // "vnp_Inv_Address"=>$vnp_Inv_Address,
        // "vnp_Inv_Company"=>$vnp_Inv_Company,
        // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
        // "vnp_Inv_Type"=>$vnp_Inv_Type
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    // }

    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}

?>



<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="../css/payment.css">
<body>

<h1>Thanh Toán</h1>
<div class="row">
  <div class="col-25">
        <div class="container">
            <h4>Giỏ hàng <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo count($cartData); ?></b></span></h4>
            <?php foreach ($cartData as $item) : ?>
                <p>
                    <a href="#"><?php echo $item['product_name']; ?></a>
                    <span class="quantity">SL: <?php echo $item['quantity']; ?></span>
                    <span class="price"><?php echo $item['price']; ?></span>
                </p>
            <?php endforeach; ?>
            <hr>
            <p>Tổng cộng <span class="price" style="color:black"><b><?php echo number_format(array_sum(array_column($cartData, 'total')), 0, ',', '.'); ?></b></span></p>
        </div>
    </div>
  <div class="col-75">
    <div class="container">
      <form id="paymentForm" method="post">
      
        <div class="row">
        <div class="col-50">
          <h3>Thông tin khách hàng</h3>
          <label for="fname"><i class="fa fa-user"></i> Họ và tên</label>
          <input type="text" id="fname" name="firstname" placeholder="Nhập họ và tên" value="<?php echo $customerInfo['user_name']; ?>" readonly>
          <label for="email"><i class="fa fa-envelope"></i> Email</label>
          <input type="text" id="email" name="email" placeholder="Nhập email" value="<?php echo $customerInfo['email']; ?>" readonly>
          <label for="adr"><i class="fa fa-address-card-o"></i> Địa chỉ</label>
          <input type="text" id="adr" name="address" placeholder="Nhập địa chỉ" value="<?php echo $customerInfo['address']; ?>" readonly>
          <label for="city"><i class="fa fa-institution"></i> Thành phố</label>
          <input type="text" id="city" name="city" placeholder="Nhập thành phố" value="<?php echo $customerInfo['city']; ?>" readonly>

          <div class="row">
              <div class="col-50">
              </div>
              <div class="col-50">
              </div>
          </div>
          </div>

          <div class="col-50">
            <h3>Phương thức thanh toán</h3>
            <fieldset>
                <legend>Chấp nhận thanh toán qua</legend>

                <div class="form__radios">
                    <div class="form__radio">
                    <label for="momo"><img class="icon" src="./img/pay_img/momo.png" alt="Momo Icon">Momo</label>
                    <input id="momo" name="payment-method" type="radio" value="momo" />
                    </div>

                    <div class="form__radio">
                    <label for="vnpay"><img class="icon" src="./img/pay_img/vnpay.png" alt="Momo Icon">VN PAY</label>
                    <input id="vnpay" name="payment-method" type="radio" value="vnpay" />
                    </div>

                    <div class="form__radio">
                      <label for="cod">
                          <svg class="icon">
                              <i class="fa-solid fa-truck-fast"></i>
                          </svg>Thanh toán khi nhận hàng
                      </label>
                      <input id="cod" name="payment-method" type="radio" value="cod" />
                  </div>
                </div>
            </fieldset>

                
            <div class="row">
            </div>
          </div>
          
        </div>
        <input type="submit" value="Tiến hành thanh toán" name="redirect" id="redirect" class="btn">
      </form>
    </div>
  </div>
</div>
</body>


