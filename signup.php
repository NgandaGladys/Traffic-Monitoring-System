<?php 
include 'root/config.php'; 
include 'root/process.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="src/style.css">
    <style type="text/css">
        body{
            background-image: url('images/pexels-pixabay-210182.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        #location {
            color: grey;
            border: 0; 
            height: 45px; 
            border-radius: 0; 
            border-bottom: 1px solid gray;
        }
        #location:focus{
            border-bottom: 1px solid gray;
            box-shadow: none;
            outline: 0;
            background-color: #ebebeb;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="overlay">
        <div class="container">
            <div class="row m-6 no-gutters">
                 <div class="col-md-2">
                     <h4></h4>
                </div>
                <div class="col-md-4 d-none d-md-block">
                    <img src="images/maxim-abramov-GFjyimhomaM-unsplash.jpg" class="img-fluid"
                        style="min-height:100%; border-radius: 10px 0 0 10px; width: 100%;height: 50px;" />
                </div>
                <div class="col-md-4 bg-white p-4" style="border-radius: 0 10px 10px 0;">
                    <h3 class="pb-3">SIGN UP</h3>
                    <div class="form-style">
                        <form method="post" action="">
                        <?php 
                        if (isset($_SESSION['status'])) {
                            echo $_SESSION['status'];
                            unset($_SESSION['status']);
                        }

                        if (isset($_SESSION['loader'])) {
                            echo $_SESSION['loader'];
                            unset($_SESSION['loader']);
                        }
                        ?>
                            <div class="form-group pb-3">
                                <input type="text" placeholder="Full Name" name="fullname" class="form-control"
                                    id="exampleInputFullName">
                                <?php 
                                    if (isset($_SESSION['fullname_err'])) {
                                        echo $_SESSION['fullname_err'];
                                        unset($_SESSION['fullname_err']);
                                    } 
                                ?>
                            </div>
                            <!-- `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered` -->
                            <div class="form-group pb-3">
                                <input type="tel" placeholder="Email Address" name="email" class="form-control"
                                    id="exampleInputPhoneNumber">
                                <?php  
                                   if (isset($_SESSION['email_err'])) {
                                        echo $_SESSION['email_err'];
                                        unset($_SESSION['email_err']);
                                    }
                                    if (isset($_SESSION['invalid_email_err'])) {
                                        echo $_SESSION['invalid_email_err'];
                                        unset($_SESSION['invalid_email_err']);
                                    } 
                                ?>
                            </div>
                            <div class="form-group pb-3">
                                <select class="form-control" id="location" name="location" required >
                                    <option value="">Select your location</option>
                                    <option>A</option>
                                    <option>B</option>
                                </select>
                            </div>
                            <div class="form-group pb-3">
                                <input type="tel" placeholder="Phone Number" name="phone" class="form-control"
                                    id="exampleInputPhoneNumber">
                                 <?php  
                                   if (isset($_SESSION['phone_err'])) {
                                        echo $_SESSION['phone_err'];
                                        unset($_SESSION['phone_err']);
                                    } ?>
                            </div>
                            <div class="form-group pb-3">
                                <input type="password" placeholder="Password" name="password" class="form-control"
                                    id="exampleInputPassword1">
                                 <?php  
                                   if (isset($_SESSION['password_err'])) {
                                        echo $_SESSION['password_err'];
                                        unset($_SESSION['password_err']);
                                    } ?>
                            </div>
                            <div class="pb-2">
                                <button type="submit" name="register_btn" class="btn btn-dark w-100 font-weight-bold mt-2">Sign up</button>
                            </div>
                        </form>
                        <div class="pt-4 text-center" style="text-align: left!important">
                            Already have an account? <a href="login">Login</a>
                        </div>
                    </div>
                </div>
                 <div class="col-md-2">
                     <h4></h4>
                </div>
            </div>
        </div>
    </div>
    <script src="https://use.fontawesome.com/f59bcd8580.js"></script>
</body>
</html>