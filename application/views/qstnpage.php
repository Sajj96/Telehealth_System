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
          <link rel="stylesheet" href="<?php echo base_url(); ?>css\fontawesome\css\all.css">
          <title>TH|Questions</title>
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
              <a href="<?php echo site_url('journey/')?>" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-book fa-fw w3-text-white"></i>Health Tips</a>
              <a href="<?php echo site_url('appointment/')?>" class="w3-bar-item w3-round w3-text-white w3-button w3-ripple"><i class="fa fa-calendar fa-fw w3-text-white"></i>Appointments
                <?php if($position=="Doctor"): ?>
                    <span class="w3-badge w3-orange w3-hover-green"><?php echo $count; ?></span>
                <?php endif ?>
              </a>
              <a href="#" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-orange w3-button"><i class="fa fa-comments fa-fw w3-text-white"></i>Questions
              <?php if($position=="Doctor"): ?>
                  <span class="w3-badge w3-white w3-hover-green"><?php echo $count_question; ?></span>
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
                <a href="#" class="w3-bar-item w3-round w3-text-white w3-hover-cyan w3-button"><i class="fa fa-file fa-fw w3-text-white"></i>Reports</a>
              <?php endif ?> -->
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
          <div><h3 class="w3-large w3-text-green w3-left"><i class="fa fa-comments fa-fw w3-text-green"></i>Questions:</h3>
          <br>
          <hr>
          </div>
              <?php if($position == "Doctor"): ?>
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a data-toggle="tab" href="#asked" >Asked Questions</a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#replied">Answered Questions</a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#all" >All Questions</a>
                  </li>
                </ul>
                <div class="tab-content" id="tabs">
                  <div id="asked" class="tab-pane fade in active">  <!--Asked Questions -->
                    <?php foreach($all_questions as $row): ?>
                      <?php if(($row->receiver == $firstname." ".$lastname) && ($row->answer == "")): ?>
                   <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card" style="width:85%;margin-top:3%;">
                     <header class="w3-grey w3-text-white">
                       <?php if($row->photo == "No Image"): ?>
                     <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                       <?php else: ?>
                     <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                     <?php endif ?>
                     </header>
                     <p class="w3-left w3-text-grey w3-margin-top" style="margin-left:5%;"><i><?php echo $row->firstname." ".$row->lastname ?></i></p>
                     <p class="w3-text-grey w3-right w3-margin-top"><i>To <?php echo "Dr.".$row->receiver; ?></i></p>
                     <br><hr>
                     <div class="w3-text">
                       <table class="w3-table w3-responsive">
                         <tr>
                           <?php if($row->attachment != ""): ?>
                           <td><img src="<?php echo base_url('images/'.$row->attachment);?>" alt="avatar" class="thumbnail" id="image_five" alt="header"></td>
                           <?php endif ?>
                           <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"><p><?php echo $row->question ?></p></td>
                         </tr>
                       </table>
                         <hr>
                       <div>
                         <small class="w3-text-grey w3-left"><i><?php echo $row->status; ?></i></small>
                         <?php if($row->answer != ""): ?>
                           <button name="button" class="w3-button w3-text-green w3-right" id="<?php echo $row->id."answer1"; ?>">View Answer</button>
                         <?php elseif($row->answer == ""): ?>
                         <button name="button" class="w3-button w3-text-blue w3-right" id="" onclick="answer_question()">Answer this Question</button>
                        <?php endif ?>
                       </div>
                     </div>
                   </div>
                   <br>
                 <?php endif ?>
                   <div class="w3-hide" id="<?php echo $row->id."letter1"?>" style="width:85%;margin-left:5%;">

                     <div class="w3-container w3-card-2 w3-margin" >
                       <div class="w3-container w3-light-grey w3-text-grey">
                           <textarea value="" class="w3-padding w3-white w3-round" style="width:80%;"
                           name="reasonbox" placeholder="Answer" rows="5"><?php echo $row->answer; ?></textarea>
                       </div>
                     </div>
                   </div>
                   <script type="text/javascript">
                     document.getElementById("<?php echo $row->id."answer1";?>").addEventListener("click",function(){
                       var letter = document.getElementById("<?php echo $row->id."letter1"?>");
                       if(letter.className.indexOf("w3-show")== -1){
                         letter.className += "w3-show";
                       }else{
                         letter.className =letter.className.replace("w3-show","");
                       }
                     });
                   </script>
                 <?php endforeach ?>
                  </div>
                  <div id="replied" class="tab-pane fade in">   <!--Answered Questions -->
                    <?php foreach($all_questions as $row): ?>
                      <?php if(($row->receiver == $firstname." ".$lastname) && ($row->answer != "")): ?>
                   <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card" style="width:85%;margin-top:3%;">
                     <header class="w3-grey w3-text-white">
                       <?php if($row->photo == "No Image"): ?>
                     <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                       <?php else: ?>
                     <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                     <?php endif ?>
                     </header>
                     <p class="w3-left w3-text-grey w3-margin-top" style="margin-left:5%;"><i><?php echo $row->firstname." ".$row->lastname ?></i></p>
                     <p class="w3-text-grey w3-right w3-margin-top"><i>To <?php echo "Dr.".$row->receiver; ?></i></p>
                     <br><hr>
                     <div class="w3-text">
                       <table class="w3-table w3-responsive">
                         <tr>
                           <?php if($row->attachment != ""): ?>
                           <td><img src="<?php echo base_url('images/'.$row->attachment);?>" alt="avatar" class="thumbnail" id="image_five" alt="header"></td>
                           <?php endif ?>
                           <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"><p><?php echo $row->question ?></p></td>
                         </tr>
                       </table>
                         <hr>
                       <div>
                         <small class="w3-text-grey w3-left"><i><?php echo $row->status; ?></i></small>
                         <?php if($row->answer != ""): ?>
                           <button name="button" class="w3-button w3-text-green w3-right" id="<?php echo $row->id."answer2"; ?>">View Answer</button>
                         <?php endif ?>
                       </div>
                     </div>
                   </div>
                   <br>
                 <?php endif ?>
                   <div class="w3-hide" id="<?php echo $row->id."letter2"?>" style="width:85%;margin-left:5%;">

                     <div class="w3-container w3-card-2 w3-margin" >
                       <div class="w3-container w3-light-grey w3-text-grey">
                           <textarea value="" class="w3-padding w3-white w3-round" style="width:80%;"
                           name="reasonbox" placeholder="Answer" rows="5"><?php echo $row->answer; ?></textarea>
                       </div>
                     </div>
                   </div>
                   <script type="text/javascript">
                     document.getElementById("<?php echo $row->id."answer2";?>").addEventListener("click",function(){
                       var letter = document.getElementById("<?php echo $row->id."letter2"?>");
                       if(letter.className.indexOf("w3-show")== -1){
                         letter.className += "w3-show";
                       }else{
                         letter.className =letter.className.replace("w3-show","");
                       }
                     });
                   </script>
                 <?php endforeach ?>
                  </div>
                  <div id="all" class="tab-pane fade in ">  <!--All Questions -->
                    <?php foreach($all_questions as $row): ?>
                   <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card" style="width:85%;margin-top:3%;">
                     <header class="w3-grey w3-text-white">
                       <?php if($row->photo == "No Image"): ?>
                     <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                       <?php else: ?>
                     <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                     <?php endif ?>
                     </header>
                     <p class="w3-left w3-text-grey w3-margin-top" style="margin-left:5%;"><i><?php echo $row->firstname." ".$row->lastname ?></i></p>
                     <p class="w3-text-grey w3-right w3-margin-top"><i>To <?php echo "Dr.".$row->receiver; ?></i></p>
                     <br><hr>
                     <div class="w3-text">
                       <table class="w3-table w3-responsive">
                         <tr>
                           <?php if($row->attachment != ""): ?>
                           <td><img src="<?php echo base_url('images/'.$row->attachment);?>" alt="avatar" class="thumbnail" id="image_five" alt="header"></td>
                           <?php endif ?>
                           <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"><p><?php echo $row->question ?></p></td>
                         </tr>
                       </table>
                         <hr>
                       <div>
                         <small class="w3-text-grey w3-left"><i><?php echo $row->status; ?></i></small>
                         <?php if($row->answer != ""): ?>
                           <button name="button" class="w3-button w3-text-green w3-right" id="<?php echo $row->id."answer3"; ?>">View Answer</button>
                         <?php elseif($row->answer == ""): ?>
                         <button name="button" class="w3-button w3-text-blue w3-right" id="" onclick="answer_question()">Answer this Question</button>
                        <?php endif ?>
                       </div>
                     </div>
                   </div>
                   <br>
                   <div class="w3-hide" id="<?php echo $row->id."letter3"?>" style="width:85%;margin-left:5%;">

                     <div class="w3-container w3-card-2 w3-margin" >
                       <div class="w3-container w3-light-grey w3-text-grey">
                           <textarea value="" class="w3-padding w3-white w3-round" style="width:80%;"
                           name="reasonbox" placeholder="Answer" rows="5"><?php echo $row->answer; ?></textarea>
                       </div>
                     </div>
                   </div>
                   <script type="text/javascript">
                     document.getElementById("<?php echo $row->id."answer3";?>").addEventListener("click",function(){
                       var letter = document.getElementById("<?php echo $row->id."letter3"?>");
                       if(letter.className.indexOf("w3-show")== -1){
                         letter.className += "w3-show";
                       }else{
                         letter.className =letter.className.replace("w3-show","");
                       }
                     });
                   </script>
                   <div class="modal fade" id="modal_answer" role="dialog">
                       <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                   <h3 class="modal-title">Answer</h3>
                               </div>
                               <div class="modal-body">
                                 <form action="<?php echo site_url('Question/Answer') ?>" id="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                                 <div class="form-body">
                                   <div class="w3-container w3-margin-top" >
                                    <div class="w3-row w3-margin-top">
                                       <div class="w3-col l12 m12 s12">
                                        <table class="w3-table w3-bordered w3-margin-top" id="">
                                          <tr>
                                    <td><div class="form-group">
                                          <div class="col-md-9">
                                            <textarea name="answer" rows="8" cols="80" class="form-control" placeholder="Your Answer"></textarea>
                                              <span class="help-block"></span>
                                              <input type="text" name="id" value="<?php echo $row->id; ?>" class="w3-hide">
                                          </div>
                                      </div>
                                    </td>
                                  </tr>
                               </table>
                             </div>
                           </div>
                         </div>
                      </div>
                     </div>
                       <div class="modal-footer">
                           <input type="submit" name="answer" class="btn btn-success" id="my_btn" value="Submit">
                           <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                       </div>
                     </form>
                 </div><!-- /.modal-content -->
             </div><!-- /.modal-dialog -->
                   </div>
                 <?php endforeach ?>
                  </div>
                </div>
              <?php else: ?>
              <div class="w3-container">   <!--Patients question page -->
                <?php if(($position != "admin") || ($position != "Doctor")): ?>
                 <button class="btn btn-success" onclick="ask_question()"><i class="glyphicon glyphicon-question-sign"></i>Ask Question</button>
                <?php endif ?>
                <hr>
                <div class="login_error">
                    <?php if(isset($message)): ?>
                      <?php echo "<div class='message w3-button w3-green w3-text-white w3-round' style='width:100%;'>"; ?>
                      <?php echo $message; ?>
                      <?php echo "</div>"; ?>
                    <?php endif ?>
                 </div>
                 <?php foreach($all_questions as $row): ?>
                <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card" style="width:85%;">
                  <header class="w3-grey w3-text-white">
                    <?php if($row->photo == "No Image"): ?>
                  <img src="<?php echo base_url();?>images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                    <?php else: ?>
                  <img src="<?php echo base_url('images/'.$row->photo);?>" alt="avatar" class="w3-image w3-circle w3-small w3-left w3-margin-top" id="image_two">
                  <?php endif ?>
                  </header>
                  <p class="w3-left w3-text-grey w3-margin-top" style="margin-left:5%;"><i><?php echo $row->firstname." ".$row->lastname ?></i></p>
                  <p class="w3-text-grey w3-right w3-margin-top"><i>To <?php echo "Dr.".$row->receiver; ?></i></p>
                  <br><hr>
                  <div class="w3-text">
                    <table class="w3-table w3-responsive">
                      <tr>
                        <?php if($row->attachment != ""): ?>
                        <td><img src="<?php echo base_url('images/'.$row->attachment);?>" alt="avatar" class="thumbnail" id="image_five" alt="header"></td>
                        <?php endif ?>
                        <td class="w3-bordered w3-leftbar w3-bar-block w3-border-light-grey"><p><?php echo $row->question ?></p></td>
                      </tr>
                    </table>
                      <hr>
                    <div>
                      <small class="w3-text-grey w3-left"><i><?php echo $row->status; ?></i></small>
                    <?php if($row->answer != ""): ?>
                      <button name="button" class="w3-button w3-text-green w3-right" id="<?php echo $row->id."answer4"; ?>">View Answer</button>
                    <?php endif ?>
                    </div>
                  </div>
                </div>
                <br>
                <div class="w3-hide" id="<?php echo $row->id."letter4"?>" style="width:85%;margin-left:5%;">

                  <div class="w3-container w3-card-2 w3-margin" >
                    <div class="w3-container w3-light-grey w3-text-grey">
                        <textarea value="" class="w3-padding w3-white w3-round" style="width:80%;"
                        name="reasonbox" placeholder="Answer" rows="5"><?php echo $row->answer; ?></textarea>
                    </div>
                  </div>
                </div>
                <script type="text/javascript">
                  document.getElementById("<?php echo $row->id."answer4";?>").addEventListener("click",function(){
                    var letter = document.getElementById("<?php echo $row->id."letter4"?>");
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
     </div>
       <script type="text/javascript" src="<?php echo base_url(); ?>js/index.js"></script>
       <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
       <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
       <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
       <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
       <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
       <script type="text/javascript">
       function ask_question()
        {
         $('#form')[0].reset(); // reset form on modals
         $('.form-group').removeClass('has-error'); // clear error class
         $('.help-block').empty(); // clear error string
         $('#modal_form').modal('show'); // show bootstrap modal
         $('.modal-title').text('Ask Question'); // Set Title to Bootstrap modal title
       }
       function answer_question()
        {
         $('#form')[0].reset(); // reset form on modals
         $('.form-group').removeClass('has-error'); // clear error class
         $('.help-block').empty(); // clear error string
         $('#modal_answer').modal('show'); // show bootstrap modal
         $('.modal-title').text('Answer'); // Set Title to Bootstrap modal title
       }
       </script>
       <div class="modal fade" id="modal_answer" role="dialog">
           <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h3 class="modal-title">Answer</h3>
                   </div>
                   <div class="modal-body">
                     <form action="<?php echo site_url('Question/Answer') ?>" id="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                     <div class="form-body">
                       <div class="w3-container w3-margin-top" >
                        <div class="w3-row w3-margin-top">
                           <div class="w3-col l12 m12 s12">
                            <table class="w3-table w3-bordered w3-margin-top" id="">
                              <tr>
                        <td><div class="form-group">
                              <div class="col-md-9">
                                <textarea name="answer" rows="8" cols="80" class="form-control" placeholder="Your Answer"></textarea>
                                  <span class="help-block"></span>
                                  <input type="text" name="id" value="<?php echo $row->id; ?>" class="w3-hide">
                              </div>
                          </div>
                        </td>
                      </tr>
                   </table>
                 </div>
               </div>
             </div>
          </div>
         </div>
           <div class="modal-footer">
               <input type="submit" name="answer" class="btn btn-success" id="my_btn" value="Submit">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
           </div>
         </form>
     </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
       </div>
       <div class="modal fade" id="modal_form" role="dialog">
           <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h3 class="modal-title">Ask Question</h3>
                   </div>
                   <div class="modal-body">
                     <form action="<?php echo site_url('Question/Asked_Question') ?>" id="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                     <div class="form-body">
                       <div class="w3-container w3-margin-top" >
                        <div class="w3-row w3-margin-top">
                           <div class="w3-col l12 m12 s12">
                            <table class="w3-table w3-bordered w3-margin-top" id="">
                              <tr>
                        <td><div class="form-group">
                              <div class="col-md-9">
                                <textarea name="qstn" rows="8" cols="80" class="form-control" placeholder="Anything in your mind?"></textarea>
                                  <span class="help-block"></span>
                              </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                      <td><div class="form-group">
                            <div class="col-md-9">
                            <select class="form-control" name="to_who">
                              <option value="">Choose Doctor's name</option>
                              <option value="all">All Physicians</option>
                              <?php foreach ($doctors as $key): ?>
                                <?php $expon=explode('<br>',$key->firstname); ?>
                               <?php $exp=explode('<br>',$key->lastname); ?>
                                 <?php echo '<option value="'.$expon[0]." ".$exp[0].'">Dr. '.$expon[0]." ".$exp[0].'</option>'; ?>
                              <?php endforeach ?>
                            </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                      </td>
                      </tr>
                      <tr>
                       <td><div class="form-group">
                             <div class="col-md-9">
                               <label class="control-label">Attach any supporting image:</label>
                                 <input name="attach" class="form-control" type="file" placeholder="Attach any supporting document:">
                                 <span class="help-block"></span>
                             </div>
                         </div>
                       </td>
                     </tr>
                   </table>
                 </div>
               </div>
             </div>
          </div>
         </div>
           <div class="modal-footer">
               <input type="submit" name="ask" class="btn btn-success" id="my_btn" value="Submit">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
           </div>
         </form>
     </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
       </div>
     </body>
</html>
