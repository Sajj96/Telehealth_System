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
  header("location:http://localhost/Telehealth/");
session_destroy();
}
include 'notifications.php';
$dt = date('D g:i A',time());
$submission_date = date('j/M/Y',time());

?>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
          <link rel="stylesheet" href="<?php echo base_url(); ?>css/styles.css">
          <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
          <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
          <link href="<?php echo base_url('css/bootstrap-wysihtml5.css')?>" rel="stylesheet">
          <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
          <link rel="stylesheet" href="<?php echo base_url(); ?>css\fontawesome\css\all.css">
          <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
          <title>TH|Consultation</title>
          <link rel="shortcut icon" href="<?php echo base_url();?>images/headicon.jpg" class="w3-image w3-circle">

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
              <?php if(($position =="Doctor") || ($position =="admin")): ?>
              <a href="<?php echo site_url('Patients/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-users fa-fw w3-text-white"></i>Patients</a>
              <?php else: ?>
              <a href="<?php echo site_url('doctor/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Search Doctor</a>
              <a href="<?php echo site_url('disease/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-heart fa-fw w3-text-white"></i>Search Disease</a>
            <?php endif ?>
            <?php if($position == "admin"): ?>
              <a href="<?php echo site_url('Doctors/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Doctors</a>
            <?php endif ?>
              <a href="<?php echo site_url('journey/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-book fa-fw w3-text-white"></i>Health Tips</a>
              <a href="<?php echo site_url('appointment/')?>" class="w3-bar-item w3-round w3-text-white w3-button w3-ripple"><i class="fa fa-calendar fa-fw w3-text-white"></i>Appointments
                <?php if($position=="Doctor"): ?>
                    <span class="w3-badge w3-orange w3-hover-green"><?php echo $count; ?></span>
                <?php endif ?>
              </a>
              <a href="<?php echo site_url('Question/') ?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-comments fa-fw w3-text-white"></i>Questions
              <?php if($position=="Doctor"): ?>
                  <span class="w3-badge w3-orange w3-hover-green"><?php echo $count_question; ?></span>
              <?php endif ?>
            <?php if($position == "Doctor"): ?>
              </a>
              <button class="w3-button w3-bar-item w3-round w3-text-white w3-hover-cyan" id=""><i class="fa fa-stethoscope fa-fw w3-text-white"></i>Consultation Notes<i class="fa fa-angle-down fa-fw w3-text-white"></i></button>
                  <a href="<?php echo site_url('Consultation/')?>" class="w3-bar-item w3-round w3-text-grey w3-hover-cyan w3-button w3-animate-zoom">Make Consultation</a>
                  <a href="#" class="w3-bar-item w3-round w3-text-grey w3-hover-cyan w3-button w3-animate-zoom w3-orange">Consultations</a>
                <?php elseif(($position == "Patient") || ($position == "admin")): ?>
                  <a href="<?php echo site_url('Consultation/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan  w3-button"><i class="fa fa-stethoscope fa-fw w3-text-white"></i>Consultation Notes</a>
                <?php endif ?>

              <a href="<?php echo site_url('Payments/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-money fa-fw w3-text-white"></i>Payments</a>
         </div>
        </div>
        <div class="" id="mainpage">
            <div class="w3-container">
              <h3 class="w3-large w3-text-green w3-left"><i class="fa fa-calendar fa-fw w3-text-green"></i>Consultations:</h3>
              <br>
              <hr>
              <?php foreach($all_cons as $row): ?>
            <div class="w3-container w3-card-2 w3-margin-top w3-hover-shadow w3-bordered w3-leftbar w3-bar-block w3-border-green " id="card_">
              <div class="w3-row w3-margin-top">
                 <div class="w3-col l12 m12 s12">
                 <table class="w3-table w3-responsive">
                   <tr>
                     <td>
                         <img src="<?php echo base_url();?>images/visits.png" alt="avatar" class="w3-image w3-circle w3-small w3-left" id="image_four">
                       </td>
                     <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"><p class="w3-text-grey">To <?php echo $row->email ?></p><p>Consultation date:<?php echo $row->date; ?> (At <?php echo $row->start_at; ?>)</p>
                       <p>Reason: <?php echo $row->reason ?></p>
                     </td>
                     <td></td>
                   <td><button name="button" class="w3-button w3-text-blue" id="<?php echo $row->email."notes"; ?>">NOTES</button></td>
                   <td>
                     <?php if($row->type == "video"): ?>
                       <a href="http://localhost:3000"><button name="button" class="w3-button w3-text-blue" id="">Start Video</button></a>
                     <?php endif ?>
                   </td>
                   </tr>
                   <tr  class="w3-animate-top">
                     <td colspan="8">
                       <div class="w3-hide" id="<?php echo $row->email."letter5"?>">

                             <div class="w3-container w3-card-2 w3-margin">
                               <div class="w3-container w3-light-grey w3-text-grey">
                                   <textarea value="" class="w3-padding w3-white w3-round" style="width:80%;"
                                   name="box" placeholder="Reasons" rows="5"><?php echo $row->notes; ?></textarea>
                               </div>
                             </div>
                       </div>
                     </td>
                     <td></td>
                     <td>  </td>
                     <td>  </td>
                     <td>  </td>
                     <td>  </td>
                     <td></td>
                     <td></td>
                   </tr>
                 </table>
              </div>
            </div>
          </div>
          <script type="text/javascript">
            document.getElementById("<?php echo $row->email."notes";?>").addEventListener("click",function(){
              var letter = document.getElementById("<?php echo $row->email."letter5"?>");
              if(letter.className.indexOf("w3-show")== -1){
                letter.className += "w3-show";
              }else{
                letter.className =letter.className.replace("w3-show","");
              }
            });
          </script>
        <?php endforeach ?>
        </div>
        </div>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/index.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/Chart.js"></script>
        <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
        <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
    </body>
  </html>
