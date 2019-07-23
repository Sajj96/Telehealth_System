<!DOCTYPE html>
<?php
if (isset($this->session->userdata['logged_in'])) {
$id = ($this->session->userdata['logged_in']['id']);
$firstname = ($this->session->userdata['logged_in']['firstname']);
$lastname = ($this->session->userdata['logged_in']['lastname']);
$email = ($this->session->userdata['logged_in']['email']);
$position = ($this->session->userdata['logged_in']['position']);
 // session_destroy();
} else {
header("location: http://localhost/telehealth/");
session_destroy();
}
$submission_date=date('j/F/Y g:i A',time());

?>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
          <link rel="stylesheet" href="<?php echo base_url(); ?>css/styles.css">
          <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
          <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-theme.min.css">
          <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
          <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
          <!-- <script type="text/javascript" src="<?php echo base_url();?>js/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
          <script type="text/javascript" src="<?php echo base_url();?>js/DataTables-1.10.18/js/dataTables.bootstrap.min.js"></script>
          <script type="text/javascript" src="<?php echo base_url();?>js/DataTables-1.10.18/js/dataTables.jqueryui.min.js"></script>
          <script type="text/javascript" src="<?php echo base_url();?>js/DataTables-1.10.18/css/jquery.dataTables.min.css"></script> -->
          <link rel="stylesheet" href="<?php echo base_url(); ?>css\fontawesome\css\all.css">
          <title>TH|Search Disease</title>
          <link rel="shortcut icon" href="<?php echo base_url();?>images/headicon.jpg" class="w3-image w3-circle">

     </head>
     <body>
       <div class="w3-main" id="main">
         <div class="w3-nav w3-cyan w3-text-white w3-border-bottom w3-top" id="navbar">
           <!-- <button class="w3-button w3-white w3-border w3-round-large w3-margin w3-large w3-hide-large w3-right" id="openButton">&#9776;</button> -->
           <button class="w3-button w3-green w3-border w3-round-large w3-margin w3-small w3-hide-large w3-right" id="openButton">&#9776;</button>
           <div class="w3-container">
             <img src="<?php echo base_url();?>images/steth3.jpg" alt="logo" class="w3-image w3-circle w3-left">
             <a href="<?php echo site_url('home/')?>"><h2 class=" w3-text-white w3-hide-medium w3-margin-left w3-hide-small w3-left" id="my">My Clinic</h2></a>
             <a href="<?php echo site_url('home/')?>"><h3 class="w3-hide-large w3-text-white w3-margin-left w3-left w3-large">My Clinic</h3></a>
              <div class="w3-dropdown-hover w3-right">
                <?php foreach($home_details as $row): ?>
                  <?php if($row->photo == "No Image"): ?>
                <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                  <?php else: ?>
                <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                <?php endif ?>
                <?php endforeach ?>
                <?php foreach($doctor_details as $row): ?>
                  <?php if($row->photo == ""): ?>
                <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                  <?php else: ?>
                <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                <?php endif ?>
                <?php endforeach ?>
               <button class="w3-text-white w3-button w3-left w3-hover-cyan w3-large w3-margin-top w3-margin-left">
                 <?php echo $firstname.' '.$lastname; ?><span class="w3-badge w3-green w3-small w3-text-green w3-animate-fading w3-margin-left">.</span><i class="fa fa-angle-down fa-fw w3-text-white"></i></button>
              <div class="w3-dropdown-content w3-card-4 w3-bar-block w3-animate-zoom w3-margin-top" id="drop">
              <a href="#" class="w3-bar-item w3-button"><i class="fa fa-gear fa-fw w3-text-blue"></i>Change Password</a>
              <a href="<?php echo site_url('home/logout');?>" class="w3-bar-item w3-button" ><i class="fa fa-sign-out fa-fw w3-text-blue"></i>Logout</a>
              </div>
             </div>
           </div>
         </div>
         <div class="w3-sidebar w3-bar-block w3-collapse w3-animate-top w3-bordered " id="mySidebar">
          <button class="w3-bar-item w3-button w3-large w3-right w3-text-green w3-border-bottom w3-hide-large" id="closeButton"> &times;</button>
          <div class="">
              <a href="<?php echo site_url('home/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button "><i class="fa fa-user fa-fw w3-text-white"></i>Health Profile</a>
              <?php if($position =="Doctor"): ?>
              <a href="#" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-users fa-fw w3-text-white"></i>Patients</a>
              <?php else: ?>
              <a href="<?php echo site_url('doctor/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Search Doctor</a>
              <a href="#" class="w3-bar-item w3-round w3-orange w3-text-white w3-hover-cyan w3-button"><i class="fa fa-heart fa-fw w3-text-white"></i>Search Disease</a>
            <?php endif ?>
              <a href="<?php echo site_url('journey/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-book fa-fw w3-text-white"></i>Health Tips</a>
              <a href="<?php echo site_url('appointment/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-calendar fa-fw w3-text-white"></i>Appointments</a>
              <a href="#" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-comments fa-fw w3-text-white"></i>Questions</a>
              <a href="<?php echo site_url('Consultation/') ?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-stethoscope fa-fw w3-text-white"></i>Consultation Notes</a>
              <!-- <a href="#" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-file-powerpoint-o fa-fw w3-text-white"></i>Prescription</a>
              <a href="" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-money fa-fw w3-text-white"></i>Payments</a> -->
         </div>
        </div>
        <div class="" id="mainpage">
          <h3 class="w3-large w3-text-green"><i class="fa fa-user-md fa-fw w3-text-green"></i>Search predicting Disease:</h3>
            <hr>
          <i class="fa fa-search fa-fw w3-text-green w3-left w3-margin-top"></i><input type="text" name="search" id="search" placeholder="Search Disease/Symptoms" class="w3-input" />
          <br>
          <div id="res" class="w3-responsive"></div>
        <div style="clear:both"></div>
      </div>
      <script type="text/javascript" src="<?php echo base_url(); ?>js/index.js"></script>
      <script>
$(document).ready(function(){

  load_data();

  function load_data(query)
  {
    $.ajax({
      url:"<?php echo site_url('Disease/fetch'); ?>",
      method:"POST",
      data:{query:query},
      success:function(data){
        $('#res').html(data);
      }
    })
  }

  $('#search').keyup(function(){
    var search = $(this).val();
    if(search != '')
    {
      load_data(search);
    }
    else
    {
      load_data();
    }
  });
});
</script>

      </body>
    </html>
