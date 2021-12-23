<?php

    session_start();

    include "./core/conn.php";

    if ($_SESSION['authenticated'] == false)
    {
        header("location: ./login.php");
    }

?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IMO Quesioner | Create Question</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./plugins/summernote/summernote-bs4.min.css">
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
          <a id="dropdownAccounts" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?= $_SESSION['name'] ?></a>

            <ul aria-labelledby="dropdownAccounts" class="dropdown-menu border-0 shadow">
              <li><a href="question.php" class="dropdown-item"><i class="fas fa-tasks mr-2"></i>Manage Question</a></li>
              <li><a href="answer.php" class="dropdown-item"><i class="fas fa-tasks mr-2"></i>Manage Answer</a></li>
              <li><a href="./core/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i>Log Out</a></li>
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
    <section class="content-header">
      <div class="container-fluid w-75">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><small>Create new Question</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Create Quesioner</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid w-75">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">New Quesioner</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- text input -->
            <form action="./core/quest_save.php" method="POST">
                <input type="hidden" name="name" value="<?php echo $_SESSION['name']; ?>">
                <div class="form-group">
                    <label>Quesioner Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter new title ..." required>
                </div>
                <hr class="my-4">
                <!-- textarea -->
                <div class="form-group">
                    <label>Quesioner Body</label>
                    <textarea name="content" id="summernote">
                        Place <em>some</em> <u>text</u> <strong>here</strong>
                    </textarea>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label>Foot note (optional)</label>
                    <input type="text" name="footnote" class="form-control" placeholder="Enter anything ...">
                </div>
                <!-- /.form-group -->

                <hr class="my-4">
                <button onclick="location.href = 'index.php'; return false;" type="button" class="btn btn-default"><i class="fas fa-arrow-circle-left mr-2"></i> Return to Home</button>
                <div class="float-right">
                    <button type="reset" class="btn btn-default pl-4 pr-4 mr-1">Reset</button>
                    <button type="submit" class="btn btn-primary pl-4 pr-4">Publish <i class="far fa-share-square ml-2"></i></button>
                </div>
            </form>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            This questionnaire is created and shared by you, we will take action against any misuse, see <a href="">privacy and rules</a>
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.container-fluid -->
    </section>
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
<!-- Summernote -->
<script src="./plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>

<!-- Page specific script -->
<script>

    $(function () {
      // Summernote
      $('#summernote').summernote()
  
    })
  </script>
</body>
</html>
