<?php
  session_start();
  include "core/conn.php";
  error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IMO Quesioner | Create your Question and Share to your Friends</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="home.html" class="navbar-brand">
        <span class="brand-text font-weight-light">IMO Quesioner</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
            <a href="#help-center" class="nav-link">Help Center</a>
        </li>
        <li class="nav-item dropdown">
        <?php
            if ($_SESSION['authenticated'] == true) {
              echo 
                '<a id="dropdownAccounts" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">'.$_SESSION['name'].'</a>';
            } else {
              echo 
                '<a id="dropdownAccounts" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Account</a>';
            }
        ?>

            <ul aria-labelledby="dropdownAccounts" class="dropdown-menu border-0 shadow">
            <?php
              if ($_SESSION['authenticated'] == true) {
                echo 
                  '<li><a href="question.php" class="dropdown-item"><i class="fas fa-tasks mr-2"></i>Manage Question</a></li>
                  <li><a href="answer.php" class="dropdown-item"><i class="fas fa-tasks mr-2"></i>Manage Answer</a></li>
                  <li><a href="./core/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i>Log Out</a></li>';
              } else {
                echo 
                  '<li><a href="login.php" class="dropdown-item"><i class="fas fa-sign-in-alt mr-2"></i>Sign in</a></li>
                  <li><a href="register.php" class="dropdown-item"><i class="fas fa-user-plus mr-2"></i>Sign up</a></li>';
              }
            ?>
            </ul>
        </li>
        <li class="nav-item ml-4">
            <a href="question_maker.php" class="btn btn-outline-primary"><i class="fas fa-pencil-alt mr-2"></i>Make a Question</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><small>Ask questions and share to your friends</small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="index.php">All Quesioner</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
        <?php
        $query = mysqli_query($connect, "SELECT * FROM quest");

        if (mysqli_num_rows($query) > 0) {
          while($data = mysqli_fetch_array($query))
          {
            ?>
            <div class="col-lg-6">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="card-title m-0"><?= $data['name'] ?></h5>
                </div>
                <div class="card-body">
                  <h6 class="card-title mb-2"><?= $data['title']  ?></h6>

                  <p class="card-text lead"><?= substr($data['content'], 0, 100) ?>..</p>
                  
                  <?php
                    if ($data['footnote'] != 'none') {
                      echo "<span><small>- ".$data['footnote']. "</small></span>";
                    };
                  ?>

                  <hr class="my-4">

                  <button type="button" class="btn btn-outline-primary" data-id="<?= $data['id'] ?>" data-toggle="modal" data-target="#link-modal"><i class="fa fa-share-alt mr-2"></i>Share with Friends</button>
                  <button onclick="location.href= 'question_answer.php?id=<?= $data['id'] ?>&userid=<?= $_SESSION['id'] ?>';" type="button" class="btn btn-primary float-right"><i class="fas fa-edit mr-2"></i>Take a Survey</button>
                </div>
              </div>
            </div>
            <!-- /.col-md-6 -->
              <?php
            }
        } else {
          echo 
          '<div class="col-lg-12 text-center">

            <h3><i class="fas fa-info-circle"></i> No questions yet.</h3>
  
            <p>
              Create your new question and share it with the world <a href="question_maker.php">here</a>.
            </p>

          </div>
          <!-- /.col -->';
        }

        ?>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

      <!-- link modal -->
      <div class="modal fade" id="link-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Copy link</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-center">Copy the following link and share with your friends</p>

              <div class="form-group">
                <input type="text" id="link" class="form-control text-center" value="http://localhost/survey/" readonly>
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button onclick="copyLink()" type="button" class="btn btn-primary">Copy</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- Spesifi script -->
<script>
  $(document).ready(function() {
    $('#link-modal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var link = button.data('id')

      var modal = $(this)
      modal.find('.modal-body input#link').val("https://localhost/survey/question_answer.php?id=" + link)
    });
  });

  function copyLink() {
    /* Get the text field */
    var copyText = document.getElementById("link");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Text copied successfully");
  }
</script>
</body>
</html>
