<?php 
  session_start();
  include('connection.php');
  if(!isset($_SESSION['userlogged']) || $_SESSION['userlogged'] !=1) {
      header("Location: index.php");
  }

  $activity_no = $_GET['activity_no'];
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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<?php
      $sql = "SELECT c.category_id, c.description, a.activity_no, a.activity_name, o.organization_name, l.level_name, a.coorganizer, a.objective, a.purpose, a.activity_background, a.committee, a.activity_date, a.position, a.currentcgpa, a.club_advisor_name, a.club_advisor_email, s.studentname, s.studentemail, s.studentphoneno, a.escort_officer, a.total_men, a.total_women, a.KI_organizer, a.KI_participant, a.activity_conclusion
      from activity a 
      join students s on s.studentno = a.studentno
      join levels l on l.level_id = a.level_id
      join organization o on o.organization_id = a.organization_id
      join activity_category ac on ac.activity_no = a.activity_no
      join category c on c.category_id = ac.category_id
      where a.activity_no = '".$activity_no."'"; 
      $qry = mysqli_query($conn, $sql);
      $d = mysqli_fetch_assoc($qry);
  ?>
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
                <a href="table_application.php" class="nav-link active">
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
                <a href="admin_approved.php" class="nav-link">
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
            <h1>Permohonan Baru</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Permohonan Baru</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <form id="application" name="application" autocomplete="off" method="POST">
        <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <?php
                    if(isset($_SESSION['status']))
                    {
                      ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <?php echo $_SESSION['status']; ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      <?php
                      unset($_SESSION['status']);
                    }
                  
            ?>
            <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Keterangan Aktiviti</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Aktiviti/Program <i>(Sila Gunakan Huruf Besar)</i></label>
                        <input type="text" name="activity_name" class="form-control" value="<?php echo $d['activity_name'] ?>" id="activity_name" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Kelab/Persatuan</label>
                        <input type="text" name="organization_name" class="form-control" value="<?php echo $d['organization_name'] ?>" id="organization_name" disabled>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label>Kod Persatuan</label>
                        <input type="text" name="organization_id" class="form-control" id="organization_id">
                    </div>
                </div> -->
                <div class="col-md-6">
                    <div class="form-group">
                          <label>Peringkat Aktiviti</label>
                          <input type="text" name="level_name" class="form-control" value="<?php echo $d['level_name'] ?>" id="level_name" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Anjuran Bersama</label>
                        <input type="text" name="coorganizer" class="form-control" value="<?php echo $d['coorganizer'] ?>" id="coorganizer_name" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Objektif Aktiviti</label>
                        <textarea class="summernote" id="objective" name="objective" rows="3" disabled><?php echo $d['objective'] ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tujuan Program/Aktiviti</label>
                        <textarea class="summernote" id="purpose" id="purpose" rows="3" name="purpose" disabled><?php echo $d['purpose'] ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Latar Belakang Program/Aktiviti</label>
                          <textarea class="summernote" name="activity_background" id="activity_background" rows="3" disabled><?php echo $d['activity_background'] ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ahli Jawatankuasa</label>
                          <textarea class="summernote" name="committee" rows="3" id="committee" disabled><?php echo $d['committee'] ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kategori Aktiviti</label>
                        <input type="text" name="coorganizer" class="form-control" value="<?php echo $d['description'] ?>" id="coorganizer_name" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                          <label>Tarikh Aktiviti:</label>
                          <input type="text" name="activity_date" class="form-control" value="<?php echo $d['activity_date'] ?>" id="activity_date" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Pengarah Projek</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['studentname'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email Pengarah Projek</label>
                        <input type="email" class="form-control" name="studentemail" id="studentemail" value= "<?php echo $d['studentemail']; ?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jawatan</label>
                        <input type="text" class="form-control" name="position" value="<?php echo $d['position'] ?>" id="position" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No Telefon Bimbit</label>
                        <input type="text" class="form-control" name="studentphoneno" id="studentphoneno" value="<?php echo $d['studentphoneno']; ?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>CGPA Semasa</label>
                        <input type="number" step="0.01"  min="1.00" max="4.00" class="form-control" value="<?php echo $d['currentcgpa'] ?>" name="cgpa" id="" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Penasihat</label>
                        <input type="text" class="form-control" name="club_advisor_name" value="<?php echo $d['club_advisor_name'] ?>" id="club_advisor_name" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email Penasihat</label>
                        <input type="email" class="form-control" name="club_advisor_email_1" value="<?php echo $d['club_advisor_email'] ?>" id="club_advisor_email_1" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Maklumat Pegawai Pengiring</label>
                        <textarea class="summernote" rows="3" name="escort_officer" id="escort_officer"><?php echo $d['escort_officer'] ?></textarea>
                    </div>
                </div>
                </div>
                <!-- /.row -->

                
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- SELECT2 EXAMPLE -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Penyertaan (Bilangan Peserta)</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bilangan peserta lelaki</label>
                                <input type="number" name="maleparticipant" value="<?php echo $d['total_men'] ?>" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bilangan peserta perempuan</label>
                                <input type="number" name="femaleparticipant" value="<?php echo $d['total_women'] ?>" class="form-control" disabled>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.card -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Hasil Aktiviti dan Kemahiran Insaniah</h3>
                </div>

                <div class="card-body">
                    <div class="form-group">
                      <label>Penganjur</label>
                      <input type="text" name="KI_organizer" value="<?php echo $d['KI_organizer'] ?>" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                      <label>Peserta</label>
                      <input type="text" name="KI_participant" value="<?php echo $d['KI_participant'] ?>" class="form-control" disabled>
                    </div>
                </div>
            </div>
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Hasil Aktiviti dan Kemahiran Insaniah</h3>
                </div>

                <div class="card-body">
                    <label for="">Rumusan program/aktiviti yang akan dijalankan</label>
                        <textarea class="summernote" name="conclusion" id="conclusion"><?php echo $d['activity_conclusion'] ?></textarea>
                </div>
            </div>
            <!-- /.card -->
        <!-- /.container-fluid -->      
    <!-- /.content -->
    </form>
    <!-- Main content -->
    </div>
    </div>
  </section>
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
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
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

<script>
  $(function () {
    bsCustomFileInput.init();

    // Summernote
    $(document).ready(function() {
      $('.summernote').summernote();
    });

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
  })

  
  
  //Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
  theme: 'bootstrap4'
  
});

</script>

<script>
  $(function () {
    // Summernote
    $('.summernote#objective').summernote('disable');  
    $('.summernote#purpose').summernote('disable');  
    $('.summernote#activity_background').summernote('disable');  
    $('.summernote#committee').summernote('disable');  
    $('.summernote#escort_officer').summernote('disable');  
    $('.summernote#conclusion').summernote('disable');  

    })
</script>
</body>
</html>
