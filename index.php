<?php 
include 'root/config.php'; 
include 'root/process.php';
if (empty($_SESSION['userid'])) {
    header("Location: login");
}else{
    // `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered`
    $role = $_SESSION['role'];
    $fullname   = $_SESSION['fullname'];
    $phone   = $_SESSION['phone'];
    $email   = $_SESSION['email'];
    $userid = $_SESSION['userid'];
    $date_registered = $_SESSION['date_registered'];
    header("refresh:1; url=".HOME_URL);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
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
            <div class="row m-5 no-gutters" >
                <div class="col-md-12 bg-white p-5" style="border-radius: 0 10px 10px 0;">
                    <div class="form-style">
                        <center>
                            <div class="spinner-border text-dark"></div>
                            <p>Re-directing to Dashboard....</p>     
                        </center>               
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://use.fontawesome.com/f59bcd8580.js"></script>
</body>
</html>