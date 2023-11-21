<?php 
include 'root/config.php'; 
include 'root/process.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="src/style.css">
    <style type="text/css">
        body{
            background-image: url('images/pexels-pixabay-210182.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .nav-item{
            justify-content: space-around;
            padding: 0 10px 0 0;
        }
        .nav-link{
            color:white;
        }
        .nav-link:hover{
            color:#ff9c02;
        }
        .navbar-nav .nav-link.active, .navbar-nav .show>.nav-link {
            color: #ff9c02;
            margin-right:920px ;
        }
    </style>
</head>

<body>
    <div class="overlay">
        <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-body fixed-top" data-bs-theme="dark">
            <div class="container-fluid">
                <div class="collapse navbar-collapse navbar-brand" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-6">
                    <li class="nav-item">
                    <a class="nav-link active " aria-current="page" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="signup">User signup</a>
                    </li>
                    <li class="nav-item ">
                    <a class="nav-link" href="login" role="button">
                       User login
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link " href="login_admin">Admin Login</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row m-5 no-gutters shadow-lg">
                <div class="col-md-2">
                    <h4></h4>
                </div>
                <div class="col-md-4 d-none d-md-block">
                    <img src="images/maxim-abramov-GFjyimhomaM-unsplash.jpg" class="img-fluid"
                        style="min-height:100%; border-radius: 10px 0 0 10px; width: 100%;height: 50px;" />
                </div>
                <div class="col-md-4 bg-white p-5" style="border-radius: 0 10px 10px 0;">
                    <h3 class="pb-3">Reset Password</h3>
                    <div class="form-style">
                        <form method="post" action="">
                            <div class="form-group pb-3">
                                <input type="password" placeholder="New Password" class="form-control"
                                    id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group pb-3">
                                <input type="password" placeholder="Confirm Password" class="form-control"
                                    id="exampleInputPassword1" required>
                            </div>
                            <div class="pb-2">
                                <button type="reset" class="btn btn-dark w-100 font-weight-bold mt-2">Reset</button>
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