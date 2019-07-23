<?php

class Disease extends CI_Controller{

  function __construct(){
         parent::__construct();
         $this->load->helper('url');
         $this->load->database();
         $this->load->helper("URL","DATE","URI","FORM");
         $this->load->library('form_validation');
         $this->load->library('session');
         $this->load->model('diseasemodel', 'ds');
    }

    function index(){
      $email = ($this->session->userdata['logged_in']['email']);
      $doc="";
      $pat="";
      $doc_id['doctor_id']=$this->ds->select_doctor($email);
      $pt_id['patient_id']=$this->ds->select_patient($email);
      foreach ($doc_id['doctor_id'] as $row) {
        $doc=$row->email;
      }
      foreach ($pt_id['patient_id'] as $value) {
        $pat=$value->email;
      }

      $data=array(
        'home_details' => $this->ds->select_patient($pat),
        'doctor_details' => $this->ds->select_doctor($doc),
        'disease'=>$this->ds->disease()

      );
      $this->load->view('diseasepage',$data);
    }

    function fetch()
      {
        $output = '';
        $query = '';
        if($this->input->post('query'))
        {
          $query = $this->input->post('query');
        }
        $data = $this->ds->fetch_data($query);
        $output .= '
       <div class="w3-container w3-margin-top" >
          <div class="w3-row">
             <div class="w3-col l12 m12 s12">
              <table class="w3-table w3-bordered w3-striped w3-margin-top">
                <tr class="w3-green w3-text-white">
                    <th>Disease</th>
                    <th>Causes</th>
                    <th>Symptoms</th>
                    <th>Treatment</th>
                </tr>
        ';
        if($data->num_rows() > 0)
        {
          foreach($data->result() as $row)
          {
            $output .= '
                <tr>
                  <td class="w3-text-red">'.$row->disease.'</td>
                  <td><ul><li>'.$row->causes.'</li></ul></td>
                  <td>'.$row->symptoms.'</td>
                  <td>'.$row->treatment.'</td>

                </tr>
            ';
          }
        }
        else
        {
          $output .= '<tr>
                  <td colspan="5">No Data Found</td>
                </tr>';
        }
        $output .= '</table></div></div></div>';
        echo $output;
      }

}
