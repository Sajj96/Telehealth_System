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
          <title>TH|Login</title>
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
               <a href="<?php echo site_url('signup/');?>"><button class="w3-button w3-green w3-round w3-margin-right w3-right w3-margin-top">Sign Up</button></a>
           </div>
         </div>
         <div class=" w3-container w3-card-2 w3-bordered w3-border-blue w3-round w3-padding w3-margin-top " id="login_form">
           <div class="login_error">
               <?php if(isset($error_message)): ?>
                 <div class="col-xs-12">
                   <div class="alert alert-danger"><center><?php echo $error_message; ?></center></div>
                 </div>
               <?php endif ?>
          </div>
           <form class="w3-container w3-center w3-padding w3-margin-top w3-margin-left" action="<?php echo site_url('login/verify_user'); ?>" method="post">
             <!-- <table  width="100%" class="w3-padding-16" id="table"> -->
             <img src="<?php echo base_url();?>images/steth.jpg" alt="logo" class="w3-image w3-circle w3-center">
             <br><br>
              <i class="fa fa-user fa-2x fa-fw w3-text-cyan w3-left "></i><input type="email" name="username" class="w3-input w3-round w3-right" placeholder="Username" required>
              <br><br><br>
              <i class="fa fa-lock fa-2x w3-text-cyan w3-left "></i><input type="password" name="pass" class="w3-input w3-round w3-right w3-margin-left" placeholder="Password" required>
              <br><br><br><br>
              <p class="w3-left w3-margin-bottom"><a href="#" class="w3-text-blue">Forgot password?</a></p>
              <input type="submit" name="submit" value="Login" class="w3-button w3-right w3-margin-right w3-orange w3-round">
               <br><br><br>
              <p class="w3-left"> Don't have an account? <a href="<?php echo site_url('signup/');?>" class="w3-text-blue">Sign Up</a></p></td>
            <!-- </table> -->
           </form>
         </div>
       </div>
     </body>
</html>
