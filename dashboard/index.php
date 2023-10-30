<?php include 'header.php';
if ($role == 'admin') { 
   if (isset($_REQUEST['officers'])) { ?>
     <!-- Hover effect table starts -->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid">
         <div class="row">
            <div class="main-header">
               <h4>Traffic Officers / Admins</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text">Officers / Admins  - <a href="#addofficer" class="btn btn-primary" data-toggle="modal">Add Officer</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
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
                           <?php $users = $dbh->query("SELECT * FROM users WHERE role ='admin' ORDER BY userid DESC ");
                           $x = 1;
                           while($rx = $users->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <td><?=$x++; ?></td>
                                 <td><?=$rx->fullname; ?></td>
                                 <td><?=$rx->phone; ?></td>
                                 <td><?=$rx->email; ?></td>
                                 <td><?=$rx->role; ?></td>
                                 <td><?=$rx->date_registered; ?></td>
                                 <td>
                                    <a href="#edit-user<?=$rx->userid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('Do you really want to delete this officer?. '); " href="?delete-user=<?=$rx->userid; ?>" class="btn btn-danger">Delete</a>
                                 </td>
                              </tr>
                           <?php include 'edit-user.php'; } ?>
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
   <!-- Hover effect table ends -->
   <?php }elseif (isset($_REQUEST['users'])) { ?>
       <!-- Sidebar chat end-->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid">
         <div class="row">
            <div class="main-header">
               <h4>Non-officers</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text">Non-officers</h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                       <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
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
                           <?php $users = $dbh->query("SELECT * FROM users WHERE role ='user' ORDER BY userid DESC ");
                           $x = 1;
                           while($rx = $users->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <td><?=$x++; ?></td>
                                 <td><?=$rx->fullname; ?></td>
                                 <td><?=$rx->phone; ?></td>
                                 <td><?=$rx->email; ?></td>
                                 <td><?=$rx->role; ?></td>
                                 <td><?=$rx->date_registered; ?></td>
                                 <td>
                                    <a href="#edit-user<?=$rx->userid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('Do you really want to delete this user?. '); " href="?delete-user=<?=$rx->userid; ?>" class="btn btn-danger">Delete</a>
                                 </td>
                              </tr>
                           <?php include 'edit-user.php'; } ?>
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
   <?php }elseif (isset($_REQUEST['delete-user'])) { 
      dbDelete('users','userid',$_REQUEST['delete-user']);
      redirect_page('?users'); ?>
   <?php }elseif (isset($_REQUEST['roads'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid">
         <div class="row">
            <div class="main-header">
               <h4>Road</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text">Road - <a href="#addroad" data-toggle="modal" class="btn btn-primary">Add Road</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Road Name</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php $roads = $dbh->query("SELECT * FROM roads ");
                           $x = 1; 
                           while($rx = $roads->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <td><?=$x++; ?></td>
                                 <td><?=$rx->road_name; ?></td>
                                 <td><a href="#edit-road<?=$rx->road_id; ?>" data-toggle="modal" class="btn btn-primary">Edit</a></td>
                                 <td><a onclick="return confirm('Do you really want to delete this Road?. '); " href="?delete-road=<?=$rx->road_id; ?>" class="btn btn-danger">Delete</a></td>
                              </tr>
                           <?php include 'edit-road.php'; } ?>
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

   <?php }elseif (isset($_REQUEST['routes'])) { ?>
      <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid">
         <div class="row">
            <div class="main-header">
               <h4>Routes</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text">Routes - <a href="#addroute" data-toggle="modal" class="btn btn-primary">Add Route</a></h5>
               </div>
               <div class="card-block">
                  <div class="row">
                     <div class="col-sm-12 table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Road Name</th>
                                 <th>Routes</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php $roads_routes = $dbh->query("SELECT * FROM roads r, routes t WHERE r.road_id = t.road_id ");
                           $x = 1; 
                           // `rid`, `road_id`, `fromm`, `too`, `status`
                           while($rx = $roads_routes->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <td><?=$x++; ?></td>
                                 <td><?=$rx->road_name; ?></td>
                                 <td><?=$rx->fromm.' - '.$rx->too; ?></td>
                                 <td></td>
                                 <td>
                                    <a href="#edit-route<?=$rx->rid; ?>" data-toggle="modal" class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('Do you really want to delete this Road?. '); " href="?delete-road=<?=$rx->road_id; ?>" class="btn btn-danger">Delete</a></td>
                              </tr>
                           <?php include 'edit-route.php'; } ?>
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
      <div class="container-fluid">
         <div class="row">
            <div class="main-header">
               <h4>Dashboard</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
               <?php $users = $dbh->query("SELECT * FROM users WHERE role = 'user' ")->rowCount(); ?>
                  <span>Users</span>
                  <h2 class="dashboard-total-products"><?=number_format($users); ?></h2>
                  <span class="label label-warning"><a style="text-decoration: none; color: #FFF; " href="?users">Users</a></span>
                  <div class="side-box">
                     <i class="ti-user text-warning-color"></i>
                  </div>
               </div>
            </div>
             <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <span>Officers</span>
                  <?php $officers = $dbh->query("SELECT * FROM users WHERE role = 'admin' ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($officers); ?></span></h2>
                  <span class="label label-warning"><a style="text-decoration: none; color: #FFF; " href="?officers">Officers</a></span>
                  <div class="side-box">
                     <i class="icon-user text-warning-color"></i>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <span>Roads</span>
                  <?php $rds = $dbh->query("SELECT * FROM roads ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><?=number_format($rds); ?></h2>
                  <span class="label label-warning"><a style="text-decoration: none; color: #FFF; " href="?roads">Roads</a></span>
                  <div class="side-box ">
                     <i class="icon-map text-warning-color"></i>
                     <!-- <i class="ti-direction-alt text-primary-color"></i> -->
                  </div>
               </div>
            </div>
           
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <span>Routes</span>
                  <?php $rts = $dbh->query("SELECT * FROM routes ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($rts); ?></span></h2>
                  <span class="label label-warning"><a style="text-decoration: none; color: #FFF; " href="?routes">Routes</a></span>
                  <div class="side-box">
                     <i class="ti-rocket text-warning-color"></i>
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

<?php }elseif ($role == 'user') { 
   if (isset($_REQUEST['roads'])) { ?>
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid">
         <div class="row">
            <div class="main-header">
               <h4>Road</h4>
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
                                 <th>#</th>
                                 <th>Road Name</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php $roads = $dbh->query("SELECT * FROM roads ");
                           $x = 1; 
                           while($rx = $roads->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <td><?=$x++; ?></td>
                                 <td><?=$rx->road_name; ?></td>
                                 <td><a href="#google-map<?=$rx->road_id; ?>" data-toggle="modal" class="btn btn-primary">View in Google Map</a></td>
                              </tr>
                           <?php include 'google-map.php'; } ?>
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
  <?php }elseif (isset($_REQUEST['routes'])) { ?>
    <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid">
         <div class="row">
            <div class="main-header">
               <h4>Routes</h4>
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
                                 <th>#</th>
                                 <th>Road Name</th>
                                 <th>Routes</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php $roads_routes = $dbh->query("SELECT * FROM roads r, routes t WHERE r.road_id = t.road_id ");
                           $x = 1; 
                           // `rid`, `road_id`, `fromm`, `too`, `status`
                           while($rx = $roads_routes->fetch(PDO::FETCH_OBJ)){ ?>
                              <tr>
                                 <td><?=$x++; ?></td>
                                 <td><?=$rx->road_name; ?></td>
                                 <td><?=$rx->fromm.' - '.$rx->too; ?></td>
                                 <td><?=$rx->status; ?></td>
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
   <?php }else{ ?>
      <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid">
         <div class="row">
            <div class="main-header">
               <h4>Welcome <?=$fullname; ?> !</h4>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>
<?php } ?>
<?php include 'footer.php'; ?>