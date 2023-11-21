<?php 
$errors = array();
foreach ($errors as $error) {
    echo $errors;
}

if (isset($_POST['register_btn'])) {
    trim(extract($_POST));
    if (empty($fullname)) {
    array_push($errors, $_SESSION['fullname_err'] = '<div class="text-danger text-start">Name is required</div>');
    }
    if (empty($email)) {
    array_push($errors, $_SESSION['email_err'] = '<div class="text-danger text-start">Email is required</div>');
    }
    if (empty($password)) {
    array_push($errors, $_SESSION['password_err'] = '<div class="text-danger text-start">Password is required</div>');
    }
    if (empty($phone)) {
    array_push($errors, $_SESSION['phone_err'] = '<div class="text-danger text-start">Phone number is required</div>');
    }

    if (empty($email)) {
        
    }else{
        function checkemail($str) {
            return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
        }
        if(!checkemail($email)){
             array_push($errors, $_SESSION['invalid_email_err'] = '<div class="text-danger text-start">Invalid Email Format </div>');
        }else{}
    }

    if (count($errors) == 0) {
        // `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered`
        $check = $dbh->query("SELECT email FROM users WHERE email='$email' ")->fetchColumn();
      if(!$check){
        $pass= sha1($password);
        $sql = "INSERT INTO users VALUES(NULL,'$fullname','$phone','$email','$pass','','user','$dtime')";
        $result = dbCreate($sql);
        if($result == 1){//activate mailer
            // $subj = "Traffic Monitoring System - Registration Verification";
            // $body = "Hello {$fullname}! Your registration to Traffic Monitoring System is successful<br>
            // Your Login details: Email {$email} and Password {$password} ";
            // GoMail($email,$subj,$body);
            //make the page have nice loader and alert after successful registration...
            $_SESSION['loader'] = '<center><div class="spinner-border text-success"></div></center>';
            $_SESSION['status'] = '<div class="card card-body alert alert-success text-center">User registration is successful, Redirecting to login ...</div>';
            header("refresh:3; url =".SITE_URL.'/login');
            //another method for alerting after successful registration...
            // echo "<script>
            //     alert('Registration is Successful');
            //     window.location = '".SITE_URL."/login';
            //     </script>";
        }else{
            //--error , registration failed. 
            $_SESSION['status'] = '<div class="card card-body alert alert-danger text-center">
            User registration failed! </div>';
            // echo "<script>
            //   alert('User registration failed');
            //   window.location = '".SITE_URL."/signup';
            //   </script>";
        }
     }else{
        //user already exists...
        $_SESSION['status'] = '<div class="card card-body alert alert-danger text-center">
            Email already registered</div>';
        //   echo "<script>
        //     alert('Email already registered');
        //     window.location = '".SITE_URL."/signup';
        //     </script>";
        }
    }
    
}elseif (isset($_POST['user_login_btn'])) {
    trim(extract($_POST));
    if (empty($email)) {
    array_push($errors, $_SESSION['email_err'] = '<div class="text-danger text-start">Email Address is required</div>');
    }
    if (empty($password)) {
    array_push($errors, $_SESSION['password_err'] = '<div class="text-danger text-start">Password is required</div>');
    }

    if (empty($email)) {
        
    }else{
        function checkemail($str) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
        }
        if(!checkemail($email)){
             array_push($errors, $_SESSION['invalid_email_err'] = '<div class="text-danger text-start">Invalid Email Format </div>');
        }
        else{}

        if (count($errors) == 0) {
            // `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered`
            $password = sha1($password);
            $result = $dbh->query("SELECT * FROM users WHERE email = '$email' AND password = '$password' ");
            if ($result->rowCount() == 1) {
                //getting the login users..
                $row = $result->fetch(PDO::FETCH_OBJ);
                //creating succession for a login user... 
                //getting user data...
                $_SESSION['userid'] = $row->userid;
                $_SESSION['fullname'] = $row->fullname;
                $_SESSION['phone'] = $row->phone;
                $_SESSION['email'] = $row->email;
                $_SESSION['role'] = $row->role;
                $_SESSION['date_registered'] = $row->date_registered;
                $_SESSION['loader'] = '<center><div class="spinner-border text-success"></div></center>';
                $_SESSION['status'] = '<div class="card card-body alert alert-success text-center">Login is Successful</div>';
                header("refresh:3; url=".SITE_URL);
            }else{
                $_SESSION['status'] = '<div class=" card card-body alert alert-danger text-center">
                Account not found, try again!</div>';
            }

        }else{
            $_SESSION['status'] = '<div class=" card card-body alert alert-danger text-center">
            Wrong Login details </div>';
        }

    }
}elseif (isset($_POST['admin_login_btn'])) {
    trim(extract($_POST));
    if (empty($email)) {
    array_push($errors, $_SESSION['email_err'] = '<div class="text-danger text-start">Email Address is required</div>');
    }
    if (empty($password)) {
    array_push($errors, $_SESSION['password_err'] = '<div class="text-danger text-start">Password is required</div>');
    }

    if (empty($email)) {
        
    }else{
        function checkemail($str) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
        }
        if(!checkemail($email)){
             array_push($errors, $_SESSION['invalid_email_err'] = '<div class="text-danger text-start">Invalid Email Format </div>');
        }
        else{}

        if (count($errors) == 0) {
            // `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered`
            $password = sha1($password);
            $result = $dbh->query("SELECT * FROM users WHERE email = '$email' AND password = '$password' And role IN ('super admin','admin')");
            if ($result->rowCount() == 1) {
                //getting the login users..
                $row = $result->fetch(PDO::FETCH_OBJ);
                //creating succession for a login user... 
                //getting user data...
                $_SESSION['userid'] = $row->userid;
                $_SESSION['fullname'] = $row->fullname;
                $_SESSION['phone'] = $row->phone;
                $_SESSION['email'] = $row->email;
                $_SESSION['role'] = $row->role;
                $_SESSION['date_registered'] = $row->date_registered;
                $_SESSION['loader'] = '<center><div class="spinner-border text-success"></div></center>';
                $_SESSION['status'] = '<div class="card card-body alert alert-success text-center">Login is Successful</div>';
                header("refresh:3; url=".SITE_URL);
            }else{
                $_SESSION['status'] = '<div class=" card card-body alert alert-danger text-center">
                Account not found, try again!</div>';
            }

        }else{
            $_SESSION['status'] = '<div class=" card card-body alert alert-danger text-center">
            Wrong Login details </div>';
        }

    }
}elseif (isset($_POST['forgot_password_btn'])) {
    trim(extract($_POST));
    if (empty($email)) {
    array_push($errors, $_SESSION['email_err'] = '<div class="text-danger text-start">Email is required</div>');
    }
    if (empty($email)) {   
    }else{
        function checkemail($str) {
            return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
        }
        if(!checkemail($email)){
             array_push($errors, $_SESSION['invalid_email_err'] = '<div class="text-danger text-start">Invalid Email Format </div>');
        }else{}
    }

    if (count($errors) == 0) {
        $token = rand(11111,999999);
        $result = $dbh->query("UPDATE users SET token = '$token' WHERE email = '$email' ");
        if($result){
            $_SESSION['email'] = $email;
            $_SESSION['loader'] = '<center><div class="spinner-border text-success"></div></center>';
            $_SESSION['status'] = '<div class="card card-body alert alert-success text-center">Redirecting to verification page ...</div>';
            header("refresh:3; url =".SITE_URL.'/otp');
        }else{
            //--error , registration failed 
            $_SESSION['status'] = '<div class="card card-body alert alert-danger text-center">
            Request failed! </div>';
            // echo "<script>
            //   alert('Request failed');
            //   window.location = '".SITE_URL."/forgot-password';
            //   </script>";
        }
    }
    

}elseif (isset($_POST['verify'])) {//updates required
    trim(extract($_POST));
    if (count($errors) == 0) {
        $result = $dbh->query("SELECT * FROM users WHERE email = '$email' AND token = '$token' " );
        if ($result->rowCount() == 1) {
        $row = $result->fetch(PDO::FETCH_OBJ);
         //`userid`, `fullname`, `email`, `phone``, `role`, `token`, `status`, `date_registered`, `password`
        $_SESSION['userid'] = $row->userid;
        $_SESSION['email'] = $row->email;
        $_SESSION['phone'] = $row->phone;
        $_SESSION['status'] = $row->status;
        $_SESSION['fullname'] = $row->fullname;
        $_SESSION['role'] = $row->role;
        $_SESSION['token'] = $row->token;
        $_SESSION['date_registered'] = $row->date_registered;
        if ($result->rowCount() > 0) {
            $_SESSION['loader'] = '<center><div class="spinner-border text-success"></div></center>';
            $_SESSION['status'] = '<div class="card card-body alert alert-success text-center">
            <strong>Verification is Successful, Redirecting...</strong></div>';
            header("refresh:3; url=".SITE_URL.'/reset-password');
        }else{
            $_SESSION['status'] = '<div class="card card-body alert alert-danger text-center">
            Verification failed, enter right code</div>';
        }
    }else{
        $_SESSION['status_err'] = '<div class="card card-body alert alert-danger text-center">
                <strong>Wrong Token inserted</strong></div>';
        // echo "<script>
        //     alert('Wrong Token inserted');
        //     window.location = '".SITE_URL."/token';
        //     </script>";
    }
    }////////////////////////////////////////////////////////////////////////////////////////////

}elseif (isset($_POST['resent_token_btn'])) {
    trim(extract($_POST));
    if (count($errors) == 0) {
        $result = $dbh->query("SELECT * FROM users WHERE phone = '$phone' " );
        if ($result->rowCount() == 1) {
            $token = rand(11111,99999);
            $dbh->query("UPDATE users SET token = '$token' WHERE phone = '$phone' ");
            $rx = dbRow("SELECT * FROM users WHERE phone = '$phone' ");
            $subj = "TMS - Account Verification";
            $body = "Hello {$rx->fullname} your account verification token is: <br>
                <h1><b>{$token}</b></h1>";
            GoMail($email,$subj,$body);
            $_SESSION['email'] = $email;
            $_SESSION['status'] = '<div class="alert alert-success text-center">Verification token has been sent to your email, Please enter the code sent to your Email to complete registration process</div>';
            header("refresh:3; url=".SITE_URL.'/token');
        }else{
            $_SESSION['status'] = '<div class="card card-body alert alert-warning text-center">
            Account Verification Failed., please check your Token and try again.</div>';
        }
    }
}elseif(isset($_POST['save_new_system_user_btn'])){//to be edited
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
}elseif (isset($_POST['add_road_new_user_btn'])) {
    trim(extract($_POST));
    // `road_id`, `road_name`
    $road_name = addslashes($road_name);
    $sql = dbCreate("INSERT INTO roads VALUES(NULL, '$road_name') ");
    if ($sql ==1) {
        echo "<script>
            alert('Road Name Added successfully');
            window.location = '".HOME_URL."?roads';
            </script>";
    }else{
        echo "<script>
            alert('Adding Road Failed');
            window.location = '".HOME_URL."?roads';
            </script>";
    }

}elseif(isset($_POST['update_road_new_user_btn'])){
    trim(extract($_POST));
    if (count($errors) == 0) {
        $road_name = addslashes($road_name);
        $sql = $dbh->query("UPDATE roads SET road_name = '$road_name' WHERE road_id = '$road_id' ");
    
        if($sql){
            echo "<script>
            alert('Road Name Updated successfully');
            window.location = '".HOME_URL."?roads';
            </script>";
        }else{
           echo "<script>
            alert('Road Name Updated failed');
            window.location = '".HOME_URL."?roads';
            </script>";
        }
    }
}elseif (isset($_POST['add_user_by_admin_new_user_btn'])) {
    trim(extract($_POST));
    if (count($errors) == 0) {
        // `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered`
        $check = $dbh->query("SELECT email FROM users WHERE email='$email' ")->fetchColumn();
      if(!$check){
        $pass= sha1($password);
        $sql = "INSERT INTO users VALUES(NULL,'$fullname','$phone','$email','$pass','','admin','$dtime')";
        $result = dbCreate($sql);
        if($result == 1){
            echo "<script>
                alert('Registration is Successful');
                window.location = '".HOME_URL."?officers';
                </script>";
        }else{
            //--error , registratio failed. 
            echo "<script>
              alert('User registration failed');
              window.location = '".HOME_URL."?officers';
              </script>";
        }
     }else{
        //user already exists...
          echo "<script>
            alert('Email already registered');
            window.location = '".HOME_URL."?officers';
            </script>";
        }
    }
}elseif (isset($_POST['add_route_btn_new_user_btn'])) {
     trim(extract($_POST));
     // `rid`, `road_id`, `fromm`, `too`, `status`
    if (count($errors) == 0) {
        $fromm = addslashes($fromm);
        $too = addslashes($too);
        $sql = $dbh->query("INSERT INTO routes VALUES(NULL,'$road_id','$fromm','$too','$status') ");
        if($sql){
            echo "<script>
            alert('Road Name Updated successfully');
            window.location = '".HOME_URL."?routes';
            </script>";
        }else{
           echo "<script>
            alert('Road Name Updated failed');
            window.location = '".HOME_URL."?routes';
            </script>";
        }
    }
}elseif (isset($_POST['update_road_route_new_user_btn'])) {
    trim(extract($_POST));
    // `rid`, `road_id`, `fromm`, `too`, `status`
    if (count($errors) == 0) {
        $fromm = addslashes($fromm);
        $too = addslashes($too);
        $sql = $dbh->query("UPDATE routes SET fromm = '$fromm', too = '$too' WHERE rid = '$rid' ");
    
        if($sql){
            echo "<script>
            alert('Road Name Updated successfully');
            window.location = '".HOME_URL."?routes';
            </script>";
        }else{
           echo "<script>
            alert('Road Name Updated failed');
            window.location = '".HOME_URL."?routes';
            </script>";
        }
    }
}elseif (isset($_POST['update_user_role_new_user_btn'])) {
    trim(extract($_POST));
    // userid, role
    if (count($errors) == 0) {
        $sql = $dbh->query("UPDATE users SET role = '$role' WHERE userid = '$userid' ");
        if($sql){
            echo "<script>
            alert('User Updated successfully');
            window.location = '".HOME_URL."?users';
            </script>";
        }else{
           echo "<script>
            alert('User Update failed');
            window.location = '".HOME_URL."?users';
            </script>";
        }
    }
}

?>
