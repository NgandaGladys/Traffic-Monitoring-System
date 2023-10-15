<?php 
$errors = array();
foreach ($errors as $error) {
    echo $errors;
}

if (isset($_POST['register_btn'])) {
    trim(extract($_POST));
    if (count($errors) == 0) {
        // `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered`
        $check = $dbh->query("SELECT email FROM users WHERE email='$email' ")->fetchColumn();
      if(!$check){
        $pass= sha1($password);
        $sql = "INSERT INTO users VALUES(NULL,'$fullname','$phone','$email','$pass','','user','$dtime')";
        $result = dbCreate($sql);
        if($result == 1){
            $api_key = "lSwE2BEOF8Z79A1L4n489S2WB6DJ9VQ9Q92yF3XlOyJ9VMl2T03hzVs52L6Kk1lI";
            $message = "GREMBASI Inv. LTD: Hi ".$surname.', your Login details is: Phone '. $phone.' Password: '.$password;
            @json_decode(send_sms_yoola_api($api_key, $phone, $message), true);
                
            echo "<script>
                alert('Registration is Successful');
                window.location = '".SITE_URL."?users';
                </script>";
        }else{
            echo "<script>
              alert('User registration failed');
              window.location = '".SITE_URL."?users';
              </script>";
        }
     }else{
          echo "<script>
            alert('Username already registered');
            window.location = '".SITE_URL."?users';
            </script>";
        }
    }
    
}elseif (isset($_POST['login_btn'])) {
    trim(extract($_POST));
    if (count($errors) == 0) {
    $password = sha1($password);
    $result = $dbh->query("SELECT * FROM users WHERE phone = '$phone' AND password = '$password' ");
        if ($result->rowCount() == 1) {
            $rows = $result->fetch(PDO::FETCH_OBJ);
            if ($rows->status == 'Approved') {  
                //`userid`, `fullname`, `email`, `phone`, `bsc_id`, `role`, `token`, `status`, `date_registered`, `password`
                $token = rand(11111, 99999);
                $dbh->query("UPDATE users SET token = '$token' WHERE userid = '".$rows->userid."' ");
                $message = "Hi ".$rows->fullname.', your Login token is  '. $token;
                $nums = $rows->phone;
                $message = "Nalongo Njala Supermarket : ".$message;
                $send = send_message($message, $phone);
                $_SESSION['phone'] = $phone;
                $_SESSION['loader'] = '<center><div class="spinner-border text-dark"></div></center>';
                $_SESSION['status'] = '<div class="card card-body alert alert-dark text-center">Account matched, New Token generated Successfully</div>';
                header("refresh:3; url=".SITE_URL.'/token');
            }else{
                $_SESSION['status'] = '<div class="card card-body alert alert-primary text-center">
                Account matched, But Under Preview!</div>';
            }
        }else{
            $_SESSION['status'] = '<div class=" card card-body alert alert-danger text-center">
            Invalid account, Try again.</div>';
        }

    }else{
        $_SESSION['status'] = '<div class=" card card-body alert alert-danger text-center">
        Wrong Token inserted</div>';
    }
}elseif (isset($_POST['verify'])) {
    trim(extract($_POST));
    if (count($errors) == 0) {
        $result = $dbh->query("SELECT * FROM users WHERE phone = '$phone' AND token = '$otp' " );
        if ($result->rowCount() == 1) {
        $row = $result->fetch(PDO::FETCH_OBJ);
         //`userid`, `fullname`, `email`, `phone``, `role`, `token`, `status`, `date_registered`, `password`
        $_SESSION['userid'] = $row->userid;
        $_SESSION['phone'] = $row->phone;
        $_SESSION['status'] = $row->status;
        $_SESSION['fullname'] = $row->fullname;
        $_SESSION['role'] = $row->role;
        $_SESSION['date_registered'] = $row->date_registered;
        if ($result->rowCount() > 0) {
            $_SESSION['loader'] = '<center><div class="spinner-border text-dark"></div></center>';
            $_SESSION['status'] = '<div class="card card-body alert alert-dark text-center">
            <strong>Login Successful, Redirecting...</strong></div>';
            header("refresh:3; url=".SITE_URL);
            }else{
                $_SESSION['status'] = '<div class="card card-body alert alert-danger text-center">
                Login failed, please check your login details again</div>';
            }
    }else{
        $_SESSION['status_err'] = '<div class="card card-body alert alert-danger text-center">
                <strong>Wrong Token inserted</strong></div>';
        // echo "<script>
        //     alert('Wrong Token inserted');
        //     window.location = '".SITE_URL."/token';
        //     </script>";
    }
    }

}elseif (isset($_POST['resent_token_btn'])) {
    trim(extract($_POST));
    if (count($errors) == 0) {
        $result = $dbh->query("SELECT * FROM users WHERE phone = '$phone' " );
        if ($result->rowCount() == 1) {
            $token = rand(11111,99999);
            $dbh->query("UPDATE users SET token = '$token' WHERE phone = '$phone' ");
            $rx = dbRow("SELECT * FROM users WHERE phone = '$phone' ");
            $subj = "POST KAZI - Account Verification Token";
            $body = "Hello {$rx->fullname} you account verification token is: <br>
                <h1><b>{$token}</b></h1>";
            GoMail($email,$subj,$body);
            $_SESSION['email'] = $email;
            $_SESSION['status'] = '<div class="alert alert-success text-center">Verification token is sent to your email successfully, Please enter the OTP send to you via Email to complete registration process</div>';
            header("refresh:3; url=".SITE_URL.'/token');
        }else{
            $_SESSION['status'] = '<div class="card card-body alert alert-warning text-center">
            Account Verification Failed., please check your Token and try again.</div>';
        }
    }
}elseif(isset($_POST['save_new_system_user_btn'])){
    trim(extract($_POST));
    if (count($errors) == 0) {
        // `userid`, `fullname`, `email`, `phone`, `password`, `bs_id`, `role`, `token`, `status`, `date_registered`, `pic`
        $check = $dbh->query("SELECT phone FROM users WHERE phone='$phone' ")->fetchColumn();
      if(!$check){
        $pass= sha1($password);
        $userid = rand(11111111,99999999);
        $token = rand(11111,99999);
        $fullname = addslashes($fullname);
        $sql = "INSERT INTO users VALUES('$userid','$fullname','$email','$phone','$pass','$role','$token','Approved','$today','')";
        $result = dbCreate($sql);
        if($result == 1){
            $message = "Hi ".$fullname.', your Login details is: Phone:'. $phone.', Password: '.$password;
            $nums = array("+256".$phone);
            {
            $recipients = "".implode(',', $nums);
            $message = "Nalongo Njala Supermarket : ".$message;
            $gateway    = new AfricasTalkingGateway($username, $apikey);
            try 
            { 
              $results = $gateway->sendMessage($recipients, $message);
              foreach($results as $result) {
              echo '';
              }
            }
            catch ( AfricasTalkingGatewayException $e )
            {
              echo "Encountered an error while sending: ".$e->getMessage();
            }
            }
            $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> System User Registered Successfully.
            </div>';
            header("refresh:3; url=".SITE_URL.'/users');
        }else{
            $_SESSION['status'] = '<div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Invalid!</strong> User Registration Failed.
            </div>';
        }
     }else{
        echo "<script>
        alert('Username already registered');
        window.location = '".SITE_URL."/users';
        </script>";
        }
    }
}elseif (isset($_POST['save_new_milk_inventory_btn'])) {
    trim(extract($_POST));
    // `milk_id`, `milk_supplier_id`, `milk_quantity`, `milk_price`, `milk_date_added`
    $price = $dbh->query("SELECT price_per_liter FROM milk_supplier WHERE id='$supplier' ")->fetchColumn();
    $sql = dbCreate("INSERT INTO milk_inventory (`milk_supplier_id`, `day_or_eve`, `price`, `date`, `liters`, `date_time`) VALUES('$supplier', '$time','$price','$today', '$quantity', '$dtime') ");
    $dbh->query("UPDATE store SET quantity= quantity + '$quantity' WHERE pid=10 ");
    if ($sql) {
        $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Inventory Recorded Successfully.
      </div>';
      redirect_page(SITE_URL.'/milk-inventory');
    }else{
        echo "<script>
            alert('Milk Inventory Adding Failed');
            window.location = '".SITE_URL."/milk-inventory';
            </script>";
    }

}elseif(isset($_POST['save_new_milk_supplier_btn'])){
    trim(extract($_POST));
    if (count($errors) == 0) {
        $userid = rand(11111111,99999999);
        $fullname = addslashes($name);
        $sql = "INSERT INTO milk_supplier (`full_name`, `village`, `phone_number`, `price_per_liter`) VALUES ('$fullname', '$village', '$phone', '$amount')";
        $result = dbCreate($sql);
        if($result == 1){
            $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> Milk Supplier Registered Successfully.
            </div>';
            header("refresh:3; url=".SITE_URL.'/milk-suppliers');
        }else{
            $_SESSION['status'] = '<div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Invalid!</strong> Milk Supplier Registration Failed.
            </div>';
        }
    }
}elseif (isset($_POST['update_milk_supplier_details_btn'])){
    trim(extract($_POST));
    $fullname = addslashes($fullname);
    //UPDATE `milk_supplier` SET `id`='[value-1]',`full_name`='[value-2]',`village`='[value-3]',`phone_number`='[value-4]',`price_per_liter`='[value-5]' WHERE 1
    $sql = $dbh->query("UPDATE milk_supplier SET full_name = '$fullname', village = '$village', phone_number = '$phone', price_per_liter = '$price' WHERE id = '$id' ");
    if ($sql) {
        $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> Supplier Details Updated Successfully.
        </div>';
        header("Location: ".SITE_URL.'/milk-suppliers');
    }else{
        echo "<script>
            alert('Supplier Details Update Failed');
            window.location = '".SITE_URL."/milk-suppliers';
            </script>";
    }

}elseif(isset($_POST['update_user_details_btn'])){
    trim(extract($_POST));
    //`userid`, `fullname`, `email`, `role`, `password`, `phone`, `token`, `status`, `date_registered`, `pic`
    $fullname = addslashes($fullname);
    $sql = $dbh->query("UPDATE users SET fullname = '$fullname', email = '$email', phone = '$phone', role = '$role' WHERE userid = '$userid' ");
    if ($sql) {
        $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> User Details Updated Successfully.
        </div>';
        header("Location: ".SITE_URL.'/users');
    }else{
        echo "<script>
            alert('User Details Update Failed');
            window.location = '".SITE_URL."/users';
            </script>";
    }

}elseif (isset($_POST['submit_banner_details_btn'])) {
    trim(extract($_POST));
    //`bid`, `bsmall_title`, `bbig_title`, `bdesc`, `bphoto`, `bdate_added`
     $filename = trim($_FILES['bphoto']['name']);
     $chk = rand(1111111111111,9999999999999);
     $ext = strrchr($filename, ".");
     $bphoto = $chk.$ext;
     $target_img = "uploads/".$bphoto;
     $url = SITE_URL.'/uploads/'.$bphoto;
     $bsmall_title = addslashes($bsmall_title);
     $bbig_title = addslashes($bbig_title);
     $bdesc = addslashes($bdesc);
    $result = dbCreate("INSERT INTO banner VALUES(NULL,'$bsmall_title','$bbig_title','$bdesc','$url','$today')");
     if (move_uploaded_file($_FILES['bphoto']['tmp_name'], $target_img)) {
          $msg ="Image uploaded Successfully";
          }else{
            $msg ="There was a problem uploading image";
          }
        if($result == 1){
            $_SESSION['upload_status'] = '<div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong>Banner Uploaded Successfully.
            </div>';
            header("Location: ".SITE_URL."/banners");
        }else{
            $_SESSION['upload_status'] = '<div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Failed!</strong>Banner Upload Failed.
            </div>';
        }

}elseif (isset($_POST['recover_btn'])) {
    trim(extract($_POST));
    $res = $dbh->query("SELECT phone FROM users WHERE (phone='$phone' ) ")->fetchColumn();
    if(!$res){
        echo "<script>
            alert('This phone number is not registered in this system');
            window.location = '".SITE_URL."/auth-login';
            </script>";
     }else{
        $_SESSION['phone'] = $phone;
        header("Location: auth-new-password");

    }
}elseif (isset($_POST['newpassowrd_btn_verification'])) {
    trim(extract($_POST));
    // `userid`, `token`, `surname`, `othername`, `gender`, `phone`, `email`, `password`, `country_id`, `branch_id`, `address`, `nin_number`, `date_registered`, `account_status`, `u_type`
    $password = sha1($new_password);
    $update_password = $dbh->query("UPDATE users SET password = '$password' WHERE phone = '$phone' ");
    if ($update_password) {
        $ro = dbRow("SELECT * FROM users WHERE phone = '$phone' ");
        $message = "Hi ".$ro->surname.', your New Login details is: Phone '. $phone.' Password: '.$new_password;
            $nums = array("+256".$phone);
            {
            $recipients = "".implode(',', $nums);
            $message = "GREMBASI INVESTMENTS LTD : ".$message;
            $gateway    = new AfricasTalkingGateway($username, $apikey);
            try 
            { 
              $results = $gateway->sendMessage($recipients, $message);
              foreach($results as $result) {
              echo '';
              }
            }
            catch ( AfricasTalkingGatewayException $e )
            {
              echo "Encountered an error while sending: ".$e->getMessage();
            }
            }
            echo "<script>
                alert('Account Login details updated Successfully');
                window.location = '".SITE_URL."/auth-login';
                </script>";
    }
}elseif (isset($_POST['update_client_btn'])) {
    trim(extract($_POST));
    //`cid`, `fname`, `lname`, `cphone`, `physical_address`, `id_number`, `occupation`, `monthly_salary`
    $fname = addslashes($fname);
    $lname = addslashes($lname);
    $physical_address = addslashes($physical_address);
    $occupation = addslashes($occupation);
    $res = $dbh->query("UPDATE clients SET fname = '$fname', lname = '$lname', cphone = '$cphone', physical_address = '$physical_address', id_number = '$id_number', occupation = '$occupation', monthly_salary = '$monthly_salary' WHERE cid = '$cid' ");
    if ($res) {
        header("Location: ".SITE_URL.'?clients');

        $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> Client details Updated successfully.
        </div>';
    }
}

?>
