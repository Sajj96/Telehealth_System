$(document).ready(function(){
  $.ajax({
    url:"<?php echo site_url('Consultation/get_vital_signs')?>",
    method:"GET",
    success: function(){

    },
    error: function(){

    }
  });
});
