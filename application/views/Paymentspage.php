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
          <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
          <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
          <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
          <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
          <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
          <link rel="stylesheet" href="<?php echo base_url();?>js/datatables.css">
          <script type="text/javascript" src="<?php echo base_url();?>js/datatables.js"></script>
          <link rel="stylesheet" href="<?php echo base_url();?>js/datatables.min.css">
          <script type="text/javascript" src="<?php echo base_url();?>js/datatables.min.js"></script>
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
          <link rel="stylesheet" href="<?php echo base_url(); ?>css\fontawesome\css\all.css">
          <title>TH|Payments</title>
          <link rel="shortcut icon" href="<?php echo base_url();?>images/headicon.jpg" class="w3-image w3-circle">

          <style media="screen">
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
              <?php if(($position =="Doctor") || ($position =="admin")): ?>
              <a href="#" class="w3-bar-item w3-round w3-text-white w3-button"><i class="fa fa-users fa-fw w3-text-white"></i>Patients</a>
              <?php else: ?>
              <a href="<?php echo site_url('doctor/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Search Doctor</a>
              <a href="<?php echo site_url('disease/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-heart fa-fw w3-text-white"></i>Search Disease</a>
            <?php endif ?>
            <?php if($position == "admin"): ?>
              <a href="<?php echo site_url('Doctors/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-user-md fa-fw w3-text-white"></i>Doctors</a>
            <?php endif ?>
              <a href="<?php echo site_url('Journey/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-book fa-fw w3-text-white"></i>Health Tips</a>
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
              <a href="" class="w3-bar-item w3-round w3-text-white w3-orange w3-hover-cyan w3-button"><i class="fa fa-money-bill-wave fa-fw w3-text-white"></i>Payments</a>
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
          <div><h3 class="w3-large w3-text-green w3-left"><i class="fa fa-calendar fa-fw w3-text-green"></i>Payments:</h3>
          <br>
          <hr>
          </div>
          <?php if($position == "Doctor"): ?>
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
                <p class="w3-large w3-text-green">Total Revenue: <?php echo $sum ?></p>
               <div class="w3-row w3-margin-top">
                  <div class="w3-col l12 m12 s12">
                    <table id="table" class="table table-striped table-responsive table-bordered" cellspacing="0" width="100%" overflow-x="auto">
                     <thead>
                     <tr class="w3-green w3-text-white">
                         <!-- <th></th> -->
                         <th>Paid For</th>
                         <th>Email</th>
                         <th>Paid By</th>
                         <th>Card Number</th>
                         <th>Month</th>
                         <th>Year</th>
                         <th>Amount</th>
                         <th>Verify Code</th>
                         <th>Status</th>
                         <!-- <th>Phone</th> -->

                     </tr>
                   </thead>
                   <tbody>
                   </tbody>
                   <tfoot>
                     <tr>
                       <th>Paid For</th>
                       <th>Email</th>
                       <th>Paid By</th>
                       <th>Card Number</th>
                       <th>Month</th>
                       <th>Year</th>
                       <th>Amount</th>
                       <th>Verify Code</th>
                       <th>Status</th>
                     </tr>
                   </tfoot>
                 </table>
               </div>
             </div>
           </div>
          <?php elseif($position == "admin"): ?>
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
                <p class="w3-large w3-text-green">Total Revenue: <?php echo $sum ?></p>
               <div class="w3-row w3-margin-top">
                  <div class="w3-col l12 m12 s12">
                    <table id="table" class="table table-striped table-responsive table-bordered" cellspacing="0" width="100%" overflow-x="auto">
                     <thead>
                     <tr class="w3-green w3-text-white">
                         <!-- <th></th> -->
                         <th>Paid For</th>
                         <th>Paid By</th>
                         <th>Card Number</th>
                         <th>Month</th>
                         <th>Year</th>
                         <th>Amount</th>
                         <th>Verify Code</th>
                         <th>Status</th>
                         <!-- <th>Phone</th> -->

                     </tr>
                   </thead>
                   <tbody>
                   </tbody>
                   <tfoot>
                     <tr>
                       <th>Paid For</th>
                       <th>Paid By</th>
                       <th>Card Number</th>
                       <th>Month</th>
                       <th>Year</th>
                       <th>Amount</th>
                       <th>Verify Code</th>
                       <th>Status</th>
                     </tr>
                   </tfoot>
                 </table>
               </div>
             </div>
           </div>
          <?php else: ?>
            <div class=" w3-container w3-card-2 w3-bordered w3-border-blue w3-round w3-margin-top " id="appoint_">
              <div class="login_error">
                  <?php if(isset($success_message)): ?>
                    <?php echo "<div class='message w3-button w3-green w3-text-white w3-round' style='width:100%;'>"; ?>
                    <?php echo $success_message; ?>
                    <?php echo "</div>"; ?>
                  <?php endif ?>
              </div>
              <form class="w3-container w3-center w3-padding w3-margin-top w3-margin-left" action="<?php echo site_url('Payments/pays');?>" method="post" enctype="multipart/form-data">
                <table class="w3-table w3-responsive">
                  <tr>
                    <td>
                      <select class="w3-select" name="for" size="">
                       <option value="">Paying For</option>
                       <option value="Appointment">Appointment</option>
                       <option value="Consultation">Consultation</option>
                      </select>
                    </td>
                    <td class="w3-text-green">
                      <label for="amount">Amount</label>
                    </td>
                    <td>
                      <input type="text" name="amount" value="10000" class="w3-input">
                    </td>

                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="w3-text-green">
                      <input type="radio" name="pay" class="w3-radio" value="card"/>
                    </td>
                    <td><img src="<?php echo base_url();?>images/visa1.png" alt="avatar" class="w3-image w3-small" id="im"></td>
                    <td><img src="<?php echo base_url();?>images/masterc.png" alt="avatar" class="w3-image w3-small" id="im"></td>
                    <td><img src="<?php echo base_url();?>images/amex1.jpg" alt="avatar" class="w3-image w3-small" id="im"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td colspan="2"> <input type="text" name="num" class="w3-input" placeholder="Debit/Credit Card Number" size="25"></td>
                    <td></td>
                    <td> <input type="text" name="code"  class="w3-input" placeholder="Security Code"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td class="w3-text-green"><label for="exp">Expires</label></td>
                    <td>
                      <select class="w3-select" name="month" >
                       <option value="">Month</option>
                       <option value="January">January</option>
                       <option value="February">February</option>
                       <option value="March">March</option>
                       <option value="April">April</option>
                       <option value="May">May</option>
                       <option value="June">June</option>
                       <option value="July">July</option>
                       <option value="August">August</option>
                       <option value="September">September</option>
                       <option value="October">October</option>
                       <option value="November">November</option>
                       <option value="December">December</option>
                      </select>
                    </td>
                    <td>
                      <select class="w3-select" name="year" >
                       <option value="">Year</option>
                       <option value="2019">2019</option>
                       <option value="2020">2020</option>
                       <option value="2021">2021</option>
                       <option value="2022">2022</option>
                       <option value="2023">2023</option>
                       <option value="2024">2024</option>
                       <option value="2025">2025</option>
                       <option value="2026">2026</option>
                       <option value="2027">2027</option>
                       <option value="2028">2028</option>
                       <option value="2029">2029</option>
                       <option value="2030">2030</option>
                      </select>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="w3-text-green"><input type="radio" name="pay" class="w3-radio" value="Mpesa"/></td>
                    <td><img src="<?php echo base_url();?>images/mpesa.jpg" alt="avatar" class="w3-image w3-small" id="im"></td>
                    <td><img src="<?php echo base_url();?>images/tg1.png" alt="avatar" class="w3-image w3-small" id="im"></td>
                    <td><img src="<?php echo base_url();?>images/airtel.png" alt="avatar" class="w3-image w3-small" id="im"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="5">
                      <p>Dial *150*01# or *150*00# or *150*60#</p>
                      <ul>
                        <li>Choose number 5</li>
                        <li>Then choose number 4 (Lipa Bili)</li>
                        <li>Then choose number 3 (Ingiza namba ya kampuni)</li>
                        <li>Enter 554433</li>
                        <li>Then you will receive verification code</li>
                      </ul>
                    </td>
                    <td class="w3-text-green"> <label for="vcode">Enter verification Code</label></td>
                    <td><input type="text" name="vcode"  class="w3-input" placeholder="00-00-00" /></td>
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
          <?php endif ?>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/index.js"></script>
        <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
        <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/Chart.js"></script>
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
                    "url": "<?php echo site_url('Payments/ajax_list')?>",
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



          });
    </script>
     </div>
      </body>
  </html>
