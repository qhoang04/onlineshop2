<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 
    session_start();
    include('function.php');
    include('db_config.php');
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
    if(isset($_GET['vnp_Amount'])) {
        $vnp_Amount = $_GET['vnp_Amount'];
        $vnp_BankCode = $_GET['vnp_BankCode'];
        $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
        $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
        $vnp_PayDate = $_GET['vnp_PayDate'];
        $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
    }
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
    $order_details = get_order_details($user_id);
	$total_pay = 0;
?>


<title>Thanh toán thành công</title>
<meta charset="utf-8">
</head>
<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}

			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}
			.invoice-box table tr.top table td.title img {
				width: 34%;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table>
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="../img/logopay.png" alt="Company logo" />
								</td>

								<td>
									Mã đơn hàng <?php echo $order_details['order_id'] ?><br />
									<?php echo $order_details['order_date'] ?><br/>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									Trường ĐH CNTT-VH<br />
									470 Trần Đại Nghĩa, Ngũ Hành Sơn<br />
									Đà Nẵng
								</td>

								<td>
									<?php echo $order_details['user_name'] ?><br />
									<?php echo $order_details['email'] ?><br/>
                                    <?php echo $order_details['address'] ?>

								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Phương thức thanh toán</td>

					<td>Check #</td>
				</tr>

				<tr class="details">
					<td><?php 
                        if (isset($_GET['vnp_Amount'])) {
                            $vnp_Amount = $_GET['vnp_Amount'];
                            echo "VNPay";
							$total_pay = $vnp_Amount;
                        }
                    ?></td>
				</tr>

				<tr class="heading">
					<td>Sản phẩm</td>

					<td>Giá</td>
				</tr>
<!-- 
				<tr class="item">
					<td>Website design</td>

					<td>$300.00</td>
				</tr>

				<tr class="item">
					<td>Hosting (3 months)</td>

					<td>$75.00</td>
				</tr>

				<tr class="item last">
					<td>Domain name (1 year)</td>

					<td>$10.00</td>
				</tr> -->

				<tr class="total">
					<td></td>

					<td>Tổng cộng: <?php echo number_format(($total_pay)/100,0, ',', '.'); ?> đ</td>
				</tr>
                <tr>
                    <td><a href="../index.php">Quay lại trang chủ</a></td>
                </tr>

			</table>
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