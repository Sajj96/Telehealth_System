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
$submission_date=date('j/F/Y g:i A',time());
include 'notifications.php';

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
       <script type="text/javascript" src="<?php echo base_url(); ?>js/html2canvas.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>js/dist/jspdf.min.js"></script>
       <script type="text/javascript">
         function printlayer(){
           document.getElementById('printpage').src = "<?php echo site_url('Patients/patient_report') ?>";
           document.getElementById('printpage').contentwindow.printl_();
         }

         window.onload = printlayer();
       </script>
       <link rel="stylesheet" href="<?php echo base_url(); ?>css\fontawesome\css\all.css">
          <title>TH|Patient Details</title>
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
                <?php if($position != "admin"): ?>
                <?php foreach($patient_details as $row): ?>
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
              <?php endif ?>
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
              <a href="<?php echo site_url('Patients/')?>" class="w3-bar-item w3-round w3-text-white w3-orange w3-button"><i class="fa fa-users fa-fw w3-text-white"></i>Patients</a>
              <?php else: ?>
              <a href="<?php echo site_url('doctor/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Search Doctor</a>
              <a href="<?php echo site_url('disease/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-heart fa-fw w3-text-white"></i>Search Disease</a>
            <?php endif ?>
            <?php if($position == "admin"): ?>
              <a href="" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Doctors</a>
            <?php endif ?>
              <a href="<?php echo site_url('Journey/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-book fa-fw w3-text-white"></i>Health Tips</a>
              <a href="<?php echo site_url('appointment/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-calendar fa-fw w3-text-white"></i>Appointments
                <?php if($position=="Doctor"): ?>
                    <span class="w3-badge w3-orange w3-hover-green"><?php echo $count; ?></span>
                <?php endif ?>
              </a>
              <a href="#" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-comments fa-fw w3-text-white"></i>Questions
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
                <a href="#" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-file-powerpoint-o fa-fw w3-text-white"></i>Reports</a>
              <?php endif ?>
              <a href="" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-money fa-fw w3-text-white"></i>Payments</a> -->
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
          <iframe src="<?php echo site_url('Patients/test') ?>" width="100%" height="100%" name="frame" class="w3-hide"></iframe>
          <div class="w3-container w3-bordered w3-border-cyan" >
            <div class="w3-row">
                 <div class="w3-col l12 m12 s12">
                   <?php foreach ($patient_details as $row): ?>
                      <table width="80%" class="w3-table w3-margin-top" id="mytable">
                        <tr>
                          <td>
                              <?php if($row->photo == "No Image"): ?>
                            <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small " id="image">
                              <?php else: ?>
                            <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small " id="image">
                            <?php endif ?>
                            <ul class="w3-left" id="list">
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
                          <form action="<?php echo site_url('Patients/patient_report') ?>" method="post" id="pdfform">
                          <td>
                              <input type="hidden" value="<?php echo $row->email; ?>" name="email" type="text"/ id="hidden_email">
                            <button type="submit" name="button" class="w3-button w3-text-white w3-green w3-round" id="pdf">
                              <i class="fa fa-download fa-fw w3-text-white"></i>Get PDF</button>
                          </td>
                          </form>
                          <td>
                            <button type="button" name="button" class="w3-button w3-text-white w3-green w3-round" id="print"  onclick="frames['frame'].print()">
                              <i class="fa fa-print fa-fw w3-text-white"></i>Print</button>
                          </td>
                        </tr>
                        <tr>
                          <td><?php echo $row->email; ?></td>
                          <td><p class="w3-left"><i class="fa  fa-phone-square fa-fw w3-text-green"></i> +(255)<?php echo $row->phone; ?></p></td>
                          <td>

                          </td>
                        </tr>
                      </table>
                    <?php endforeach ?>
                  </div>
            </div>
            <hr>
            <h4 class="w3-large w3-text-green w3-left"><b>Vital Signs:</b></h4><br /> <br />
            <div class="w3-left" id="chart">
              <canvas id="canvas"></canvas>
            </div>
            <div class="w3-right" id="chart">
              <canvas id="canvas_two"></canvas>
            </div>
          </div>
          <br />
          <div id="div-id-name">
          <h4 class="w3-large w3-text-green w3-left"><b>Health History:</b></h4><br /> <br />
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
            <div class="w3-container">
              <br>
            <h4 class="w3-large w3-text-green w3-left"><b>Consultations:</b></h4><br /> <br />
            <?php foreach($patient_consults as $row): ?>
              <?php if($row->email != ""): ?>
          <div class="w3-container w3-card-2 w3-margin-top w3-hover-shadow w3-bordered w3-leftbar w3-bar-block w3-border-green" id="card_">
            <div class="w3-row w3-margin-top">
               <div class="w3-col l12 m12 s12">
               <table class="w3-table w3-responsive">
                 <tr>
                   <td>
                       <img src="<?php echo base_url();?>images/visits.png" alt="avatar" class="w3-image w3-circle w3-small w3-left" id="image_four">
                     </td>
                   <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"><p class="w3-text-grey">By <?php echo $row->doctor ?></p><p>Consultation date:<?php echo $row->date; ?> (At <?php echo $row->start_at; ?>)</p>
                     <p>Reason: <?php echo $row->reason ?></p>
                   </td>
                   <td></td>
                 <?php foreach($presc as $key): ?>
                   <td><p>Medications: <?php echo $key->medics ?></p></td>
                   <td><p>Dosage: <?php echo $key->dosage; ?></p></td>
                   <td><p>Start: <p></p><?php echo $key->start ?></p></td>
                   <td><p>Stop: <p></p><?php echo $key->stop ?></p></td>
                   <td><p>Quantity: <?php echo $key->quantity ?></p></td>
                 <?php endforeach ?>
                 <td><button name="button" class="w3-button w3-text-blue" id="<?php echo $row->email."notes"; ?>">NOTES</button></td>
                 </tr>
                 <tr>
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
      <?php else: ?>
        <p class="w3-text-green ">No Consultations</p>
      <?php endif ?>
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
    </div><br>
        <div class="w3-container">
          <h4 class="w3-large w3-text-green w3-left"><b>Appointments:</b></h4><br /> <br />
          <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card">
              <div class="w3-row w3-margin-top w3-small">
                   <div class="w3-col l12 m12 s12">
                     <table class="w3-table">
                       <tr class="w3-light-green w3-text-white">
                         <th>To</th>
                         <th>On</th>
                         <th>At</th>
                         <th>Reason</th>
                         <th>Status</th>
                         <th>Submitted On</th>
                         <th>Submitted At</th>
                       </tr>
                       <?php foreach($appoints as $row): ?>
                       <tr>
                         <td><?php echo "Dr ".$row->doctor; ?></td>
                         <td><?php echo $row->date; ?></td>
                         <td><?php echo $row->time; ?></td>
                         <td><?php echo $row->reason; ?></td>
                         <td><?php echo $row->status; ?></td>
                         <td><?php echo $row->sub_date; ?></td>
                         <td><?php echo $row->day; ?></td>

                      </tr>
                     <?php endforeach ?>
                     </table>
                   </div>

              </div>
            </div>
        </div><br><br>
       </div>
      </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/index.js"></script>
        <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
        <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/Chart.js"></script>
        <!-- <script type="text/javascript">
          $(document).ready(function(){
            $('#pdf').click(function(){
              $('#hidden_email').val($('#chart').html());
              $('#pdfform').submit();
            });
        });
        </script> -->
        <script type="text/javascript">
        $(document).ready(function(){
          var tmp = document.getElementById("mytable");
          var x = tmp.rows[1].cells[0].innerHTML;
          $.ajax({
            url:"<?php echo site_url('Patients/get_temperature')?>/"+ x,
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
          var pulse = document.getElementById("mytable");
          var x = pulse.rows[1].cells[0].innerHTML;
          $.ajax({
            url:"<?php echo site_url('Patients/get_pulse')?>/"+ x,
            type:"GET",
            dataType: "JSON",
            success: function(data){
              console.log(data);
              var vital_ = [];
              var tmp = [];
              for(var i in data){
                vital_.push(data[i].Times);
                tmp.push(data[i].Pulse_bpm);
              }

              var chartdata = {
                labels: vital_,
                datasets : [
                  {
                    label : 'Pulse Rates(BPM)',
                    backgroundColor: 'rgba(63,195,128,1)',
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
      </div>
    </body>
  </html>
