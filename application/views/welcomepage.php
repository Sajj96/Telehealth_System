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
               <!-- <a href="<?php echo site_url('signup/');?>"><button class="w3-button w3-green w3-round w3-margin-right w3-right w3-margin-top">Sign Up</button></a> -->
           </div>
         </div>
         <div class=" w3-container w3-bordered w3-border-blue w3-round w3-padding w3-margin-top " id="login_form">
           <a href="<?php echo site_url('');?>"><button class="w3-button w3-green w3-round w3-margin-right  w3-margin-top">Login</button></a>
           <a href="<?php echo site_url('');?>"><button class="w3-button w3-green w3-round w3-margin-right w3-margin-top">Sign Up</button></a>
         </div>
         <div class="w3-container w3-margin-top">
           <img src="<?php echo base_url();?>images/gif/telem.gif" alt="gif" class="w3-image" id="gif_tele">
         </div>
         <br>
         <div class="w3-container w3-margin-top">
           <img src="<?php echo base_url();?>images/gif/new.gif" alt="gif" class="w3-image w3-circle w3-left " id="web">
           <img src="<?php echo base_url();?>images/gif/phone.gif" alt="gif" class="w3-image w3-circle w3-right" id="phone">
         </div>
       </div>
     </body>
</html>
