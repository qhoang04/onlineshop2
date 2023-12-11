<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="../css/payment.css">
<body>

<h1>Thanh Toán</h1>
<div class="row">
    <div class="col-25">
        <div class="container">
        <h4>Giỏ hàng <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>4</b></span></h4>
        <p><a href="#">Product 1</a> <span class="price">15</span></p>
        <p><a href="#">Product 2</a> <span class="price">5</span></p>
        <p><a href="#">Product 3</a> <span class="price">8</span></p>
        <p><a href="#">Product 4</a> <span class="price">2</span></p>
        <hr>
        <p>Tổng cộng <span class="price" style="color:black"><b>30</b></span></p>
        </div>
    </div>
  <div class="col-75">
    <div class="container">
      <form action="/action_page.php">
      
        <div class="row">
          <div class="col-50">
            <h3>Thông tin khách hàng</h3>
            <label for="fname"><i class="fa fa-user"></i> Họ và tên</label>
            <input type="text" id="fname" name="firstname" placeholder="Nhập họ và tên">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="Nhập email">
            <label for="adr"><i class="fa fa-address-card-o"></i> Địa chỉ</label>
            <input type="text" id="adr" name="address" placeholder="Nhập địa chỉ">
            <label for="city"><i class="fa fa-institution"></i> Thành phố</label>
            <input type="text" id="city" name="city" placeholder="Nhập thành phố">

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
                    <input checked id="momo" name="payment-method" type="radio" />
                    </div>

                    <div class="form__radio">
                    <label for="vnpay"><img class="icon" src="./img/pay_img/vnpay.png" alt="Momo Icon">VN PAY</label>
                    <input id="vnpay" name="payment-method" type="radio" />
                    </div>

                    <div class="form__radio">
                    <label for="cod"><svg class="icon">
                    <i class="fa-solid fa-truck-fast"></i>
                        </svg>Thanh toán khi nhận hàng</label>
                    <input id="cod" name="payment-method" type="radio" />
                    </div>
                </div>
            </fieldset>

                
            <div class="row">
            </div>
          </div>
          
        </div>
        <input type="submit" value="Tiến hành thanh toán" class="btn">
      </form>
    </div>
  </div>
</div>
</body>

