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

$submission_date=date('j/F/Y g:i A',time());

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
          <title>TH|Appointment</title>
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
              <a href="<?php echo site_url('appointment/')?>" class="w3-bar-item w3-round w3-text-white w3-orange w3-button w3-ripple"><i class="fa fa-calendar fa-fw w3-text-white"></i>Appointments
                <?php if($position=="Doctor"): ?>
                    <span class="w3-badge w3-white w3-hover-green"><?php echo $count; ?></span>
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
          <?php if($position ==  "Doctor"): ?>  <!-- Appointment Page for Doctor -->
            <div><h3 class="w3-large w3-text-green w3-left"><i class="fa fa-calendar fa-fw w3-text-green"></i>Appointments:</h3>
            <br>
            <hr>
            </div>
            <div class="w3-left" id="refresh"><button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button></div>
            <br />
            <br />
            <ul class="nav nav-tabs">
              <li class="active">
                <a data-toggle="tab" href="#waiting" style="color:orange;">Waiting<span class="w3-badge w3-orange"><?php echo $count; ?></span></a>
              </li>
              <li>
                <a data-toggle="tab" href="#Rescheduled">Rescheduled<span class="w3-badge w3-blue"><?php echo $count_reschedule; ?></span></a>
              </li>
              <li>
                <a data-toggle="tab" href="#canceled" style="color:red;">Cancelled<span class="w3-badge w3-red"><?php echo $count_cancel; ?></span></a>
              </li>
              <li>
                <a data-toggle="tab" href="#confirm" style="color:green;">Confirmed<span class="w3-badge w3-green"><?php echo $count_confirm; ?></span></a>
              </li>
            </ul>
          <div class="w3-responsive">
            <div class="tab-content" id="tabs">
            <div id="waiting" class="tab-pane fade in active">  <!--Waiting tab -->
              <?php foreach($requests as $row): ?>
                <?php if(($row->status == "Pending") && ($row->doctor == $firstname." ".$lastname)): ?>
             <div class="w3-container w3-margin-top w3-card-2 w3-hover-shadow w3-bordered w3-leftbar w3-bar-block w3-border-orange" id="card_">
               <div class="w3-row w3-margin-top">
                  <div class="w3-col l12 m12 s12">
                  <form class="" action="<?php echo site_url('appointment/confirm'); ?>" method="post">
                  <table class="w3-table w3-responsive">
                    <tr>
                      <td>
                        <?php if($row->photo == "No Image"): ?>
                          <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-left" id="image_three">
                        <?php else: ?>
                          <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_three">
                        <?php endif ?>
                      </td>
                      <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"><p><?php echo $row->patient; ?>(<?php echo $row->email; ?>)</p><p>Consultation with Dr.<?php echo $row->doctor; ?> (On <?php echo $row->date; ?>)</p></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><p>Submitted On:<p></p><?php echo $row->day; ?></p></td>
                      <td><input type="text" name="email" value="<?php echo $row->email; ?>" class="w3-hide"></td>
                      <td><p class="w3-margin-left"><span class="glyphicon glyphicon-info-sign" style="color:orange;font-size:25px;"></span></p><p>Waiting</p></td>
                    </tr>
                    <tr>
                      <td><?php echo $row->sub_date; ?></td>
                      <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"></td>
                      <td></td>
                      <td></td>
                      <td><a name="button" class="w3-button w3-text-blue" id="<?php echo $row->email."waiting"; ?>">REASON</a></td>
                      <td><a name="button" class="w3-button w3-text-red" onclick="document.getElementById('<?php echo $row->email."cancel1"?>').style.display='block'">CANCEL</a></td>
                      <td><a name="button" class="w3-button w3-text-blue" onclick="document.getElementById('<?php echo $row->email."resche"?>').style.display='block'">RESCHEDULE</a></td>
                      <td><input type="submit" name="submit" value="CONFIRM" class="w3-button w3-text-green"></td>
                    </tr>
                  </table>
                </form>
               </div>
             </div>
           </div>
         <?php endif ?>
         <div class="w3-hide" id="<?php echo $row->email."letter1"?>">

           <div class="w3-container w3-card-2 w3-margin">
             <div class="w3-container w3-light-grey w3-text-grey">
                 <textarea value="" class="w3-padding w3-white w3-round" style="width:80%;"
                 name="reasonbox" placeholder="Reasons" rows="5"><?php echo $row->reason; ?></textarea>
             </div>
           </div>
         </div>
         <script type="text/javascript">
           document.getElementById("<?php echo $row->email."waiting";?>").addEventListener("click",function(){
             var letter = document.getElementById("<?php echo $row->email."letter1"?>");
             if(letter.className.indexOf("w3-show")== -1){
               letter.className += "w3-show";
             }else{
               letter.className =letter.className.replace("w3-show","");
             }
           });
         </script>
         <div class="w3-modal w3-card-4 w3-animate-zoom w3-round" id="<?php echo $row->email."resche" ?>">
           <div class="w3-modal-content">
             <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan"  id="f1">
               <span onclick="document.getElementById('<?php echo $row->email."resche" ?>').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                 <div class="w3-container w3-margin">
                   <div class="w3-container">
                     <form class="" action="<?php echo site_url('appointment/reschedule'); ?>" method="post">
                      <label>Date</label><input type="date" name="date" class="w3-input">
                      <label>Time</label><input type="time" name="time" class="w3-input">
                      <input type="text" name="email" value="<?php echo $row->email; ?>" class="w3-hide">
                      <input type="submit" name="submit" value="Submit" class="w3-button w3-blue w3-margin-top w3-round w3-text-white w3-right">
                    </form>
                   </div>
                 </div>
               </div>
             </div>
         </div>
         <div class="w3-modal w3-card-4 w3-animate-zoom w3-round" id="<?php echo $row->email."cancel1" ?>">
           <div class="w3-modal-content">
             <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan"  id="f1">
               <span onclick="document.getElementById('<?php echo $row->email."cancel1" ?>').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
                 <div class="w3-container w3-margin">
                   <div class="w3-container">
                     <form class="" action="<?php echo site_url('appointment/cancel'); ?>" method="post">
                       <textarea value="" class="w3-padding w3-white w3-round" style="width:80%;"
                       name="cancelbox" placeholder="Write reasons to cancel..." rows="5"></textarea>
                      <input type="text" name="email" value="<?php echo $row->email; ?>" class="w3-hide">
                      <input type="submit" name="submit" value="Submit" class="w3-button w3-blue w3-margin-top w3-round w3-text-white w3-right">
                    </form>
                   </div>
                 </div>
               </div>
             </div>
         </div>
         <?php endforeach ?>
         </div>
      <div  id="Rescheduled" class="tab-pane fade">   <!--Reschedule tab -->
           <?php foreach($requests as $row): ?>
             <?php if(($row->status == "Rescheduled") && ($row->doctor == $firstname." ".$lastname)): ?>
           <div class="w3-container w3-margin-top w3-card-2 w3-hover-shadow 3-bordered w3-leftbar w3-bar-block w3-border-blue" id="card_">
             <div class="w3-row w3-margin-top">
                <div class="w3-col l12 m12 s12">
                <form class="" action="<?php echo site_url('appointment/confirm'); ?>" method="post">
                <table class="w3-table w3-responsive">
                  <tr>
                    <td><?php if($row->photo == "No Image"): ?>
                        <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-left" id="image_three">
                      <?php else: ?>
                        <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_three">
                      <?php endif ?></td>
                    <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"><p><?php echo $row->patient; ?>(<?php echo $row->email; ?>)</p><p>Consultation with Dr.<?php echo $row->doctor; ?> (On <?php echo $row->date; ?>)</p></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p>Rescheduled On:<p></p><?php echo $row->day; ?> At <?php echo $row->time; ?></p></td>
                    <td><input type="text" name="email" value="<?php echo $row->email; ?>" class="w3-hide"></td>
                    <td><p class="w3-margin-left"><span class="glyphicon glyphicon-calendar" style="color:blue;font-size:25px;"></span></p><p>Rescheduled</p></td>
                  </tr>
                  <tr>
                    <td><?php echo $row->sub_date; ?></td>
                    <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a name="button" class="w3-button w3-text-blue" id="<?php echo $row->email."reschedule"; ?>">APPOINTMENT REASON</a></td>
                    <td><a name="button" class="w3-button w3-text-red" onclick="document.getElementById('<?php echo $row->email."cancel"?>').style.display='block'">CANCEL</a></td>
                    <td><input type="submit" name="submit" value="CONFIRM" class="w3-button w3-text-green"></td>
                  </tr>
                </table>
              </form>
             </div>
           </div>
         </div>
       <?php endif ?>
       <div class="w3-hide" id="<?php echo $row->email."letter2"?>">

         <div class="w3-container w3-card-2 w3-margin">
           <div class="w3-container w3-light-grey w3-text-grey">
               <textarea value="" class="w3-padding w3-white w3-round" style="width:80%;"
               name="reasonbox" placeholder="Reasons" rows="5"><?php echo $row->reason; ?></textarea>
           </div>
         </div>
       </div>
       <script type="text/javascript">
         document.getElementById("<?php echo $row->email."reschedule";?>").addEventListener("click",function(){
           var letter = document.getElementById("<?php echo $row->email."letter2"?>");
           if(letter.className.indexOf("w3-show")== -1){
             letter.className += "w3-show";
           }else{
             letter.className =letter.className.replace("w3-show","");
           }
         });
       </script>
       <div class="w3-modal w3-card-4 w3-animate-zoom w3-round" id="<?php echo $row->email."cancel" ?>">
         <div class="w3-modal-content">
           <div class="w3-container w3-leftbar w3-bar-block w3-border-cyan"  id="f1">
             <span onclick="document.getElementById('<?php echo $row->email."cancel" ?>').style.display='none'" class="w3-button w3-display-topright w3-clear w3-large">&times;</span>
               <div class="w3-container w3-margin">
                 <div class="w3-container">
                   <form class="" action="<?php echo site_url('appointment/cancel'); ?>" method="post">
                     <textarea value="" class="w3-padding w3-white w3-round" style="width:80%;"
                     name="cancelbox" placeholder="Write reasons to cancel..." rows="5"></textarea>
                    <input type="text" name="email" value="<?php echo $row->email; ?>" class="w3-hide">
                    <input type="submit" name="submit" value="Submit" class="w3-button w3-blue w3-margin-top w3-round w3-text-white w3-right">
                  </form>
                 </div>
               </div>
             </div>
           </div>
       </div>
     <?php endforeach ?>
         </div>
        <div id="canceled" class="tab-pane fade">   <!--Cancel tab -->
           <?php foreach($requests as $row): ?>
             <?php if(($row->status == "Cancel") && ($row->doctor == $firstname." ".$lastname)): ?>
           <div class="w3-container w3-margin-top w3-card-2 w3-hover-shadow w3-bordered w3-leftbar w3-bar-block w3-border-red" id="card_">
             <div class="w3-row w3-margin-top">
                <div class="w3-col l12 m12 s12">
                <table class="w3-table w3-responsive">
                  <tr>
                    <td><?php if($row->photo == "No Image"): ?>
                        <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-left" id="image_three">
                      <?php else: ?>
                        <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_three">
                      <?php endif ?></td>
                    <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"><p><?php echo $row->patient; ?>(<?php echo $row->email; ?>)</p><p>Consultation with Dr.<?php echo $row->doctor; ?> (On <?php echo $row->date; ?>)</p></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p>Cancelled On:<p></p><?php echo $row->day; ?> At <?php echo $row->time; ?></p></td>
                    <td><input type="text" name="email" value="<?php echo $row->email; ?>" class="w3-hide"></td>
                    <td><p class="w3-margin-left"><span class="glyphicon glyphicon-remove-sign" style="color:red;font-size:25px;"></span></p><p>Cancelled</p></td>
                  </tr>
                  <tr>
                    <td><?php echo $row->sub_date; ?></td>
                    <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"></td>
                    <td></td>
                    <td></td>
                    <td> </td>
                    <td> </td>
                    <td><button name="button" class="w3-button w3-text-blue" id="<?php echo $row->email."cancel"; ?>">APPOINTMENT REASON</button></td>
                    <td><button name="button" class="w3-button w3-text-red" id="<?php echo $row->email."c_reason"; ?>">REASON TO CANCEL</button></td>
                  </tr>
                </table>
             </div>
           </div>
         </div>
       <?php endif ?>
       <div class="w3-hide" id="<?php echo $row->email."letter3"?>">

         <div class="w3-container w3-card-2 w3-margin">
           <div class="w3-container w3-light-grey w3-text-grey">
               <textarea value="" class="w3-padding w3-white w3-round" style="width:80%;"
               name="box" placeholder="Reasons" rows="5"><?php echo $row->reason; ?></textarea>
           </div>
         </div>
       </div>
       <div class="w3-hide" id="<?php echo $row->email."letter4"?>">

         <div class="w3-container w3-card-2 w3-margin">
           <div class="w3-container w3-light-grey w3-text-grey">
               <textarea value="" class="w3-padding w3-white w3-round" style="width:80%;"
               name="box" placeholder="Reasons" rows="5"><?php echo $row->c_reason; ?></textarea>
           </div>
         </div>
       </div>
       <script type="text/javascript">
         document.getElementById("<?php echo $row->email."cancel";?>").addEventListener("click",function(){
           var letter = document.getElementById("<?php echo $row->email."letter3"?>");
           if(letter.className.indexOf("w3-show")== -1){
             letter.className += "w3-show";
           }else{
             letter.className =letter.className.replace("w3-show","");
           }
         });
       </script>
       <script type="text/javascript">
         document.getElementById("<?php echo $row->email."c_reason";?>").addEventListener("click",function(){
           var letter = document.getElementById("<?php echo $row->email."letter4"?>");
           if(letter.className.indexOf("w3-show")== -1){
             letter.className += "w3-show";
           }else{
             letter.className =letter.className.replace("w3-show","");
           }
         });
       </script>
     <?php endforeach ?>
         </div>
         <div id="confirm" class="tab-pane fade">  <!--Confirming tab -->
           <?php foreach($requests as $row): ?>
             <?php if(($row->status == "Confirmed") && ($row->doctor == $firstname." ".$lastname)): ?>
           <div class="w3-container w3-card-2 w3-margin-top w3-hover-shadow w3-bordered w3-leftbar w3-bar-block w3-border-green" id="card_">
             <div class="w3-row w3-margin-top">
                <div class="w3-col l12 m12 s12">
                <table class="w3-table w3-responsive">
                  <tr>
                    <td><?php if($row->photo == "No Image"): ?>
                        <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-left" id="image_three">
                      <?php else: ?>
                        <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_three">
                      <?php endif ?></td>
                    <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"><p><?php echo $row->patient; ?>(<?php echo $row->email; ?>)</p><p>Consultation with Dr.<?php echo $row->doctor; ?> (On <?php echo $row->date; ?>)</p></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p>Confirmed On:</p><p><?php echo $row->day; ?></p> At <?php echo $row->time; ?></td>
                    <td><input type="text" name="email" value="<?php echo $row->email; ?>" class="w3-hide"></td>
                    <td><p class="w3-margin-left"><span class="glyphicon glyphicon-ok-sign" style="color:green;font-size:25px;"></span></p><p>Confirmed</p></td>
                  </tr>
                  <tr>
                    <td><?php echo $row->sub_date; ?></td>
                    <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"></td>
                    <td></td>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                    <td><button name="button" class="w3-button w3-text-blue" id="<?php echo $row->email."confirm"; ?>">APPOINTMENT REASON</button></td>
                  </tr>
                </table>
             </div>
           </div>
         </div>
   <?php endif ?>
       <div class="w3-hide" id="<?php echo $row->email."letter5"?>">

             <div class="w3-container w3-card-2 w3-margin">
               <div class="w3-container w3-light-grey w3-text-grey">
                   <textarea value="" class="w3-padding w3-white w3-round" style="width:80%;"
                   name="box" placeholder="Reasons" rows="5"><?php echo $row->reason; ?></textarea>
               </div>
             </div>
       </div>
       <script type="text/javascript">
         document.getElementById("<?php echo $row->email."confirm";?>").addEventListener("click",function(){
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
   </div>
 <?php elseif($position == "admin"): ?>
   <div class="w3-container">
     <h3 class="w3-large w3-text-green w3-left"><i class="fa fa-calendar fa-fw w3-text-green"></i>Appointments:</h3>
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
         <div class="w3-col l12 m12 s12">
           <table id="table" class="table table-striped table-responsive table-bordered" cellspacing="0" width="100%" overflow-x="auto" style="border:1px;">
            <thead>
            <tr class="w3-green w3-text-white" style="background-color:black;color:white;">
                <!-- <th></th> -->
                <th>To</th>
                <th>On</th>
                <th>At</th>
                <th>By</th>
                <th>Email</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Submitted At</th>
                <th>Submitted On</th>
                <!-- <th>Phone</th> -->

            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
                <!-- <th></th> -->
                <th>To</th>
                <th>On</th>
                <th>At</th>
                <th>By</th>
                <th>Email</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Submitted On</th>
                <th>Submitted At</th>

            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
 <?php else: ?>
          <div class="w3-container">
            <h3 class="w3-large w3-text-green w3-left"><i class="fa fa-calendar fa-fw w3-text-green"></i>Appointments:</h3>
            <br>
            <hr>
               <?php foreach($Appointment as $row): ?>
                  <?php if($row->status == "Pending"): ?>
                    <div class="w3-container w3-card-2 w3-bordered w3-leftbar w3-bar-block w3-border-orange w3-animate-zoom" id="appoint_form">
                      <div class="w3-left">
                          <p>You submitted your request to <?php echo "Dr.".$row->doctor; ?></p>
                          <p>Please make payments for your Appointment for further notifications</p>
                          <p>Go to payment page or Click <a href="<?php echo site_url('Payments/') ?>">here</a></p>
                      </div>
                    <div class="w3-right">
                      <p class="w3-margin-left"><span class="glyphicon glyphicon-info-sign" style="color:orange;font-size:25px;"></span><br><?php echo $row->status; ?></p>
                     </div>
                    </div>
                  <?php endif ?>
                  <?php if($row->status == "Rescheduled"): ?>
                    <div class="w3-container w3-card-2 w3-bordered w3-leftbar w3-bar-block w3-border-blue w3-animate-zoom" id="appoint_form">
                      <div class="w3-left">
                          <p>Your appointment request to <?php echo "Dr.".$row->doctor; ?> has been rescheduled</p>
                          <p>Note: Come on <?php echo $row->day; ?> at <?php echo $row->time; ?>; Sorry for any inconvenience</p>
                      </div>
                    <div class="w3-right">
                      <p class="w3-margin-left"><span class="glyphicon glyphicon-calendar" style="color:blue;font-size:25px;"></span><br><?php echo $row->status; ?></p>
                     </div>
                    </div>
                  <?php endif ?>
                  <?php if($row->status == "Cancel"): ?>
                    <div class="w3-container w3-card-2 w3-bordered w3-leftbar w3-bar-block w3-border-red w3-animate-zoom" id="appoint_form">
                      <div class="w3-left">
                          <p>Your appointment request to <?php echo "Dr.".$row->doctor; ?> has been cancelled</p>
                          <p>Reason:<?php echo $row->c_reason; ?> ; Sorry for any inconvenience</p>
                      </div>
                    <div class="w3-right">
                      <p class="w3-margin-left"><span class="glyphicon glyphicon-remove-sign" style="color:red;font-size:25px;"></span><br><?php echo $row->status; ?></p>
                     </div>
                    </div>
                  <?php endif ?>
                  <?php if($row->status == "Confirmed"): ?>
                    <div class="w3-container w3-card-2 w3-bordered w3-leftbar w3-bar-block w3-border-green w3-animate-zoom" id="appoint_form">
                      <div class="w3-left">
                          <p>Your appointment request to <?php echo "Dr.".$row->doctor; ?> has been confirmed</p>
                          <p>Note:Remember to come on time on <?php echo $row->day; ?> at <?php echo $row->time; ?>, Thank you for trusting us</p>
                      </div>
                    <div class="w3-right">
                      <p class="w3-margin-left"><span class="glyphicon glyphicon-ok-sign" style="color:green;font-size:25px;"></span><br><?php echo $row->status; ?></p>
                     </div>
                    </div>
                  <?php endif ?>
                <?php endforeach ?>
              </div>
            <!-- <a href="http://localhost:3000"><button type="button" name="button" class="w3-button w3-green w3-right w3-round">Video</button></a> -->
          <div class=" w3-container w3-card-2 w3-bordered w3-border-blue w3-round w3-margin-top " id="appoint_form">
            <div class="login_error">
                <?php if(isset($success_message)): ?>
                  <?php echo "<div class='message w3-button w3-green w3-text-white w3-round' style='width:100%;'>"; ?>
                  <?php echo $success_message; ?>
                  <?php echo "</div>"; ?>
                <?php endif ?>
                <?php if(isset($error)): ?>
                  <?php echo "<div class='message w3-button w3-blue w3-text-white w3-round ' style='width:100%;'>"; ?>
                  <?php echo $error; ?>
                  <?php echo "</div>"; ?>
                <?php endif ?>
             </div>
            <form class="w3-container w3-center w3-padding w3-margin-top w3-margin-left" action="<?php echo site_url('appointment/appoint');?>" method="post" enctype="multipart/form-data">
              <table class="w3-table">
                <tr>
                  <td>Doctor's Name:</td>
                  <!-- <td><input type="text" name="name" class="w3-input w3-button" required></td> -->
                  <td><select class="w3-select w3-text-black" name="name" required>
                       <option value="">Choose Doctor's name</option>
                       <?php foreach ($doctors as $key): ?>
                         <?php $expon=explode('<br>',$key->firstname); ?>
                        <?php $exp=explode('<br>',$key->lastname); ?>
                          <?php echo '<option value="'.$expon[0]." ".$exp[0].'">Dr. '.$expon[0]." ".$exp[0].'</option>'; ?>
                       <?php endforeach ?>
                  </select></td>
                </tr>
                <tr>
                  <td>Date of Appointment:</td>
                  <td><input type="date" name="date" class="w3-input" required></td>
                </tr>
                <tr>
                  <td>Time:</td>
                  <td><input type="time" name="time" class="w3-input" required></td>
                </tr>
                <tr>
                  <?php foreach($home_details as $row): ?>
                  <td>Patient's Name:</td>
                  <td><input type="text" name="pname" class="w3-input" value="<?php echo $firstname.' '.$lastname; ?>"></td>
                </tr>
                <tr>
                  <td>Email:</td>
                  <td><input type="email" name="email" class="w3-input" value="<?php echo $row->email; ?>"></td>
                </tr>
                <tr>
                  <td>Phone Number:</td>
                  <td><input type="text" name="phone" class="w3-input" value="<?php echo "(+255)".$row->phone; ?>"></td>
                <?php endforeach ?>
                </tr>
                <tr>
                  <td>Reason for Appointment:</td>
                  <td><textarea name="reason" rows="6" cols="60" class="w3-round" required></textarea></td>
                </tr>
                <tr>
                  <td><input type="reset" name="cancel" value="Cancel" class="w3-input w3-button  w3-red w3-text-white w3-round"></td>
                  <td><input type="submit" name="submit" class="w3-input w3-button w3-green w3-text-white w3-round"></td>
                </tr>
              </table>
            </form>
          </div>
        <?php endif ?>
        </div>
       </div>
       <script type="text/javascript" src="<?php echo base_url(); ?>js/index.js"></script>
       <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
       <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
       <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
       <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
       <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
       <script type="text/javascript">
         function reload_table(){
           window.location.href="https://sajjabuu.test/Telehealth/index.php/appointment"
         }

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
                     "url": "<?php echo site_url('Appointment/ajax_list')?>",
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
