<?php include 'header.php'; ?>

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
                  <span class="label label-warning">Road Users</span>
                  <div class="side-box">
                     <i class="ti-user text-warning-color"></i>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <span>Roads</span>
                  <?php $rds = $dbh->query("SELECT * FROM roads ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><?=number_format($rds); ?></h2>
                  <span class="label label-primary">Roads</span>
                  <div class="side-box ">
                     <i class="fa fa-road"></i>
                     <!-- <i class="ti-map text-primary-color"></i> -->
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <span>Officers</span>
                  <?php $officers = $dbh->query("SELECT * FROM users WHERE role = 'officer' ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($officers); ?></span></h2>
                  <span class="label label-success">Officers</span>
                  <div class="side-box">
                     <i class="ti-direction-alt text-success-color"></i>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6">
               <div class="card dashboard-product">
                  <span>Routes</span>
                  <?php $rts = $dbh->query("SELECT * FROM routes ")->rowCount(); ?>
                  <h2 class="dashboard-total-products"><span><?=number_format($rts); ?></span></h2>
                  <span class="label label-danger">Routes</span>
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

<?php include 'footer.php'; ?>