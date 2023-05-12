<?php 
 $conn = mysqli_connect('localhost', 'root', '') or
 die ('Unable to connect. Check your connection parameters.');
 mysqli_select_db($conn, 'bms_db' ) or die(mysqli_error($conn));
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $validation_reg = "SELECT `email` FROM `tbl_users` WHERE email = '$email' ";
    $validate = mysqli_query($conn,$validation_reg);

    if(mysqli_num_rows($validate) > 0){
        foreach($validate as $row){
            if($row['email'] == $email){
                $otp = rand(9999, 1111);
                //hashing of otp
                $hashed_otp = password_hash($otp,PASSWORD_DEFAULT);
                $query_otp = " INSERT INTO reset_password (code, email) VALUES('$hashed_otp', '$email')";
                $send_query_otp = mysqli_query($conn,$query_otp);
                if($send_query_otp){
                    header("location: otp-password.php?u=$email");
                    require ("PHPMailer/src/PHPMailer.php");
                    require("PHPMailer/src/SMTP.php");
                    require("PHPMailer/src/Exception.php");
                            
                    try {

                        $mail = new PHPMailer(true);
                        $mail->isSMTP();                                          
                        $mail->Host       = 'smtp.gmail.com';                    
                        $mail->SMTPAuth   = true;                               
                        $mail->Username   = 'jijieazy13@gmail.com';                     
                        $mail->Password   = 'kxaeexkrxhyhypat';                              
                        $mail->SMTPSecure = 'ssl';            
                        $mail->Port       = 465;                                    
                    
                        //Recipients
                        $mail->SetFrom('jijieazy13@gmail.com');
                        $mail->addAddress($email);
                        // $mail->addAttachment($path);       
                    
                        //Content
                        $mail->isHTML(true);                                 
                        $mail->Subject = "Password Reset OTP";
                        $mail->Body    = "This is your otp ".$otp." Please don't reply" ;

                        $mail->send();


                        $timestamp =  $_SERVER["REQUEST_TIME"];  
                        // sendMail($email, $otp);
                        // generate the timestamp when otp is forwarded to user email/mobile.
                        // $_SESSION['time'] = $timestamp;
                        $_SESSION['email'] = $email;
                        $_SESSION['otp'] = $otp;
                        // echo $_SESSION['email'];
                        // header("location: otp-password.php");

                    } catch (Exception $e) {
                        return false;
                    }
                    // echo "success";
                }else{
                    echo "error";
                }

                return $validate;

            }
        }
    }
}
?>