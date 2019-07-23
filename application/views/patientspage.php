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
          <link rel="stylesheet" href="<?php echo base_url(); ?>css\fontawesome\css\all.css">
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
              <?php if(($position =="Doctor") || ($position =="admin")): ?>
              <a href="#" class="w3-bar-item w3-round w3-text-white w3-orange w3-button"><i class="fa fa-users fa-fw w3-text-white"></i>Patients</a>
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
          <br>
          <div class="" id="top_button">
            <!-- <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Patient</button> -->
            <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
            <p class="w3-large w3-text-green">Total number of patients: <?php echo $count_patient ?></p>
          </div>
          <?php if($position == "admin"): ?>
            <div class="w3-container w3-margin-top" id="tbscroll">
               <div class="w3-row w3-margin-top">
                  <div class="w3-col l12 m12 s12">
                    <table id="table" class="table table-striped table-responsive table-bordered" cellspacing="0" width="100%" overflow-x="auto">
                     <thead>
                     <tr class="w3-green w3-text-white">
                         <!-- <th></th> -->
                         <th>Photo</th>
                         <th>Firstname</th>
                         <th>Lastname</th>
                         <th>Email</th>
                         <th>Gender</th>
                         <th>DOB</th>
                         <th>Address</th>
                         <!-- <th>Phone</th> -->
                         <th></th>
                         <th></th>
                     </tr>
                   </thead>
                   <tbody>
                   </tbody>
                   <tfoot>
                     <tr>
                         <!-- <th></th> -->
                         <th>Photo</th>
                         <th>Firstname</th>
                         <th>Lastname</th>
                         <th>Email</th>
                         <th>Gender</th>
                         <th>DOB</th>
                         <th>Address</th>
                         <!-- <th>Phone</th> -->
                         <th></th>
                         <th></th>
                     </tr>
                   </tfoot>
                 </table>
               </div>
             </div>
           </div>
         <?php else: ?>
          <div class="w3-container w3-margin-top" id="tbscroll">
             <div class="w3-row w3-margin-top">
                <div class="w3-col l12 m12 s12">
                  <table id="table" class="table table-striped table-responsive table-bordered" cellspacing="0" width="100%" overflow-x="auto">
                   <thead>
                   <tr class="w3-green w3-text-white">
                       <!-- <th></th> -->
                       <th>Photo</th>
                       <th>Firstname</th>
                       <th>Lastname</th>
                       <th>Email</th>
                       <th>Gender</th>
                       <th>DOB</th>
                       <th>Address</th>
                       <!-- <th>Phone</th> -->
                       <th></th>
                       <th></th>
                   </tr>
                 </thead>
                 <tbody>
                 </tbody>
                 <tfoot>
                   <tr>
                       <!-- <th></th> -->
                       <th>Photo</th>
                       <th>Firstname</th>
                       <th>Lastname</th>
                       <th>Email</th>
                       <th>Gender</th>
                       <th>DOB</th>
                       <th>Address</th>
                       <!-- <th>Phone</th> -->
                       <th></th>
                       <th></th>
                   </tr>
                 </tfoot>
               </table>
             </div>
           </div>
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
            "url": "<?php echo site_url('Patients/ajax_list')?>",
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

    $("input").change(function(){
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
   });
  });

  function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Patient'); // Set Title to Bootstrap modal title
}



  function edit_person(id)
  {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('Patients/ajax_single_patient/')?>/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $.ajax({
              url : "<?php echo site_url('Patients/ajax_hc/')?>/" + id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                $('#hcdata').val(data.Diagnosed);
                $('#hc').val(data.HC);
                $('#hcmed').val(data.HC_Med);
                $('#hccp').val(data.current_past);
               }
            });


             $('[name="email"]').val(data.email);
             $('[name="photo"]').val(data.photo);
             $('#fname').val(data.firstname);
             $('[name="lastName"]').val(data.lastname);
             $('[name="gender"]').val(data.gender);
             $('[name="address"]').val(data.address);
             $('[name="dob"]').datepicker('update',data.dob);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Patient Information'); // Set title to Bootstrap modal title
            $.ajax({
              url:"<?php echo site_url('Patients/get_temperature')?>/" +id,
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
                      label : 'Temperature Ranges(Celcius)',
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

              }
          });
            $.ajax({
              url:"<?php echo site_url('Patients/get_pulse')?>/" +id,
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

              }
          });

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }

    });

}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('Patients/ajax_add')?>";
    } else {
        url = "<?php echo site_url('Patients/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        }
    });
}

