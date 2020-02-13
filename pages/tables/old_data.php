<?php
session_start();
  include_once('../../dbconnect.php');
    
    
    include_once('header.php');
    date_default_timezone_set("Asia/Calcutta");
    $sql = "SELECT * FROM t_info where t_lastdate < Now() ";
    $result = mysqli_query($con, $sql);

?>




<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | DataTables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div style="background-color: #1B374C;">
    <div class ="offset-md-1" >
  <img src="../../dist/img/logo-iisc.png" alt="IISc Logo" class="brand-image  " style="background-color: #1B374C;";>
  <span  class = 'offset-md-4'  style="color:White">IISc Bangalore Tenders</span>

</div></div> 
<!-- <span  class = 'offset-md-11'><a href="../../logout.php" class="btn btn-info" role="button">Sign Out</a></span> -->
 <span  class = 'offset-md-10'><a href="data.php ">View Current Tenders</a></span>
  <!-- <div class="content-wrapper"> -->
    <div class="">
    
    <section class="content">
      <div class="row">
        <div class="col-12">
          
         

          <div class="card">
            
            <!-- /.card-header -->
            <div class="card-body ">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                 <tr>
        <th>ID</th>
        <th>Tender Number</th>
        <th>Division</th>
        <th>Department</th>
        <th>Title</th>
        <th>Last Date and Time</th>
       
      </tr>
                </thead>
                <tbody>
                  <?php
            while($row = mysqli_fetch_assoc($result)){ 
            $div_id = $row['division'];
            $dept_id = $row['department'];
            $fetch_div = mysqli_query($con,"select * from divisions where ID = $div_id");
            $div_result = mysqli_fetch_assoc($fetch_div);

            $fetch_dept = mysqli_query($con,"select * from departments where ID = $dept_id");
            $dept_result = mysqli_fetch_assoc($fetch_dept);

             ?>
                  <tr>
                      <td> <?php echo $row['ID'];    ?></td>
                      <td> <?php echo $row['t_number'];    ?></td>  
                     
                      <td> <?php echo $div_result['name'];    ?></td>
                      <td> <?php echo $dept_result['name'];    ?></td>  
                      
                      <td> <?php echo $row['t_detail'];    ?></td>
                     
                      <td> <?php echo $row['t_lastdate'];    ?></td>
                     

                        <?php
                        $date1 = strtotime($row['t_lastdate']); 
                        $date2 = strtotime(date('Y-m-d H:i:s')); 
                        $diff = abs($date2 - $date1); 
                        $years = floor($diff / (365*60*60*24)); 
                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
                        $days = floor($diff / (60*60*24)); 
                        $hours = floor(($diff - $days*60*60*24) / (60*60)); 
                        $minutes = floor(($diff - $days*60*60*24 - $hours*60*60)/ 60); 
                        $seconds = floor(($diff - $days*60*60*24 - $hours*60*60 - $minutes*60)); 
                        ?> 
                       
                
                 
                </tr><?php  }   ?>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

  
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>
