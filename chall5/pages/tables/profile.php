<?php
  include_once "../../db.php";

  $id = intval($_GET['user']);
  $ka = $conn->prepare("SELECT * FROM user WHERE pid=$id");
  $ka->execute();
  while ($rt = $ka->fetch()) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Profile</title>
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

<body style="background-color: #eee;">
    <section>
    <div class="container py-5">
        <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
            <div class="card-body text-center">
                <?php
                    if(!$rt['avatar']) echo '<img src="https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png" class="rounded-circle img-fluid" style="width: 150px;">';
                    else echo '<img src="../../photo/'.$rt['avatar'].'" class="rounded-circle img-fluid" style="width: 150px;">';
                    echo '<h5 class="my-3">'.$rt['user'].'</h5>';
                    echo '<p class="text-muted mb-4">'.$rt['bio'].'</p>';
                    if($rt['pid']!=$_SESSION['pid'])
                        echo '<div class="d-flex justify-content-center mb-2"><button class="btn btn-outline-primary ms-1"><a href="../chat/chat.php?user='.$id.'" style="text-decoration: none;">Message</a></button></div>';
                ?>
            </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                <div class="col-sm-3">
                    <p class="mb-0">Full Name</p>
                </div>
                <div class="col-sm-9">
                    <?php
                        echo '<p class="text-muted mb-0">'.$rt['name'].'</p>';
                    ?>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-sm-3">
                    <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                    <?php
                        echo '<p class="text-muted mb-0">'.$rt['email'].'</p>';
                    ?>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-sm-3">
                    <p class="mb-0">Phone</p>
                </div>
                <div class="col-sm-9">
                    <?php
                        echo '<p class="text-muted mb-0">'.$rt['sdt'].'</p>';
                    ?>
                </div>
                </div>
            </div>
            </div>
            <?php } ?>
        </div>
        </div>
    </div>
    </section>
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