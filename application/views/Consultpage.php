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
          <script type="text/javascript">
          function printlayer(layer){
            var generator = window.open(",'name,");
            var layertext = document.getElementById(layer);
            generator.document.write(layertext.innerHTML.replace("Print Me"));
            generator.document.close();
            generator.print();
            generator.close();
          }
          </script>
          <title>TH|Consultation</title>
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
              <?php if(($position =="Doctor") || ($position =="admin")): ?>
              <a href="<?php echo site_url('Patients/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-users fa-fw w3-text-white"></i>Patients</a>
              <?php else: ?>
              <a href="<?php echo site_url('doctor/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Search Doctor</a>
              <a href="<?php echo site_url('disease/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-heart fa-fw w3-text-white"></i>Search Disease</a>
            <?php endif ?>
            <?php if($position == "admin"): ?>
              <a href="<?php echo site_url('Doctors/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Doctors</a>
            <?php endif ?>
              <a href="<?php echo site_url('Journey/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-book fa-fw w3-text-white"></i>Health Tips</a>
              <a href="<?php echo site_url('appointment/')?>" class="w3-bar-item w3-round w3-text-white w3-button w3-ripple"><i class="fa fa-calendar fa-fw w3-text-white"></i>Appointments
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
                  <a href="<?php echo site_url('Consultation/')?>" class="w3-bar-item w3-round w3-orange w3-text-grey w3-hover-cyan  w3-button w3-animate-zoom">Make Consultation</a>
                  <a href="<?php echo site_url('Consultation/consult_two')?>" class="w3-bar-item w3-round w3-text-grey w3-hover-cyan w3-button w3-animate-zoom">Consultations</a>
              <?php elseif(($position == "Patient") || ($position == "admin")): ?>
                <a href="<?php echo site_url('Consultation/')?>" class="w3-bar-item w3-round w3-text-white w3-orange w3-hover-cyan  w3-button"><i class="fa fa-stethoscope fa-fw w3-text-white"></i>Consultation Notes</a>
              <?php endif ?>
            <!-- <?php if($position == "admin"): ?>
            <a href="<?php echo site_url('Reports/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-file fa-fw w3-text-white"></i>Reports</a>
          <?php endif ?>-->
             <a href="<?php echo site_url('Payments/') ?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-money fa-fw w3-text-white"></i>Payments</a>
         </div>
        </div>
        <div class="" id="mainpage">
          <?php if($position == "Doctor"): ?>  <!--Doctor Consultation -->
            <div class="w3-container w3-responsive">
            <h3 class="w3-large w3-text-green w3-left"><i class="fa fa-calendar fa-fw w3-text-green"></i>Log Consultation:</h3>
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
              <form class="w3-container w3-center w3-padding w3-margin-top w3-margin-left" action="<?php echo site_url('Consultation/Consults');?>" method="post" enctype="multipart/form-data">
                <table class="w3-table w3-responsive">
                  <tr>
                    <td><b>Medical Practitioner</b></td>
                    <td><b>Consultation Type</b></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><input type="text" name="dtname" class="w3-input" value="<?php echo "Dr.".$firstname ." ".$lastname?>"></td>
                    <td><select name="appoint_type" class="w3-select">
                      <option value="clinic">Clinical</option>
                      <option value="video">Video</option>
                    </select></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><b>Patient name</b></td>
                    <td><b>Associated Appointment</b></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><select name="ptname" class="w3-select" id="patient">
                      <option value="">Choose patient</option>
                      <?php foreach ($patients as $key): ?>
                         <?php echo '<option value="'.$key->email.'">'.$key->firstname." ".$key->lastname.'</option>'; ?>
                         <?php endforeach ?>
                    </select></td>
                    <td>
                      <select name="date_appoint" class="w3-select" id="appoint">
                        <option value="">Choose appointment</option>
                      </select>
                    </td>
                    <td><select name="email_of_pt" class="w3-select w3-hide" id="email_">
                      </select></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><b>Date of Consultation:</b></td>
                    <td><input type="date" value="<?php echo $submission_date; ?>" name="dateof" class="w3-input" required/></td>
                    <td><b>Start At:</b></td>
                    <td><input type="time" value="<?php echo $dt; ?>" name="timeof" class="w3-input" required></td>
                  </tr>
                  <tr>
                    <td><b>Reason for Consultation</b></td>
                    <td colspan="3"><input type="text" name="reasonof" class="w3-input" required></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><b>Notes:</b></td>
                    <td colspan="3"><textarea name="notes" rows="6" cols="60" class="w3-round" required></textarea></td>
                    <td></td>
                    <td></td>
                  </tr>
                </table>
                <div class="w3-container w3-card-4 w3-bordered" id="card">
                  <div class="w3-row w3-margin-top w3-small">
                       <div class="w3-col l12 m12 s12">
                         <table class="w3-table w3-responsive">
                           <tr>
                             <caption class="w3-large w3-text-green">Prescription</caption>

                           </tr>
                           <tr class="w3-light-grey">
                             <th>Medication</th>
                             <th>Dosage</th>
                             <th>Start</th>
                             <th>Stop</th>
                             <th>Prescription Quantity</th>
                           </tr>
                           <tr>
                             <td><input type="text" class="w3-input" name="med" id="med"></td>
                             <td><input type="text" name="doses" class="w3-input"></td>
                             <td><input type="date" name="start" id="on" class="w3-input"></td>
                             <td><input type="date" name="stop" id="off" class="w3-input"></td>
                             <td><input type="number" name="quantity" id="quant" class="w3-input"></td>
                           </tr>
                           </tr>
                           <tr>
                             <td colspan="5"><hr></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                           </tr>
                           <tr>
                             <td><button class="w3-text-green w3-button w3-white" onclick="document.getElementById('id02').style.display='block'"><i class="fa fa-plus-circle fa-fw w3-text-green "></i>ADD NEW</a></td>
                             <td></td>
                             <td></td>
                             <td></td>
                           </tr>
                         </table>
                       </div>
                  </div>
                </div>
                <hr>
                <div>
                  <input type="submit" name="submit" class="w3-small w3-button w3-green w3-text-white w3-round w3-margin-left">

                <input type="reset" name="cancel" value="Cancel" class="w3-small w3-button  w3-red w3-text-white w3-round w3-right">
              </div>
              </form>
            </div>
            <div class="w3-modal w3-card-4 w3-animate-zoom" id="id02">
              <div class="w3-modal-content">
                <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan">
                  <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                  <p class="w3-center w3-large w3-text-green">Add Medications</p>
                  <hr>
                  <form class="" action="" method="post">
                    <div class="w3-row">
                         <div class="w3-col l12 m12 s12">
                          <table class="w3-table w3-responsive">
                            <tr>
                              <td>Medication <input type="text" name="med" value="" class="w3-input w3-round" id="medics" required></td>
                              <td>Dosage <input type="text" name="dosage" value="" class="w3-input w3-round" id="dose" required ></td>
                              <td>Start <input type="date" name="start" value="" class="w3-input w3-round" id="start" required></td>
                            </tr>
                            <tr>
                              <td>Stop <input type="date" name="stop" value="" class="w3-input w3-round" id="stop" required></td>
                              <td>Prescription Quantity <input type="number" name="quantity" value="" class="w3-input w3-round" id="quantity" required></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td><input type="button" name="" value="Ok" class="w3-button w3-green w3-text-white w3-round" id="btnOk" onclick="document.getElementById('id02').style.display='none'"></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        <?php elseif($position == "admin"): ?> <!--Admin Consultation -->
          <div class="w3-container">
            <h3 class="w3-large w3-text-green w3-left"><i class="fa fa-calendar fa-fw w3-text-green"></i>Consultations:</h3>
            <br>
            <hr>
            <button class="w3-button w3-right w3-green w3-text-white w3-round" id="print" onclick="javascript:printlayer('div-id-name')"><i class="glyphicon glyphicon-print"></i>Print</button>
          <div class="w3-container w3-margin-top" id="div-id-name">
            <div class="w3-row w3-hide">
                 <div class="w3-col l12 m12 s12">
                   <table>
                     <tr>
                       <td class="w3-padding-left">
                         <img src="<?php echo base_url();?>images/steth.png" alt="logo" class="w3-image w3-circle w3-left w3-margin-top"></td>
                         <td>
                         <h2 class=" w3-text-black w3-xxlarge"><b>My Clinic Health Management</b></h2>
                         <p>Email: myclinichealth@gmail.com</p>
                         <p>Phone: +255 659608434, +255 717 848561</p>
                         <p>Theme: We are close to you and your health</p>
                       </td>
                     </tr>
                   </table>
                 </div>
             </div>
             <br>
             <div class="w3-row w3-margin-top" >
                <div class="w3-col l12 m12 s12">
                  <table id="table" class="table table-striped table-responsive table-bordered" cellspacing="0" width="100%" overflow-x="auto" >
                   <thead>
                   <tr class="w3-green w3-text-white">
                       <!-- <th></th> -->
                       <th>By</th>
                       <th>Type</th>
                       <th>Email</th>
                       <th>Appointment</th>
                       <th>On</th>
                       <th>At</th>
                       <th>Reason</th>
                       <th>Notes</th>
                       <!-- <th>Phone</th> -->

                   </tr>
                 </thead>
                 <tbody>
                 </tbody>
                 <tfoot>
                   <tr>
                       <!-- <th></th> -->
                       <th>By</th>
                       <th>Type</th>
                       <th>Email</th>
                       <th>Appointment</th>
                       <th>On</th>
                       <th>At</th>
                       <th>Reason</th>
                       <th>Notes</th>

                   </tr>
                 </tfoot>
               </table>
             </div>
           </div>
         </div>
       </div>
          <?php else: ?> <!--Patient Consultation -->
            <div class="w3-container">
              <h3 class="w3-large w3-text-green w3-left"><i class="fa fa-calendar fa-fw w3-text-green"></i>Consultations:</h3>
              <br>
              <hr>
              <?php foreach($all_consults as $row): ?>
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
                   <td><button name="button" class="w3-button w3-text-blue" id="<?php echo $row->email."notes"; ?>">NOTES</button></td>
                 <?php endforeach ?>
                   <td>
                     <?php if($row->type == "video"): ?>
                       <a href="http://localhost:3000"><button name="button" class="w3-button w3-text-blue" id="">Start Video</button></a>
                     <?php endif ?>
                   </td>
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
        </div>
          <?php endif ?>
        </div>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/index.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/Chart.js"></script>
        <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
        <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            $('#btnOk').click(function(){
              var data = $("#id02 #medics").val().trim();
              var data1 = $("#id02 #dose").val().trim();
              var data2 = $("#id02 #start").val().trim();
              var data3 = $("#id02 #stop").val().trim();
              var data4 = $("#id02 #quantity").val().trim();

              $('#med').val(data);
              $('[name="doses"]').val(data1);
              $('#on').val(data2);
              $('#off').val(data3);
              $('#quant').val(data4);
            });
          });
        </script>
        <script type="text/javascript">
          $(document).ready(function(){
            $('#patient').change(function(){
              var email = $('#patient').val();
              if(email != ''){
                $.ajax({
                  url:"<?php echo site_url('Consultation/fetch_appoint'); ?>",
                  method: "POST",
                  data:{email:email},
                  success: function(data){
                    $('#appoint').html(data);
                  },
                  error: function(data){
                    alert("No data");
                  }
                })
              }
            });
          });

          $(document).ready(function(){
            $('#patient').change(function(){
              var email = $('#patient').val();
              if(email != ''){
                $.ajax({
                  url:"<?php echo site_url('Consultation/fetch_'); ?>",
                  method: "POST",
                  data:{email:email},
                  success: function(data){
                    $('#email_').html(data);
                  },
                  error: function(data){
                    alert("No data");
                  }
                })
              }
            });
          });
        </script>
        <script type="text/javascript">
        var save_method; //for save method string
        var table;

        $(document).ready(function() {

            //datatables
            table = $('#table').DataTable({

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('Consultation/ajax_list')?>",
                    "type": "POST",
                    dataType: "JSON"
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                {
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

            });

            $('.datepicker').datepicker({
              autoclose: true,
              format: "yyyy-mm-dd",
              todayHighlight: true,
              orientation: "top auto",
              todayBtn: true,
              todayHighlight: true,
          });
          });
        </script>
    </body>
  </html>
