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
//session_destroy();
}
include 'notifications.php';

$submission_date=date('j/F/Y g:i A',time());

?>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
          <link rel="stylesheet" href="<?php echo base_url(); ?>css/styles.css">
          <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
          <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
          <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
          <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
          <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
          <link rel="stylesheet" href="<?php echo base_url();?>js/datatables.css">
          <script type="text/javascript" src="<?php echo base_url();?>js/datatables.js"></script>
          <link rel="stylesheet" href="<?php echo base_url();?>js/datatables.min.css">
          <script type="text/javascript" src="<?php echo base_url();?>js/datatables.min.js"></script>
          <link rel="stylesheet" href="<?php echo base_url(); ?>css\fontawesome\css\all.css">
          <title>TH|Journey</title>
          <link rel="shortcut icon" href="<?php echo base_url();?>images/headicon.jpg" class="w3-image w3-circle">

     </head>
     <body>
       <div class="w3-main" id="main">
         <div class="w3-nav w3-cyan w3-text-white w3-border-bottom w3-top" id="navbar">
           <!-- <button class="w3-button w3-white w3-border w3-round-large w3-margin w3-large w3-hide-large w3-right" id="openButton">&#9776;</button> -->
           <button class="w3-button w3-green w3-border w3-round-large w3-margin w3-small w3-hide-large w3-right" id="openButton">&#9776;</button>
           <div class="w3-container">
             <img src="<?php echo base_url();?>images/steth3.jpg" alt="logo" class="w3-image w3-circle w3-left" id="image_one">
               <h2 class=" w3-text-white w3-hide-medium w3-margin-left w3-hide-small w3-left" id="my">My Clinic</h2>
               <h3 class="w3-hide-large w3-text-white w3-margin-left w3-left w3-large">My Clinic</h3>
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
         <div class="w3-sidebar w3-bar-block w3-collapse w3-animate-top w3-bordered " id="mySidebar" style="margin-top:10px;">
          <button class="w3-bar-item w3-button w3-large w3-right w3-text-green w3-border-bottom w3-hide-large" id="closeButton"> &times;</button>
          <div class="">
              <a href="<?php echo site_url('home/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button "><i class="fa fa-user fa-fw w3-text-white"></i>Health Profile</a>
              <?php if(($position =="Doctor") || ($position =="admin")): ?>
              <a href="#" class="w3-bar-item w3-round w3-text-white  w3-button"><i class="fa fa-users fa-fw w3-text-white"></i>Patients</a>
              <?php else: ?>
              <a href="<?php echo site_url('doctor/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Search Doctor</a>
              <a href="<?php echo site_url('disease/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-heart fa-fw w3-text-white"></i>Search Disease</a>
            <?php endif ?>
            <?php if($position == "admin"): ?>
              <a href="<?php echo site_url('Doctors/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Doctors</a>
            <?php endif ?>
              <a href="#" class="w3-bar-item w3-round w3-text-white w3-orange w3-hover-cyan w3-button"><i class="fa fa-book fa-fw w3-text-white"></i>Health Tips</a>
              <a href="<?php echo site_url('appointment/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-calendar fa-fw w3-text-white"></i>Appointments
                <?php if($position=="Doctor"): ?>
                    <span class="w3-badge w3-orange w3-hover-green"><?php echo $count; ?></span>
                <?php endif ?>
              </a>
              <a href="<?php echo site_url('Question/') ?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-comments fa-fw w3-text-white"></i>Questions
              <?php if($position=="Doctor"): ?>
                  <span class="w3-badge w3-orange w3-hover-green"><?php echo $count_question; ?></span>
              <?php endif ?>
              </a>
              <?php if($position == "Doctor"): ?>
                <button class="w3-button w3-bar-item w3-round w3-text-white w3-hover-cyan" id="doc_con"><i class="fa fa-stethoscope fa-fw w3-text-white"></i>Consultation Notes<i class="fa fa-angle-down fa-fw w3-text-white"></i></button>
                  <div class="w3-hide" id="page">
                    <a href="<?php echo site_url('Consultation/')?>" class="w3-bar-item w3-round w3-text-grey w3-hover-cyan  w3-button w3-animate-zoom">Make Consultation</a>
                    <a href="<?php echo site_url('Consultation/consult_two')?>" class="w3-bar-item w3-round w3-text-grey w3-hover-cyan w3-button w3-animate-zoom">Consultations</a>
                  </div>
                <?php elseif(($position == "Patient") || ($position == "admin")): ?>
                  <a href="<?php echo site_url('Consultation/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan  w3-button"><i class="fa fa-stethoscope fa-fw w3-text-white"></i>Consultation Notes</a>
                <?php endif ?>
                <!-- <?php if($position == "admin"): ?>
                <a href="<?php echo site_url('Reports/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-file fa-fw w3-text-white"></i>Reports</a>
              <?php endif ?> -->
              <!-- <a href="" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-money fa-fw w3-text-white"></i>Payments</a> -->
         </div>
         <script type="text/javascript">
           document.getElementById("doc_con").addEventListener("click",function(){
             var letter = document.getElementById("page");
             if(letter.className.indexOf("w3-show")== -1){
               letter.className += "w3-show";
             }else{
               letter.className =letter.className.replace("w3-show","");
             }
           });
         </script>
        </div>
        <div class="w3-margin-top" id="mainpage" >
          <?php if($position == "Doctor"): ?>
            <div class="w3-container" style="margin-top:60px;">
            <h3 class="w3-large w3-text-green w3-left"><i class="fa fa-lightbulb fa-fw w3-text-green"></i>Health Tips:</h3>
            <br>
             <hr>
            <div class=" w3-container w3-card-2 w3-bordered w3-border-blue w3-round w3-margin-top " id="appoint_">
              <div class="login_error">
                  <?php if(isset($success_message)): ?>
                    <?php echo "<div class='message w3-button w3-green w3-text-white w3-round' style='width:100%;'>"; ?>
                    <?php echo $success_message; ?>
                    <?php echo "</div>"; ?>
                  <?php endif ?>
               </div>
              <form class="w3-container w3-center w3-padding w3-margin-top w3-margin-left" action="<?php echo site_url('Journey/post_tip');?>" method="post" enctype="multipart/form-data">
                <table class="w3-table w3-responsive">
                  <tr>
                    <td class="w3-text-green"><label for="concern">Condition:</label></td>
                    <td>
                      <select class="w3-select" name="concern" >
                        <option value="">Choose condition</option>
                        <option value="Arthritis">Arthritis</option>
                        <option value="Hypertension">Hypertension</option>
                        <option value="Asthma">Asthma</option>
                        <option value="Blindness">Blindness</option>
                        <option value="Cancer">Cancer</option>
                        <option value="Chronic bronchitis">Chronic Bronchitis</option>
                        <option value="Coronary heart disease">Coronary Heart Disease</option>
                        <option value="Dementia">Dementia</option>
                        <option value="Diabetes">Diabetes</option>
                        <option value="Epilepsy">Epilepsy</option>
                        <option value="Neuron disease">Motor Neuron Disease</option>
                        <option value="Multiple Sclerosis">Multiple Sclerosis</option>
                        <option value="Osteoporosis">Osteoporosis</option>
                        <option value="Pagets's Disease of Bone">Pagets's Disease of Bone</option>
                        <option value="Parkinson's Disease">Parkinson's Disease</option>
                        <option value="Stroke">Stroke</option>
                        <option value="Chronic Kidney Disease">Chronic Kidney Disease</option>
                        <option value="Deep Vein Thrombosis">Deep Vein Thrombosis</option>
                        <option value="Shingles">Shingles</option>
                        <option value="Cholesterol">Cholesterol</option>
                        <option value="weight">Weight Loss</option>

                      </select>
                    </td>
                    <td class="w3-text-green"><label for="group">Age Group:</label></td>
                    <td><select name="group" class="w3-select">
                      <option value="">Choose age group</option>
                      <option value="all">All</option>
                      <option value="child">Children</option>
                      <option value="youth">Adolescence</option>
                      <option value="old">Old</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td class="w3-text-green"><p><b>What must be done:</b></p></td>
                    <td colspan="3">
                      <textarea name="must" rows="8" cols="80" class="w3-round"></textarea>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="w3-text-green"><p><b>When must be done:</b></p></td>
                    <td class="w3-text-green">Daily<input type="radio" name="when" class="w3-radio" value="daily"/></td>
                    <td class="w3-text-green">Weekly<input type="radio" name="when" class="w3-radio" value="week"/></td>
                    <td class="w3-text-green">Monthly<input type="radio" name="when" class="w3-radio"/ value="month"></td>
                  </tr>
                  <tr>
                    <td class="w3-text-green"><p><b>Any associated attachment(max. 30MB)</b></p></td>
                    <td colspan="2"><input type="file" name="attach" class="w3-input"/></td>
                    <td></td>
                    <td></td>
                  </tr>
                </table>
                <div class="w3-margin-top">
                  <input type="submit" name="submit" value="Post" class="w3-small w3-button w3-green w3-text-white w3-round w3-margin-left">

                <input type="reset" name="cancel" value="Cancel" class="w3-small w3-button  w3-red w3-text-white w3-round">
              </div>
              </form>
            </div>
          </div>
          <?php else: ?>
            <div class="w3-container" style="margin-top:60px;">
            <h3 class="w3-large w3-text-green w3-left"><i class="fa fa-lightbulb fa-fw w3-text-green"></i>Health Tips:</h3>
            <br>
             <hr>
            <?php foreach($view_tips as $row): ?>
            <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card" style="width:100%;margin-top:3%;">
              <header class="w3-grey w3-text-white">
                <?php if($row->photo == "No Image"): ?>
              <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                <?php else: ?>
              <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
              <?php endif ?>
              </header>
              <p class="w3-text-grey w3-right w3-margin-top"><i>By <?php echo "Dr.".$row->firstname." ".$row->lastname; ?></i></p>
              <br><hr>
              <div class="w3-text">
                <table class="w3-table w3-responsive">
                  <tr>
                    <!-- <?php if($row->Attach != ""): ?> -->
                    <td>
                      <embed src="<?php echo base_url('images/'.$row->Attach);?>" width="300" height="180" autostart="false" autoplay="0"></embed>
                    </td>
                    <!-- <?php endif ?> -->
                    <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey">
                      <p class="w3-text-grey"><i><b>Condition:</b><?php echo $row->condition; ?></i></p>
                      <pre><?php echo $row->must ?></pre></td>
                  </tr>
                </table>
                  <hr>
                <div>
                  <small class="w3-text-grey w3-centered w3-margin-left w3-margin-top"><i><b>For:</b>  <?php echo $row->age; ?></i></small>
                  <small class="w3-text-grey w3-right"><i><b>Done:</b> <?php echo $row->when; ?></i></small>
                </div>
              </div>
            </div>
          <?php endforeach ?>
          <?php endif ?>
         </div>
        </div>
       </div>
     </body>
</html>
