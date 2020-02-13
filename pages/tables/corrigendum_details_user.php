<?php
session_start();
  include_once('../../dbconnect.php');
    
    $t_no = $_GET['ID'];
    //include_once('header.php');
    date_default_timezone_set("Asia/Calcutta");
    $sql = "SELECT * FROM corrigendum where tender_number = '$t_no'";
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

<style type="text/css">
  .no-sort::after { display: none!important; }

  .no-sort::before { display: none!important; }

.no-sort { pointer-events: none!important; cursor: default!important; }


table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting {
    padding-right: 18px;
</style>




</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div style="background-color: #1B374C;">
    <div class ="offset-md-1" >
  <img src="../../dist/img/logo-iisc.png" alt="IISc Logo" class="brand-image  " style="background-color: #1B374C;";>
  <span  class = 'offset-md-4'  style="color:White">IISc Bangalore Tenders</span>

</div></div>
 <!-- <span  class = 'offset-md-11'><a href="../../logout.php" class="btn btn-info" role="button">Sign Out</a></span> -->
 <!-- <span  class = 'offset-md-10'><a href="old_data.php ">View Old Tenders</a></span> -->
  <!-- <div class="content-wrapper"> -->
    <div class="">
    
    <section class="content">
      <div class="row">
        <div class="col-12">
          
         

          <div class="card">
            
            <!-- /.card-header -->
            <div class="card-body ">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                 <tr>
       <!--  <th class='no-sort'>ID</th> -->
        <th>S.No.</th>
        <th>Corrigendum<br>Title</th>
        <th>Corrigendum<br> Date</th>
        <th>Document Link</th>
        <th>Last Date and Time</th>
        <th>Approx. Days Left</th>
      </tr>
                </thead>
                <tbody>
                  <?php
             $s_no = 1;
            while($row = mysqli_fetch_assoc($result)){ 
             ?>
                  <tr>
                      <td> <?php echo $s_no;    ?></td>
                      <td> <?php echo $row['title'];    ?></td>
                      <td> <?php echo $row['upload_date'];    ?></td> 
                     
                      <td > 
          <a href="<?php echo '../../TenderFiles/merged'.'/'.$row['file'];    ?>" target="_blank"><?php  echo $row['file'];  ?></a>
          </td> 
                      
                     
        
       <?php $old_date = $row['last_date']; 

        $new_date =  date('d/m/Y H:i:s',strtotime($old_date));

           ?>


        <td><?php echo $new_date;  ?> </td>
         <?php
         $date1 = strtotime($row['last_date']); 
         $date2 = strtotime(date('Y-m-d H:i:s')); 
         $diff = abs($date2 - $date1); 
         $years = floor($diff / (365*60*60*24)); 
         $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
         $days = floor($diff / (60*60*24)); 
         $hours = floor(($diff - $days*60*60*24) / (60*60)); 
         $minutes = floor(($diff - $days*60*60*24 - $hours*60*60)/ 60); 
         $seconds = floor(($diff - $days*60*60*24 - $hours*60*60 - $minutes*60)); 
         
         ?>
         <td> <?php echo $days; ?> </td>
       
        
         </tr> <?php $s_no++; }?>
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
    $( ".nosort" ).removeClass("sorting");
    $('#example2').DataTable({ 
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    }); 
  });
</script> 


</body>
</html>
