<?php


if(isset($_POST['submit'])){

    $email = $_POST['email'];

    $validation_reg = "SELECT `email` FROM `tbl_users` WHERE email = '$email' ";
    $validate = mysqli_query($conn,$validation_reg);

    if(mysqli_num_rows($validate) > 0){

        $otp = rand(9999, 1111);
        //hashing of otp
        $hashed_otp = password_hash($otp,PASSWORD_DEFAULT);

        // if(sendMail($email,$otp)){

        $query_otp = " INSERT INTO reset_password (code, email) VALUES('$hashed_otp', '$email')";
        $send_query_otp = mysqli_query($conn,$query_otp);
        if($send_query_otp){
            
            $timestamp =  $_SERVER["REQUEST_TIME"];  
            // generate the timestamp when otp is forwarded to user email/mobile.
            $_SESSION['time'] = $timestamp;
            $_SESSION['email'] = $email;
            $_SESSION['otp'] = $otp;
            sendMail($email, $otp);

            header("Location: otp-password.php");
        }else{
            echo "<script>alert('PUtanginamo')</script>";
        }
           
            // $query_otp = "UPDATE `reset_password` SET `code`='$hashed_otp' WHERE email = '$email'";
            // insert the database of the otp

        // }else{
        //     echo "<script>alert('PUtanginamo')</script>";
        // }


        //    else{
        //    }
    }else{
        echo "<script>alert('Something went wrong!')</script>";
        // echo"invalid";
    }




}

?>