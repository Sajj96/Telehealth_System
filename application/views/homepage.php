<!DOCTYPE html>
<?php

if (isset($this->session->userdata['logged_in'])) {
$id = ($this->session->userdata['logged_in']['id']);
$firstname = ($this->session->userdata['logged_in']['firstname']);
$lastname = ($this->session->userdata['logged_in']['lastname']);
$email = ($this->session->userdata['logged_in']['email']);
$position = ($this->session->userdata['logged_in']['position']);

 // session_destroy();
}else{
  header("location:http://localhost/Telehealth/");
session_destroy();
}

include 'notifications.php';
$dt = date('g:i A',time());
$submission_date = date('Y-m-d',time());
$d = date('l');

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
          <link rel="stylesheet" href="<?php echo base_url(); ?>css\fontawesome\css\all.css">
          <title>TH|Home</title>
          <link rel="shortcut icon" href="<?php echo base_url();?>images/headicon.jpg">
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
                 <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-margin-top" id="image_two">
                 <?php endif ?>
                 <?php endforeach ?>
                 <?php foreach($doctor_details as $row): ?>
                   <?php if($row->photo == ""): ?>
                 <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                   <?php else: ?>
                 <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-margin-top" id="image_two">
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
         <div class="w3-sidebar w3-bar-block w3-collapse w3-bordered " id="mySidebar">
          <button class="w3-bar-item w3-button w3-large w3-right w3-text-green w3-border-bottom w3-hide-large" id="closeButton"> &times;</button>
          <div class="">
              <?php if(($position =="Patient") || ($position == "admin")): ?>
              <a href="#" class="w3-bar-item w3-round w3-text-white w3-orange w3-button"><i class="fa fa-user fa-fw w3-text-white"></i>Health Profile</a>
            <?php elseif ($position =="Doctor"): ?>
              <a href="#" class="w3-bar-item w3-round w3-text-white w3-orange w3-button"><i class="fa fa-user fa-fw w3-text-white"></i>Doctor Profile</a>
            <?php endif ?>
              <?php if(($position =="Doctor") || ($position =="admin")): ?>
              <a href="<?php echo site_url('patients/') ?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-users fa-fw w3-text-white"></i>Patients</a>
              <?php else: ?>
              <a href="<?php echo site_url('doctor/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Search Doctor</a>
              <a href="<?php echo site_url('disease/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-heart fa-fw w3-text-white"></i>Search Disease</a>
            <?php endif ?>
            <?php if($position == "admin"): ?>
              <a href="<?php echo site_url('Doctors/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Doctors</a>
            <?php endif ?>
              <a href="<?php echo site_url('Journey/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button w3-ripple"><i class="fa fa-book fa-fw w3-text-white"></i>Health Tips</a>
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

              <a href="<?php echo site_url('Payments/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-money-bill-wave fa-fw w3-text-white"></i>Payments</a>
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
        <div class="" id="mainpage">
          <?php if($position == "Doctor"): ?>
            <div class="w3-container w3-bordered w3-border-cyan" id="profile">
              <div class="w3-row">
                   <div class="w3-col l12 m12 s12">
                     <?php foreach ($doctor_details as $row): ?>
                        <table width="80%" class="w3-table w3-margin-top">
                          <tr>
                            <td><?php foreach($doctor_details as $row): ?>
                                  <?php if($row->photo == "No Image"): ?>
                                <img src="<?php echo base_url();?>images/headericon.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-border-white" id="image">
                                  <?php else: ?>
                                <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-border-white" id="image">
                                <?php endif ?>
                                <?php endforeach ?>
                              <ul class="" id="list">
                                <?php
                                  $db = new DateTime($row->dob);
                                  $now = new DateTime();
                                  $df = $now->diff($db);
                                  $age = $df->y
                                 ?>
                                <li class="w3-text-green w3-large w3-margin-left"><?php echo $row->firstname.' '.$row->lastname; ?></li>
                                <li class="w3-margin-left">Age: <?php echo $age; ?> (<?php echo $row->dob; ?>)</li>
                                <li class="w3-margin-left">Sex:<?php echo $row->gender; ?></li>
                              </ul>
                            </td>
                            <td>
                              <p>Doctor ID:D<?php echo $id;?></p>
                            </td>
                            <td></td>
                          </tr>
                          <tr class="w3-hide-small">
                            <td colspan="3"><hr></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td><p class="w3-left"><i class="fa fa-envelope fa-fw w3-text-green"></i><?php echo $row->email; ?> </p>
                              <p class="w3-left"><i class="fa  fa-phone-square fa-fw w3-text-green"></i> +(255)<?php echo $row->phone; ?></p>
                            </td>
                            <td></td>
                            <td></td>
                          </tr>
                        </table>
                      <?php endforeach ?>
                    </div>
               </div>
            </div>
            <hr>
          <?php elseif($position == "admin"): ?>
            <div><p class="w3-text-green w3-center w3-xxlarge w3-margin-top">Welcome Admin</p></div>
          <?php else: ?>
          <div class="w3-container w3-bordered w3-border-cyan" id="profile">
            <div class="w3-row">
                 <div class="w3-col l12 m12 s12">
                   <?php foreach ($home_details as $row): ?>
                      <table width="80%" class="w3-table w3-margin-top">
                        <tr>
                          <td>
                              <?php if($row->photo == "No Image"): ?>
                            <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small" id="image">
                              <?php else: ?>
                            <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small" id="image">
                            <?php endif ?>
                            <ul class="" id="list">
                              <?php
                                $db = new DateTime($row->dob);
                                $now = new DateTime();
                                $df = $now->diff($db);
                                $age = $df->y
                               ?>
                              <li class="w3-text-green w3-large w3-margin-left"><?php echo $row->firstname.' '.$row->lastname; ?></li>
                              <li class="w3-margin-left">Age: <?php echo $age; ?> (<?php echo $row->dob; ?>)</li>
                              <li class="w3-margin-left">Sex:<?php echo $row->gender; ?></li>
                            </ul>
                          </td>
                          <td><p>Monitored Under:</p>
                            <p>Patient ID:P<?php echo $id;?></p>
                          </td>
                          <td></td>
                        </tr>
                        <tr class="w3-hide-small">
                          <td colspan="3"><hr></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td><p class="w3-left"><i class="fa fa-envelope fa-fw w3-text-green"></i><?php echo $row->email; ?> </p>
                            <p class="w3-left"><i class="fa  fa-phone-square fa-fw w3-text-green"></i> +(255)<?php echo $row->phone; ?></p>
                          </td>
                          <td></td>
                          <td></td>
                        </tr>
                      </table>
                    <?php endforeach ?>
                  </div>
            </div>
          </div>
          <div class="w3-margin">
                     <div class="w3-bar w3-padding w3-centered" id="hometab" align="center">
                          <a class="tablink w3-green w3-button w3-bar-item w3-border w3-margin-right w3-round" id="historytab">Health History</a>
                          <a class="tablink w3-orange w3-button w3-bar-item w3-border w3-margin-right w3-round" id="vitaltab">Vital Signs</a>
                     </div>
        </div>
        <hr>
        <div class="w3-row w3-margin-top w3-bordered w3-responsive" id="tb">
         <div class="w3-col l12 m12 s12">
          <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card">
            <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-thermometer fa-fw w3-text-green"></i>Temperature(Today-<?php echo $d;?>)</p>     <!-- Health condition tab -->
            <div class="w3-row  w3-small">
                 <div class="w3-col l12 m12 s12">
                   <table class="w3-table w3-bordered" width="100%">
                     <tr class="w3-light-grey w3-text-black">
                       <th>Temperature</th>
                       <th>Time</th>
                       <th>Date</th>
                       <th>At</th>
                     </tr>
                     <?php foreach($temp as $row): ?>
                     <tr>
                       <td><?php echo $row->Temp; ?></td>
                       <td><?php echo $row->Time; ?></td>
                       <td><?php echo $row->date; ?></td>
                       <td><?php echo $row->At; ?></td>
                     </tr>
                   <?php endforeach ?>
                     <tr>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                     </tr>
                   </table>
                 </div>

            </div>
          </div>
          <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card">     <!-- Pulse tab -->
            <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-heartbeat fa-fw w3-text-green"></i>Pulses(Today-<?php echo $d;?>)</p>
              <div class="w3-row w3-margin-top w3-small">
                   <div class="w3-col l12 m12 s12">
                     <table class="w3-table w3-bordered" width="100%">
                       <tr class="w3-light-grey w3-text-black">
                         <th>Pulse(bpm)</th>
                         <th>Times</th>
                         <th>Date</th>
                         <th>At</th>
                         <th>Location</th>
                         <th>Note</th>
                       </tr>
                       <?php foreach($pulse as $row): ?>
                       <tr>
                         <td><?php echo $row->Pulse_bpm; ?></td>
                         <td><?php echo $row->Times; ?></td>
                         <td><?php echo $row->date; ?></td>
                         <td><?php echo $row->At; ?></td>
                         <td><?php echo $row->location; ?></td>
                         <td><?php echo $row->note; ?></td>
                       </tr>
                     <?php endforeach ?>
                       <tr>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                       </tr>
                     </table>
                   </div>

              </div>
            </div>
        </div>
      </div>
        <hr>
       <div class="w3-container tabcontent w3-responsive" id="historytab_page">   <!-- Health History Tab -->
          <div class="w3-row w3-margin-top w3-bordered w3-responsive" id="tb">
               <div class="w3-col l12 m12 s12">
                <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card">
                    <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-heartbeat fa-fw w3-text-green"></i>Health Condition</p>
                    <div class="w3-row w3-margin-top w3-small">
                         <div class="w3-col l12 m12 s12">
                           <table class="w3-table">
                             <tr class="w3-light-grey">
                               <th>Health Condition</th>
                               <th>Diagnosed In</th>
                               <th>Medications</th>
                               <th>Current/Past</th>
                               <th></th>
                               <th></th>
                             </tr>
                             <?php foreach($health_condition as $row): ?>
                             <tr>
                               <td><?php echo $row->HC; ?></td>
                               <td><?php echo $row->Diagnosed; ?></td>
                               <td><?php echo $row->HC_Med; ?></td>
                               <td><?php echo $row->current_past; ?></td>
                               <td><button class="w3-btn w3-blue w3-text-white  w3-round-small" id="btn_edit" onclick="document.getElementById('<?php echo $row->id ?>').style.display='block'"><i class="fa fa-edit fa-fw"></i>Edit</button></td>
                               <td><button class="w3-btn w3-red w3-text-white w3-round-small" id="btn_delete" onclick="delete_hc('<?php echo $row->id; ?>')"><i class="fa fa-trash fa-fw"></i>Delete</button></td>
                             </tr>
                           <?php endforeach ?>
                             <tr>
                               <td colspan="4"><hr></td>
                               <td></td>
                               <td></td>
                               <td></td>
                             </tr>
                             <tr>
                               <td><button class="w3-text-green w3-button w3-white w3-teal" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-plus-circle fa-fw w3-text-green "></i>ADD NEW</a></td>
                               <td></td>
                               <td></td>
                               <td></td>
                             </tr>
                           </table>
                         </div>

                    </div>
                  </div>
                  <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card">
                    <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-eyedropper fa-fw w3-text-green"></i>Medications</p>
                    <div class="w3-row w3-margin-top w3-small">
                         <div class="w3-col l12 m12 s12">
                           <table width="100%" class="w3-table">
                             <tr class="w3-light-grey">
                               <th>Medication</th>
                               <th>Dosage</th>
                               <th>Taken For</th>
                               <th>Current/Past</th>
                               <th></th>
                               <th></th>
                             </tr>
                             <?php foreach($medication as $row): ?>
                             <tr>
                               <td><?php echo $row->medication; ?></td>
                               <td><?php echo $row->dosage; ?></td>
                               <td><?php echo $row->taken_for; ?></td>
                               <td><?php echo $row->current_past; ?></td>
                               <td><button class="w3-btn w3-blue w3-text-white  w3-round-small" id="btn_edit" onclick="document.getElementById('<?php echo $row->id."med" ?>').style.display='block'"><i class="fa fa-edit fa-fw"></i>Edit</button></td>
                               <td><button class="w3-btn w3-red w3-text-white w3-round-small" id="btn_delete" onclick="delete_medic('<?php echo $row->id ?>')"><i class="fa fa-trash fa-fw"></i>Delete</button></td>
                             </tr>
                             </tr>
                             <?php endforeach ?>
                             <tr>
                               <td colspan="4"><hr></td>
                               <td></td>
                               <td></td>
                               <td></td>
                             </tr>
                             <tr>
                               <td><button class="w3-text-green w3-button w3-white w3-teal" onclick="document.getElementById('id02').style.display='block'"><i class="fa fa-plus-circle fa-fw w3-text-green "></i>ADD NEW</a></td>
                               <td></td>
                               <td></td>
                               <td></td>
                             </tr>
                           </table>
                         </div>

                    </div>
                  </div>
                <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan w3-margin-top w3-margin-bottom" id="card">
                    <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-frown-o fa-fw w3-text-green"></i>Allergies</p>
                    <div class="w3-row w3-margin-top w3-small">
                         <div class="w3-col l12 m12 s12">
                           <table width="100%" class="w3-table">
                             <tr class="w3-light-grey">
                               <th>Allergy</th>
                               <th>Triggered By</th>
                               <th>Medications</th>
                               <th>Reaction</th>
                               <th></th>
                               <th></th>
                             </tr>
                             <?php foreach($Allergies as $row): ?>
                             <tr>
                               <td><?php echo $row->allergy; ?></td>
                               <td><?php echo $row->triggered_by; ?></td>
                               <td><?php echo $row->allergy_med; ?></td>
                               <td><?php echo $row->reaction; ?></td>
                               <td><button class="w3-btn w3-blue w3-text-white  w3-round-small" id="btn_edit" onclick="document.getElementById('<?php echo $row->id."al" ?>').style.display='block'"><i class="fa fa-edit fa-fw"></i>Edit</button></td>
                               <td><button class="w3-btn w3-red w3-text-white w3-round-small" id="btn_delete" onclick="delete_al('<?php echo $row->id; ?>')"><i class="fa fa-trash fa-fw"></i>Delete</button></td>
                             </tr>
                             </tr>
                           <?php endforeach ?>
                             <tr>
                               <td colspan="4"><hr></td>
                               <td></td>
                               <td></td>
                               <td></td>
                             </tr>
                             <tr>
                               <td><button class="w3-text-green w3-button w3-white w3-teal" onclick="document.getElementById('id03').style.display='block'"><i class="fa fa-plus-circle fa-fw w3-text-green "></i>ADD NEW</a></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                             </tr>
                           </table>
                         </div>

                    </div>
                  </div>
                  <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan w3-margin-top" id="card">
                    <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-child fa-fw w3-text-green"></i>Social History</p>
                    <div class="w3-row w3-margin-top w3-small w3-">
                         <div class="w3-col l12 m12 s12">
                           <table class="w3-table">
                             <tr>
                               <td><textarea name="" class="w3-large w3-round" style="width:70%;" rows="5"><?php foreach($social_history as $row): ?><?php echo $row->social_hist; ?><?php endforeach ?></textarea></td>
                             </tr>
                             <tr>
                              <td><button class="w3-text-green w3-button w3-white w3-teal" onclick="document.getElementById('id06').style.display='block'"><i class="fa fa-plus-circle fa-fw w3-text-green "></i>ADD NEW</a></td>
                             </tr>
                           </table>
                         </div>
                    </div>

                  </div>
                  <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan w3-margin-top" id="card">
                    <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-frown-o fa-fw w3-text-green"></i>Hospitalizations</p>
                    <div class="w3-row w3-margin-top w3-small">
                         <div class="w3-col l12 m12 s12">
                           <table width="100%" class="w3-table">
                             <tr class="w3-light-grey">
                               <th>When</th>
                               <th>Reason</th>
                               <th>Where</th>
                               <th>Discharge Report</th>
                               <th></th>
                               <th></th>
                             </tr>
                             <?php foreach($Hospitalization as $row): ?>
                             <tr>
                               <td><?php echo $row->when; ?></td>
                               <td><?php echo $row->hosp_reason; ?></td>
                               <td><?php echo $row->where; ?></td>
                               <td><?php echo $row->report; ?></td>
                               <td><button class="w3-btn w3-blue w3-text-white  w3-round-small" id="btn_edit" onclick="document.getElementById('<?php echo $row->id."hosp" ?>').style.display='block'"><i class="fa fa-edit fa-fw"></i>Edit</button></td>
                               <td><button class="w3-btn w3-red w3-text-white w3-round-small" id="btn_delete" onclick="delete_hosp('<?php echo $row->id; ?>')"><i class="fa fa-trash fa-fw"></i>Delete</button></td>
                             </tr>
                             </tr>
                           <?php endforeach ?>
                             <tr>
                               <td colspan="4"><hr></td>
                               <td></td>
                               <td></td>
                               <td></td>
                             </tr>
                             <tr>
                               <td><button class="w3-text-green w3-button w3-white w3-teal" onclick="document.getElementById('id04').style.display='block'"><i class="fa fa-plus-circle fa-fw w3-text-green "></i>ADD NEW</a></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                             </tr>
                           </table>
                         </div>

                    </div>
                  </div>
                  <div class="w3-container w3-card-4  w3-bordered w3-leftbar w3-bar-block w3-border-cyan w3-margin-top" id="card">
                    <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-frown-o fa-fw w3-text-green"></i>Surgery</p>
                    <div class="w3-row w3-margin-top w3-small">
                         <div class="w3-col l12 m12 s12">
                           <table width="100%" class="w3-table">
                             <tr class="w3-light-grey">
                               <th>Surgery</th>
                               <th>Implants(If any)</th>
                               <th>Done on</th>
                               <th>By</th>
                               <th></th>
                               <th></th>
                             </tr>
                             <?php foreach($Surgery as $row): ?>
                             <tr>
                               <td><?php echo $row->surgery; ?></td>
                               <td><?php echo $row->implants; ?></td>
                               <td><?php echo $row->done_on; ?></td>
                               <td><?php echo $row->by; ?></td>
                               <td><button class="w3-btn w3-blue w3-text-white  w3-round-small" id="btn_edit" onclick="document.getElementById('<?php echo $row->id."surg" ?>').style.display='block'"><i class="fa fa-edit fa-fw"></i>Edit</button></td>
                               <td><button class="w3-btn w3-red w3-text-white w3-round-small" id="btn_delete" onclick="delete_surg('<?php echo $row->id; ?>')"><i class="fa fa-trash fa-fw"></i>Delete</button></td>
                             </tr>
                             </tr>
                           <?php endforeach ?>
                             <tr>
                               <td colspan="4"><hr></td>
                               <td></td>
                               <td></td>
                               <td></td>
                             </tr>
                             <tr>
                               <td><button class="w3-text-green w3-button w3-white w3-teal" onclick="document.getElementById('id05').style.display='block'"><i class="fa fa-plus-circle fa-fw w3-text-green "></i>ADD NEW</a></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                             </tr>
                           </table>
                         </div>

                    </div>
                  </div>
                <div class="w3-modal w3-card-4 w3-animate-zoom" id="id01">
                  <div class="w3-modal-content">
                    <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan"  id="f1">
                      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                      <p class="w3-center w3-large w3-text-green">Add your Health Condition</p>
                      <hr>
                      <form class="" action="<?php echo site_url('home/health_condition');?>" method="post">
                        <div class="w3-row">
                             <div class="w3-col l12 m12 s12">
                              <table class="w3-table">
                                <tr>
                                  <td>Health Condition <input type="text" name="condition" value="" class="w3-input w3-round" required></td>
                                  <td>Diagnosed In <input type="text" name="diagnose" value="" class="w3-input w3-round" required></td>
                                </tr>
                                <tr>
                                  <td>Medications <input type="text" name="medication" value="" class="w3-input w3-round" required></td>
                                  <td><select class="w3-select w3-left w3-small w3-text-orange" name="health">
                                      <option value="PastHC">Past</option>
                                      <option value="CurrentHC">Current</option>
                                    </select></td>
                                </tr>
                                <tr>
                                  <td><input type="submit" name="" value="Submit" class="w3-button w3-green w3-round w3-right" ></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                    </form>
                    </div>
                  </div>
                </div>
                <div class="w3-modal w3-card-4 w3-animate-zoom" id="id02">
                  <div class="w3-modal-content">
                    <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan">
                      <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                      <p class="w3-center w3-large w3-text-green">Add Medications</p>
                      <hr>
                      <form class="" action="<?php echo site_url('home/Medics');?>" method="post">
                        <div class="w3-row">
                             <div class="w3-col l12 m12 s12">
                              <table class="w3-table">
                                <tr>
                                  <td>Medication <input type="text" name="med" value="" class="w3-input w3-round" required></td>
                                  <td>Dosage <input type="text" name="dosage" value="" class="w3-input w3-round" required></td>
                                </tr>
                                <tr>
                                  <td>Taken For <input type="text" name="taken" value="" class="w3-input w3-round" required></td>
                                  <td><select class="w3-select w3-left w3-small w3-text-orange" name="medication">
                                    <option value="PastMed">Past</option>
                                    <option value="CurrentMed">Current</option>
                                  </select></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td><input type="submit" name="" value="Submit" class="w3-button w3-green w3-round w3-right"></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                    </form>
                    </div>
                  </div>
                </div>
                <div class="w3-modal w3-card-4 w3-animate-zoom" id="id06">
                  <div class="w3-modal-content">
                    <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan">
                      <span onclick="document.getElementById('id06').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                      <p class="w3-center w3-large w3-text-green">Add Social History</p>
                      <hr>
                      <form class="" action="<?php echo site_url('home/social_hist');?>" method="post">
                        <div class="w3-row">
                             <div class="w3-col l12 m12 s12">
                              <table class="w3-table">
                                <tr>
                                  <td><textarea name="social" rows="5" cols="80" class="w3-text"></textarea></td>
                                </tr>
                                <tr>
                                  <td><input type="submit" name="" value="Submit" class="w3-button w3-green w3-round w3-right"></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                    </form>
                    </div>
                  </div>
                </div>
                <div class="w3-modal w3-card-4 w3-animate-zoom" id="id03">
                  <div class="w3-modal-content">
                    <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan">
                      <span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                      <p class="w3-center w3-large w3-text-green">Allergies</p>
                      <hr>
                      <form class="" action="<?php echo site_url('home/Allergies');?>" method="post">
                        <div class="w3-row">
                             <div class="w3-col l12 m12 s12">
                              <table class="w3-table">
                                <tr>
                                  <td>Allergy<input type="text" name="allergy" value="" class="w3-input w3-round" required></td>
                                  <td>Triggered By <input type="text" name="triggered_by" value="" class="w3-input w3-round" required></td>
                                </tr>
                                <tr>
                                  <td>Medications <input type="text" name="allergy_med" value="" class="w3-input w3-round" required></td>
                                  <td>Reaction <input type="text" name="reaction" value="" class="w3-input w3-round" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td><input type="submit" name="" value="Submit" class="w3-button w3-green w3-round w3-right"></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                    </form>
                    </div>
                  </div>
                </div>
                <div class="w3-modal w3-card-4 w3-animate-zoom w3-margin-left" id="id04">
                  <div class="w3-modal-content">
                    <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan">
                      <span onclick="document.getElementById('id04').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                      <p class="w3-center w3-large w3-text-green">Hospitalizations</p>
                      <hr>
                      <form class="" action="<?php echo site_url('home/hospital');?>" method="post">
                        <div class="w3-row">
                             <div class="w3-col l12 m12 s12">
                              <table class="w3-table">
                                <tr>
                                  <td>When<input type="date" name="when" value="" class="w3-input w3-round" required></td>
                                  <td>Reason <input type="text" name="hosp_reason" value="" class="w3-input w3-round" required></td>
                                </tr>
                                <tr>
                                  <td>Where <input type="text" name="where" value="" class="w3-input w3-round" required></td>
                                  <td>Discharge Report <input type="file" name="attach" value="" class="w3-input w3-round w3-text-orange" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td><input type="submit" name="" value="Submit" class="w3-button w3-green w3-round w3-right"></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                    </form>
                    </div>
                  </div>
                </div>
                <div class="w3-modal w3-card-4 w3-animate-zoom" id="id05">
                  <div class="w3-modal-content">
                    <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan">
                      <span onclick="document.getElementById('id05').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                      <p class="w3-center w3-large w3-text-green">Add Surgery/Implants</p>
                      <hr>
                      <form class="" action="<?php echo site_url('home/surgery');?>" method="post">
                        <div class="w3-row">
                             <div class="w3-col l12 m12 s12">
                              <table class="w3-table">
                                <tr>
                                  <td>Surgery<input type="text" name="surgery" value="" class="w3-input w3-round" required></td>
                                  <td>Implant(If any)<input type="text" name="implant" value="" class="w3-input w3-round" required></td>
                                </tr>
                                <tr>
                                  <td>Done on<input type="date" name="done_on" value="" class="w3-input w3-round" required></td>
                                  <td>By <input type="text" name="by" value="" class="w3-input w3-round" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td><input type="submit" name="" value="Submit" class="w3-button w3-green w3-round w3-right"></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                    </form>
                    </div>
                  </div>
                </div>
                <?php foreach($health_condition as $row): ?>
                <div class="w3-modal w3-card-4 w3-animate-zoom" id="<?php echo $row->id; ?>">  <!--Modal to edit Health Condition  -->
                  <div class="w3-modal-content">
                    <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan"  id="f1">
                      <span onclick="document.getElementById('<?php echo $row->id; ?>').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                      <p class="w3-center w3-large w3-text-green">Edit your Health Condition</p>
                      <hr>
                      <form class="" action="<?php echo site_url('home/health_update');?>" method="post">
                        <div class="w3-row">
                             <div class="w3-col l12 m12 s12">
                              <table class="w3-table">
                                <tr>
                                  <td>Health Condition <input type="text" name="condition" value="<?php echo $row->HC; ?>" class="w3-input w3-round"></td>
                                  <td>Diagnosed In <input type="text" name="diagnose" value="<?php echo $row->Diagnosed; ?>" class="w3-input w3-round"></td>
                                </tr>
                                <tr>
                                  <td>Medications <input type="text" name="medication" value="<?php echo $row->HC_Med; ?>" class="w3-input w3-round"></td>
                                  <td><select class="w3-select w3-left w3-small w3-text-orange" name="health">
                                      <option value=""><?php echo $row->current_past; ?></option>
                                      <option value="PastHC">Past</option>
                                      <option value="CurrentHC">Current</option>
                                    </select></td>
                                </tr>
                                <tr>
                                  <td><input type="text" name="id" value="<?php echo $row->id; ?>" class="w3-hide w3-input w3-round"></td>
                                  <td><input type="submit" name="" value="Edit" class="w3-button w3-blue w3-round w3-right" ></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                    </form>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
              <?php foreach($medication as $row): ?>
                <div class="w3-modal w3-card-4 w3-animate-zoom" id="<?php echo $row->id."med"; ?>">  <!-- Modal to edit medication -->
                  <div class="w3-modal-content">
                    <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan">
                      <span onclick="document.getElementById('<?php echo $row->id."med"; ?>').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                      <p class="w3-center w3-large w3-text-green">Edit Medications</p>
                      <hr>
                      <form class="" action="<?php echo site_url('home/Medics_update');?>" method="post">
                        <div class="w3-row">
                             <div class="w3-col l12 m12 s12">
                              <table class="w3-table">
                                <tr>
                                  <td>Medication <input type="text" name="med" value="<?php echo $row->medication; ?>" class="w3-input w3-round"></td>
                                  <td>Dosage <input type="text" name="dosage" value="<?php echo $row->dosage; ?>" class="w3-input w3-round" required></td>
                                </tr>
                                <tr>
                                  <td>Taken For <input type="text" name="taken" value="<?php echo $row->taken_for; ?>" class="w3-input w3-round" required></td>
                                  <td><select class="w3-select w3-left w3-small w3-text-orange" name="medication">
                                    <option value=""><?php echo $row->current_past; ?></option>
                                    <option value="PastMed">Past</option>
                                    <option value="CurrentMed">Current</option>
                                  </select></td>
                                </tr>
                                <tr>
                                  <td><input type="text" name="id" value="<?php echo $row->id; ?>" class="w3-hide w3-input w3-round"></td>
                                  <td><input type="submit" name="" value="Edit" class="w3-button w3-blue w3-round w3-right"></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                    </form>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
              <?php foreach($Allergies as $row): ?>
                <div class="w3-modal w3-card-4 w3-animate-zoom" id="<?php echo $row->id."al" ?>">
                  <div class="w3-modal-content">
                    <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan">
                      <span onclick="document.getElementById('<?php echo $row->id."al" ?>').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                      <p class="w3-center w3-large w3-text-green">Allergies</p>
                      <hr>
                      <form class="" action="<?php echo site_url('home/Allergy_update');?>" method="post">
                        <div class="w3-row">
                             <div class="w3-col l12 m12 s12">
                              <table class="w3-table">
                                <tr>
                                  <td>Allergy<input type="text" name="allergy" value="<?php echo $row->allergy; ?>" class="w3-input w3-round" required></td>
                                  <td>Triggered By <input type="text" name="triggered_by" value="<?php echo $row->triggered_by; ?>" class="w3-input w3-round" required></td>
                                </tr>
                                <tr>
                                  <td>Medications <input type="text" name="allergy_med" value="<?php echo $row->allergy_med; ?>" class="w3-input w3-round" required></td>
                                  <td>Reaction <input type="text" name="reaction" value="<?php echo $row->reaction; ?>" class="w3-input w3-round" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td><input type="submit" name="" value="Submit" class="w3-button w3-green w3-round w3-right"></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                    </form>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
              <?php foreach($Hospitalization as $row): ?>
                <div class="w3-modal w3-card-4 w3-animate-zoom w3-margin-left" id="<?php echo $row->id."hosp" ?>">
                  <div class="w3-modal-content">
                    <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan">
                      <span onclick="document.getElementById('<?php echo $row->id."hosp" ?>').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                      <p class="w3-center w3-large w3-text-green">Edit Hospitalizations</p>
                      <hr>
                      <form class="" action="<?php echo site_url('home/hospital_update');?>" method="post">
                        <div class="w3-row">
                             <div class="w3-col l12 m12 s12">
                              <table class="w3-table">
                                <tr>
                                  <td>When<input type="date" name="when" value="<?php echo $row->when; ?>" class="w3-input w3-round" required></td>
                                  <td>Reason <input type="text" name="hosp_reason" value="<?php echo $row->hosp_reason; ?>" class="w3-input w3-round" required></td>
                                </tr>
                                <tr>
                                  <td>Where <input type="text" name="where" value="<?php echo $row->where; ?>" class="w3-input w3-round" required></td>
                                  <td>Discharge Report <input type="file" name="attach" value="<?php echo $row->report; ?>" class="w3-input w3-round w3-text-orange" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td><input type="submit" name="" value="Submit" class="w3-button w3-green w3-round w3-right"></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                    </form>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
              <?php foreach($Surgery as $row): ?>
                <div class="w3-modal w3-card-4 w3-animate-zoom" id="<?php echo $row->id."surg"; ?>">
                  <div class="w3-modal-content">
                    <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan">
                      <span onclick="document.getElementById('<?php echo $row->id."surg"; ?>').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                      <p class="w3-center w3-large w3-text-green">Edit Surgery/Implants</p>
                      <hr>
                      <form class="" action="<?php echo site_url('home/surgery_update');?>" method="post">
                        <div class="w3-row">
                             <div class="w3-col l12 m12 s12">
                              <table class="w3-table">
                                <tr>
                                  <td>Surgery<input type="text" name="surgery" value="<?php echo $row->surgery; ?>" class="w3-input w3-round" required></td>
                                  <td>Implant(If any)<input type="text" name="implant" value="<?php echo $row->implants; ?>" class="w3-input w3-round" required></td>
                                </tr>
                                <tr>
                                  <td>Done on<input type="date" name="done_on" value="<?php echo $row->done_on; ?>" class="w3-input w3-round" required></td>
                                  <td>By <input type="text" name="by" value="<?php echo $row->by; ?>" class="w3-input w3-round"></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td><input type="submit" name="" value="Submit" class="w3-button w3-green w3-round w3-right"></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                    </form>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
            </div>
         </div>
       </div>
       <div class="w3-container tabcontent w3-responsive" id="vitaltab_page" style="display:none;">    <!-- Vital Signs Tab -->
         <div class=" w3-container w3-card-2 w3-bordered w3-border-blue w3-round w3-margin-top " id="appoint_">
           <form class="w3-container w3-center w3-padding w3-margin-top w3-margin-left" action="<?php echo site_url('Home/Pulse_rate');?>" method="post" enctype="multipart/form-data">
             <table class="w3-table w3-responsive">
               <tr>
                 <td class="w3-text-green"><label for="concern">Add Vital Sign:</label></td>
                 <td>
                   <select class="w3-select" name="vital" >
                     <option value="Pulse">Pulses</option>
                     <option value="Temperature">Temperature</option>
                   </select>
                 </td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
               </tr>
               <tr>
                 <td class="w3-text-green"><label for="group">Date:</label></td>
                 <td> <input type="date" name="date" value="" class="w3-input"><i class="fa fa-calendar fa-fw w3-margin-bottom w3-right w3-text-green"></i></td>
                 <td class="w3-text-green"><label for="group">Time:</label></td>
                 <td> <input type="time" name="time" value="" class="w3-input"> <i class="fa fa-clock fa-fw w3-margin-bottom w3-right w3-text-green"></i></td>
                 <td class="w3-text-green"><label for="group">Measured:</label></td>
                 <td>
                   <select class="w3-select" name="in" >
                    <option value="morning">Morning</option>
                    <option value="afternoon">Afternoon</option>
                    <option value="evening">Evening</option>
                    <option value="night">Night</option>
                  </select>
                 </td>
               </tr>
               <tr>
                 <td class="w3-text-green"><label for="group">Pulse:</label></td>
                 <td> <input type="text" name="value" value="" class="w3-input"></td>
                 <td class="w3-text-green"><label for="group">Location:</label></td>
                 <td class="w3-text-green"><input type="radio" name="loc" class="w3-radio" value="wrist"/>Wrist</td>
                 <td class="w3-text-green"><input type="radio" name="loc" class="w3-radio" value="neck"/>Neck</td>
                 <td></td>
               </tr>
               <tr>
                 <td class="w3-text-green"><label for="group">Note:</label></td>
                 <td colspan="4">
                   <textarea name="note" rows="8" cols="80" class="w3-round" placeholder="Please add any additional information regarding your reading"></textarea>
                 </td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
               </tr>
             </table>
             <div class="w3-margin-top">
               <input type="submit" name="submit" value="SUBMIT" class="w3-small w3-button w3-green w3-text-white w3-round w3-margin-left">

             <input type="reset" name="cancel" value="CANCEL" class="w3-small w3-button  w3-red w3-text-white w3-round">
           </div>
           </form>
         </div>
       </div>
       <?php endif ?>
      </div>
    </div>
       <script type="text/javascript" src="<?php echo base_url(); ?>js/index.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>js/homepage.js"></script>
       <script type="text/javascript">
       //Health Condition
       function delete_hc(id)
       {
          if(confirm('Are you sure delete this data?'))
          {
              // ajax delete data to database
              $.ajax({
                  url : "<?php echo site_url('Home/delete_hcondition')?>/"+id,
                  type: "POST",
                  dataType: "JSON",
                  success: function(data)
                  {
                    window.location.href="http://localhost/Telehealth/index.php/Home"

                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      alert('Error deleting data');
                  }
              });

          }
       }
       function reload(){
         card.ajax.reload(null,false);
       }
       //Medication
       function delete_medic(id)
       {
          if(confirm('Are you sure delete this data?'))
          {
              // ajax delete data to database
              $.ajax({
                  url : "<?php echo site_url('Home/delete_med')?>/"+id,
                  type: "POST",
                  dataType: "JSON",
                  success: function(data)
                  {
                    window.location.href="http://localhost/Telehealth/index.php/Home"
                    reload();
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      alert('Error deleting data');
                  }
              });

          }
       }

       //Allergies
       function delete_al(id)
       {
          if(confirm('Are you sure delete this data?'))
          {
              // ajax delete data to database
              $.ajax({
                  url : "<?php echo site_url('Home/delete_al')?>/"+id,
                  type: "POST",
                  dataType: "JSON",
                  success: function(data)
                  {
                    window.location.href="http://localhost/Telehealth/index.php/Home"
                    reload();
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      alert('Error deleting data');
                  }
              });

          }
       }
       //Hospitalization
       function delete_hosp(id)
       {
          if(confirm('Are you sure delete this data?'))
          {
              // ajax delete data to database
              $.ajax({
                  url : "<?php echo site_url('Home/delete_hosp')?>/"+id,
                  type: "POST",
                  dataType: "JSON",
                  success: function(data)
                  {
                    window.location.href="http://localhost/Telehealth/index.php/Home"
                    reload();
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      alert('Error deleting data');
                  }
              });

          }
       }
       //surgery
       function delete_surg(id)
       {
          if(confirm('Are you sure delete this data?'))
          {
              // ajax delete data to database
              $.ajax({
                  url : "<?php echo site_url('Home/delete_surg')?>/"+id,
                  type: "POST",
                  dataType: "JSON",
                  success: function(data)
                  {
                    window.location.href="http://localhost/Telehealth/index.php/Home"
                    reload();
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      alert('Error deleting data');
                  }
              });

          }
       }
       </script>
    </body>
</html>
