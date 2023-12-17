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
$stmt->bindParam(':email', $email,);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Dashboard</title>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
   <!-- Favicon icon -->
   <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
   <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
   <!-- Google font-->
   <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
   <!-- themify -->
   <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
   <!-- iconfont -->
   <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
   <!-- simple line icon -->
   <link rel="stylesheet" type="text/css" href="assets/icon/simple-line-icons/css/simple-line-icons.css">
   <!-- Required Fremwork -->
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap/css/bootstrap.min.css">
   <!-- Chartlist chart css -->
   <link rel="stylesheet" href="assets/plugins/chartist/dist/chartist.css" type="text/css" media="all">
   <!-- Weather css -->
   <link href="assets/css/svg-weather.css" rel="stylesheet">
   <!-- Style.css -->
   <link rel="stylesheet" type="text/css" href="assets/css/main.css">
   <!-- Responsive.css-->
   <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
</head>

<body class="sidebar-mini fixed">
   <div class="loader-bg">
      <div class="loader-bar">
      </div>
   </div>
   <div class="wrapper">
      <!-- Navbar-->
        <header class="main-header-top hidden-print">
            <h2 class="logo" style="cursor:default;">
                <!-- <img class="img-fluid able-logo" src="assets/images/tms-logo.png" alt="Theme-logo"> -->
                Traffic Monitoring System
            </h2>
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#!" data-toggle="offcanvas" class="sidebar-toggle"></a>
                <!-- Navbar Right Menu-->
                <div class="navbar-custom-menu f-right">
                <ul class="top-nav">          
                    <!-- window screen -->
                    <!-- <li class="pc-rheader-submenu">
                        <a href="#!" class="drop icon-circle" onclick="javascript:toggleFullScreen()">
                            <i class="icon-size-fullscreen"></i>
                        </a>

                    </li> -->
                    <!-- User Menu-->
                    <li class="dropdown">
                        <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                            <span><img class="img-circle " src="../images/avatar.png" style="width:40px;" alt="User Image"></span>
                            <span><b><?php echo ucwords($user['fullname']); ?></b> <i class=" icofont icofont-simple-down"></i></span>

                        </a>
                        <ul class="dropdown-menu settings-menu">
                            <!-- <li><a href="#!"><i class="icon-settings"></i> Settings</a></li> -->
                            <a href="profile" style="color:gray;"><li><i class="icon-user"></i> Profile</li></a>
                            <a href="<?=SITE_URL; ?>/logout" onclick="return confirm('Do you really want to Logout?. '); " style="color:gray;"><li><i class="icon-logout"></i> Logout</li></a>
                        </ul>
                    </li>
                </ul>
                </div>
            </nav>
        </header>
        <!-- Side-Nav-->
        <aside class="main-sidebar hidden-print">
            <section class="sidebar" id="sidebar-scroll">
                <!-- Sidebar Menu-->
                <ul class="sidebar-menu">
                    <?php if ($role == 'super_admin') { ?>
                        <li class="active treeview">
                            <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>">
                                <i class="icon-speedometer"></i><span> Dashboard</span>
                            </a>                
                        </li>
                        <li class="treeview">
                            <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?admins">
                                <i class="icon-user"></i><span> Admins</span>
                            </a>                
                        </li>
                        <li class="treeview">
                            <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?users">
                                <i class="icon-user"></i><span> Users</span>
                            </a>                
                        </li>
                        <li class="treeview">
                            <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?officers">
                                <i class="icon-user"></i><span> Officers</span>
                            </a>                
                        </li>
                        <li class="treeview">
                            <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?roads">
                                <i class="icon-map"></i><span> Roads</span>
                            </a>                
                        </li>
                        <li class="treeview">
                        <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?traffic_points">
                            <i class="icon-map"></i><span> Traffic Points</span>
                        </a>                
                        </li>
                        <li class="treeview">
                            <a class="waves-effect waves-dark" onclick="return confirm('Do you really want to Logout?. '); " href="<?=SITE_URL; ?>/logout">
                                <i class="icon-power"></i><span> Logout</span>
                            </a>                
                        </li>
                    <?php } elseif ($role == 'admin') { ?>
                        <li class="active treeview">
                            <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>">
                                <i class="icon-speedometer"></i><span> Dashboard</span>
                            </a>                
                        </li>
                        <li class="treeview">
                            <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?officers">
                                <i class="icon-user"></i><span> Officers</span>
                            </a>                
                        </li>
                        <li class="treeview">
                            <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?roads">
                                <i class="icon-map"></i><span> Roads</span>
                            </a>                
                        </li>
                        <li class="treeview">
                        <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?traffic_points">
                            <i class="icon-map"></i><span> Traffic Points</span>
                        </a>                
                        </li>
                        <li class="treeview">
                            <a class="waves-effect waves-dark" onclick="return confirm('Do you really want to Logout?. '); " href="<?=SITE_URL; ?>/logout">
                                <i class="icon-power"></i><span> Logout</span>
                            </a>                
                        </li>
                    <?php } elseif ($role == 'officer') { ?>
                        <li class="active treeview">
                            <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>">
                                <i class="icon-speedometer"></i><span> Dashboard</span>
                            </a>                
                        </li>
                        <li class="treeview">
                            <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?roads">
                                <i class="icon-map"></i><span> Roads</span>
                            </a>                
                        </li>
                        <li class="treeview">
                        <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?traffic_points">
                            <i class="icon-map"></i><span> Traffic Points</span>
                        </a>                
                        </li>
                        <li class="treeview">
                            <a class="waves-effect waves-dark" onclick="return confirm('Do you really want to Logout?. '); " href="<?=SITE_URL; ?>/logout">
                                <i class="icon-power"></i><span> Logout</span>
                            </a>                
                        </li>
                    <?php } elseif ($role == 'user') { ?>
                    <li class="treeview">
                            <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>">
                                <i class="icon-map"></i><span> Your Location </span>
                            </a>                
                        </li>
                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?traffic_points">
                            <i class="icon-map"></i><span>All Locations</span>
                        </a>                
                    </li>
                    <li class="treeview">
                        <a class="waves-effect waves-dark" onclick="return confirm('Do you really want to Logout?. '); " href="<?=SITE_URL; ?>/logout">
                            <i class="icon-power"></i><span> Logout</span>
                        </a>                
                    </li>
                    <?php }?>
                </ul>
            </section>
        </aside>
    </div>
</body>
      
      
<?php 
include 'super_admin/addroad.php'; 
include 'super_admin/addadmin.php';
include 'super_admin/addofficer.php';
include 'super_admin/add-traffic-point.php';
include 'admin/addroadtwo.php';
include 'admin/addofficertwo.php';
include 'admin/add-traffic-point-two.php';
include 'addroadone.php';
include 'addofficerone.php';
include 'add-traffic-point-one.php';
include 'officer/add-traffic-point-three.php';
include 'addofficerfive.php';
include 'addroadfive.php';
include 'add-traffic-point-four.php';
include 'add-traffic-point-five.php';
?>


