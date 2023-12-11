<?php 
include '../root/config.php'; 
include '../root/process.php'; 
if (session_status() == PHP_SESSION_NONE) {
    // Start the session only if it hasn't been started already
    session_start();
}

$email = $_SESSION['email']; // Adjust this based on your actual session variable

$stmt = $dbh->prepare("SELECT * FROM users WHERE email= :email");
$stmt->bindParam(':email', $email);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/style.css">
    <style type="text/css">
        body{
            background-image: url('../images/pexels-pixabay-210182.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        h3 {
           text-align:center;
        }
        .form p {
            font-weight:normal;
            color: black;
            font-size:18px;
            line-height: 20px;
        }
        .form #s1{
            margin-left:65px;
        }
        .form #s2{
            margin-left:72px;
        }
        .form #s3{
            margin-left:47px;
        }
        .form #s4{
            margin-left:67px;
        }
    </style>
</head>

<body>
    <div class="overlay">
        <div class="container">
            <div class="row m-5 no-gutters">
                <div class="col-md-6 bg-white p-5" style="border-radius: 10px; border: 1px solid #ccc; display:block; margin:0 auto;">
                    <h3 class="pb-3">User Profile</h3>
                    <div class="form-style form">
                        <form method="post" action="">
                            <div class="form-group pb-3">
                                <p>Name: <span id="s1"><?php echo $user['fullname']; ?></span></p>
                            </div>
                            <div class="form-group pb-3">
                                <p>Email: <span id="s2"><?php echo $user['email']; ?></span></p>
                            </div>
                            <div class="form-group pb-3">
                                <p>Location: <span id="s3"><?php echo $user['location']; ?></span></p>
                            </div>
                            <div class="form-group pb-3">
                                <p>Phone: <span id="s4"><?php echo $user['phone']; ?></span></p>
                            </div>
                            <div class="pb-2">
                                <a class="btn btn-warning w-100 font-weight-bold mt-2" href="update_profile.php" style="text-decoration:none; color:white;">Update Profile</a>
                                <!-- <a href="login"><button class="btn btn-dark w-100 font-weight-bold mt-2">Update Profile</button></a> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://use.fontawesome.com/f59bcd8580.js"></script>
</body>
</html>