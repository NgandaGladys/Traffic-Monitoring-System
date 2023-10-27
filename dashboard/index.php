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
               <h4>Trafic Officers / Admins</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text">Officers / Admins</h5>
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
   <!-- Hover effect table ends -->
   <?php }elseif (isset($_REQUEST['users'])) { ?>
       <!-- Sidebar chat end-->
   <div class="content-wrapper">
      <!-- Container-fluid starts -->
      <!-- Main content starts -->
      <div class="container-fluid">
         <div class="row">
            <div class="main-header">
               <h4>Road Users</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text">Road Users</h5>
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
                                    <a onclick="return confirm('Do you really want to delete this user?. '); " href="?delete-user=<?=$rx->userid; ?>" class="btn btn-danger">Delete</a>
                                 </td>
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
               <h4>Road Users</h4>
            </div>
         </div>
         <!-- 4-blocks row start -->
         <div class="row dashboard-header">
             <div class="card">
               <div class="card-header">
                  <h5 class="card-header-text">Road Users - <a href="#addroad" data-toggle="modal" class="btn btn-primary">Add Road</a></h5>
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
                                 <td><a href="" class="btn btn-primary">Edit</a></td>
                                 <td><a href="?delete-road=<?=$rx->road_id; ?>" class="btn btn-danger">Delete</a></td>
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
   <?php }elseif (isset($_REQUEST['delete-road'])) { 
      dbDelete('roads','road_id',$_REQUEST['delete-road']);
      redirect_page('?roads'); ?>

   <?php }elseif (isset($_REQUEST[''])) { ?>

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
               <?php $users = $dbh->query("SELECT * FROM users ")->rowCount(); ?>
                  <span>Users</span>
                  <h2 class="dashboard-total-products"><?=number_format($users); ?></h2>
                  <span class="label label-warning"><a style="text-decoration: none; color: #FFF; " href="?roads">Road Users</a></span>
                  <div class="side-box">
                     <i class="ti-user text-warning-color"></i>
                  </div>
               </div>
            </div>
             <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <span>Officers</span>
                  <?php $officers = $dbh->query("SELECT * FROM users WHERE role = 'officer' ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($officers); ?></span></h2>
                  <span class="label label-success"><a style="text-decoration: none; color: #FFF; " href="?officers">Officers</a></span>
                  <div class="side-box">
                     <i class="icon-user text-primary-color"></i>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <span>Roads</span>
                  <?php $rds = $dbh->query("SELECT * FROM roads ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><?=number_format($rds); ?></h2>
                  <span class="label label-primary"><a style="text-decoration: none; color: #FFF; " href="?roads">Roads</a></span>
                  <div class="side-box ">
                     <i class="icon-map text-primary-color"></i>
                     <!-- <i class="ti-direction-alt text-primary-color"></i> -->
                  </div>
               </div>
            </div>
           
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <span>Routes</span>
                  <?php $rts = $dbh->query("SELECT * FROM routes ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($rts); ?></span></h2>
                  <span class="label label-danger"><a style="text-decoration: none; color: #FFF; " href="?routes">Routes</a></span>
                  <div class="side-box">
                     <i class="ti-rocket text-danger-color"></i>
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

<?php }elseif ($role == 'user') { ?>
   
<?php } ?>

<?php include 'footer.php'; ?>