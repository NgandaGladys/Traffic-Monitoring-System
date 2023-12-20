<?php 
$errors = array();
foreach ($errors as $error) {
    echo $errors;
}
//Forms
if (isset($_POST['register_btn'])) {//signup
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
        $sql = "INSERT INTO users VALUES(NULL,'$fullname','$phone','$email','$location','$pass','','user','$dtime')";
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
    
}elseif (isset($_POST['user_login_btn'])) {//user login
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
            $result = $dbh->query("SELECT * FROM users WHERE email = '$email' AND password = '$password' And role IN ('super_admin','admin','officer','user')");
            if ($result->rowCount() == 1) {
                //getting the login users..
                $row = $result->fetch(PDO::FETCH_OBJ);
                //creating succession for a login user... 
                //getting user data...
                $_SESSION['userid'] = $row->userid;
                $_SESSION['fullname'] = $row->fullname;
                $_SESSION['phone'] = $row->phone;
                $_SESSION['email'] = $row->email;
                $_SESSION['location'] = $row->location;
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
}elseif (isset($_POST['admin_login_btn'])) {//admin login
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
            $result = $dbh->query("SELECT * FROM users WHERE email = '$email' AND password = '$password' And role IN ('super_admin','officer','admin')");
            if ($result->rowCount() == 1) {
                //getting the login users..
                $row = $result->fetch(PDO::FETCH_OBJ);
                //creating succession for a login user... 
                //getting user data...
                $_SESSION['userid'] = $row->userid;
                $_SESSION['fullname'] = $row->fullname;
                $_SESSION['phone'] = $row->phone;
                $_SESSION['email'] = $row->email;
                $_SESSION['location'] = $row->location;
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
}elseif (isset($_POST['forgot_password_btn'])) {//forgot password
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
    

}elseif (isset($_POST['verify'])) {//updates required otp 
    trim(extract($_POST));
    if (count($errors) == 0) {
        $token = $_SESSION['token'];
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

}elseif (isset($_POST['resent_token_btn'])) {//otp
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
}elseif (isset($_POST['add_road_btn'])) {//add road
    trim(extract($_POST));
    // `road_id`, `road_name`
    $road_name = addslashes($road_name);
    $sql = dbCreate("INSERT INTO roads VALUES(NULL, '$road_name','$location') ");
    if ($sql ==1) {
        echo "<script>
            alert('Road added successfully');
            window.location = '".HOME_URL."?roads';
            </script>";
    }else{
        echo "<script>
            alert('Failed to add road');
            window.location = '".HOME_URL."?roads';
            </script>";
    }

}elseif(isset($_POST['update_road_btn'])){//update road
    trim(extract($_POST));
    if (count($errors) == 0) {
        $road_name = addslashes($road_name);
        $sql = $dbh->query("UPDATE roads SET road_name = '$road_name',location = '$location' WHERE road_id = '$road_id' ");
    
        if($sql){
            echo "<script>
            alert('Road updated successfully');
            window.location = '".HOME_URL."?roads';
            </script>";
        }else{
           echo "<script>
            alert('Failed to update road');
            window.location = '".HOME_URL."?roads';
            </script>";
        }
    }
}elseif (isset($_POST['add_road_btn_one'])) {//add road
    trim(extract($_POST));
    // `road_id`, `road_name`
    $road_name = addslashes($road_name);
    $sql = dbCreate("INSERT INTO roads VALUES(NULL, '$road_name','Jinja Road Main Station') ");
    if ($sql ==1) {
        echo "<script>
            alert('Road added successfully');
            window.location = '".HOME_URL."?roads';
            </script>";
    }else{
        echo "<script>
            alert('Failed to add road');
            window.location = '".HOME_URL."?roads';
            </script>";
    }

}elseif(isset($_POST['update_road_btn_one'])){//update road
    trim(extract($_POST));
    if (count($errors) == 0) {
        $road_name = addslashes($road_name);
        $sql = $dbh->query("UPDATE roads SET road_name = '$road_name',location = 'Jinja Road Main Station' WHERE road_id = '$road_id' ");
    
        if($sql){
            echo "<script>
            alert('Road updated successfully');
            window.location = '".HOME_URL."?roads';
            </script>";
        }else{
           echo "<script>
            alert('Failed to update road');
            window.location = '".HOME_URL."?roads';
            </script>";
        }
    }
}elseif (isset($_POST['add_road_btn_two'])) {//add road
    trim(extract($_POST));
    // `road_id`, `road_name`
    $road_name = addslashes($road_name);
    $sql = dbCreate("INSERT INTO roads VALUES(NULL, '$road_name','Mukono Police Station') ");
    if ($sql ==1) {
        echo "<script>
            alert('Road added successfully');
            window.location = '".HOME_URL."?roads';
            </script>";
    }else{
        echo "<script>
            alert('Failed to add road');
            window.location = '".HOME_URL."?roads';
            </script>";
    }

}elseif(isset($_POST['update_road_btn_two'])){//update road
    trim(extract($_POST));
    if (count($errors) == 0) {
        $road_name = addslashes($road_name);
        $sql = $dbh->query("UPDATE roads SET road_name = '$road_name',location = 'Mukono Police Station' WHERE road_id = '$road_id' ");
    
        if($sql){
            echo "<script>
            alert('Road updated successfully');
            window.location = '".HOME_URL."?roads';
            </script>";
        }else{
           echo "<script>
            alert('Failed to update road');
            window.location = '".HOME_URL."?roads';
            </script>";
        }
    }
}elseif (isset($_POST['add_road_btn_three'])) {//add road
    trim(extract($_POST));
    // `road_id`, `road_name`
    $road_name = addslashes($road_name);
    $sql = dbCreate("INSERT INTO roads VALUES(NULL, '$road_name','Bweyogerere Police Station') ");
    if ($sql ==1) {
        echo "<script>
            alert('Road added successfully');
            window.location = '".HOME_URL."?roads';
            </script>";
    }else{
        echo "<script>
            alert('Failed to add road');
            window.location = '".HOME_URL."?roads';
            </script>";
    }

}elseif(isset($_POST['update_road_btn_three'])){//update road
    trim(extract($_POST));
    if (count($errors) == 0) {
        $road_name = addslashes($road_name);
        $sql = $dbh->query("UPDATE roads SET road_name = '$road_name',location = 'Bweyogerere Police Station' WHERE road_id = '$road_id' ");
    
        if($sql){
            echo "<script>
            alert('Road updated successfully');
            window.location = '".HOME_URL."?roads';
            </script>";
        }else{
           echo "<script>
            alert('Failed to update road');
            window.location = '".HOME_URL."?roads';
            </script>";
        }
    }
}elseif (isset($_POST['add_new_admin_btn'])) {//add admin
    trim(extract($_POST));
    if (count($errors) == 0) {
        // `userid`, `fullname`, `phone`, `email`,`location`, `password`, `token`, `role`, `date_registered`
        $check = $dbh->query("SELECT email FROM users WHERE email='$email' ")->fetchColumn();
      if(!$check){
        $pass= sha1($password);
        $sql = "INSERT INTO users VALUES(NULL,'$fullname','$phone','$email','$location','$pass','','admin','$dtime')";
        $result = dbCreate($sql);
        if($result == 1){
            echo "<script>
                alert('Admin added successfully');
                window.location = '".HOME_URL."?admins';
                </script>";
        }else{
            //--error , registration failed. 
            echo "<script>
              alert('Failed to add Admin');
              window.location = '".HOME_URL."?admins';
              </script>";
        }
     }else{
          echo "<script>
            alert('Admin email already registered');
            window.location = '".HOME_URL."?admins';
            </script>";
        }
    }
}elseif (isset($_POST['add_new_officer_btn'])) {//add officer
    trim(extract($_POST));
    if (count($errors) == 0) {
        // `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered`
        $check = $dbh->query("SELECT email FROM users WHERE email='$email' ")->fetchColumn();
      if(!$check){
        $pass= sha1($password);
        $sql = "INSERT INTO users VALUES(NULL,'$fullname','$phone','$email','$location','$pass','','officer','$dtime')";
        $result = dbCreate($sql);
        if($result == 1){
            echo "<script>
                alert('Officer added successfully');
                window.location = '".HOME_URL."?officers';
                </script>";
                exit;
        }else{
            //--error , registration failed. 
            echo "<script>
              alert('Failed to add Officer');
              window.location = '".HOME_URL."?officers';
              </script>";
        }
     }else{
        //user already exists...
        echo "<script>
            alert('Officer email already registered');
            window.location = '".HOME_URL."?officers';
            </script>";
        }
    }
}elseif (isset($_POST['add_new_officer_btn_one'])) {//add officer
    trim(extract($_POST));
    if (count($errors) == 0) {///
        // `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered`
        $check = $dbh->query("SELECT email FROM users WHERE email='$email' ")->fetchColumn();
      if(!$check){
        $pass= sha1($password);
        $sql = "INSERT INTO users VALUES(NULL,'$fullname','$phone','$email','Jinja Road Main Station','$pass','','officer','$dtime')";
        $result = dbCreate($sql);
        if($result == 1){
            echo "<script>
                alert('Officer added successfully');
                window.location = '".HOME_URL."?officers';
                </script>";
                exit;
        }else{
            //--error , registration failed. 
            echo "<script>
              alert('Failed to add Officer');
              window.location = '".HOME_URL."?officers';
              </script>";
        }
     }else{
        //user already exists...
        echo "<script>
            alert('Officer email already registered');
            window.location = '".HOME_URL."?officers';
            </script>";
        }
    }
}elseif (isset($_POST['add_new_officer_btn_two'])) {//add officer
    trim(extract($_POST));
    if (count($errors) == 0) {
        // `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered`
        $check = $dbh->query("SELECT email FROM users WHERE email='$email' ")->fetchColumn();
      if(!$check){
        $pass= sha1($password);
        $sql = "INSERT INTO users VALUES(NULL,'$fullname','$phone','$email','Mukono Police Station','$pass','','officer','$dtime')";
        $result = dbCreate($sql);
        if($result == 1){
            echo "<script>
                alert('Officer added successfully');
                window.location = '".HOME_URL."?officers';
                </script>";
                exit;
        }else{
            //--error , registration failed. 
            echo "<script>
              alert('Failed to add Officer');
              window.location = '".HOME_URL."?officers';
              </script>";
        }
     }else{
        //user already exists...
        echo "<script>
            alert('Officer email already registered');
            window.location = '".HOME_URL."?officers';
            </script>";
        }
    }
}elseif (isset($_POST['add_new_officer_btn_three'])) {//add officer
    trim(extract($_POST));
    if (count($errors) == 0) {
        // `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered`
        $check = $dbh->query("SELECT email FROM users WHERE email='$email' ")->fetchColumn();
      if(!$check){
        $pass= sha1($password);
        $sql = "INSERT INTO users VALUES(NULL,'$fullname','$phone','$email','Bweyogerere Police Station','$pass','','officer','$dtime')";
        $result = dbCreate($sql);
        if($result == 1){
            echo "<script>
                alert('Officer added successfully');
                window.location = '".HOME_URL."?officers';
                </script>";
                exit;
        }else{
            //--error , registration failed. 
            echo "<script>
              alert('Failed to add Officer');
              window.location = '".HOME_URL."?officers';
              </script>";
        }
     }else{
        //user already exists...
        echo "<script>
            alert('Officer email already registered');
            window.location = '".HOME_URL."?officers';
            </script>";
        }
    }
}elseif (isset($_POST['add_route_btn'])) {//add route
     trim(extract($_POST));
     // `rid`, `road_id`, `fromm`, `too`, `status`
    if (count($errors) == 0) {
        $fromm = addslashes($fromm);
        $too = addslashes($too);
        $sql = $dbh->query("INSERT INTO traffic_points VALUES(NULL,'$road_id','$fromm','$too','$status') ");
        if($sql){
            echo "<script>
            alert('Traffic point added successfully');
            window.location = '".HOME_URL."?traffic_points';
            </script>";
        }else{
           echo "<script>
            alert('Failed to add traffic point');
            window.location = '".HOME_URL."?traffic_points';
            </script>";
        }
    }
}elseif (isset($_POST['update_route_btn'])) {//update route
    trim(extract($_POST));
    // `rid`, `road_id`, `fromm`, `too`, `status`
    if (count($errors) == 0) {
        $fromm = addslashes($fromm);
        $too = addslashes($too);
        $sql = $dbh->query("UPDATE traffic_points SET fromm = '$fromm', too = '$too', status = '$status' WHERE rid = '$rid' ");
    
        if($sql){
           echo "<script>
            alert('Traffic point updated successfully');
            window.location = '".HOME_URL."?traffic_points';
            </script>";
        }else{
           echo "<script>
            alert('Failed to update traffic point');
            window.location = '".HOME_URL."?traffic_points';
            </script>";
        }
    }
}elseif (isset($_POST['update_admin_details_btn'])) {//update admin
    trim(extract($_POST));
    // userid, role
    if (count($errors) == 0) {
        $pass= sha1($password);
        $sql = $dbh->query("UPDATE users SET fullname ='$fullname',phone ='$phone',email ='$email',location='$location' ,password ='$pass',role = 'admin' WHERE userid = '$userid' ");
        if($sql){
            echo "<script>
            alert('Admin details updated successfully');
            window.location = '".HOME_URL."?admins';
            </script>";
        }else{
           echo "<script>
            alert('Failed to update admin details');
            window.location = '".HOME_URL."?admins';
            </script>";
        }
    }
}elseif (isset($_POST['update_officer_details_btn'])) {//update officer
    trim(extract($_POST));
    // userid, role
    if (count($errors) == 0) {
        $pass= sha1($password);
        $sql = $dbh->query("UPDATE users SET fullname ='$fullname',phone ='$phone',email ='$email',location ='$location',password ='$pass',role = 'officer' WHERE userid = '$userid' ");
        if($sql){
            echo "<script>
            alert('Officer details updated successfully');
            window.location = '".HOME_URL."?officers';
            </script>";
        }else{
           echo "<script>
            alert('Failed to update officer details');
            window.location = '".HOME_URL."?officers';
            </script>";
        }
    }
}elseif (isset($_POST['update_officer_details_btn_one'])) {//update officer
    trim(extract($_POST));
    // userid, role
    if (count($errors) == 0) {
        $pass= sha1($password);
        $sql = $dbh->query("UPDATE users SET fullname ='$fullname',phone ='$phone',email ='$email',location ='Jinja Road Main Station',password ='$pass',role = 'officer' WHERE userid = '$userid' ");
        if($sql){
            echo "<script>
            alert('Officer details updated successfully');
            window.location = '".HOME_URL."?officers';
            </script>";
        }else{
           echo "<script>
            alert('Failed to update officer details');
            window.location = '".HOME_URL."?officers';
            </script>";
        }
    }
}elseif (isset($_POST['update_officer_details_btn_two'])) {//update officer
    trim(extract($_POST));
    // userid, role
    if (count($errors) == 0) {
        $pass= sha1($password);
        $sql = $dbh->query("UPDATE users SET fullname ='$fullname',phone ='$phone',email ='$email',location ='Mukono Police Station',password ='$pass',role = 'officer' WHERE userid = '$userid' ");
        if($sql){
            echo "<script>
            alert('Officer details updated successfully');
            window.location = '".HOME_URL."?officers';
            </script>";
        }else{
           echo "<script>
            alert('Failed to update officer details');
            window.location = '".HOME_URL."?officers';
            </script>";
        }
    }
}elseif (isset($_POST['update_officer_details_btn_three'])) {//update officer
    trim(extract($_POST));
    // userid, role
    if (count($errors) == 0) {
        $pass= sha1($password);
        $sql = $dbh->query("UPDATE users SET fullname ='$fullname',phone ='$phone',email ='$email',location ='Bweyogerere Police Station',password ='$pass',role = 'officer' WHERE userid = '$userid' ");
        if($sql){
            echo "<script>
            alert('Officer details updated successfully');
            window.location = '".HOME_URL."?officers';
            </script>";
        }else{
           echo "<script>
            alert('Failed to update officer details');
            window.location = '".HOME_URL."?officers';
            </script>";
        }
    }
}elseif (isset($_POST['update_user_details_btn'])) {//update user details
    trim(extract($_POST));
    // userid, role
    if (count($errors) == 0) {
        $pass= sha1($password);
        $sql = $dbh->query("UPDATE users SET fullname ='$fullname',phone ='$phone',email ='$email',location ='$location',password ='$pass' WHERE email = '$email' ");
        if($sql){
            echo "<script>
            alert('Profile updated successfully');
            window.location = '".SITE_URL."';
            </script>";
        }else{
           echo "<script>
            alert('Failed to update profile');
            window.location = '".SITE_URL."';
            </script>";
        }
    }
}

?>
