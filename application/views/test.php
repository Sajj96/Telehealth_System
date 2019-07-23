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
  header("location:https://sajjabuu.test/Telehealth/");
session_destroy();
}
$submission_date=date('j/F/Y g:i A',time());
include_once('notifications.php');

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
          <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
          <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
          <link rel="stylesheet" href="<?php echo base_url();?>js/datatables.css">
          <script type="text/javascript" src="<?php echo base_url();?>js/datatables.js"></script>
          <link rel="stylesheet" href="<?php echo base_url();?>js/datatables.min.css">
          <script type="text/javascript" src="<?php echo base_url();?>js/datatables.min.js"></script>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
          crossorigin="anonymous">
          <title>TH|Search Patient</title>
          <link rel="shortcut icon" href="<?php echo base_url();?>images/headicon.jpg" class="w3-image w3-circle">

          <style media="screen">
            input[type="text"]{
              border:none;
              box-shadow: none;
            }
            #card{
              display: inline-block;
              overflow-x: scroll;
              white-space: nowrap;
            }
          </style>
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
              <a href="#" class="w3-bar-item w3-round w3-text-white w3-orange w3-button"><i class="fa fa-users fa-fw w3-text-white"></i>Patients</a>
              <?php else: ?>
              <a href="<?php echo site_url('doctor/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Search Doctor</a>
              <a href="<?php echo site_url('disease/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-heart fa-fw w3-text-white"></i>Search Disease</a>
            <?php endif ?>
              <a href="#" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-book fa-fw w3-text-white"></i>Health Journey</a>
              <a href="<?php echo site_url('appointment/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-calendar fa-fw w3-text-white"></i>Appointments
                <?php if($position=="Doctor"): ?>
                    <span class="w3-badge w3-orange w3-hover-green"><?php echo $count; ?></span>
                <?php endif ?>
              </a>
              <a href="#" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-comments fa-fw w3-text-white"></i>Questions</a>
              <?php if($position == "Doctor"): ?>
                <button class="w3-button w3-bar-item w3-round w3-text-white w3-hover-cyan" id="doc_con"><i class="fa fa-stethoscope fa-fw w3-text-white"></i>Consultation Notes<i class="fa fa-angle-down fa-fw w3-text-white"></i></button>
                  <div class="w3-hide" id="page">
                    <a href="<?php echo site_url('Consultation/')?>" class="w3-bar-item w3-round w3-text-grey w3-hover-cyan  w3-button w3-animate-zoom">Make Consultation</a>
                    <a href="#" class="w3-bar-item w3-round w3-text-grey w3-hover-cyan w3-button w3-animate-zoom">Consultations</a>
                  </div>
              <?php else: ?>
                <a href="<?php echo site_url('Consultation/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan  w3-button"><i class="fa fa-stethoscope fa-fw w3-text-white"></i>Consultation Notes</a>
              <?php endif ?>
              <a href="#" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-file-powerpoint-o fa-fw w3-text-white"></i>Prescription</a>
              <a href="" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-money fa-fw w3-text-white"></i>Payments</a>
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
          <div class="w3-container w3-bordered w3-border-cyan" id="profile">
            <div class="w3-row">
                 <div class="w3-col l12 m12 s12">
                   <?php foreach ($home_details as $row): ?>
                      <table width="80%" class="w3-table w3-margin-top">
                        <tr>
                          <td>
                              <?php if($row->photo == "No Image"): ?>
                            <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-left" id="image">
                              <?php else: ?>
                            <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-left" id="image">
                            <?php endif ?>
                            <ul class="w3-left" id="list">
                              <li class="w3-text-green w3-large w3-margin-left"><?php //echo $row->firstname.' '.$row->lastname; ?></li>
                              <li class="w3-margin-left">Age:(<?php //echo $row->dob; ?>)</li>
                              <li class="w3-margin-left">Sex:<?php //echo $row->gender; ?></li>
                            </ul>
                          </td>
                          <td><p>Monitored Under:</p>
                            <p>Patient ID:P<?php echo $id;?></p>
                          </td>
                          <td></td>
                        </tr>
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
          <div class="w3-left" id="chart">
            <canvas id="canvas"></canvas>
          </div>
          <div class="w3-right" id="chart">
            <canvas id="canvas_two"></canvas>
          </div>
          <br>
          <br>
          <ul class="nav nav-tabs">
            <li class="active">
              <a data-toggle="tab" href="#health" style="color:green;">Health Condition</a>
            </li>
            <li>
              <a data-toggle="tab" href="#medication" style="color:green;">Medication</a>
            </li>
            <li>
              <a data-toggle="tab" href="#allergy" style="color:green;">Allergies</a>
            </li>
            <li>
              <a data-toggle="tab" href="#social" style="color:green;">Social History</a>
            </li>
            <li>
              <a data-toggle="tab" href="#hospital" style="color:green;">Hospitalization</a>
            </li>
            <li>
              <a data-toggle="tab" href="#surgery" style="color:green;">Surgery</a>
            </li>
          </ul>

          <div class="w3-responsive">
          <div class="tab-content" id="tabs">
              <div id="health" class="tab-pane fade in active">  <!-- Health condition tab -->
                <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card">
                    <div class="w3-row w3-margin-top w3-small">
                         <div class="w3-col l12 m12 s12">
                           <table class="w3-table">
                             <tr class="w3-light-grey">
                               <th>Health Condition</th>
                               <th>Diagnosed In</th>
                               <th>Medications</th>
                               <th>Current/Past</th>
                             </tr>
                             <?php foreach($health_condition as $row): ?>
                             <tr>
                               <td><?php echo $row->HC; ?></td>
                               <td><?php echo $row->Diagnosed; ?></td>
                               <td><?php echo $row->HC_Med; ?></td>
                               <td><?php echo $row->current_past; ?></td>
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
              <div id="medication" class="tab-pane fade">   <!--medication tab -->
                <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card">
                  <div class="w3-row w3-margin-top w3-small">
                       <div class="w3-col l12 m12 s12">
                         <table width="100%" class="w3-table">
                           <tr class="w3-light-grey">
                             <th>Medication</th>
                             <th>Dosage</th>
                             <th>Taken For</th>
                             <th>Current/Past</th>
                           </tr>
                           <?php foreach($medication as $row): ?>
                           <tr>
                             <td><?php echo $row->medication; ?></td>
                             <td><?php echo $row->dosage; ?></td>
                             <td><?php echo $row->taken_for; ?></td>
                             <td><?php echo $row->current_past; ?></td>
                           </tr>
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
              <div id="allergy" class="tab-pane fade">   <!--allergy tab -->
                <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan w3-margin-top w3-margin-bottom" id="card">
                    <div class="w3-row w3-margin-top w3-small">
                         <div class="w3-col l12 m12 s12">
                           <table width="100%" class="w3-table">
                             <tr class="w3-light-grey">
                               <th>Allergy</th>
                               <th>Triggered By</th>
                               <th>Medications</th>
                               <th>Reaction</th>
                             </tr>
                             <?php foreach($Allergies as $row): ?>
                             <tr>
                               <td><?php echo $row->allergy; ?></td>
                               <td><?php echo $row->triggered_by; ?></td>
                               <td><?php echo $row->allergy_med; ?></td>
                               <td><?php echo $row->reaction; ?></td>
                             </tr>
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
              <div id="social" class="tab-pane fade">   <!--Social tab -->
                <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan w3-margin-top" id="card">
                  <div class="w3-row w3-margin-top w3-small w3-">
                       <div class="w3-col l12 m12 s12">
                         <table class="w3-table">
                           <tr>
                             <td><textarea name="" class="w3-large w3-round" style="width:70%;" rows="5"><?php foreach($social_history as $row): ?><?php echo $row->social_hist; ?><?php endforeach ?></textarea></td>
                           </tr>
                           <tr>
                             <td></td>
                           </tr>
                         </table>
                       </div>
                  </div>

                </div>
              </div>
              <div id="hospital" class="tab-pane fade">   <!--Hospitalization tab -->
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
                           </tr>
                           <?php foreach($Hospitalization as $row): ?>
                           <tr>
                             <td><?php echo $row->when; ?></td>
                             <td><?php echo $row->hosp_reason; ?></td>
                             <td><?php echo $row->where; ?></td>
                             <td><?php echo $row->report; ?></td>
                           </tr>
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
              <div id="surgery" class="tab-pane fade">   <!--Surgery tab -->
                <div class="w3-container w3-card-4  w3-bordered w3-leftbar w3-bar-block w3-border-cyan w3-margin-top" id="card">
                  <div class="w3-row w3-margin-top w3-small">
                       <div class="w3-col l12 m12 s12">
                         <table width="100%" class="w3-table">
                           <tr class="w3-light-grey">
                             <th>Surgery</th>
                             <th>Implants(If any)</th>
                             <th>Done on</th>
                             <th>By</th>
                           </tr>
                           <?php foreach($Surgery as $row): ?>
                           <tr>
                             <td><?php echo $row->surgery; ?></td>
                             <td><?php echo $row->implants; ?></td>
                             <td><?php echo $row->done_on; ?></td>
                             <td><?php echo $row->by; ?></td>
                           </tr>
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
          </div>
        </div>
      </div>
      <script type="text/javascript">
      $(document).ready(function(){
        $.ajax({
          url:"<?php echo site_url('Patient_details/get_temperature')?>",
          type:"GET",
          dataType: "JSON",
          success: function(data){
            console.log(data);
            var vital_id = [];
            var temp = [];
            for(var i in data){
              vital_id.push(data[i].Time);
              temp.push(data[i].Temp);
            }

            var chartdata = {
              labels: vital_id,
              datasets : [
                {
                  label : 'Temperature Ranges',
                  backgroundColor: 'rgba(248,148,6,1)',
                  borderColor : 'rgba(200,200,200,0.75)',
                  hoverbackgroundColor: 'rgba(200,200,200,1)',
                  hoverborderColor: 'rgba(200,200,200,1)',
                  data: temp
                }
              ]
            };

            var ctx = $("#canvas");
            var barGraph = new Chart(ctx, {
              type: 'bar',
              data: chartdata
            });

          },
          error: function(data){
            alert("No Chart");
          }
        });
      });

      $(document).ready(function(){
        $.ajax({
          url:"<?php echo site_url('Patient_details/get_pulse')?>",
          type:"GET",
          dataType: "JSON",
          success: function(data){
            console.log(data);
            var vital_ = [];
            var tmp = [];
            for(var i in data){
              vital_.push(data[i].Time);
              tmp.push(data[i].Pulse_bpm);
            }

            var chartdata = {
              labels: vital_,
              datasets : [
                {
                  label : 'Pulse Rates',
                  backgroundColor: 'rgba(248,148,6,1)',
                  borderColor : 'rgba(200,200,200,0.75)',
                  hoverbackgroundColor: 'rgba(200,200,200,1)',
                  hoverborderColor: 'rgba(200,200,200,1)',
                  data: tmp
                }
              ]
            };

            var ctx = $("#canvas_two");
            var barGraph = new Chart(ctx, {
              type: 'bar',
              data: chartdata
            });

          },
          error: function(data){
            alert("No Chart");
          }
        });
      });
      </script>
    </body>
  </html>
