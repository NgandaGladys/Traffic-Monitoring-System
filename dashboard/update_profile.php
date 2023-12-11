<?php 
include '../root/config.php'; 
include '../root/process.php'; 
if (session_status() == PHP_SESSION_NONE) {
    // Start the session only if it hasn't been started already
    session_start();
}

$email = $_SESSION['email'];

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

        h3 {
           text-align:center;
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
                <div class="col-md-5 bg-white p-5" style="border-radius: 10px; border: 1px solid #ccc; display:block; margin:0 auto;">
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
                                            <select class="form-control" name="location" required>
                                                <option value="A" <?php echo $user['location'] === 'A' ? 'selected' : ''; ?>>A</option>
                                                <option value="B" <?php echo $user['location'] === 'B' ? 'selected' : ''; ?>>B</option>
                                                <!-- <option value="C" <?php echo $user['location'] === 'C' ? 'selected' : ''; ?>>C</option> -->
                                            </select>
                                            <!-- <input class="form-control" name="location" value="<?php echo $user['location']; ?>" type="text" /> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Password: </label>
                                            <input class="form-control" name="password" value="" type="password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-2">
                                    <button type="submit" name="update_user_details_btn" class="btn btn-success w-100 font-weight-bold mt-3">Save updates</button>
                                <!-- <a href="login"><button class="btn btn-dark w-100 font-weight-bold mt-2">Update Profile</button></a> -->
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

