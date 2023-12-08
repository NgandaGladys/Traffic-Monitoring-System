<?php 
include 'root/config.php'; 
include 'root/process.php';
if (empty($_SESSION['userid'])) {
    header("Location: index.html");
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
</head>
<body>
    <div class="overlay">
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