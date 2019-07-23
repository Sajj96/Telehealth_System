<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller{

  function __construct(){
         parent::__construct();
         $this->load->helper('url');
         $this->load->database();
         $this->load->helper("URL","DATE","URI","FORM");
         $this->load->library('form_validation');
         $this->load->library('session');
         $this->load->model('doctormodel', 'dm');
    }
public function index(){
  $email = ($this->session->userdata['logged_in']['email']);
  $doc="";
  $pat="";
  $doc_id['doctor_id']=$this->dm->select_doctor($email);
  $pt_id['patient_id']=$this->dm->select_patient($email);
  foreach ($doc_id['doctor_id'] as $row) {
    $doc=$row->email;
  }
  foreach ($pt_id['patient_id'] as $value) {
    $pat=$value->email;
  }

  $data=array(
    'home_details' => $this->dm->select_patient($pat),
    'doctor_details' => $this->dm->select_doctor($doc),
    'details' => $this->dm->get_names()

  );
    $this->load->view('doctorscpage',$data);
  }

  function display_names(){

    $email = ($this->session->userdata['logged_in']['email']);
    $doc="";
    $pat="";
    $doc_id['doctor_id']=$this->dm->select_doctor($email);
    $pt_id['patient_id']=$this->dm->select_patient($email);
    foreach ($doc_id['doctor_id'] as $row) {
      $doc=$row->email;
    }
    foreach ($pt_id['patient_id'] as $value) {
      $pat=$value->email;
    }

    $data=array(
      'home_details' => $this->dm->select_patient($pat),
      'doctor_details' => $this->dm->select_doctor($doc),
      'details' => $this->dm->get_names()
    );
      $this->load->view('doctorscpage',$data);
  }
  function fetch()
  	{
  		$output = '';
  		$query = '';
  		if($this->input->post('query'))
  		{
  			$query = $this->input->post('query');
  		}
  		$data = $this->dm->fetch_data($query);
  		$output .= '
     <div class="w3-container w3-margin-top" >
        <div class="w3-row">
           <div class="w3-col l12 m12 s12">
  					<table class="w3-table w3-bordered w3-striped w3-margin-top">
  						<tr class="w3-green w3-text-white">
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Category</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Available</th>
                  <th>At(time)</th>
  						</tr>
  		';
  		if($data->num_rows() > 0)
  		{
  			foreach($data->result() as $row)
  			{
  				$output .= '
  						<tr>
  							<td>'.$row->firstname.'</td>
  							<td>'.$row->lastname.'</td>
  							<td>'.$row->category.'</td>
  							<td>'.$row->address.'</td>
  							<td>'.$row->phone.'</td>
                <td>'.$row->day.'</td>
                <td>'.$row->time.'</td>

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
