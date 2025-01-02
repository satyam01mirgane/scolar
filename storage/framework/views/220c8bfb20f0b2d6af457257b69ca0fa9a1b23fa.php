<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo e(app_setting()->site_title); ?></title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <!--Favicon-->
  <link rel="icon" href="<?php echo e(asset(app_setting()->favicon)); ?>" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/style.css')); ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#" role="button"></a>
      </li>     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <!--<a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>-->
<!-- Notifications Dropdown Menu -->
<!--<li class="nav-item dropdown">
  <a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <span class="badge badge-warning navbar-badge">15</span>
  </a>
  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-item dropdown-header">15 Notifications</span>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">
      <i class="fas fa-envelope mr-2"></i> 4 new messages
      <span class="float-right text-muted text-sm">3 mins</span>
    </a>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">
      <i class="fas fa-users mr-2"></i> 8 friend requests
      <span class="float-right text-muted text-sm">12 hours</span>
    </a>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">
      <i class="fas fa-file mr-2"></i> 3 new reports
      <span class="float-right text-muted text-sm">2 days</span>
    </a>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
  </div>
</li>-->
<?php
if(isset(Auth::user()->photo))
{
	$photo = asset('profile/'.Auth::user()->photo);
}else{
	$photo = asset('user.png');
}
?>
      <!-- Messages Dropdown Menu -->
      <li>
        <div class="user-panel pb-3 d-flex">
          <div class="image">
            <img src="<?php echo e($photo); ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="Javascript:;" class="d-block"><?php echo e(Auth::user()->name); ?></a>
          </div>
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->
<?php /**PATH D:\New folder\htdocs\RUN\resources\views/front/common/profile-header.blade.php ENDPATH**/ ?>