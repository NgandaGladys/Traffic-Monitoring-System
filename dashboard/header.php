<?php 
include '../root/config.php'; 
include '../root/process.php';
if (empty($_SESSION['userid'])) {
    header("Location: ".SITE_URL.'/login');
}else{
    // `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered`
    $role = $_SESSION['role'];
    $fullname   = $_SESSION['fullname'];
    $phone   = $_SESSION['phone'];
    $email   = $_SESSION['email'];
    $userid = $_SESSION['userid'];
    $date_registered = $_SESSION['date_registered'];
} 

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
         <a href="<?=HOME_URL; ?>" class="logo">
            <!-- <img class="img-fluid able-logo" src="assets/images/logo.png" alt="Theme-logo"> -->
            Traffic Monitoring System
        </a>
         <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#!" data-toggle="offcanvas" class="sidebar-toggle"></a>
            <!-- Navbar Right Menu-->
            <div class="navbar-custom-menu f-right">
               <ul class="top-nav">
                  <!--Notification Menu-->
                  <li class="dropdown notification-menu">
                     <a href="#!" data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">
                        <i class="icon-bell"></i>
                        <span class="badge badge-danger header-badge">9</span>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="not-head">You have <b class="text-primary">4</b> new notifications.</li>
                        <li class="bell-notification">
                           <a href="javascript:;" class="media">
                              <span class="media-left media-icon">
                            <img class="img-circle" src="assets/images/avatar-1.png" alt="User Image">
                            </span>
                              <div class="media-body"><span class="block">Lisa sent you a mail</span><span class="text-muted block-time">2min ago</span></div>
                           </a>
                        </li>

                        <li class="not-footer">
                           <a href="#!">See all notifications.</a>
                        </li>
                     </ul>
                  </li>
                  <!-- chat dropdown -->
                 
                  <!-- window screen -->
                  <li class="pc-rheader-submenu">
                     <a href="#!" class="drop icon-circle" onclick="javascript:toggleFullScreen()">
                        <i class="icon-size-fullscreen"></i>
                     </a>

                  </li>
                  <!-- User Menu-->
                  <li class="dropdown">
                     <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                        <span><img class="img-circle " src="../images/avatar.png" style="width:40px;" alt="User Image"></span>
                        <span><b><?=ucwords($fullname); ?></b> <i class=" icofont icofont-simple-down"></i></span>

                     </a>
                     <ul class="dropdown-menu settings-menu">
                        <li><a href="#!"><i class="icon-settings"></i> Settings</a></li>
                        <li><a href="#"><i class="icon-user"></i> Profile</a></li>
                        <li><a href="#"><i class="icon-envelope-open"></i> My Messages</a></li>
                        <li class="p-0">
                           <div class="dropdown-divider m-0"></div>
                        </li>
                        <li><a href="#"><i class="icon-lock"></i> Lock Screen</a></li>
                        <li><a href="<?=SITE_URL; ?>/logout" onclick="return confirm('Do you really want to Logout?. '); "><i class="icon-logout"></i> Logout</a></li>

                     </ul>
                  </li>
               </ul>

               <!-- search -->
               <div id="morphsearch" class="morphsearch">
                  <form class="morphsearch-form">

                     <input class="morphsearch-input" type="search" placeholder="Search..." />

                     <button class="morphsearch-submit" type="submit">Search</button>

                  </form>
                  <div class="morphsearch-content">
                     <div class="dummy-column">
                        <h2>People</h2>
                        <a class="dummy-media-object" href="#!">
                           <img class="round" src="http://0.gravatar.com/avatar/81b58502541f9445253f30497e53c280?s=50&d=identicon&r=G" alt="Sara Soueidan" />
                           <h3>Sara Soueidan</h3>
                        </a>

                        <a class="dummy-media-object" href="#!">
                           <img class="round" src="http://1.gravatar.com/avatar/9bc7250110c667cd35c0826059b81b75?s=50&d=identicon&r=G" alt="Shaun Dona" />
                           <h3>Shaun Dona</h3>
                        </a>
                     </div>
                     <div class="dummy-column">
                        <h2>Popular</h2>
                        <a class="dummy-media-object" href="#!">
                           <img src="assets/images/avatar-1.png" alt="PagePreloadingEffect" />
                           <h3>Page Preloading Effect</h3>
                        </a>

                        <a class="dummy-media-object" href="#!">
                           <img src="assets/images/avatar-1.png" alt="DraggableDualViewSlideshow" />
                           <h3>Draggable Dual-View Slideshow</h3>
                        </a>
                     </div>
                     <div class="dummy-column">
                        <h2>Recent</h2>
                        <a class="dummy-media-object" href="#!">
                           <img src="assets/images/avatar-1.png" alt="TooltipStylesInspiration" />
                           <h3>Tooltip Styles Inspiration</h3>
                        </a>
                        <a class="dummy-media-object" href="#!">
                           <img src="assets/images/avatar-1.png" alt="NotificationStyles" />
                           <h3>Notification Styles Inspiration</h3>
                        </a>
                     </div>
                  </div>
                  <!-- /morphsearch-content -->
                  <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
               </div>
               <!-- search end -->
            </div>
         </nav>
      </header>
      <!-- Side-Nav-->
      <aside class="main-sidebar hidden-print ">
         <section class="sidebar" id="sidebar-scroll">
            <!-- Sidebar Menu-->
            <ul class="sidebar-menu">
                <li class="active treeview">
                    <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>">
                        <i class="icon-speedometer"></i><span> Dashboard</span>
                    </a>                
                </li>
               <?php if ($role == 'admin') { ?>
                <li class="treeview">
                    <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?officers">
                        <i class="icon-user"></i><span> Officers</span>
                    </a>                
                </li>
                <li class="treeview">
                    <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?users">
                        <i class="icon-user"></i><span> Users</span>
                    </a>                
                </li>
                <?php } ?>
                <li class="treeview">
                    <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?roads">
                        <i class="icon-map"></i><span> Roads</span>
                    </a>                
                </li>
                <li class="treeview">
                    <a class="waves-effect waves-dark" href="<?=HOME_URL; ?>?routes">
                        <i class="icon-map"></i><span> Routes</span>
                    </a>                
                </li>
                <li class="treeview">
                    <a class="waves-effect waves-dark" onclick="return confirm('Do you really want to Logout?. '); " href="<?=SITE_URL; ?>/logout">
                        <i class="icon-power"></i><span> Logout</span>
                    </a>                
                </li>

            </ul>
         </section>
      </aside>
      <!-- Sidebar chat start -->

      <div class="showChat_inner">
         <div class="media chat-inner-header">
            <a class="back_chatBox">
               <i class="icofont icofont-rounded-left"></i> <b><?=ucwords($fullname); ?></b>
            </a>
         </div>
         <div class="media chat-messages">
            <a class="media-left photo-table" href="#!">
               <img class="media-object img-circle m-t-5" src="assets/images/avatar-1.png" alt="Generic placeholder image">
               <div class="live-status bg-success"></div>
            </a>
            <div class="media-body chat-menu-content">
               <div class="">
                  <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                  <p class="chat-time">8:20 a.m.</p>
               </div>
            </div>
         </div>
         <div class="media chat-messages">
            <div class="media-body chat-menu-reply">
               <div class="">
                  <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                  <p class="chat-time">8:20 a.m.</p>
               </div>
            </div>
            <div class="media-right photo-table">
               <a href="#!">
                  <img class="media-object img-circle m-t-5" src="assets/images/avatar-2.png" alt="Generic placeholder image">
                  <div class="live-status bg-success"></div>
               </a>
            </div>
         </div>
         <div class="media chat-reply-box">
            <div class="md-input-wrapper">
               <input type="text" class="md-form-control" id="inputEmail" name="inputEmail">
               <label>Share your thoughts</label>
               <span class="highlight"></span>
               <span class="bar"></span> <button type="button" class="chat-send waves-effect waves-light">
                     <i class="icofont icofont-location-arrow f-20 "></i>
                 </button>

               <button type="button" class="chat-send waves-effect waves-light">
                    <i class="icofont icofont-location-arrow f-20 "></i>
                </button>
            </div>

         </div>
      </div>
<?php 
include 'addroad.php'; 
include 'addofficer.php';
include 'addroute.php';
?>