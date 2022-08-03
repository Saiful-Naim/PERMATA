<?php 
  // save as dashboard.php
  session_start();
  include('connection.php');
  if(!isset($_SESSION['userlogged']) || $_SESSION['userlogged'] !=1) {
      header("Location: index.php");
  }

  // $activity_no = $_POST['activity_no'];

  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div> -->

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="dashboard_admin.php" class="nav-link">Halaman Utama</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/uitm-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PERMATA</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['USER_NAME'];?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="dashboard_admin.php" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Halaman Utama
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-folder"></i>
                <p>
                  Permohonan Pelajar
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="table_application.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Senarai Permohonan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="admin_proses.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permohonan Diproses</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permohonan Diluluskan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="admin_rejected.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permohonan Ditolak</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="pages/table_user.php" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Senarai Pengguna
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="plogout.php" class="nav-link" style="background-color: #a83232;">
                <i class="nav-icon fas fa-door-open"></i>
                <p>
                  Log Keluar
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Senarai Permohonan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Senarai Permohonan</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Senarai Permohonan Aktiviti Pelajar</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Bil.</th>
                      <th>Nama Aktiviti</th>
                      <th>Penganjur</th>
                      <!-- <th>Pengajur Bersama</th> -->
                      <th>Tarikh Aktiviti</th>
                      <!-- <th>Peringkat</th> -->
                      <th>Pengarah Program</th>
                      <!-- <th>Penasihat Kelab</th> -->
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      include("connection.php");
                      $sql = "SELECT a.activity_no, a.activity_name, o.organization_name, a.coorganizer, a.activity_date, l.level_name, a.studentno, s.studentname, a.club_advisor_name, a.application_status
                      from activity a 
                      join students s on s.studentno = a.studentno
                      join levels l on l.level_id = a.level_id
                      join organization o on o.organization_id = a.organization_id
                      where a.application_status = 'APPROVED';";
                      $qry = mysqli_query($conn, $sql);
                      $row = mysqli_num_rows($qry);

                      if($row >= 0)
                      {
                          // $counter = 1;
                          while($d = mysqli_fetch_assoc($qry))
                          {
                      ?>
                  <tr>
                      <td><?php echo $d['activity_no']; ?></td>
                      <td><?php echo $d['activity_name']; ?></td>
                      <td><?php echo $d['organization_name']; ?></td>
                      <!-- <td><?php echo $d['coorganizer']; ?></td> -->
                      <td><?php echo $d['activity_date']; ?></td>
                      <!-- <td><?php echo $d['level_name']; ?> </td> -->
                      <td><?php echo $d['studentname']; ?></td>
                      <!-- <td><?php echo $d['club_advisor_name']; ?></td> -->
                      <td><span class="badge badge-success"><?php echo $d['application_status']; ?></span></td>
                      <td>
                          <div class="btn-group">
                            <!-- <form action="tableadmin_view.php" method="POST" class="action-form-child"> -->
                            <button type="submit" onclick="window.location.href='tableadmin_view_approve.php?activity_no=<?php echo $d['activity_no']; ?>'" class="btn btn-primary btnn-block btn-sm fas fa-eye"></button>     
                            <button type="submit" onclick="window.location.href='action_delete.php?activity_no=<?php echo $d['activity_no']; ?>'" name="id" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                          </div>
                      </td>
                  </tr>
                  <?php
                              // $counter++;
                          } // close while() @ line #
                      } // close if($row > 0) @ line 
                  ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2022 HEP UiTM Raub</a>. All rights reserved.</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Page specific script -->

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  </body>
  </html>
