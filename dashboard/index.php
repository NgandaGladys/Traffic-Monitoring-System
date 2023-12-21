<?php include 'header.php';
if ($role == 'super_admin') { 
   if (isset($_REQUEST['admins'])) { ?>
     <!-- Hover effect table starts -->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Traffic Admins</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Full Name, Phone, Email">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#addadmin" class="btn btn-primary" data-toggle="modal">Add admin</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>id</th>
                                 <th>FullName</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <!-- <th>Role</th> -->
                                 <th>Location</th>
                                 <th>Date Registered</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <!-- `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered` -->
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (fullname LIKE '%$search%' OR phone LIKE '%$search%' OR email LIKE '%$search%' OR role LIKE '%$search%')";
                              }
                           $users = $dbh->query("SELECT * FROM users WHERE role ='admin' $condition ORDER BY userid DESC ");
                           $x = 1;
                           while($rx = $users->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <td><?=$x++; ?></td>
                                 <td><?=$rx->fullname; ?></td>
                                 <td><?=$rx->phone; ?></td>
                                 <td><?=$rx->email; ?></td>
                                 <!-- <td><?=$rx->role; ?></td> -->
                                 <td><?=$rx->location; ?></td>
                                 <td><?=$rx->date_registered; ?></td>
                                 <td>
                                    <a href="#edit-admin<?=$rx->userid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('Do you really want to delete this admin? '); " href="?delete-admin=<?=$rx->userid; ?>" class="btn btn-danger">Delete</a>
                                 </td>
                              </tr>
                           <?php include 'super_admin/edit-admin.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
      <!-- Main content ends -->
      <!-- Container-fluid ends -->
   </div>
   <?php }elseif (isset($_REQUEST['delete-admin'])) { 
      dbDelete('users','userid',$_REQUEST['delete-admin']);
      redirect_page('?admins'); ?>
   <!-- Hover effect table ends -->
   <?php }elseif (isset($_REQUEST['officers'])) { ?>
     <!-- Hover effect table starts -->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Traffic Officers</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Full Name, Phone, Email">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#addofficer" class="btn btn-primary float-right" data-toggle="modal">Add Officer</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>id</th>
                                 <th>FullName</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Location</th>
                                 <!-- <th>Role</th> -->
                                 <th>Date Registered</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <!-- `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered` -->
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (fullname LIKE '%$search%' OR phone LIKE '%$search%' OR email LIKE '%$search%' OR role LIKE '%$search%')";
                              }
                           $users = $dbh->query("SELECT * FROM users WHERE role ='officer' $condition ORDER BY userid DESC ");
                           $x = 1;
                           while($rx = $users->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <td><?=$x++; ?></td>
                                 <td><?=$rx->fullname; ?></td>
                                 <td><?=$rx->phone; ?></td>
                                 <td><?=$rx->email; ?></td>
                                 <td><?=$rx->location; ?></td>
                                 <!-- <td><?=$rx->role; ?></td> -->
                                 <td><?=$rx->date_registered; ?></td>
                                 <td>
                                    <a href="#edit-officer<?=$rx->userid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('Do you really want to delete this officer? '); " href="?delete-officer=<?=$rx->userid; ?>" class="btn btn-danger">Delete</a>
                                 </td>
                              </tr>
                           <?php include 'super_admin/edit-officer.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
      <!-- Main content ends -->
      <!-- Container-fluid ends -->
   </div>
   <?php }elseif (isset($_REQUEST['delete-officer'])) { 
      dbDelete('users','userid',$_REQUEST['delete-officer']);
      redirect_page('?officers'); ?>
   <!-- Hover effect table ends -->
   <?php }elseif (isset($_REQUEST['users'])) { ?>
       <!-- Sidebar chat end-->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Users</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                       <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>id</th>
                                 <th>FullName</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Location</th>
                                 <!-- <th>Role</th> -->
                                 <th>Date Registered</th>
                              </tr>
                           </thead>
                           <!-- `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered` -->
                           <tbody>
                           <?php $users = $dbh->query("SELECT * FROM users WHERE role ='user' ORDER BY userid DESC ");
                           $x = 1;
                           while($rx = $users->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <td><?=$x++; ?></td>
                                 <td><?=$rx->fullname; ?></td>
                                 <td><?=$rx->phone; ?></td>
                                 <td><?=$rx->email; ?></td>
                                 <td><?=$rx->location; ?></td>
                                 <!-- <td><?=$rx->role; ?></td> -->
                                 <td><?=$rx->date_registered; ?></td>
                              </tr>
                           <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
      <!-- Main content ends -->
      <!-- Container-fluid ends -->
   </div>
   <?php }elseif (isset($_REQUEST['roads'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Roads</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Location">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#addroad" data-toggle="modal" class="btn btn-primary float-right">Add Road</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>id</th>
                                 <th>Road Name</th>
                                 <th>Location</th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (road_name LIKE '%$search%' OR location LIKE '%$search%')";
                              }
                           $roads = $dbh->query("SELECT * FROM roads WHERE 1 $condition");
                           $x = 1; 
                           while($rx = $roads->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <td><?=$x++; ?></td>
                                 <td><?=$rx->road_name; ?></td>
                                 <td><?=$rx->location; ?></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td><a href="#edit-road<?=$rx->road_id; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                 <a onclick="return confirm('Do you really want to delete this Road? '); " href="?delete-road=<?=$rx->road_id; ?>" class="btn btn-danger">Delete</a></td>
                              </tr>
                           <?php include 'super_admin/edit-road.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST['delete-road'])) { 
      dbDelete('roads','road_id',$_REQUEST['delete-road']);
      redirect_page('?roads'); ?>

   <?php }elseif (isset($_REQUEST['traffic_points'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Traffic Points</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Traffic Point">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#add-traffic-point" data-toggle="modal" class="btn btn-primary float-right">Add Traffic Point</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>id</th>
                                 <th>Road Name</th>
                                 <th>Location</th>
                                 <th>Traffic Point</th>
                                 <th>Traffic Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (r.road_name LIKE '%$search%' OR t.fromm LIKE '%$search%' OR t.too LIKE '%$search%' OR t.status LIKE '%$search%')";
                              }
                           $roads_routes = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.road_id = t.road_id $condition");
                           $x = 1; 
                           // `rid`, `road_id`, `fromm`, `too`, `status`
                           while($rx = $roads_routes->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <td><?=$x++; ?></td>
                                 <td><?=$rx->road_name; ?></td>
                                 <td><?=$rx->location; ?></td>
                                 <td><?=$rx->fromm.' - '.$rx->too; ?></td>
                                 <td><?=$rx->status; ?></td>
                                 <td>
                                    <a href="#edit-traffic-point<?=$rx->rid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('Do you really want to delete this traffic point? '); " href="?delete-traffic-point=<?=$rx->rid; ?>" class="btn btn-danger">Delete</a></td>
                              </tr>
                           <?php include 'super_admin/edit-traffic-point.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST['delete-traffic-point'])) { 
      dbDelete('traffic_points','rid',$_REQUEST['delete-traffic-point']);
      redirect_page('?traffic_points'); ?>
   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }else { ?>
  
   <!-- Sidebar chat end-->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Dashboard</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Admins</h5>
                  <?php $admins = $dbh->query("SELECT * FROM users WHERE role = 'admin' ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($admins); ?></span></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?admins">Admins</a></span>
                  <div class="side-box">
                     <i class="icon-user text-warning-color"></i>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Officers</h5>
                  <?php $officers = $dbh->query("SELECT * FROM users WHERE role = 'officer' ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($officers); ?></span></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?officers">Officers</a></span>
                  <div class="side-box">
                     <i class="icon-user text-warning-color"></i>
                  </div>
               </div>
            </div>
                 <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
               <?php $users = $dbh->query("SELECT * FROM users WHERE role = 'user' ")->rowCount(); ?>
                  <h5>Users</h5>
                  <h2 class="dashboard-total-products"><?=number_format($users); ?></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?users">Users</a></span>
                  <div class="side-box">
                     <i class="icon-user text-warning-color"></i>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Roads</h5>
                  <?php $rds = $dbh->query("SELECT * FROM roads ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><?=number_format($rds); ?></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?roads">Roads</a></span>
                  <div class="side-box ">
                     <i class="icon-map text-warning-color"></i>
                     <!-- <i class="ti-direction-alt text-primary-color"></i> -->
                  </div>
               </div>
            </div>
           
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Traffic Points</h5>
                  <?php $rts = $dbh->query("SELECT * FROM traffic_points ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($rts); ?></span></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?traffic_points">Traffic Points</a></span>
                  <div class="side-box">
                     <i class="icon-map text-warning-color"></i>
                  </div>
               </div>
            </div>
         </div>
         <!-- 4-blocks row end -->
      </div>
      <!-- Main content ends -->
      <!-- Container-fluid ends -->
   </div>
<?php } ?>
<?php }elseif ($role == 'admin' && $location == 'Jinja Road Main Station') { 
   if (isset($_REQUEST['officers'])) { ?>
     <!-- Hover effect table starts -->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Traffic Officers</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Full Name, Phone, Email,">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#addofficerone" class="btn btn-primary float-right" data-toggle="modal">Add Officer</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>FullName</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Role</th>
                                 <th>Date Registered</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <!-- `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered` -->
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (fullname LIKE '%$search%' OR phone LIKE '%$search%' OR email LIKE '%$search%' OR role LIKE '%$search%')";
                              }
                           $users = $dbh->query("SELECT * FROM users WHERE role ='officer' AND location = 'Jinja Road Main Station' $condition ORDER BY userid DESC ");
                           $x = 1;
                           while($rx = $users->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <!-- <td><?=$x++; ?></td> -->
                                 <td><?=$rx->fullname; ?></td>
                                 <td><?=$rx->phone; ?></td>
                                 <td><?=$rx->email; ?></td>
                                 <td><?=$rx->role; ?></td>
                                 <td><?=$rx->date_registered; ?></td>
                                 <td>
                                    <a href="#edit-officer-one<?=$rx->userid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('Do you really want to delete this officer?. '); " href="?delete-officer=<?=$rx->userid; ?>" class="btn btn-danger">Delete</a>
                                 </td>
                              </tr>
                           <?php include 'edit-officer-one.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
      <!-- Main content ends -->
      <!-- Container-fluid ends -->
   </div>
   <?php }elseif (isset($_REQUEST['delete-officer'])) { 
      dbDelete('users','userid',$_REQUEST['delete-officer']);
      redirect_page('?officers'); ?>
   <!-- Hover effect table ends -->
   <?php }elseif (isset($_REQUEST['roads'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Roads</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#addroadone" data-toggle="modal" class="btn btn-primary float-right">Add Road</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>Road Name</th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND road_name LIKE '%$search%'";
                              }
                           $roads = $dbh->query("SELECT * FROM roads WHERE location = 'Jinja Road Main Station' $condition");
                           $x = 1; 
                           while($rx = $roads->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <!-- <td><?=$x++; ?></td> -->
                                 <td><?=$rx->road_name; ?></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td><a href="#edit-road-one<?=$rx->road_id; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                 <a onclick="return confirm('Do you really want to delete this Road?. '); " href="?delete-road=<?=$rx->road_id; ?>" class="btn btn-danger">Delete</a></td>
                              </tr>
                           <?php include 'edit-road-one.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST['delete-road'])) { 
      dbDelete('roads','road_id',$_REQUEST['delete-road']);
      redirect_page('?roads'); ?>

   <?php }elseif (isset($_REQUEST['traffic_points'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Traffic Points</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Traffic Point">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#add-traffic-point-one" data-toggle="modal" class="btn btn-primary float-right">Add Traffic Point</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>Road Name</th>
                                 <th>Traffic Point</th>
                                 <th>Traffic Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (r.road_name LIKE '%$search%' OR t.fromm LIKE '%$search%' OR t.too LIKE '%$search%' OR t.status LIKE '%$search%')";
                              }
                           $roads_routes = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.location = 'Jinja Road Main Station' AND r.road_id = t.road_id $condition");
                           $x = 1; 
                           // `rid`, `road_id`, `fromm`, `too`, `status`
                           while($rx = $roads_routes->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <!-- <td><?=$x++; ?></td> -->
                                 <td><?=$rx->road_name; ?></td>
                                 <td><?=$rx->fromm.' - '.$rx->too; ?></td>
                                 <td><?=$rx->status; ?></td>
                                 <td>
                                    <a href="#edit-traffic-point-one<?=$rx->rid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('Do you really want to delete this traffic point?. '); " href="?delete-traffic-point=<?=$rx->rid; ?>" class="btn btn-danger">Delete</a></td>
                              </tr>
                           <?php include 'edit-traffic-point-one.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST['delete-traffic-point'])) { 
      dbDelete('traffic_points','rid',$_REQUEST['delete-traffic-point']);
      redirect_page('?traffic_points'); ?>
   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }else { ?>
  
   <!-- Sidebar chat end-->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Dashboard</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Officers</h5>
                  <?php $officers = $dbh->query("SELECT * FROM users WHERE role = 'officer' AND location = 'Jinja Road Main Station'")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($officers); ?></span></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?officers">Officers</a></span>
                  <div class="side-box">
                     <i class="icon-user text-warning-color"></i>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Roads</h5>
                  <?php $rds = $dbh->query("SELECT * FROM roads WHERE location = 'Jinja Road Main Station' ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><?=number_format($rds); ?></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?roads">Roads</a></span>
                  <div class="side-box ">
                     <i class="icon-map text-warning-color"></i>
                     <!-- <i class="ti-direction-alt text-primary-color"></i> -->
                  </div>
               </div>
            </div>
           
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Traffic Points</h5>
                  <?php $rts = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.location = 'Jinja Road Main Station' AND r.road_id = t.road_id ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($rts); ?></span></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?traffic_points">Traffic Points</a></span>
                  <div class="side-box">
                     <i class="icon-map text-warning-color"></i>
                  </div>
               </div>
            </div>
         </div>
         <!-- 4-blocks row end -->
      </div>
      <!-- Main content ends -->
      <!-- Container-fluid ends -->
   </div>
<?php } ?>
<?php }elseif ($role == 'admin' && $location == 'Mukono Police Station') { 
   if (isset($_REQUEST['officers'])) { ?>
     <!-- Hover effect table starts -->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Traffic Officers</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Full Name, Phone, Email,">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#addofficertwo" class="btn btn-primary float-right" data-toggle="modal">Add Officer</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>FullName</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Role</th>
                                 <th>Date Registered</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <!-- `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered` -->
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (fullname LIKE '%$search%' OR phone LIKE '%$search%' OR email LIKE '%$search%' OR role LIKE '%$search%')";
                              }
                           $users = $dbh->query("SELECT * FROM users WHERE role ='officer' AND location = 'Mukono Police Station' $condition ORDER BY userid DESC ");
                           $x = 1;
                           while($rx = $users->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <!-- <td><?=$x++; ?></td> -->
                                 <td><?=$rx->fullname; ?></td>
                                 <td><?=$rx->phone; ?></td>
                                 <td><?=$rx->email; ?></td>
                                 <td><?=$rx->role; ?></td>
                                 <td><?=$rx->date_registered; ?></td>
                                 <td>
                                    <a href="#edit-officer-two<?=$rx->userid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('Do you really want to delete this officer?. '); " href="?delete-officer=<?=$rx->userid; ?>" class="btn btn-danger">Delete</a>
                                 </td>
                              </tr>
                           <?php include 'admin/edit-officer-two.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
      <!-- Main content ends -->
      <!-- Container-fluid ends -->
   </div>
   <?php }elseif (isset($_REQUEST['delete-officer'])) { 
      dbDelete('users','userid',$_REQUEST['delete-officer']);
      redirect_page('?officers'); ?>
   <!-- Hover effect table ends -->
   <?php }elseif (isset($_REQUEST['roads'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Roads</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#addroadtwo" data-toggle="modal" class="btn btn-primary float-right">Add Road</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>Road Name</th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND road_name LIKE '%$search%'";
                              }
                           $roads = $dbh->query("SELECT * FROM roads WHERE location = 'Mukono Police Station' $condition");
                           $x = 1; 
                           while($rx = $roads->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <!-- <td><?=$x++; ?></td> -->
                                 <td><?=$rx->road_name; ?></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td><a href="#edit-road-two<?=$rx->road_id; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                 <a onclick="return confirm('Do you really want to delete this Road?. '); " href="?delete-road=<?=$rx->road_id; ?>" class="btn btn-danger">Delete</a></td>
                              </tr>
                           <?php include 'admin/edit-road-two.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST['delete-road'])) { 
      dbDelete('roads','road_id',$_REQUEST['delete-road']);
      redirect_page('?roads'); ?>

   <?php }elseif (isset($_REQUEST['traffic_points'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Traffic Points</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Traffic Point">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#add-traffic-point-two" data-toggle="modal" class="btn btn-primary float-right">Add Traffic Point</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>Road Name</th>
                                 <th>Traffic Point</th>
                                 <th>Traffic Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (r.road_name LIKE '%$search%' OR t.fromm LIKE '%$search%' OR t.too LIKE '%$search%' OR t.status LIKE '%$search%')";
                              }
                           $roads_routes = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.location = 'Mukono Police Station' AND r.road_id = t.road_id $condition");
                           $x = 1; 
                           // `rid`, `road_id`, `fromm`, `too`, `status`
                           while($rx = $roads_routes->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <!-- <td><?=$x++; ?></td> -->
                                 <td><?=$rx->road_name; ?></td>
                                 <td><?=$rx->fromm.' - '.$rx->too; ?></td>
                                 <td><?=$rx->status; ?></td>
                                 <td>
                                    <a href="#edit-traffic-point-two<?=$rx->rid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('Do you really want to delete this traffic point?. '); " href="?delete-traffic-point=<?=$rx->rid; ?>" class="btn btn-danger">Delete</a></td>
                              </tr>
                           <?php include 'admin/edit-traffic-point-two.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST['delete-traffic-point'])) { 
      dbDelete('traffic_points','rid',$_REQUEST['delete-traffic-point']);
      redirect_page('?traffic_points'); ?>
   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }else { ?>
  
   <!-- Sidebar chat end-->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Dashboard</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Officers</h5>
                  <?php $officers = $dbh->query("SELECT * FROM users WHERE role = 'officer' AND location = 'Mukono Police Station'")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($officers); ?></span></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?officers">Officers</a></span>
                  <div class="side-box">
                     <i class="icon-user text-warning-color"></i>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Roads</h5>
                  <?php $rds = $dbh->query("SELECT * FROM roads WHERE location = 'Mukono Police Station' ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><?=number_format($rds); ?></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?roads">Roads</a></span>
                  <div class="side-box ">
                     <i class="icon-map text-warning-color"></i>
                     <!-- <i class="ti-direction-alt text-primary-color"></i> -->
                  </div>
               </div>
            </div>
           
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Traffic Points</h5>
                  <?php $rts = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.location = 'Mukono Police Station' AND r.road_id = t.road_id ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($rts); ?></span></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?traffic_points">Traffic Points</a></span>
                  <div class="side-box">
                     <i class="icon-map text-warning-color"></i>
                  </div>
               </div>
            </div>
         </div>
         <!-- 4-blocks row end -->
      </div>
      <!-- Main content ends -->
      <!-- Container-fluid ends -->
   </div>
<?php } ?>
<?php }elseif ($role == 'admin' && $location == 'Bweyogerere Police Station') { 
   if (isset($_REQUEST['officers'])) { ?>
     <!-- Hover effect table starts -->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Traffic Officers</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Full Name, Phone, Email,">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#addofficerfive" class="btn btn-primary float-right" data-toggle="modal">Add Officer</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>FullName</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Role</th>
                                 <th>Date Registered</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <!-- `userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered` -->
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (fullname LIKE '%$search%' OR phone LIKE '%$search%' OR email LIKE '%$search%' OR role LIKE '%$search%')";
                              }
                           $users = $dbh->query("SELECT * FROM users WHERE role ='officer' AND location = 'Bweyogerere Police Station' $condition ORDER BY userid DESC ");
                           $x = 1;
                           while($rx = $users->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <!-- <td><?=$x++; ?></td> -->
                                 <td><?=$rx->fullname; ?></td>
                                 <td><?=$rx->phone; ?></td>
                                 <td><?=$rx->email; ?></td>
                                 <td><?=$rx->role; ?></td>
                                 <td><?=$rx->date_registered; ?></td>
                                 <td>
                                    <a href="#edit-officer-five<?=$rx->userid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('Do you really want to delete this officer?. '); " href="?delete-officer=<?=$rx->userid; ?>" class="btn btn-danger">Delete</a>
                                 </td>
                              </tr>
                           <?php include 'edit-officer-five.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
      <!-- Main content ends -->
      <!-- Container-fluid ends -->
   </div>
   <?php }elseif (isset($_REQUEST['delete-officer'])) { 
      dbDelete('users','userid',$_REQUEST['delete-officer']);
      redirect_page('?officers'); ?>
   <!-- Hover effect table ends -->
   <?php }elseif (isset($_REQUEST['roads'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Roads</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#addroadfive" data-toggle="modal" class="btn btn-primary float-right">Add Road</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>Road Name</th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND road_name LIKE '%$search%'";
                              }
                           $roads = $dbh->query("SELECT * FROM roads WHERE location = 'Bweyogerere Police Station' $condition");
                           $x = 1; 
                           while($rx = $roads->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <!-- <td><?=$x++; ?></td> -->
                                 <td><?=$rx->road_name; ?></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td><a href="#edit-road-five<?=$rx->road_id; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                 <a onclick="return confirm('Do you really want to delete this Road?. '); " href="?delete-road=<?=$rx->road_id; ?>" class="btn btn-danger">Delete</a></td>
                              </tr>
                           <?php include 'edit-road-five.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST['delete-road'])) { 
      dbDelete('roads','road_id',$_REQUEST['delete-road']);
      redirect_page('?roads'); ?>

   <?php }elseif (isset($_REQUEST['traffic_points'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Traffic Points</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Traffic Point">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#add-traffic-point-five" data-toggle="modal" class="btn btn-primary float-right">Add Traffic Point</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>Road Name</th>
                                 <th>Traffic Point</th>
                                 <th>Traffic Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (r.road_name LIKE '%$search%' OR t.fromm LIKE '%$search%' OR t.too LIKE '%$search%' OR t.status LIKE '%$search%')";
                              }
                           $roads_routes = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.location = 'Bweyogerere Police Station' AND r.road_id = t.road_id $condition");
                           $x = 1; 
                           // `rid`, `road_id`, `fromm`, `too`, `status`
                           while($rx = $roads_routes->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <!-- <td><?=$x++; ?></td> -->
                                 <td><?=$rx->road_name; ?></td>
                                 <td><?=$rx->fromm.' - '.$rx->too; ?></td>
                                 <td><?=$rx->status; ?></td>
                                 <td>
                                    <a href="#edit-traffic-point-five<?=$rx->rid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('Do you really want to delete this traffic point?. '); " href="?delete-traffic-point=<?=$rx->rid; ?>" class="btn btn-danger">Delete</a></td>
                              </tr>
                           <?php include 'edit-traffic-point-five.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST['delete-traffic-point'])) { 
      dbDelete('traffic_points','rid',$_REQUEST['delete-traffic-point']);
      redirect_page('?traffic_points'); ?>
   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }else { ?>
  
   <!-- Sidebar chat end-->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Dashboard</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Officers</h5>
                  <?php $officers = $dbh->query("SELECT * FROM users WHERE role = 'officer' AND location = 'Bweyogerere Police Station'")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($officers); ?></span></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?officers">Officers</a></span>
                  <div class="side-box">
                     <i class="icon-user text-warning-color"></i>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Roads</h5>
                  <?php $rds = $dbh->query("SELECT * FROM roads WHERE location = 'Bweyogerere Police Station' ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><?=number_format($rds); ?></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?roads">Roads</a></span>
                  <div class="side-box ">
                     <i class="icon-map text-warning-color"></i>
                     <!-- <i class="ti-direction-alt text-primary-color"></i> -->
                  </div>
               </div>
            </div>
           
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Traffic Points</h5>
                  <?php $rts = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.location = 'Bweyogerere Police Station' AND r.road_id = t.road_id ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($rts); ?></span></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?traffic_points">Traffic Points</a></span>
                  <div class="side-box">
                     <i class="icon-map text-warning-color"></i>
                  </div>
               </div>
            </div>
         </div>
         <!-- 4-blocks row end -->
      </div>
      <!-- Main content ends -->
      <!-- Container-fluid ends -->
   </div>
<?php } ?>
<?php }elseif ($role == 'officer' && $location == 'Jinja Road Main Station') { 
   if (isset($_REQUEST['roads'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Roads</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>Road Name</th>
                                 <!-- <th>Location</th> -->
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND road_name LIKE '%$search%'";
                              }

                              $roads = $dbh->query("SELECT * FROM roads WHERE location = 'Jinja Road Main Station'$condition");
                              $x = 1; 
                              while($rx = $roads->fetch(PDO::FETCH_OBJ)){ ?>
                                 <tr>
                                    <!-- <td><?=$x++; ?></td> -->
                                    <td><?=$rx->road_name; ?></td>
                                    <!-- <td><?=$rx->location; ?></td> -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                 </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST['traffic_points'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Traffic Points</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Traffic Point">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#add-traffic-point-three" data-toggle="modal" class="btn btn-primary float-right">Add Traffic Point</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>Road Name</th>
                                 <!-- <th>Location</th> -->
                                 <th>Traffic Point</th>
                                 <th>Traffic Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (r.road_name LIKE '%$search%' OR t.fromm LIKE '%$search%' OR t.too LIKE '%$search%' OR t.status LIKE '%$search%')";
                              }

                              $roads_routes = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.road_id = t.road_id $condition");
                              $x = 1;
                              while ($rx = $roads_routes->fetch(PDO::FETCH_OBJ)) { ?>
                                 <tr>
                                    <td><?= $rx->road_name; ?></td>
                                    <td><?= $rx->fromm . ' - ' . $rx->too; ?></td>
                                    <td><?= $rx->status; ?></td>
                                    <td><a href="#edit-traffic-point-three<?=$rx->rid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a></td>
                                 </tr>
                              <?php include 'officer/edit-traffic-point-three.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }else { ?>
  
   <!-- Sidebar chat end-->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Dashboard</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Roads</h5>
                  <?php $rds = $dbh->query("SELECT * FROM roads WHERE location = 'Jinja Road Main Station' ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><?=number_format($rds); ?></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?roads">Roads</a></span>
                  <div class="side-box ">
                     <i class="icon-map text-warning-color"></i>
                     <!-- <i class="ti-direction-alt text-primary-color"></i> -->
                  </div>
               </div>
            </div> 
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Traffic Points</h5>
                  <?php $rts = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.location = 'Jinja Road Main Station' AND r.road_id = t.road_id ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($rts); ?></span></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?traffic_points">Traffic Points</a></span>
                  <div class="side-box">
                     <i class="icon-map text-warning-color"></i>
                  </div>
               </div>
            </div>
         </div>
         <!-- 4-blocks row end -->
      </div>
      <!-- Main content ends -->
      <!-- Container-fluid ends -->
   </div>
<?php } ?>
<?php }elseif ($role == 'officer' && $location == 'Mukono Police Station') { 
   if (isset($_REQUEST['roads'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Roads</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>Road Name</th>
                                 <!-- <th>Location</th> -->
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND road_name LIKE '%$search%'";
                              }
                           $roads = $dbh->query("SELECT * FROM roads WHERE location = 'Mukono Police Station'$condition");
                           $x = 1; 
                           while($rx = $roads->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <!-- <td><?=$x++; ?></td> -->
                                 <td><?=$rx->road_name; ?></td>
                                 <!-- <td><?=$rx->location; ?></td> -->
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                           <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST['traffic_points'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Traffic Points</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Traffic Point">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#add-traffic-point-four" data-toggle="modal" class="btn btn-primary float-right">Add Traffic Point</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>Road Name</th>
                                 <!-- <th>Location</th> -->
                                 <th>Traffic Point</th>
                                 <th>Traffic Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (r.road_name LIKE '%$search%' OR t.fromm LIKE '%$search%' OR t.too LIKE '%$search%' OR t.status LIKE '%$search%')";
                              }
 
                           $roads_routes = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.location = 'Mukono Police Station' AND r.road_id = t.road_id $condition");
                           $x = 1; 
                           // `rid`, `road_id`, `fromm`, `too`, `status`
                           while($rx = $roads_routes->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <!-- <td><?=$x++; ?></td> -->
                                 <td><?=$rx->road_name; ?></td>
                                 <!-- <td><?=$rx->location; ?></td> -->
                                 <td><?=$rx->fromm.' - '.$rx->too; ?></td>
                                 <td><?=$rx->status; ?></td>
                                 <td>
                                    <a href="#edit-traffic-point-four<?=$rx->rid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                              </tr>
                           <?php include 'edit-traffic-point-four.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }else { ?>
  
   <!-- Sidebar chat end-->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Dashboard</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header"> 
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Roads</h5>
                  <?php $rds = $dbh->query("SELECT * FROM roads WHERE location = 'Mukono Police Station' ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><?=number_format($rds); ?></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?roads">Roads</a></span>
                  <div class="side-box ">
                     <i class="icon-map text-warning-color"></i>
                     <!-- <i class="ti-direction-alt text-primary-color"></i> -->
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Traffic Points</h5>
                  <?php $rts = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.location = 'Mukono Police Station' AND r.road_id = t.road_id ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($rts); ?></span></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?traffic_points">Traffic Points</a></span>
                  <div class="side-box">
                     <i class="icon-map text-warning-color"></i>
                  </div>
               </div>
            </div>
         </div>
         <!-- 4-blocks row end -->
      </div>
      <!-- Main content ends -->
      <!-- Container-fluid ends -->
   </div>
<?php } ?>
<?php }elseif ($role == 'officer' && $location == 'Bweyogerere Police Station') { 
   if (isset($_REQUEST['roads'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Roads</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>Road Name</th>
                                 <!-- <th>Location</th> -->
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND road_name LIKE '%$search%'";
                              }
                           $roads = $dbh->query("SELECT * FROM roads WHERE location = 'Bweyogerere Police Station'$condition");
                           $x = 1; 
                           while($rx = $roads->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <!-- <td><?=$x++; ?></td> -->
                                 <td><?=$rx->road_name; ?></td>
                                 <!-- <td><?=$rx->location; ?></td> -->
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                           <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST['traffic_points'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Traffic Points</h4>
               <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Traffic Point">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
               </form>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text"><a href="#add-traffic-point-five" data-toggle="modal" class="btn btn-primary float-right">Add Traffic Point</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <!-- <th>id</th> -->
                                 <th>Road Name</th>
                                 <!-- <th>Location</th> -->
                                 <th>Traffic Point</th>
                                 <th>Traffic Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (r.road_name LIKE '%$search%' OR t.fromm LIKE '%$search%' OR t.too LIKE '%$search%' OR t.status LIKE '%$search%')";
                              }

                           $roads_routes = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.location = 'Bweyogerere Police Station' AND r.road_id = t.road_id $condition");
                           $x = 1; 
                           // `rid`, `road_id`, `fromm`, `too`, `status`
                           while($rx = $roads_routes->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <!-- <td><?=$x++; ?></td> -->
                                 <td><?=$rx->road_name; ?></td>
                                 <!-- <td><?=$rx->location; ?></td> -->
                                 <td><?=$rx->fromm.' - '.$rx->too; ?></td>
                                 <td><?=$rx->status; ?></td>
                                 <td>
                                    <a href="#edit-traffic-point-five<?=$rx->rid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                              </tr>
                           <?php include 'edit-traffic-point-five.php'; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>            
         </div>
         <!-- 4-blocks row end -->
      </div>
   </div>
   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

   <?php }else { ?>
  
   <!-- Sidebar chat end-->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h4>Dashboard</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header"> 
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Roads</h5>
                  <?php $rds = $dbh->query("SELECT * FROM roads WHERE location = 'Bweyogerere Police Station' ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><?=number_format($rds); ?></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?roads">Roads</a></span>
                  <div class="side-box ">
                     <i class="icon-map text-warning-color"></i>
                     <!-- <i class="ti-direction-alt text-primary-color"></i> -->
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <h5>Traffic Points</h5>
                  <?php $rts = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.location = 'Bweyogerere Police Station' AND r.road_id = t.road_id ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($rts); ?></span></h2>
                  <span class="label" style="background-color: #ff9c02; padding:8px;"><a style="text-decoration: none; color: #ffffff; " href="?traffic_points">Traffic Points</a></span>
                  <div class="side-box">
                     <i class="icon-map text-warning-color"></i>
                  </div>
               </div>
            </div>
         </div>
         <!-- 4-blocks row end -->
      </div>
      <!-- Main content ends -->
      <!-- Container-fluid ends -->
   </div>
<?php } ?>
<?php }elseif ($role == 'user' && $location == 'Jinja Road Main Station') { 
  if (isset($_REQUEST['traffic_points'])) { ?>
       <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h3 style="text-align:center;">Welcome <?=$fullname; ?> !</h3><br/>
               <div class="main-header">
                  <h4>Where are you going?</h4>
                  <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Traffic Point">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="row dashboard-header"> 
            <div class="card">
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>Road</th>
                                 <th>Traffic Point</th>
                                 <th>Traffic Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (r.road_name LIKE '%$search%' OR t.fromm LIKE '%$search%' OR t.too LIKE '%$search%' OR t.status LIKE '%$search%')";
                              }

                              $roads_routes = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.road_id = t.road_id $condition");
                              $x = 1;
                              while ($rx = $roads_routes->fetch(PDO::FETCH_OBJ)) { ?>
                                 <tr>
                                    <td><?= $rx->road_name; ?></td>
                                    <td><?= $rx->fromm . ' - ' . $rx->too; ?></td>
                                    <td><?= $rx->status; ?></td>
                                 </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>   
         </div>
      </div>
   </div>
   <?php }else{ ?>
      <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h3 style="text-align:center;">Welcome <?=$fullname; ?> !</h3><br/>
               <div class="main-header">
                  <h4>Where are you going?</h4>
                  <form method="POST" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Traffic Point">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="row dashboard-header"> 
            <div class="card">
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>Road</th>
                                 <th>Traffic Point</th>
                                 <th>Traffic Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_POST['search']) && !empty($_POST['search'])) {
                                 $search = $_POST['search'];
                                 $condition = " AND (r.road_name LIKE '%$search%' OR t.fromm LIKE '%$search%' OR t.too LIKE '%$search%' OR t.status LIKE '%$search%')";
                              }

                              $roads_routes = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.road_id = t.road_id $condition");
                              $x = 1;
                              while ($rx = $roads_routes->fetch(PDO::FETCH_OBJ)) { ?>
                                 <tr>
                                    <td><?= $rx->road_name; ?></td>
                                    <td><?= $rx->fromm . ' - ' . $rx->too; ?></td>
                                    <td><?= $rx->status; ?></td>
                                 </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>   
         </div>
      </div>
   </div>
   <?php } ?>
<?php }elseif ($role == 'user' && $location == 'Mukono Police Station') { 
  if (isset($_REQUEST['traffic_points'])) { ?>
      <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h3 style="text-align:center;">Welcome <?=$fullname; ?> !</h3><br/>
               <div class="main-header">
                  <h4>Where are you going?</h4>
                  <form method="GET" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Traffic Point">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="row dashboard-header"> 
            <div class="card">
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>Road</th>
                                 <th>Traffic Point</th>
                                 <th>Traffic Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_GET['search']) && !empty($_GET['search'])) {
                                 $search = $_GET['search'];
                                 $condition = " AND (r.road_name LIKE '%$search%' OR t.fromm LIKE '%$search%' OR t.too LIKE '%$search%' OR t.status LIKE '%$search%')";
                              }

                              $roads_routes = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.road_id = t.road_id $condition");
                              $x = 1;
                              while ($rx = $roads_routes->fetch(PDO::FETCH_OBJ)) { ?>
                                 <tr>
                                    <td><?= $rx->road_name; ?></td>
                                    <td><?= $rx->fromm . ' - ' . $rx->too; ?></td>
                                    <td><?= $rx->status; ?></td>
                                 </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>   
         </div>
      </div>
   </div>
   <?php }else{ ?>
      <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h3 style="text-align:center;">Welcome <?=$fullname; ?> !</h3><br/>
               <div class="main-header">
                  <h4>Where are you going?</h4>
                  <form method="GET" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Traffic Point">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="row dashboard-header"> 
            <div class="card">
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>Road</th>
                                 <th>Traffic Point</th>
                                 <th>Traffic Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_GET['search']) && !empty($_GET['search'])) {
                                 $search = $_GET['search'];
                                 $condition = " AND (r.road_name LIKE '%$search%' OR t.fromm LIKE '%$search%' OR t.too LIKE '%$search%' OR t.status LIKE '%$search%')";
                              }

                              $roads_routes = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.road_id = t.road_id $condition");
                              $x = 1;
                              while ($rx = $roads_routes->fetch(PDO::FETCH_OBJ)) { ?>
                                 <tr>
                                    <td><?= $rx->road_name; ?></td>
                                    <td><?= $rx->fromm . ' - ' . $rx->too; ?></td>
                                    <td><?= $rx->status; ?></td>
                                 </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>   
         </div>
      </div>
   </div>
   <?php } ?>
<?php }elseif ($role == 'user' && $location == 'Bweyogerere Police Station') {   
  if (isset($_REQUEST['traffic_points'])) { ?>
       <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h3 style="text-align:center;">Welcome <?=$fullname; ?> !</h3><br/>
               <div class="main-header">
                  <h4>Where are you going?</h4>
                  <form method="GET" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Traffic Point">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="row dashboard-header"> 
            <div class="card">
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>Road</th>
                                 <th>Traffic Point</th>
                                 <th>Traffic Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_GET['search']) && !empty($_GET['search'])) {
                                 $search = $_GET['search'];
                                 $condition = " AND (r.road_name LIKE '%$search%' OR t.fromm LIKE '%$search%' OR t.too LIKE '%$search%' OR t.status LIKE '%$search%')";
                              }

                              $roads_routes = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.road_id = t.road_id $condition");
                              $x = 1;
                              if ($roads_routes->rowCount() > 0) {
                              while ($rx = $roads_routes->fetch(PDO::FETCH_OBJ)) { ?>
                                 <tr>
                                    <td><?= $rx->road_name; ?></td>
                                    <td><?= $rx->fromm . ' - ' . $rx->too; ?></td>
                                    <td><?= $rx->status; ?></td>
                                 </tr>
                              <?php } 
                              } else {
                                 // No results found, display an error message
                                 echo '<p>No results found for the specified search.</p>';
                              } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>   
         </div>
      </div>
   </div>
   <?php }else{ ?>
      <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid" style="background-color:#e5e5e5">
         <div class="row">
            <div class="main-header">
               <h3 style="text-align:center;">Welcome <?=$fullname; ?> !</h3><br/>
               <div class="main-header">
                  <h4>Where are you going?</h4>
                  <form method="GET" action="">
                     <input type="text" style="margin-top:20px;border-radius:5px; padding:8px; width:50%;" name="search" placeholder="Search by Road or Traffic Point">
                     <button type="submit" style="margin-top:20px; background-color:black; color:white; border-radius:5px; padding:8px;">Search</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="row dashboard-header"> 
            <div class="card">
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>Road</th>
                                 <th>Traffic Point</th>
                                 <th>Traffic Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $condition = ""; // Initialize the condition for the SQL query

                              if (isset($_GET['search']) && !empty($_GET['search'])) {
                                 $search = $_GET['search'];
                                 $condition = " AND (r.road_name LIKE '%$search%' OR t.fromm LIKE '%$search%' OR t.too LIKE '%$search%' OR t.status LIKE '%$search%')";
                              }

                              $roads_routes = $dbh->query("SELECT * FROM roads r, traffic_points t WHERE r.road_id = t.road_id $condition");
                              $x = 1;
                              while ($rx = $roads_routes->fetch(PDO::FETCH_OBJ)) { ?>
                                 <tr>
                                    <td><?= $rx->road_name; ?></td>
                                    <td><?= $rx->fromm . ' - ' . $rx->too; ?></td>
                                    <td><?= $rx->status; ?></td>
                                 </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>   
         </div>
      </div>
   </div>
   <?php } ?>
<?php } ?>
<?php include 'footer.php'; ?>