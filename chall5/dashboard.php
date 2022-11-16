<?php

  include_once "db.php";
  if(!isset($_SESSION['pid'])) header("Location: /index.php");

  $pid = $_SESSION['pid'];
  $data = $conn->query("SELECT * FROM user where pid=$pid");
  $data->execute();
  $data = $data->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- inject:js -->
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/1c24ae6fde.js" crossorigin="anonymous"></script>
  <!-- endinject -->
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
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
            <h1 class="welcome-text">Welcome Back, <span class="text-black fw-bold"><?php echo $data['name']; ?></span></h1>
            <h3 class="welcome-sub-text">Your performance summary </h3>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item d-none d-lg-block">
            <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
              <span class="input-group-addon input-group-prepend border-right">
                <span class="icon-calendar input-group-text calendar-icon"></span>
              </span>
              <input type="text" class="form-control">
            </div>
          </li>
          <li class="nav-item">
            <form class="search-form" action="#">
              <i class="icon-search"></i>
              <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form>
          </li>
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <?php 
              if($data['avatar'])
                echo '<img class="img-xs rounded-circle" src="photo/'.$data['avatar'].'"></a>';
              else echo '<img class="img-xs rounded-circle" src="https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png"</a>';
              ?>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <?php
                if($data['avatar'])
                  echo '<img class="img-sm rounded-circle" src="photo/'.$data['avatar'].'">';
                else echo '<img class="img-sm rounded-circle" src="https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png" alt="Profile image">';
                ?>
                <p class="mb-1 mt-3 font-weight-semibold"><?php echo $data['name']; ?></p>
                <p class="fw-light text-muted mb-0"><?php echo $data['email']; ?></p>
              </div>
              <a class="dropdown-item" href="pages/profile/profile.php"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
              <a class="dropdown-item" href="index.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
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
      <!-- partial:partials/_settings-panel.html -->
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
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
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
                <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.php">Danh sách sinh viên</a></li>
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
                <li class="nav-item"> <a class="nav-link" href="pages/profile/profile.php"> Profile </a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="index.php"> Logout </a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link ps-0" id="home-tab" data-toggle="tab" href="#overview">Bài tập</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#challenge">Challenge</a>
                    </li>
                  </ul>
                </div>
                <div class="tab-content tab-content-basic">
                  <div  id="overview" class="tab-pane fade show active">
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                      <h4 class="card-title card-title-dash">Bài tập</h4>
                                      <?php if($data['role']==1){
                                        echo '<div class="add-items d-flex mb-0">
                                                <button class="btn btn-primary btn-me text-white mb-0 me-0" ><a href="pages/homework/create.php" style="color:white; text-decoration:none;">Thêm bài tập</a></button>
                                              </div>';
                                      } ?>
                                    </div>
                                    <div class="list-wrapper">
                                      <ul class="todo-list todo-list-rounded">
                                        <?php 
                                          $ka = $conn->prepare("SELECT * FROM hwt ORDER BY date DESC");
                                          $ka->execute();
                                          while($rt = $ka->fetch()){
                                        ?>
                                        <li class="d-block">
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <h5>Bài tập: <?php echo $rt['name']; ?></h5>
                                            </label>
                                            <label class="form-check-label">
                                              <a href=<?php echo '"pages/homework/download.php?file='.$rt['file'].'">'.$rt['file']; ?></a>
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3"><?php echo $rt['date']; ?></div>
                                            </div><br>
                                            <form class="forms-sample" method="POST" action="pages/homework/submithw.php?hw=<?php echo $rt['hid']; ?>" enctype="multipart/form-data">
                                              <div class="form-group row" style="height:40px;">
                                                <label for="exampleInputPassword2" class="col-sm-1 col-form-label" style="margin-left:30px;"><h5>Nộp bài</h5></label>
                                                <div class="col-sm-6">
                                                  <input type="file" class="form-control" name="file" required>
                                                </div>
                                                <div class="col-sm-3">
                                                  <button class="btn btn-primary btn-icon-text" style="color:white">
                                                    <i class="ti-file btn-icon-prepend"></i>Submit
                                                  </button>
                                                </div>
                                              </div>
                                            </form>
                                            <?php 
                                              $prj_id = $rt['hid'];
                                              if($data['role']==1){ 
                                                $na = $conn->prepare("SELECT * FROM hws WHERE prj_id=$prj_id");
                                                $na->execute();
                                                $count = 1;
                                                while($r = $na->fetch()){
                                            ?>
                                              <label class="form-check-label">
                                                <?php 
                                                  echo $count.', '.$r['user']." "; 
                                                  $count++; 
                                                ?>
                                                <a href=<?php echo '"pages/homework/downhw.php?file='.$r['file'].'">'.$r['file']; ?></a>
                                              </label>
                                              <div class="d-flex mt-2">
                                                <div class="ps-4 text-small me-3"><?php echo $r['date']; ?></div>
                                              </div>
                                            <?php 
                                                }
                                              }
                                              else {
                                                $pid = $_SESSION['pid'];
                                                $na = $conn->prepare("SELECT * FROM hws WHERE (prj_id=$prj_id AND pid=$pid)");
                                                $na->execute();
                                                $count=1;
                                                while($r = $na->fetch()){
                                            ?>
                                                <label class="form-check-label">
                                                  <?php 
                                                    echo $count.', '.$r['user']." "; 
                                                    $count++;
                                                  ?>
                                                  <a href=<?php echo '"pages/homework/downhw.php?file='.$r['file'].'">'.$r['file']; ?></a>
                                                </label>
                                                <div class="d-flex mt-2">
                                                  <div class="ps-4 text-small me-3"><?php echo $r['date']; ?></div>
                                                </div>
                                            <?php
                                                }
                                              }
                                            ?>
                                          </div>
                                        </li>
                                        <?php } ?>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <!-- </div>
                <div class="tab-content tab-content-basic"> -->
                  <div  id="challenge" class="tab-pane fade show active">
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                      <h4 class="card-title card-title-dash">Challenge</h4>
                                      <?php if($data['role']==1){
                                      echo '<div class="add-items d-flex mb-0">
                                              <button class="btn btn-primary btn-me text-white mb-0 me-0" ><a href="pages/challenge/create.php" style="color:white; text-decoration:none;">Thêm challenge</a></button>
                                            </div>';
                                      } ?>
                                    </div>
                                    <div class="list-wrapper">
                                      <ul class="todo-list todo-list-rounded">
                                        <?php 
                                          $ka = $conn->prepare("SELECT * FROM chall ORDER BY date DESC");
                                          $ka->execute();
                                          while($rt = $ka->fetch()){
                                        ?>
                                        <li class="d-block">
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <h5>Challenge: <?php echo $rt['name']; ?></h5>
                                            </label>
                                            <label class="form-check-label">
                                              Hint: <?php echo $rt['hint']; ?> 
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3"><?php echo $rt['date']; ?></div>
                                            </div><br>
                                            <form class="forms-sample" method="POST" action="pages/challenge/answer.php?cid=<?php echo $rt['cid']; ?>">
                                              <div class="form-group row">
                                                <label for="exampleInputPassword2" class="col-sm-1 col-form-label" style="margin-left:30px;"><h5>Trả lời</h5></label>
                                                <div class="col-sm-3">
                                                  <input type="text" class="form-control" name="ans" >
                                                </div>
                                                <div class="col-sm-3">
                                                  <button class="btn btn-primary btn-icon-text" style="color:white">Answer</button>
                                                </div>
                                              </div>
                                              
                                            </form>
                                            <?php 
                                              if(isset($_SESSION['ans'])){
                                                if($_SESSION['ans']==$rt['cid']){
                                                  $fh = fopen("pages/challenge/chall/".$rt['file'], 'r');
                                                  $pageText = fread($fh, 25000);
                                                  echo '<label class="form-check-label"><h6>Chúc mừng bạn đã trả lời đúng câu hỏi, sau đây là phần quà của bạn:</h6><br>'.nl2br($pageText).'</label>';
                                                  unset($_SESSION['ans']);
                                                }
                                              } 
                                            ?>
                                          </div>
                                        </li>
                                        <?php } ?>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/jquery.cookie.js" type="text/javascript"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
