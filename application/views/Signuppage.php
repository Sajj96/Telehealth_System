<!DOCTYPE html>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
          <link rel="stylesheet" href="<?php echo base_url(); ?>css/styles.css">
          <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
          <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
          <link rel="stylesheet" href="<?php echo base_url(); ?>css\fontawesome\css\all.css">
          <title>TH|SignUp</title>
          <link rel="shortcut icon" href="<?php echo base_url();?>images/headicon.jpg" class="w3-image w3-circle">
          <style media="screen">
            body{
              background-image:url("<?php echo base_url();?>images/gif/necce.gif");
              background-size: cover;
              height: 100%;
              background-repeat: no-repeat;
              background-position: center;
            }
          </style>
     </head>
     <body>
       <div class="w3-main" id="main">
         <div class="w3-nav w3-cyan w3-text-white w3-border-bottom">
           <div class="w3-container">
             <img src="<?php echo base_url();?>images/steth3.jpg" alt="logo" class="w3-image w3-circle w3-left">
             <h2 class=" w3-text-white w3-hide-medium w3-margin-left w3-hide-small w3-left" id="my">My Clinic</h2>
               <p class="w3-hide-large w3-text-white w3-margin-left w3-left w3-margin-top w3-large">My Clinic</p>
              <a href="<?php echo site_url('login/');?>"><button class="w3-button w3-green w3-round w3-margin-right w3-right w3-margin-top">Sign In</button></a>
           </div>
         </div>
         <div class=" w3-container w3-card-2 w3-bordered w3-border-blue w3-round w3-margin-top " id="signup_form">
           <?php if(isset($message)): ?>
             <div class="col-xs-12">
               <div class="alert alert-success" style="text-align:center"><?php echo $message; ?></div>
             </div>
           <?php endif ?>
           <?php if(isset($error)): ?>
             <div class="col-xs-12">
               <div class="alert alert-danger" style="text-align:center"><?php echo $error; ?></div>
             </div>
           <?php endif ?>
           <form class="w3-container w3-center w3-padding w3-margin-top w3-margin-left" action="<?php echo site_url('signup/signup_users');?>" method="post" enctype="multipart/form-data">
             <img src="<?php echo base_url();?>images/steth.jpg" alt="logo" class="w3-image w3-circle w3-center">
             <br><br>
              <table  width="100%" class="w3-table" id="table">
               <tr>
                 <td class="w3-text-green w3-large">Click to upload photo</td>
                 <td><input type="file" name="attach" class="w3-button w3-round-xxlarge w3-text-orange"></td>
               </tr>
              <tr>
                <td><input type="email" name="email" class="w3-input w3-round " placeholder="Enter email" required></td>
                <td><input type="password" name="pass" class="w3-input w3-round " placeholder="Enter password" required></td>
              </tr>
              <tr>
                <td><input type="text" name="fname" class="w3-input w3-round " placeholder="Firstname" required></td>
                <td><input type="text" name="lname" class="w3-input w3-round " placeholder="Lastname" required></td>
              </tr>
              <tr>
                <td><input type="date" name="date" class="w3-input w3-round " placeholder="Date of Birth" required></td>
                <td><select class="w3-select w3-round w3-right" name="gender" required>
                    <option value="">--Choose Gender--</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Male">Intersex</option>
                  </select></td>
              </tr>
              <tr>
                 <td><input type="text" name="phone" class="w3-input w3-round " placeholder="(+255)" required></td>
                <td><input type="text" name="address" class="w3-input w3-round" placeholder="Address"></td>
              </tr>
              <tr>
                <td><select class="w3-select w3-round w3-right w3-hide" name="position" required>
                    <option value="Patient">Patient</option>
                  </select></td>
                  <td></td>
              </tr>
                <tr class="w3-hide" id="doc">
                  <td><select class="w3-select w3-round w3-right" name="professional" >
                      <option value="">--Choose your Professional--</option>
                      <option value="MD">MD</option>
                      <option value="CO">CO</option>
                    </select></td>
                    <td><select class="w3-select w3-round w3-right" name="category" >
                        <option value="">--Choose your Category--</option>
                        <option value="General">General</option>
                        <option value="Bone">Bones</option>
                        <option value="Heart">Heart</option>
                        <option value="Infections">Infections</option>
                        <option value="Gynaecology">Gynaecology</option>
                        <option value="Cancer">Cancer</option>
                        <option value="Kidney">Kidney</option>
                      </select></td>
                </tr>
                <tr  class="w3-hide" id="doc2">
                  <td><select class="w3-select w3-round w3-right w3-border-blue" name="day" multiple>
                      <option value="All">All Week Days</option>
                      <option value="MON">MON</option>
                      <option value="TUE">TUE</option>
                      <option value="WED">WED</option>
                      <option value="THU">THU</option>
                      <option value="FRI">FRI</option>
                      <option value="SAT">SAT</option>
                      <option value="SUN">SUN</option>
                    </select></td>
                    <td><input type="time" name="time" class="w3-input w3-round" placeholder="Time"></td>
                </tr>
          <script type="text/javascript">
          document.getElementById("position").addEventListener("click",function(){
            var letter = document.getElementById("doc");
            if(letter.className.indexOf("w3-show")== -1 && document.getElementById("position").value === "Doctor"){
              letter.className += "w3-show";
            }else{
              letter.className =letter.className.replace("w3-show","");
            }
          });
        </script>
        <script type="text/javascript">
        document.getElementById("position").addEventListener("click",function(){
          var letter = document.getElementById("doc2");
          if(letter.className.indexOf("w3-show")== -1 && document.getElementById("position").value === "Doctor"){
            letter.className += "w3-show";
          }else{
            letter.className =letter.className.replace("w3-show","");
          }
        });
      </script>
              <tr>
                <td><input type="checkbox" name="policy" value="Accepted" class="w3-check" id="con">I accept <a href="#" class="w3-text-blue">Terms and Condition</a></td>
                <td><input type="submit" name="submit" value="Submit" class="w3-button w3-right w3-margin-right w3-orange w3-round" id="sub"></td>
              </tr>
            </table>
           </form>
         </div>
       </div>
       <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
       <script>
       $(function(){
         var btn = $('#sub');
         btn.attr('disabled','disabled');
         $('input[name=policy]').change(function(e){
           if($(this).val() == "Accepted"){
             btn.removeAttr('disabled');
           }
           else if($(this).val() == ""){
             btn.attr('disabled','disabled');
             window.location.href="https://sajjabuu.test/Telehealth/index.php/SignUp"
           }
         });
       });
       </script>
     </body>
</html>