function delete_person(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('Patients/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

  </script>


  <div class="modal fade" id="modal_form" role="dialog">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Patient Form</h3>
              </div>
              <div class="modal-body">
                <form action="<?php echo site_url('Patients/display_patient_details') ?>" id="form" class="form-horizontal" method="post">
                <input type="hidden" value="" name="id"/>
                <div class="form-body">
                  <div class="w3-container w3-margin-top" >
                   <div class="w3-row w3-margin-top">
                      <div class="w3-col l12 m12 s12">
                       <table class="w3-table w3-bordered w3-margin-top" id="tabledata">
                         <tr>
                   <td><div class="form-group">
                         <label class="control-label col-md-3">Firstname:</label>
                         <div class="col-md-9">
                             <input name="firstName" id="fname" placeholder="First Name" class="form-control" type="text">
                             <span class="help-block"></span>
                         </div>
                     </div>
                   </td>
                  <td><div class="form-group">
                        <label class="control-label col-md-3">Lastname:</label>
                        <div class="col-md-9">
                            <input name="lastName" placeholder="Last Name" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                  </td>
                  <td colspan="2"><div class="form-group">
                        <label class="control-label col-md-3">Email:</label>
                        <div class="col-md-9">
                            <input name="email" placeholder="Email" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                  </td>
                  <td></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
     </div>
            <div class="w3-left" id="chart">
              <canvas id="canvas"></canvas>
            </div>
            <div class="w3-right" id="chart">
              <canvas id="canvas_two"></canvas>
            </div>
            <div class="w3-container w3-card-4 w3-bordered w3-leftbar w3-bar-block w3-border-cyan" id="card">
                <p class="w3-left w3-text-green w3-margin-top"><i class="fa fa-heartbeat fa-fw w3-text-green"></i>Health Condition</p>
                <div class="w3-row w3-margin-top w3-small" id="form">
                     <div class="w3-col l12 m12 s12">
                       <table class="w3-table w3-responsive">
                         <tr class="w3-light-grey">
                           <th>Health Condition</th>
                           <th>Diagnosed In</th>
                           <th>Medications</th>
                           <th>Current/Past</th>
                         </tr>
                         <tr>
                           <td>
                             <div class="form-group">
                                 <div class="col-md-9">
                                     <input name="dc" id="hc" class="form-control" type="text">
                                     <span class="help-block"></span>
                                 </div>
                             </div>
                           </td>
                           <td>
                             <div class="form-group">
                                 <div class="col-md-9">
                                     <input name="dc" id="hcdata" class="form-control" type="text">
                                     <span class="help-block"></span>
                                 </div>
                             </div>
                           </td>
                           <td>
                             <div class="form-group">
                                 <div class="col-md-9">
                                     <input name="dc" id="hcmed" class="form-control" type="text">
                                     <span class="help-block"></span>
                                 </div>
                             </div>
                           </td>
                           <td>
                             <div class="form-group">
                                 <div class="col-md-9">
                                     <input name="dc" id="hccp" class="form-control" type="text">
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
              <div class="modal-footer">
                  <!-- <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button> -->
                  <input type="submit" name="show" class="btn btn-primary" id="my_btn" value="View More...">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </form>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  <script type="text/javascript">
  // $(document).ready(function(id){


  // $(document).ready(function(id){

  </script>
</div>
      </body>
  </html>
