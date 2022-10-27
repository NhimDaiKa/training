<?php
    
    include_once "../../db.php";
    if(!isset($_SESSION['usr']))
      header("Location: /index.php");

    $id = $_SESSION['pid'];
    $ka = $conn->prepare("SELECT * FROM user WHERE pid=$id");
    $ka->execute();
    $rt = $ka->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Create User</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../../vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../../vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <!-- endinject -->
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Welcome Back, <span class="text-black fw-bold"><?php echo $rt['name']; ?></span></h1>
            <h3 class="welcome-sub-text">Thông tin cá nhân</h3>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <form class="search-form" action="#">
              <i class="icon-search"></i>
              <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form>
          </li>
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <?php 
                if(!$rt['avatar'])
                  echo '<img class="img-xs rounded-circle" src="https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png"> </a>';
                else echo '<img class="img-xs rounded-circle" src="../../photo/'.$rt['avatar'].'"> </a>';
              ?>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <?php 
                  if(!$rt['avatar'])
                    echo '<img class="img-sm rounded-circle" src="https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png">';
                  else echo '<img class="img-sm rounded-circle" src="../../photo/'.$rt['avatar'].'">';
                ?>
                <p class="mb-1 mt-3 font-weight-semibold"><?php echo $rt['name']; ?></p>
                <p class="fw-light text-muted mb-0"><?php echo $rt['email']; ?></p>
              </div>
              <a class="dropdown-item" href="../profile/profile.php"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
              <a class="dropdown-item" href="../../"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border me-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border me-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../../dashboard.php">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Thông tin</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Danh sách</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../../pages/tables/basic-table.php">Danh sách sinh viên</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item nav-category">pages</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../profile/profile.php"> Profile </a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../../index.php"> Logout </a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-5 grid-margin stretch-card">
                <div class="container py-5">
                    <div class="col-lg-10">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <?php
                                    if(!$rt['avatar']) echo '<img src="https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png"
                                    class="rounded-circle img-fluid" style="width: 150px;">';
                                    else echo '<img src="../../photo/'.$rt['avatar'].'" class="rounded-circle img-fluid" style="width: 150px; height:150px;">';
                                    echo '<h5 class="my-3">'.$rt['user'].'</h5>';
                                    echo '<p class="text-muted mb-4">'.$rt['bio'].'</p>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Chỉnh sửa thông tin</h4>
                  <p class="card-description">
                    Thay đổi thông tin
                  </p>
                  <form class="forms-sample" method="POST" action="editprofile.php" enctype="multipart/form-data">
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email" name="email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputMobile" placeholder="Mobile number" name="number">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Bio</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputMobile" placeholder="Bio" name="bio">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name="pass">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Profile Picture</label>
                      <div class="col-sm-9">
                        <input type="file" class="form-control" id="exampleInputMobile" name="image">
                      </div>
                    </div>
                    <button class="btn btn-primary me-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../vendors/select2/select2.min.js"></script>
  <script src="../../vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../js/file-upload.js"></script>
  <script src="../../js/typeahead.js"></script>
  <script src="../../js/select2.js"></script>
  <!-- End custom js for this page-->
</body>

</html>