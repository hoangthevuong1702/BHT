<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

class Email {
    public function sendEmail() {
        $name = isset($_POST['username'])? $_POST['username']:null;
        $email = isset($_POST['email'])? $_POST['email']:null;
        $phone = isset($_POST['phone'])? $_POST['phone']:null;
        $address = isset($_POST['address'])? $_POST['address']:null;
        $total = isset($_POST['total'])? $_POST['total']:null;
        $nameProduct = isset($_SESSION['name']) ? $_SESSION['name'] : null;      
        $quantity = isset($_SESSION['quantity']) ? $_SESSION['quantity'] : null;              
        $shippingFee = 30000; // Phí vận chuyển
        $vat = 0; // Giả sử không có VAT, bạn có thể điều chỉnh giá trị này
        // Tính tổng tiền
        $totalAmount = $total + $shippingFee + $vat;
        // phần html
        $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Xác nhận thanh toán</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                }

                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                }

                h2 {
                    text-align: center;
                }

                .order-details {
                    border: 1px solid #ccc;
                    padding: 20px;
                    border-radius: 5px;
                    background-color: #f9f9f9;
                }

                .order-details h3 {
                    text-align: center;
                }

                .order-summary {
                    margin-top: 20px;
                }

                .order-summary table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .order-summary table, th, td {
                    border: 1px solid #ccc;
                }

                .order-summary th, .order-summary td {
                    padding: 10px;
                    text-align: left;
                }

                .order-summary th {
                    background-color: #f2f2f2;
                }

                .order-summary td {
                    vertical-align: top;
                }

                .footer-note {
                    margin-top: 20px;
                    font-size: 14px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>XÁC NHẬN THANH TOÁN</h2>
                <div class="order-details">
                    <p>Kính chào quý khách Hoàng Thế vượng,</p>
                    <p>Đơn hàng của Quý Khách đặt tại BHT đã được xác nhận thanh toán thành công.</p>
                    <div class="order-summary">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$nameProduct.'</td>
                                    <td>'.$total.'</td>
                                    <td>'.$quantity.'</td>
                                    <td>'.$total.'</td>
                                </tr>
                            </tbody>
                        </table>
                        <p>Tổng giá trị sản phẩm: '.$total.' VND</p>
                        <p>Phí vận chuyển:' .$shippingFee. 'VND</p>
                        <p>Thành tiền (Đã bao gồm VAT): '.$totalAmount.' VND</p>
                    </div>
                    <p>(*)</p>
                    <h3>Thông tin đơn hàng</h3>
                    <p>Phương thức giao hàng: Giao hàng tận nơi</p>
                    <h3>Địa chỉ giao hàng</h3>
                    <p>Tên người nhận:' .$name.'</p>
                    <p>Địa chỉ người nhận: '.$address.'</p>
                    <p>Số điện thoại liên hệ: '.$phone.'</p>
                </div>
            </div>
        </body>
        </html>';
        $mail = new PHPMailer(true);

        try { 
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'thevuong1702@gmail.com';                     //SMTP username
            $mail->Password   = 'rqgm dnte uios mucw';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('thevuong1702@gmail.com', 'HTV');
            $mail->addAddress($email, $name);     //Add a recipient

            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'SUCCESS';
            $mail->Body    = $html;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
