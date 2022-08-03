<?php
  include('../../include/header.php');
  include('../../connection.php');

  $activity_no = $_POST['activity_no'];
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../dashboard.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Hubungi</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../dashboard.php" class="brand-link">
      <img src="../../dist/img/uitm-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PERMATA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <a href="#" class="d-block"><?php echo $d['studentname'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="../../dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Halaman Utama
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Permohonan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permohonan Baru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="proses.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permohonan Diproses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="approved.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permohonan Diluluskan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="rejected.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permohonan Ditolak</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="../../info.php" class="nav-link">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
                Info HEP
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../plogout.php" class="nav-link" style="background-color: #a83232;">
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
            <h1>Permohonan Pelajar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Permohonan pelajar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <form id="application" name="application" action="../../papplication.php" method="POST">
        <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Keterangan Aktiviti</h3>
            </div><input type="text" id="id" name="id" value="<?php echo $activity_no ?>" >
            <?php
           $sql = "SELECT c.description, a.activity_no, a.activity_name, o.organization_name, l.level_name, a.coorganizer, a.objective, a.purpose, a.activity_background, a.committee, a.activity_date, a.position, a.currentcgpa, a.club_advisor_name, a.club_advisor_email, a.escort_officer, a.total_men, a.total_women, a.KI_organizer, a.KI_participant, a.activity_conclusion
                    from activity a 
                    join students s on s.studentno = a.studentno
                    join levels l on l.level_id = a.level_id
                    join organization o on o.organization_id = a.organization_id
                    join activity_category ac on ac.activity_no = a.activity_no
                    join category c on c.category_id = ac.category_id
                    where a.activity_no = '$activity_no'";
                    $qry = mysqli_query($conn, $sql);
                    $d = mysqli_fetch_assoc($qry)
            ?>   
        <input type="text" id="id" name="id" value="<?php echo $d['activity_no'];?>" hidden>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Aktivit/Program</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['activity_name'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Kelab/Persatuan</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['organization_name'];?>" disabled>
                    </div>
                </div>   
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Peringkat Aktiviti</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['level_name'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Anjuran Bersama</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['coorganizer'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Objektif Akitiviti</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['objective'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tujuan Program/Aktiviti</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['purpose'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Latar Belakang Program/Aktiviti</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['activity_background'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ahli Jawatankuasa</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['committee'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kategori Aktiviti</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['description'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tarikh Aktiviti</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['activity_date'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Pengarah Projek</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $_SESSION['studentname'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email Pengarah Projek</label>
                        <input type="email" class="form-control" name="studentemail" id="studentemail" value= "<?php echo $_SESSION['studentemail']; ?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jawatan</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['position'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No Telefon Bimbit</label>
                        <input type="text" class="form-control" name="studentphoneno" id="studentphoneno" value="<?php echo $_SESSION['studentphoneno']; ?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>CGPA Semasa</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['currentcgpa'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Penasihat</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['club_advisor_name'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email Penasihat</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['club_advisor_email'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Maklumat Pegawai Pengiring</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['escort_officer'];?>" disabled>
                    </div>
                </div>
                </div>
                <!-- /.row -->

                
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- SELECT2 EXAMPLE -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Penyertaan (Bilangan Peserta)</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Bilangan Peserta Lelaki</label>
                            <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['total_men'];?>" disabled>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Bilangan Peserta Perempuan</label>
                            <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['total_women'];?>" disabled>
                          </div>
                </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.card -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Hasil Aktiviti dan Kemahiran Insaniah</h3>
                </div>

                <div class="card-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Penganjur</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['KI_organizer'];?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Peserta</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['KI_participant'];?>" disabled>
                    </div>
                </div>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Hasil Aktiviti dan Kemahiran Insaniah</h3>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Rumusan Program/Aktiviti yang akan dijalankan</label>
                        <input type="text" class="form-control" name="studentname" id="studentname" value= "<?php echo $d['activity_conclusion'];?>" disabled>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
        </section>
    <!-- /.content -->
    </form>
    <form action="../../action_approve.php" method="POST" class="action-form-child">
      <button type="submit" name="activity_no" value="<?php echo $d['activity_no'] ?>" href="pages/forms/action_approve.php" class="btn btn-sm btn-success">Approve</button>
    </form>
    <form action="../../action_reject.php" method="POST" class="action-form-child">
      <button type="submit" name="activity_no" value="<?php echo $d['activity_no'] ?>" href="pages/forms/action_reject.php" class="btn btn-sm btn-danger">Reject</button>
    </form>
    <!-- Main content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- Alert -->
<script>
  function papplication(student_id) {
    Swal.fire({
      title: 'Do you want to save the changes?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Save',
      denyButtonText: `Don't save`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        Swal.fire('Saved!', '', 'success')
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }
</script>
<!-- Page specific script -->

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
</body>
</html>
