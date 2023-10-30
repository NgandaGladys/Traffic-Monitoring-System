<?php 
include 'root/config.php'; 
include 'root/process.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <!-- Bootstrap 5 CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS Link -->
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
        <section class="wrapper">
            <div class="container">
                <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3 text-center">
                    <div class="rounded bg-white shadow p-5">
                        <form method="POST" action="">
                            <a href="login" style="float: left;">←back </a>
                            <h3 class="text-dark fw-bolder fs-4 mb-2">OTP Verification</h3><br>
                            <div class="otp_input text-start mb-2">
                                <label for="digit">Enter code sent to your email address</label>
                                <div class="d-flex align-items-center justify-content-between mt-2">
                                    <input type="text" class="form-control" name="otp1" placeholder="" required maxlength="1">
                                    <input type="text" class="form-control" name="otp2" placeholder="" required maxlength="1">
                                    <input type="text" class="form-control" name="otp3" placeholder="" required maxlength="1">
                                    <input type="text" class="form-control" name="otp4" placeholder="" required maxlength="1">
                                    <input type="text" class="form-control" name="otp5" placeholder="" required maxlength="1">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary submit_btn my-4">Verify</button>
                        </form>
                        <!-- <div class="fw-normal text-muted mb-2"> -->
                        <form method="POST" action="">
                            <div class="form-group">
                                Didn't receive the code ?
                                <button type="submit" name="resend_code_btn" class="btn-sm btn-primary my-4" style="
                                    font-weight:500;background-color: white;
                                    color: blue;transition: all 200ms ease-in-out; border: none; border-radius: 10px;">Resend</button>
                            </div>
                        </form>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>