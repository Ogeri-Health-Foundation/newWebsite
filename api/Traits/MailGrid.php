<?php

require_once "../../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
USE PHPMailer\PHPMailer\Exception;

trait sendMail
    {
        public function sendMail($email, $otp_link_code){ 

            $mail = new PHPMailer(true);
    
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'mail.dreamlenxenterprise.com.ng'; 
                        $mail->SMTPAuth = true;
                        $mail->Username = 'info@dreamlenxenterprise.com.ng'; 
                        $mail->Password = 'info@dreamlenxxx123456'; 
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
                        $mail->Port = 465;
                        
    
                $mail->setFrom('info@dreamlenxenterprise.com.ng', 'OHF');
                $mail->addAddress($email);
    
                $mail->isHTML(true);
                $mail->Subject = 'Verify Your Email - Action Required';

                $mail->Body = "
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Email Verification</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f4;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            max-width: 600px;
                            margin: 20px auto;
                            background: #ffffff;
                            padding: 20px;
                            border-radius: 10px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            text-align: center;
                        }
                        h2 {
                            color: #333;
                        }
                        p {
                            color: #555;
                            font-size: 16px;
                            line-height: 1.5;
                        }
                           
                        .btn {
                            display: inline-block;
                            padding: 12px 20px;
                            font-size: 16px;
                            color: #fff;
                            background-color: #007bff;
                            text-decoration: none;
                            border-radius: 5px;
                            font-weight: bold;
                            margin-top: 10px;
                        }
                        .btn:hover {
                            background-color: #0056b3;
                        }
                        .footer {
                            margin-top: 20px;
                            font-size: 12px;
                            color: #999;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h2>Email Verification Required</h2>
                        <p>Hello Admin,</p>
                        <p>Thank you for signing in. To complete your authentication, please verify your email address by clicking the button below:</p>
                        <a href='https://ogerihealth.org/api/v1/verifyRoute.php?code=$otp_link_code' class='btn'>Verify Email</a>
                        <p>If you did not request this, please ignore this email.</p>
                        <p class='footer'>If the button does not work, copy and paste this link into your browser:</p>
                        <p class='footer'>
                            <a href='https://ogerihealth.org/api/v1/verifyRoute.php?code=$otp_link_code'>
                                https://ogerihealth.org/api/v1/verifyRoute.php?code=$otp_link_code
                            </a>
                        </p>
                        <p class='footer'>&copy; " . date('Y') . " Your Company. All rights reserved.</p>
                    </div>
                </body>
                </html>
                ";
                
                $mail->isHTML(true); 
                $mail->send();
                
            } catch (Exception $e) {
                exit("Error sending verification email: {$mail->ErrorInfo}");
            } 
        }
























        public function sendMedicalMail($senderEmail, $senderName, $senderPhone, $senderMessage, $Adminemail){
            $mail = new PHPMailer(true);
    
                    try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'praiseonojs@gmail.com';
                $mail->Password   = 'ktle eksd aybh fgsw';  // ❗ Make sure to store this securely
                 $mail->SMTPSecure = 'ssl';
                $mail->Port       = 465;
    
                $mail->setFrom($senderEmail, $senderName);
                $mail->addAddress($Adminemail);
    
                $mail->isHTML(true);
                $mail->Subject = 'Medical report from ' . $senderEmail;

                $mail->Body = "
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Email Verification</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f4;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            max-width: 600px;
                            margin: 20px auto;
                            background: #ffffff;
                            padding: 20px;
                            border-radius: 10px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            
                        }
                        h2 {
                            color: #333;
                        }
                        p {
                            color: #555;
                            font-size: 16px;
                            line-height: 1.5;
                        }

                        h5{
                            color: #555;
                            font-size: 16px;
                    }
                           
                        .btn {
                            display: inline-block;
                            padding: 12px 20px;
                            font-size: 16px;
                            color: #fff;
                            background-color: #007bff;
                            text-decoration: none;
                            border-radius: 5px;
                            font-weight: bold;
                            margin-top: 10px;
                        }
                        .btn:hover {
                            background-color: #0056b3;
                        }
                        .footer {
                            margin-top: 20px;
                            font-size: 12px;
                            color: #999;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h2>Medical report from $senderName</h2>
                        <p>Hello Admin,</p>
                        <p>This is a medical report from $senderName</p>
                        <h5>Email: $senderEmail</h5>
                        <h5>Phone: $senderPhone</h5>
                        <h5>Message: $senderMessage</h5>
                        <p class='footer'>
                        </p>
                        <p class='footer'>&copy; " . date('Y') . " Your Company. All rights reserved.</p>
                    </div>
                </body>
                </html>
                ";
                
                $mail->isHTML(true); 
                $mail->send();
                
            } catch (Exception $e) {
                exit("Error sending verification email: {$mail->ErrorInfo}");
            } 
        }
    }













