<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $name = $_POST['name'];
    $sender_email = $_POST['email']; // Địa chỉ email của người gửi
    $message = $_POST['message'];

    // Kiểm tra tính hợp lệ của địa chỉ email
    if (!filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php");
        exit();
    }

    // Tạo đối tượng PHPMailer
    $mail = new PHPMailer();

    // Cấu hình SMTP (thay thế thông tin này bằng thông tin thực của bạn)
    $mail->isSMTP();
    $mail->CharSet  = "utf-8";
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'voquochoang2004@gmail.com';
    $mail->Password = 'zgzisobsesekcqds';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Cài đặt thông tin người gửi và người nhận (quản trị viên)
    $mail->setFrom($sender_email, $name);
    $mail->addAddress('voquochoang2004@gmail.com', 'Admin');

    // Thiết lập nội dung email cho quản trị viên
    $mail->isHTML(true);
    $mail->Subject = 'Feedback from Contact Form';
    $mail->Body = "Name: $name<br>Email: $sender_email<br>Message: $message";

    // Gửi email đến quản trị viên
	if ($mail->send()) {
		$mail->clearAddresses();
		$mail->addAddress($sender_email, $name);
		$mail->Subject = 'Confirmation of Contact Form Submission';
		$mail->Body = 'Thank you for your feedback. We will get back to you soon.';
		
		if ($mail->send()) {
			header("Location: ../index.php");
			exit();
		} else {
			header("Location: ../index.php");
			exit();
		}
	} else {
		echo json_encode(["status" => "error", "message" => "Có lỗi xảy ra khi gửi liên hệ."]);
		exit();
	}
}
?>
