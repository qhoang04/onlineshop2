<style>
    
body {
    font-family: Arial;
    font-size: 17px;
    padding: 8px;
}
  
  h1 {
    text-align: center;
  }
  
  * {
    box-sizing: border-box;
  }
  
  .row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap; 
    flex-wrap: wrap;
    margin: 0 -16px;
  }
  fieldset {
    border: 0;
    margin: 0;
    padding: 0;
  }
  legend {
    font-weight: 600;
    margin-block-end: 0.5em;
    padding: 0;
  }
  input[type="radio"] {
    accent-color: var(--color-primary);
  }
  .form__radios {
    display: grid;
    gap: 1em;
  }
  .form__radio {
    align-items: center;
    background-color: #fefdfe;
    border-radius: 1em;
    box-shadow: 0 0 1em rgba(0, 0, 0, 0.0625);
    display: flex;
    padding: 1em;
  }
  
  .form__radio label {
    align-items: center;
    display: flex;
    flex: 1;
    gap: 1em;
  }
  .icon {
    block-size: 1em;
    display: inline-block;
    fill: currentColor;
    inline-size: 1em;
    vertical-align: middle;
  }
  
  .col-25 {
    -ms-flex: 25%; 
    flex: 25%;
  }
  
  .col-50 {
    -ms-flex: 50%; 
    flex: 50%;
  }
  
  .col-75 {
    -ms-flex: 75%; 
    flex: 75%;
  }
  
  .col-25,
  .col-50,
  .col-75 {
    padding: 0 16px;
  }
  
  .container {
    background-color: #f2f2f2;
    padding: 5px 20px 15px 20px;
    border: 1px solid lightgrey;
    border-radius: 3px;
  }
  
  input[type=text] {
    width: 100%;
    margin-bottom: 20px;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 3px;
  }
  
  label {
    margin-bottom: 10px;
    display: block;
  }
  
  .icon-container {
    margin-bottom: 20px;
    padding: 7px 0;
    font-size: 24px;
  }
  
  .btn {
    background-color: #4CAF50;
    color: white;
    padding: 12px;
    margin: 10px 0;
    border: none;
    width: 100%;
    border-radius: 3px;
    cursor: pointer;
    font-size: 17px;
  }
  
  .btn:hover {
    background-color: #45a049;
  }
  
  a {
    color: #2196F3;
  }
  
  hr {
    border: 1px solid lightgrey;
  }
  
  span.price {
    float: right;
    color: grey;
  }
  .sub-menu-wrap {
            position: absolute;
            top: 100%;
            right: 10%;
            width: 320px;
            max-height: 400px;
            overflow: hidden;
            transition: max-height 0.5s;
        }
        .sub-menu-wrap.open-menu {
            max-height: 400px;
            
        }
        .sub-menu {
            background: #fff;
            padding: 20px;
            margin: 10px;
        }
        .sub-menu-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #525252;
            margin: 12px 0;
        }
        .sub-menu-link p {
            width: 100%;
        }
        .sub-menu-link img {
            width: 40px;
            background: #e5e5e5;
            border-radius: 50%;
            padding: 8px;
            margin-right: 15px;
        }
        .sub-menu-link span {
            font-size: 22px;
            transition: transform 0.5s;
        }
        .sub-menu-link:hover span {
            transform: translate(5px);
        }
        .sub-menu-link:hover p {
            font-weight: 600;
        }
  
  /* Responsive layout */
  @media (max-width: 800px) {
    .row {
      flex-direction: column-reverse;
    }
    .col-25 {
      margin-bottom: 20px;
    }
  }
</style>

<fieldset>
                <legend>Chấp nhận thanh toán qua</legend>

                <div class="form__radios">
                    <div class="form__radio">
                    <label for="momo"><img class="icon" src="./img/pay_img/momo.png" alt="Momo Icon">Momo</label>

                    </div>
                    <button onclick="toggleMenu()">click here</button>
                    <div class="sub-menu-wrap" id="subMenu">
                        <div class="sub-menu">
                            <a href="#" class="sub-menu-link">
                                <img src="images/profile.png">
                                <p>Edit Profile</p>
                                <span>></span>
                            </a>
                            <a href="#" class="sub-menu-link">
                                <img src="images/setting.png">
                                <p>Settings & Privacy</p>
                                <span>></span>
                            </a>
                            <a href="#" class="sub-menu-link">
                                <img src="images/help.png">
                                <p>Help & Support</p>
                                <span>></span>
                            </a>
                            <a href="#" class="sub-menu-link">
                                <img src="images/logout.png">
                                <p>Logout</p>
                                <span>></span>
                            </a>
                        </div>
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
            <script>
    let subMenu = document.getElementById('subMenu');

    function toggleMenu() {
        subMenu.classList.toggle("open-menu");
    }
</script>