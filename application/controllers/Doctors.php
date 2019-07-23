<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Doctors extends CI_Controller{

    function __construct(){
           parent::__construct();
           $this->load->helper('url');
           $this->load->database();
           $this->load->helper("URL","DATE","URI","FORM");
           $this->load->library('form_validation');
           $this->load->library('session');
           $this->load->model('doctorlistmodel', 'dm');
      }

      public function index(){
        $pt_email="";
        $this->session->set_flashdata('email',$pt_email);
        $email = ($this->session->userdata['logged_in']['email']);
        $doc="";
        $pat="";
        $dt['pt_cond'] = $this->dm->all_patient();
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
          'details' => $this->dm->get_names(),
          'all_patients' => $this->dm->all_patient()

        );
          $this->load->view('doctorslistpage',$data);
        }

        function display_doctors_details(){

          $email_doc = ($this->session->userdata['logged_in']['email']);
          $email = $this->input->post('email');
          $doc="";
          $pat="";
          $doc_id['doctor_id']=$this->dm->select_doctor($email_doc);
          $pt_id['patient_id']=$this->dm->select_patient($email);
          foreach ($doc_id['doctor_id'] as $row) {
            $doc=$row->email;
          }
          foreach ($pt_id['patient_id'] as $value) {
            $pat=$value->email;
          }

          if(isset($_POST['show'])){
          $data=array(
            'patient_details' => $this->dm->select_patient($email),
            'doctor_details' => $this->dm->select_doctor($doc)
          );
            $this->load->view('patient_details_page',$data);

          }
        }

  public function ajax_list()
	 {
		$list = $this->dm->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
      if($person->photo == "No Image"){
      $row[] = '<img src="../../images/doctoricon.jpg" alt="avatar" class="w3-image w3-circle w3-small" id="image_three">';
      }else {
      $row[] = '<img src="../../images/'.$person->photo.'" alt="avatar" class="w3-image w3-circle w3-small" id="image_three">';
       }
			$row[] = $person->firstname;
			$row[] = $person->lastname;
      $row[] = $person->email;
			$row[] = $person->professional;
      $row[] = $person->category;
			$row[] = $person->address;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="View" onclick="edit_person('."'".$person->email."'".')"><i class="glyphicon glyphicon-eye-open"></i>View</a>';
			$row[]='<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->email."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->dm->count_all(),
						"recordsFiltered" => $this->dm->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

  public function ajax_single_doctor($id){
    $data = $this->dm->select_($id);
    echo json_encode($data);
  }

  public function all($id){
    $da =  $this->dm->allmodal($id);
    echo json_encode($da);
  }
	public function ajax_hc($id)
	{
	  	$data =  $this->dm->get_by_hc($id);
      // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
      echo json_encode($data);

	}
  public function ajax_med($id)
  {
    $da =  $this->dm->get_by_med($id);
    echo json_encode($da);

  }

  public function ajax_allergy($id)
  {
    $da =  $this->dm->get_by_al($id);
    echo json_encode($da);

  }

  public function ajax_add()
  {
    $date_array=getdate();
    $submission_date = $date_array['year']."-";
    $submission_date .= $date_array['mon']."-";
    $submission_date .= $date_array['mday'];
  $data = array(
      'firstName' => $this->input->post('firstName'),
      'lastName' => $this->input->post('lastName'),
      'email' => $this->input->post('email'),
      'gender' => $this->input->post('gender'),
      'address' => $this->input->post('address'),
      'password' => md5($this->input->post('pass')),
      'category' => $this->input->post('category'),
      'dob' => $this->input->post('dob'),
      'phone' => $this->input->post('phone'),
      'professional' => $this->input->post('prof'),
      'day' => $this->input->post('day'),
      'time' => $this->input->post('time'),
      'photo' => "No Image",
      'registered' => $submission_date
    );

    $dat = array(
      'firstName' => $this->input->post('firstName'),
      'lastName' => $this->input->post('lastName'),
      'email' => $this->input->post('email'),
      'position' => "Doctor",
      'password' => md5($this->input->post('pass'))
    );
  $insert = $this->dm->save($data);
  $this->dm->save_user($dat);
  echo json_encode(array("status" => TRUE));
}

public function ajax_update()
{
  $data = array(
    'firstName' => $this->input->post('firstName'),
    'lastName' => $this->input->post('lastName'),
    'email' => $this->input->post('email'),
    'gender' => $this->input->post('gender'),
    'address' => $this->input->post('address'),
    'category' => $this->input->post('category'),
    'dob' => $this->input->post('dob'),
    'phone' => $this->input->post('phone'),
    'professional' => $this->input->post('prof'),
    'day' => $this->input->post('day'),
    'time' => $this->input->post('time'),
    'registered' => $this->input->post('registered')
    );
  $this->dm->update(array('email' => $this->input->post('email')), $data);
  echo json_encode(array("status" => TRUE));
}

public function ajax_delete($id)
{
  $this->dm->delete_by_id($id);
}

function get_temperature($id){
  $data = $this->dm->select_temperature($id);
  echo json_encode($data);
}

function get_pulse($id){
  $data = $this->dm->select_pulse($id);
  echo json_encode($data);
}

function test(){
}
}
