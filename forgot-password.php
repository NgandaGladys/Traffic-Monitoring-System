<?php 
include 'root/config.php'; 
include 'root/process.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="src/style.css">
    <style type="text/css">
        body{
            background-image: url('images/pexels-pixabay-210182.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <div class="overlay">
        <div class="container">
            <div class="row m-5 no-gutters shadow-lg">
                <div class="col-md-6 d-none d-md-block">
                    <img src="images/maxim-abramov-GFjyimhomaM-unsplash.jpg" class="img-fluid"
                        style="min-height:100%; border-radius: 10px 0 0 10px; width: 100%;height: 50px;" />
                </div>
                <div class="col-md-6 bg-white p-5" style="border-radius: 0 10px 10px 0;">
                    <h3 class="pb-3">Forgot Password</h3>
                    <p>Enter your Email Address to reset password</p>
                    <div class="form-style">
                        <form method="post" action="">
                            <div class="form-group pb-3">
                                <input type="tel" placeholder="Email Address" name="email" class="form-control"
                                    id="exampleInputPhoneNumber" required>
                            </div>
                            <div class="pb-2">
                                <button type="submit" name="forgot_password_btn" class="btn btn-dark w-100 font-weight-bold mt-2">Continue</button>
                            </div>
                        </form>
                        <div class="pt-4 text-center" style="text-align: left!important">
                            Already have an account. <a href="login">Login</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://use.fontawesome.com/f59bcd8580.js"></script>
</body>

</html>