<?php 
include 'yoolasmsapi.php';

$errors = array();
foreach ($errors as $error) {
    echo $errors;
}

if (isset($_POST['login_btn'])) {
    trim(extract($_POST));
    if (count($errors) == 0) {
    $password = sha1($password);
    $result = $dbh->query("SELECT * FROM users WHERE phone = '$phone' AND password = '$password' AND status = 'Approved' ");
    $result2 = $dbh->query("SELECT * FROM users WHERE phone = '$phone' AND password = '$password' AND status = 'Pending' ");
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
        }elseif ($result->rowCount() == 1) {
            $_SESSION['status_err'] = '<div class=" card card-body alert alert-danger text-center">
            Account under Preview!. Contact System Admin</div>';
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

}
elseif (isset($_POST['make_a_milk_sale_by_milk_attendant'])) {
    trim(extract($_POST));
    $quantity = $dbh->query("SELECT quantity FROM store WHERE pid=10 ")->fetchColumn();
    if ($quantity < $liters) {
        $_SESSION['status'] = '<div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed!</strong> You have only '.$quantity.' liters in store.
      </div>';
      redirect_page(SITE_URL.'/milk-sale');
    }
    $price = $dbh->query("SELECT buying_price FROM milk_customer WHERE id = '$customer_id' ")->fetchColumn();
    $amount_to_pay = $price * $liters;
    $_SESSION['amount_to_pay'] = $amount_to_pay;
    $_SESSION['liters'] = $liters;
    $_SESSION['price_each'] = $price;
    $_SESSION['customer_id'] = $customer_id;
    redirect_page(SITE_URL.'/milk-sale-preview');
}elseif (isset($_POST['save_new_milk_customer_btn'])) {
    trim(extract($_POST));
    // `milk_id`, `milk_supplier_id`, `milk_quantity`, `milk_price`, `milk_date_added`
    $sql = dbCreate("INSERT INTO `milk_customer`(`id`, `name`, `phone`, `buying_price`) VALUES (NULL, '$name', '$phone', '$price') ");
    if ($sql) {
        $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Milk Customer Recorded Successfully.
      </div>';
    }else{
        echo "<script>
            alert('Milk Customer Add Failed');
            window.location = '".SITE_URL."/milk-inventory';
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

}elseif (isset($_POST['submit_rooms_details_btn'])) {
   trim(extract($_POST));
    //`room_id`, `rtid`, `room_number`, `room_pic`, `room_status`
     $filename = trim($_FILES['room_pic']['name']);
     $chk = rand(1111111111111,9999999999999);
     $ext = strrchr($filename, ".");
     $room_pic = $chk.$ext;
     $target_img = "uploads/".$room_pic;
     $url = SITE_URL.'/uploads/'.$room_pic;
    $result = dbCreate("INSERT INTO rooms VALUES(NULL,'$rtid','$room_number','$url','Available')");
     if (move_uploaded_file($_FILES['room_pic']['tmp_name'], $target_img)) {
          $msg ="Image uploaded Successfully";
          }else{
            $msg ="There was a problem uploading image";
          }
        if($result == 1){
            $_SESSION['room_status'] = '<div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong>Room Details Updated Successfully.
            </div>';
            header("Location: ".SITE_URL."/banners");
        }else{
            $_SESSION['room_status'] = '<div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Failed!</strong>Room Upload Failed.
            </div>';
        }
}elseif (isset($_POST['update_rooms_details_btn'])) {
    trim(extract($_POST));
    // `room_id`, `rtid`, `room_number`, `room_pic`, `room_status`
    $sql = $dbh->query("UPDATE rooms SET room_number = '$room_number', room_status = '$room_status' WHERE room_id = '$room_id' ");
    if ($sql) {
        echo "<script>
            alert('Room Updated Successful');
            window.location = '".SITE_URL."/rooms';
            </script>";
    }else{
        echo "<script>
            alert('Room Update Failed');
            window.location = '".SITE_URL."/rooms';
            </script>";
    }
}elseif (isset($_POST['save_new_book_shop_btn'])) {
    trim(extract($_POST));
    //`bs_id`, `bs_name`
     $bs_name = addslashes($bs_name);
    $chk = $dbh->query("SELECT bs_name FROM book_shops WHERE (bs_name='$bs_name' ) ")->fetchColumn();
    if(!$chk){
        $result = dbCreate("INSERT INTO book_shops VALUES(NULL,'$bs_name')");
        if($result == 1){
            $_SESSION['book_shop_status'] = '<div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong>Book Shop Name Added Successfully.
            </div>';
            header("refresh:3;url=".SITE_URL."/book-shops");
            }else{
                $_SESSION['book_shop_status'] = '<div class="alert alert-dark alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Error!</strong>Error while adding new book shop.
                </div>';
            }
        }else{
            $_SESSION['book_shop_status'] = '<div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Warning!</strong>This Book Shop already Exists.
            </div>';
        }
}elseif (isset($_POST['update_room_type_details_btn'])) {
    trim(extract($_POST));
    // `rtid`, `rt_price`, `discount`
    $sql = $dbh->query("UPDATE room_types SET rt_price = '$rt_price', discount = '$discount' WHERE rtid = '$rtid' ");
    if ($sql) {
        echo "<script>
            alert('Room Type Updated Successful');
            window.location = '".SITE_URL."/room-types';
            </script>";
    }else{
        echo "<script>
            alert('Room Type Update Failed');
            window.location = '".SITE_URL."/room-types';
            </script>";
    }
}elseif (isset($_POST['save_new_book_category_btn'])) {
    trim(extract($_POST));
    //`cat_id`, `cat_name`
     $cat_name = addslashes($cat_name);
    $chk = $dbh->query("SELECT cat_name FROM book_categories WHERE (cat_name='$cat_name' ) ")->fetchColumn();
    if(!$chk){
        $result = dbCreate("INSERT INTO book_categories VALUES(NULL,'$cat_name')");
        if($result == 1){
            $_SESSION['book_shop_status'] = '<div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong>Book Category Added Successfully.
            </div>';
            header("refresh:3;url=".SITE_URL."/category");
            }else{
                $_SESSION['book_shop_status'] = '<div class="alert alert-dark alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Error!</strong>Error while adding new book Category.
                </div>';
            }
        }else{
            $_SESSION['book_shop_status'] = '<div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Warning!</strong>This Book Category already Exists.
            </div>';
        }
}elseif (isset($_POST['submit_Stock_btn'])) {
    trim(extract($_POST));
    $check = $dbh->query("SELECT product_name FROM products WHERE product_name='$product_name' ")->fetchColumn();
    if(!$check){
        // $stock_date_added = time();
        $userid = $_SESSION['userid'];
        $result = dbCreate("INSERT INTO products(`pid`, `barcode`, `product_name`, `category_of_user`,`cost_price`, `selling_price`, `qty`, `stock_added_by`, `stock_date_added`) 
            VALUES(NULL, '$code', '$product_name', '$category_of_user', '$cost_price','$selling_price',1,'$userid','$today')" );
        if($result == 1){
            $id = $dbh->query("SELECT pid FROM products ORDER BY pid DESC LIMIT 1")->fetchColumn();
            $dbh->query("INSERT INTO store VALUES('','$id','$qty')");
            if ($category_of_user == 'bakery') {
                $dbh->query("INSERT INTO `bakery_inventory`(`item_id`, `item_name`, `quantity`, `price_each`, `date`) VALUES ('$id', '$product_name', '$qty', '$cost_price', '$today')");
            }
            echo "<script>
            alert('Stock added successfuly');
            window.location = 'stock';
            </script>";
        }else{
            echo "<script>
            alert('Stock registration failed. ');
            // window.location = 'stock';
            </script>";
        }
    }else{
        echo "<script>
            alert('This stock is already added... Try adding another stock');
            window.location = 'manage-stock';
            </script>";
    }

}elseif (isset($_POST['update_stock'])) {
   trim(extract($_POST));
      //`pid`, `product_name`, `cost_price`, `selling_price`, `qty`, `stock_added_by`, `stock_date_added`
      $result = dbCreate("UPDATE products SET barcode='$code', cost_price='$cost_price', selling_price = '$selling_price', product_name = '$productname' WHERE pid='$pid' ");
      if($result == 1){
         echo "<script>
        alert('Product updated successfully');
        window.location = '".SITE_URL."/stock';
        </script>";
      }else{
        echo "<script>
        alert('Product updated failed');
        window.location = '".SITE_URL."/stock';
        </script>";
    }
}elseif(isset($_POST['add_stock'])){
    trim(extract($_POST));
    $old_qty = $dbh->query("SELECT quantity FROM store WHERE pid='$identity' ")->fetchColumn();
    if($action == 'add'){
        $new_qty = ($old_qty + $quantity);
        if($action == 'add'){
            if ($category_of_user == 'bakery') {
                $product_name = $dbh->query("SELECT product_name FROM products WHERE pid='$identity'")->fetchColumn();
                $cost_price = $dbh->query("SELECT cost_price FROM products WHERE pid='$identity'")->fetchColumn();
                $dbh->query("INSERT INTO `bakery_inventory`(`item_id`, `item_name`, `quantity`, `price_each`, `date`) VALUES ('$identity', '$product_name', '$quantity', '$cost_price', '$today')");
            }
    }
    }else{
        $new_qty = ($old_qty - $quantity);
    }
    if($new_qty >= 0){
        $dbh->query("UPDATE store SET quantity='$new_qty' WHERE pid='$identity' ");
        redirect_page(SITE_URL.'/stock');
    }else{
        echo "<script>
        alert('Quantity can not be negative, please check the quantity or action');
        window.location = '".SITE_URL."/stock';
        </script>";
    }
}elseif (isset($_POST['confirm_milk_inventory_edit'])) {
    trim(extract($_POST));
    $old_liters = $dbh->query("SELECT liters FROM milk_inventory WHERE milk_supplier_id='$supllier_id' AND date_time='$date_time' LIMIT 1")->fetchColumn();

    if($new_quantity >= -1){
        $dbh->query("UPDATE milk_inventory SET liters='$new_quantity' WHERE milk_supplier_id='$supllier_id' AND date_time='$date_time' ");
        $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> Liter details Updated Successfully.
        </div>';
        redirect_page(SITE_URL.'/milk-inventory');
    }else{
        echo "<script>
        alert('Liters can not be negative, please check');
        window.location = '".SITE_URL."/milk-inventory';
        </script>";
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
            // 0773325394 - nakayima
    }
}elseif (isset($_POST['make_payments_btn'])) {
    trim(extract($_POST));
    //`phid`, `loan_id`, `cid`, `userid`, `deposit`, `date_paid`
    $check = $dbh->query("SELECT cid, date_paid FROM payment_history WHERE (cid='$cid' AND date_paid = '$today' ) ")->fetchColumn();
    if(!$check){
    $sql = dbCreate("INSERT INTO payment_history VALUES(NULL,'$loan_id', '$cid', '$userid', '$deposit', '$today') "); 
    }else{
        echo "<script>
        alert('You have already Paid Loan today.!');
        // window.location = '".SITE_URL."?save';
        </script>";
    }
}elseif (isset($_POST['saving_type_btn'])) {
    trim(extract($_POST));
    //`saving_type_id`, `saving_type`
    $check = $dbh->query("SELECT * FROM saving_type WHERE saving_type = '$saving_type' ")->fetchColumn(); 
    if(!$check){
    $result = $dbh->query("INSERT INTO saving_type VALUES(NULL,'$saving_type') ");
        if($result){
            echo "<script>
            alert('Saving Type details added Successfully');
            window.location = '".SITE_URL."?save';
            </script>";
        }else{
            echo "<script>
            alert('Saving Error');
            window.location = '".SITE_URL."?save';
            </script>";
        }
    }else{
        echo "<script>
        alert('This client have got active saving !, First close his/her savings.');
        window.location = '".SITE_URL."?save';
        </script>";
    }
}elseif (isset($_POST['save_history_btn_btn'])) {
    
}elseif (isset($_POST['save_history_btn'])) {
    trim(extract($_POST));
    $update_savings = $dbh->query("UPDATE savings SET saving_amount = saving_amount + '$amount' WHERE saving_clients_id = '$saving_clients_id' ");
    if ($update_savings) {
        //`shid`, `saving_clients_id`, `amount`, `date_saved`
        $dbh->query("INSERT INTO saving_history VALUES(NULL,'$saving_clients_id','$amount','$today') ");
        $ro = dbRow("SELECT * FROM saving_clients WHERE saving_clients_id = '$saving_clients_id' ");
    // `saving_clients_id`, `saving_type_id`, `firstname`, `lastname`, `photo`, `gender`, `phone`, `location`, `account_number`, `f_member_name`, `f_member_gender`, `f_memeber_phone`, `gmemeber2_name`, `gmemeber2_phone`, `gmemeber2_gender`, `gmemeber2_photo`, `gmemeber3_name`, `gmemeber3_phone`, `gmemeber3_gender`, `gmemeber3_photo`
        $bo = dbRow("SELECT SUM(saving_amount) AS 'SavingAmount', saving_clients_id FROM savings WHERE saving_clients_id = '$saving_clients_id' ");
        $message = "Hi ".ucwords($ro->firstname).', Your Saving of ugx. '. $amount.' recieved. New Saving Balc ugx.'.$bo->SavingAmount;
        $nums = array("+256".$ro->phone);
        // $nums = array("+256782507087");
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
        alert('Savings added is Successful');
        window.location = '".SITE_URL."?sav='".base64_encode($saving_clients_id)."';
        </script>";
    }
}elseif (isset($_POST['witdraw_amount_btn'])) {
    trim(extract($_POST));
    //`withdraw_id`, `saving_clients_id`, `witdraw_amount`, `withdraw_date`
    $qu = dbRow("SELECT * FROM savings WHERE saving_clients_id = '$saving_clients_id' ");
    if ($qu->saving_amount > $witdraw_amount) {
        $sql = $dbh->query("INSERT INTO widthdraws VALUES(NULL,'$saving_clients_id', '$witdraw_amount','$today') ");
        if ($sql) {
            $baal = $dbh->query("UPDATE savings SET saving_amount = saving_amount - '$witdraw_amount' WHERE saving_clients_id = '$saving_clients_id' ");
            $ro = dbRow("SELECT * FROM saving_clients WHERE saving_clients_id = '$saving_clients_id' ");
            $blc = dbRow("SELECT * FROM savings WHERE saving_clients_id = '$saving_clients_id' ");
            $message = "Hi ".ucwords($ro->firstname).', Your Withdraw confirmation of ugx. '. $witdraw_amount.' New Balc.'.$blc->saving_amount;
            $nums = array("+256".$ro->phone);
            // $nums = array("+256782507087");
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
            alert('Withdraw request initiated Successfully');
            window.location = '".SITE_URL."?savings';
            </script>";
        }
    }else{
        echo "<script>
            alert('Oops !!!, you dont have enough money to Withdraw. ');
            window.location = '".SITE_URL."?savings';
            </script>";
    }
}elseif (isset($_POST['save_client_form_btn'])) {
    trim(extract($_POST));
    if (($saving_type_id == 1) || ($saving_type_id ==2)) {
        $sql = $dbh->query("INSERT INTO saving_clients(`saving_clients_id`, `saving_type_id`, `firstname`, `lastname`, `photo`, `gender`, `phone`, `location`, `account_number`, `f_member_name`, `f_member_gender`, `f_memeber_phone`, `gmemeber2_name`, `gmemeber2_phone`, `gmemeber2_gender`, `gmemeber2_photo`, `gmemeber3_name`, `gmemeber3_phone`, `gmemeber3_gender`, `gmemeber3_photo`) VALUES(NULL,'$saving_type_id','$firstname','$lastname','','$gender','$phone','$location','$account_number','$f_member_name','$f_member_gender','$f_memeber_phone','','','','','','','','') ");
        if ($sql) {
            // `saving_id`, `userid`, `saving_clients_id`, `saving_amount`, `saving_interest`, `barcode`, `saving_status`, `saving_date`
            $last_id = $dbh->lastInsertId();
            $userid = $_SESSION['userid'];
            $barcode = mt_rand();
            $dbh->query("INSERT INTO  savings VALUES(NULL,'$userid','$last_id',0,5,'$barcode','Approved','$today') ");
            $account = dbRow("SELECT * FROM saving_type WHERE saving_type_id = '$saving_type_id' ");
        $message = "Hi ".ucwords($firstname).', Your have opened up a '.$account->saving_type.' Saving Account with GREMBASI Inv. LTD . ';
        $nums = array("+256".$phone);
        // $nums = array("+256782507087");
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
        alert('Client Savings details added Successfully');
        window.location = '".SITE_URL."?save';
        </script>";
        }
    }elseif ($saving_type_id == 3) {
        $sql = $dbh->query("INSERT INTO saving_clients(`saving_clients_id`, `saving_type_id`, `firstname`, `lastname`, `photo`, `gender`, `phone`, `location`, `account_number`, `f_member_name`, `f_member_gender`, `f_memeber_phone`, `gmemeber2_name`, `gmemeber2_phone`, `gmemeber2_gender`, `gmemeber2_photo`, `gmemeber3_name`, `gmemeber3_phone`, `gmemeber3_gender`, `gmemeber3_photo`) VALUES(NULL,'$saving_type_id','$firstname','$lastname','','$gender','$phone','$location','$account_number','','','','$gmemeber2_name','$gmemeber2_phone','$gmemeber2_gender','','$gmemeber3_name','$gmemeber3_phone','$gmemeber3_gender','') ");

        if ($sql) {
            // `saving_id`, `userid`, `saving_clients_id`, `saving_amount`, `saving_interest`, `barcode`, `saving_status`, `saving_date`
            $last_id = $dbh->lastInsertId();
            $userid = $_SESSION['userid'];
            $barcode = mt_rand();
            $dbh->query("INSERT INTO  savings VALUES(NULL,'$userid','$last_id',0,5,'$barcode','Approved','$today') ");
            $account = dbRow("SELECT * FROM saving_type WHERE saving_type_id = '$saving_type_id' ");
            $message = "Hi ".ucwords($firstname).', Your have opened up a '.$account->saving_type.' Saving Account with GREMBASI Inv. LTD . ';
            $nums = array("+256".$phone, "+256".$gmemeber2_phone, "+256".$gmemeber3_phone);
            // $nums = array("+256782507087");
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
        alert('Client Savings details added Successfully');
        window.location = '".SITE_URL."?save';
        </script>";
        }
    }
}elseif (isset($_REQUEST['delete-loan-client'])) {
    $id = base64_decode($_GET['delete-loan-client']);
    $sql = $dbh->query("DELETE FROM clients WHERE cid = '$id' ");
    if ($sql) {
        echo "<script>
        alert('Money Lending client deleted successfully');
        window.location = '".SITE_URL."?clients';
        </script>";
    }
}elseif (isset($_REQUEST['delete-country'])) {
    $id = base64_decode($_GET['delete-country']);
    $sql = $dbh->query("DELETE FROM countries WHERE country_id = '$id' ");
    if ($sql) {
        echo "<script>
        alert('Country Details deleted successfully');
        window.location = '".SITE_URL."?countries';
        </script>";
    }
}elseif (isset($_REQUEST['delete-branch'])) {
    $id = base64_decode($_GET['delete-branch']);
    $sql = $dbh->query("DELETE FROM branch WHERE branch_id = '$id' ");
    if ($sql) {
        echo "<script>
        alert('Branch Details deleted successfully');
        window.location = '".SITE_URL."?branches';
        </script>";
    }
}elseif (isset($_POST['send_sms_btn'])) {
    trim(extract($_POST));
    $user = dbRow("SELECT * FROM clients WHERE cid = '$cid' ");
    $pah = dbRow("SELECT * FROM payment_history WHERE cid = '$cid' ORDER BY phid DESC ");
    //calculate days without paying....
    $from=date_create(date($today));
    $to=date_create($pah->date_paid);
    $diff=date_diff($to,$from);
    //print_r($diff);
    //echo $diff->format('%R%a days');
    // $start = strtotime($today);
    // $end = strtotime($pah->date_paid);
    // $days_between = ceil(abs($end - $start) / 86400);
    $message = "Hi ".ucwords($user->fname).', Your have taken '.$diff->format('%R%a days').' days without paying your Loan.Kindly pay your Loan Now';
            $nums = array("+256".$user->cphone);
            // $nums = array("+256782507087");
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
        alert('Message sent successfully');
        window.location = '".SITE_URL."?defaulters';
        </script>";
}elseif (isset($_POST['fine_send_sms_btn'])) {
    trim(extract($_POST));
    $user = dbRow("SELECT * FROM clients WHERE cid = '$cid' ");
    $pah = dbRow("SELECT * FROM payment_history WHERE cid = '$cid' ORDER BY phid DESC ");
    $dbh->query("UPDATE loans SET loan_amount = loan_amount + 10000 WHERE cid = '$cid' ");
    //calculate days without paying....
    $from=date_create(date($today));
    $to=date_create($pah->date_paid);
    $diff=date_diff($to,$from);
    //print_r($diff);
    //echo $diff->format('%R%a days');
    // $start = strtotime($today);
    // $end = strtotime($pah->date_paid);
    // $days_between = ceil(abs($end - $start) / 86400);
    $message = "Hi ".ucwords($user->fname).', Your have taken '.$diff->format('%R%a days').' days without paying your Loan.You have additional charge Ugx. 10,000';
            $nums = array("+256".$user->cphone);
            // $nums = array("+256782507087");
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
        alert('Message sent successfully');
        window.location = '".SITE_URL."?defaulters';
        </script>";
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
