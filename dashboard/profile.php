<?php 
include '../root/config.php'; 
include '../root/process.php'; 
if (session_status() == PHP_SESSION_NONE) {
    // Start the session only if it hasn't been started already
    session_start();
}
$role = $_SESSION['role'];
$fullname   = $_SESSION['fullname'];
$phone   = $_SESSION['phone'];
$email   = $_SESSION['email'];
$location = $_SESSION['location']; 
$userid = $_SESSION['userid'];
$date_registered = $_SESSION['date_registered'];  

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
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/style.css">
    <style>
        body {
            background-image: url('../images/pexels-pixabay-210182.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        h3{
            text-align:center;
        }
        select[readonly] {
            pointer-events: none; 
            background-color: none;
            border:none;
        }
        .form-group label{
            /* text-align: center; */
            margin-top:4px;
            font-size: 18px;
            display: inline;
            border:none;
        }
        .form-group input{
            cursor: default;
            /* text-align: center; */
            margin-top:4px;
            font-size: 18px;
            display: inline;
            border:none;
        }
        .form-group input:focus {
            border-bottom:none;
            box-shadow: none;
            outline: 0;
            background-color: white;
            border-radius: none;
        }

    </style>
</head>
<body>
    <div class="overlay">
        <div class="container">
            <div class="row m-6 no-gutters">
                <div class="col-md-5 bg-white p-5" style="border-radius: 10px; border: 1px solid #ccc; display:block; margin:0 auto;">
                    <a href="javascript:history.back('dashboard')" class="text-secondary fs-3" style="text-decoration:none;"><span aria-hidden="true" >&times;</span></a>
                    <h3>User Profile</h3>
                    <div class="modal-content">
                        <form action="" method="post" enctype="multipart/form-data" class="form-style">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control" readonly name="fullname" value="Full Name: <?php echo $user['fullname']; ?>" type="text" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control" readonly name="phone" maxlength="10" value="Phone Number: <?php echo $user['phone']; ?>" type="text" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control" readonly name="email" value="Email: <?php echo $user['email']; ?>" type="email" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <!-- <select class="form-control" readonly name="location" required>
                                                <option value="A" <?php echo $user['location'] === 'A' ? 'selected' : ''; ?>>A</option>
                                                <option value="B" <?php echo $user['location'] === 'B' ? 'selected' : ''; ?>>B</option>
                                                <option value="C" <?php echo $user['location'] === 'C' ? 'selected' : ''; ?>>C</option> -->
                                            <!-- </select> -->
                                            <input class="form-control" readonly name="location" value="Location: <?php echo $user['location']; ?>" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-2">
                                    <a class="btn btn-warning w-100 font-weight-bold mt-2" href="update_profile.php" style="text-decoration:none; color:white;margin-right:45px">Update Profile</a>
                                </div>
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

