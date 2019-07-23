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
       <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css" type="text/css" media="all">
       <link rel="stylesheet" href="<?php echo base_url(); ?>css/styles.css" type="text/css" media="all">
       <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
       <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
       <link href="<?php echo base_url('css/bootstrap-wysihtml5.css')?>" rel="stylesheet">
       <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
       <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>js/html2canvas.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>js/dist/jspdf.min.js"></script>
       <link rel="stylesheet" href="<?php echo base_url(); ?>css\fontawesome\css\all.css">
       <script type="text/javascript">
       function printlr(layer){
         var generator = window.open(",'name,");
         var layertext = document.getElementById(layer);
         generator.document.write(layertext.innerHTML.replace("Print Me"));
         generator.document.close();
         generator.print();
         generator.close();
       }
       </script>
          <title>TH|Patient Details</title>
          <link rel="shortcut icon" href="<?php echo base_url();?>images/headicon.jpg" class="w3-image w3-circle">
          <style media="screen" type="text/css">

          </style>
     </head>
     <body id="div-id-name">
       <div class="w3-main" id="main">
         <div class="w3-row">
              <div class="w3-col l12 m12 s12">
                <table>
                  <tr>
                    <td class="w3-padding-left">
                      <img src="./images/steth.png" alt="logo" class=" w3-xlarge w3-circle w3-left w3-margin-top"></td>
                      <td>
                      <h2 class=" w3-text-black w3-xlarge"><b>My Clinic Health Management</b></h2>
                      <p>Email: myclinichealth@gmail.com</p>
                      <p>Phone: +255 659608434, +255 717 848561</p>
                      <p>Theme: We are close to you and your health</p>
                    </td>
                  </tr>
                </table>
              </div>
          </div>
          <hr>

          <div class="w3-container">
            <div class="w3-row">
                 <div class="w3-col l12 m12 s12">
                   <?php foreach ($patient_details as $row): ?>
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
                            <p>Patient ID:P<?php print $id;?></p>
                          </td>
                        </tr>
                        <tr>
                          <td><?php echo $row->email; ?></td>
                          <td><p class="w3-left"><i class="fa  fa-phone-square fa-fw w3-text-green"></i> +(255)<?php echo $row->phone; ?></p></td>
                          <td></td>
                        </tr>
                      </table>
                    <?php endforeach ?>
                  </div>
            </div>
          </div>
            <hr>
          <div class="container">
            <h4 class="w3-large w3-text-green w3-left"><b>Vital Signs:</b></h4><br /> <br />
            <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card">     <!-- Health condition tab -->
                <div class="w3-row  w3-small">
                     <div class="w3-col l12 m12 s12">
                       <table class="w3-table w3-bordered" width="100%">
                         <tr class="w3-light-grey w3-text-black">
                           <th>Temperature</th>
                           <th>Time</th>
                           <th>Date</th>
                         </tr>
                         <?php foreach($temp as $row): ?>
                         <tr>
                           <td><?php echo $row->Temp; ?></td>
                           <td><?php echo $row->Time; ?></td>
                           <td><?php echo $row->date; ?></td>
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
                  <div class="w3-row  w3-small">
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
          <br />
          <br>
          <div class="container">
          <h4 class="w3-large w3-text-green w3-left"><b>Health History:</b></h4><br />

                          <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card">     <!-- Health condition tab -->
                            <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-frown-o fa-fw w3-text-black"></i>Health Condition:</p>
                              <div class="w3-row  w3-small">
                                   <div class="w3-col l12 m12 s12">
                                     <table class="w3-table w3-bordered" width="100%">
                                       <tr class="w3-light-grey w3-text-black">
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

                          <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card"> <!--medication tab -->
                            <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-frown-o fa-fw w3-text-black"></i>Medications:</p>
                            <div class="w3-row w3-margin-top w3-small">
                                 <div class="w3-col l12 m12 s12">
                                   <table width="100%" class="table">
                                     <tr class="w3-light-grey w3-text-black">
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

                          <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan w3-margin-top w3-margin-bottom" id="card"> <!--allergy tab -->
                            <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-frown-o fa-fw w3-text-black"></i>Allergy:</p>
                              <div class="w3-row w3-margin-top w3-small">
                                   <div class="w3-col l12 m12 s12">
                                     <table width="100%" class="w3-table">
                                       <tr class="w3-light-grey w3-text-black">
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

                          <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan w3-margin-top" id="card"> <!--Social tab -->
                            <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-frown-o fa-fw w3-text-black"></i>Social History:</p>
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

                          <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan w3-margin-top" id="card"> <!--Hospitalization tab -->
                            <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-frown-o fa-fw w3-text-black"></i>Hospitalizations:</p>
                            <div class="w3-row w3-margin-top w3-small">
                                 <div class="w3-col l12 m12 s12">
                                   <table width="100%" class="w3-table">
                                     <tr class="w3-light-grey w3-text-black">
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

                          <div class="w3-container w3-card-4  w3-bordered w3-leftbar w3-bar-block w3-border-cyan w3-margin-top" id="card"> <!--Surgery tab -->
                              <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-frown-o fa-fw w3-text-black"></i>Surgery:</p>
                            <div class="w3-row w3-margin-top w3-small">
                                 <div class="w3-col l12 m12 s12">
                                   <table width="100%" class="w3-table w3-bordered">
                                     <tr class="w3-light-grey w3-text-black">
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
                          </div><br>
                        </div>
          <div class="w3-container">
          <h4 class="w3-large w3-text-green w3-left"><b>Appointments:</b></h4><br /> <br />
          <div class="w3-container w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card">
              <div class="w3-row w3-margin-top w3-small">
                   <div class="w3-col l12 m12 s12">
                     <table width="100%" class="w3-table ">
                       <tr class="w3-light-grey w3-text-black">
                         <th>To</th>
                         <th>On</th>
                         <th>At</th>
                         <th>Reason</th>
                         <th>Status</th>
                         <th>Submitted At</th>
                         <th>Submitted On</th>
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
        <br>
        <h4 class="w3-large w3-text-green w3-left"><b>Consultations:</b></h4><br /> <br />
        <div class="w3-container w3-card-2 w3-margin-top w3-hover-shadow w3-bordered w3-leftbar w3-bar-block w3-border-green" id="card_">
          <div class="w3-row w3-margin-top">
             <div class="w3-col l12 m12 s12">
               <table width="100%" class="w3-table">
                 <tr class="w3-light-grey w3-text-black">
                   <th>By</th>
                   <th>Type</th>
                   <th>Appointment</th>
                   <th>On</th>
                   <th>At</th>
                   <th>Reason</th>
                   <th>Notes</th>
                   <th>Submitted At</th>
                 </tr>
                 <?php foreach($patient_consults as $row): ?>
                 <tr>
                   <td><?php echo $row->doctor; ?></td>
                   <td><?php echo $row->type; ?></td>
                   <td><?php echo $row->asso_appoint; ?></td>
                   <td><?php echo $row->date; ?></td>
                   <td><?php echo $row->start_at; ?></td>
                   <td><?php echo $row->reason; ?></td>
                   <td><?php echo $row->notes; ?></td>

                </tr>
               <?php endforeach ?>
               </table>
          </div>
        </div>
      </div>

  <br>
    <h4 class="w3-large w3-text-green w3-left"><b>Prescriptions:</b></h4><br /> <br />
    <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-green" id="card_">
      <div class="w3-row w3-margin-top w3-small">
           <div class="w3-col l12 m12 s12">
             <table width="100%" class="w3-table">
               <tr class="w3-light-grey w3-text-black">
                 <th>Medication</th>
                 <th>Dosage</th>
                 <th>Start</th>
                 <th>Stop</th>
                 <th>Prescription Quantity</th>
               </tr>

               <?php foreach($presc as $key): ?>
                 <tr>
                 <td><?php echo $key->medics ?></td>
                 <td><?php echo $key->dosage; ?></td>
                 <td><?php echo $key->start ?></td>
                 <td><?php echo $key->stop ?></td>
                 <td><?php echo $key->quantity ?></td>
               </tr>
               <?php endforeach ?>

             </table>
           </div>
      </div>
    </div>
  </div>
  <br>
      </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/index.js"></script>
        <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
        <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/Chart.js"></script>
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
