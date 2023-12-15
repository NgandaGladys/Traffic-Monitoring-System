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
    <title>Update Profile</title>
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
            background-color: #eee; 
        }

        .form-group label{
            margin-top:4px;
            font-size: 16px;
        }

    </style>
</head>
<body>
    <div class="overlay">
        <div class="container">
            <div class="row m-6 no-gutters">
                <div class="col-md-5 bg-white p-4" style="border-radius: 10px; border: 1px solid #ccc; display:block; margin:0 auto;">
                    <a href="javascript:history.back('profile.php')" class="text-secondary fs-3" style="text-decoration:none;"><span aria-hidden="true" >&times;</span></a>    
                    <h3>Update User Profile</h3>
                    <div class="modal-content">
                        <form action="" method="post" enctype="multipart/form-data" class="form-style">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Full Name: </label>
                                            <input class="form-control" name="fullname" value="<?php echo $user['fullname']; ?>" type="text" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Phone Number: </label>
                                            <input class="form-control" name="phone" maxlength="10" value="<?php echo $user['phone']; ?>" type="text" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Email: </label>
                                            <input class="form-control" name="email" value="<?php echo $user['email']; ?>" type="email" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Location: </label>
                                            <select class="form-control" readonly name="location" required>
                                                <option value="Jinja Road Main Station" <?php echo $user['location'] === 'Jinja Road Main Station' ? 'selected' : ''; ?>>Jinja Road Main Station</option>
                                                <option value="Mukono Police Station" <?php echo $user['location'] === 'Mukono Police Station' ? 'selected' : ''; ?>>Mukono Police Station</option>
                                                <option value="Bweyogerere Police Station" <?php echo $user['location'] === 'Bweyogerere Police Station' ? 'selected' : ''; ?>>Bweyogerere Police Station</option>
                                            </select>
                                            <!-- <input class="form-control" name="location" value="<?php echo $user['location']; ?>" type="text" /> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Password: </label>
                                            <input class="form-control" name="password" value="" type="password" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-2">
                                    <button type="submit" name="update_user_details_btn" class="btn btn-success w-100 h-28 font-weight-bold mt-3 fs-5">Save</button>
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

