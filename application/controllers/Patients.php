<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Patients extends CI_Controller{

    function __construct(){
           parent::__construct();
           $this->load->helper('url');
           $this->load->database();
           $this->load->helper("URL","DATE","URI","FORM");
           $this->load->library('form_validation');
           $this->load->library('session');
           $this->load->library('pdf');
           $this->load->model('patientmodel', 'pm');
      }

      public function index(){
        $pt_email="";
        $this->session->set_flashdata('email',$pt_email);
        $email = ($this->session->userdata['logged_in']['email']);
        $doc="";
        $pat="";
        $dt['pt_cond'] = $this->pm->all_patient();
        $doc_id['doctor_id']=$this->pm->select_doctor($email);
        $pt_id['patient_id']=$this->pm->select_patient($email);
        foreach ($doc_id['doctor_id'] as $row) {
          $doc=$row->email;
        }
        foreach ($pt_id['patient_id'] as $value) {
          $pat=$value->email;
        }

        $data=array(
          'home_details' => $this->pm->select_patient($pat),
          'doctor_details' => $this->pm->select_doctor($doc),
          'details' => $this->pm->get_names(),
          'all_patients' => $this->pm->all_patient(),
          'health_condition' =>$this->pm->health_c(),
          'medication'=>$this->pm->medic(),
          'Allergies' =>$this->pm->aller(),
          'social_history'=>$this->pm->social(),
          'Hospitalization'=>$this->pm->Hosp(),
          'Surgery'=>$this->pm->sur()

        );
          $this->load->view('patientspage',$data);
        }

        function display_patient_details(){

          $email_doc = ($this->session->userdata['logged_in']['email']);
          $email = $this->input->post('email');
          $doc="";
          $pat="";
          $doc_id['doctor_id']=$this->pm->select_doctor($email_doc);
          $pt_id['patient_id']=$this->pm->select_patient($email);
          foreach ($doc_id['doctor_id'] as $row) {
            $doc=$row->email;
          }
          foreach ($pt_id['patient_id'] as $value) {
            $pat=$value->email;
          }

          if(isset($_POST['show'])){
          $data=array(
            'patient_details' => $this->pm->select_patient($email),
            'doctor_details' => $this->pm->select_doctor($doc),
            'health_condition' =>$this->pm->health_cond(),
            'medication'=>$this->pm->medication(),
            'Allergies' =>$this->pm->allergy(),
            'social_history'=>$this->pm->social_history(),
            'Hospitalization'=>$this->pm->Hospitalization(),
            'Surgery'=>$this->pm->surgery(),
            'patient_consults' => $this->pm->consults(),
            'presc' => $this->pm->prescs(),
            'appoints' => $this->pm->appoints()
          );
            $this->load->view('patient_details_page',$data);

          }
        }

    function patient_report(){
      $email_doc = ($this->session->userdata['logged_in']['email']);
      $email = $this->input->post('email');
      $pat="";

      $pt_id['patient_id']=$this->pm->select_patient($email);

      foreach ($pt_id['patient_id'] as $value) {
        $pat=$value->email;
      }

      if(isset($_POST['button'])){
      $data=array(
        'patient_details' => $this->pm->select_patient($email),
        'health_condition' =>$this->pm->health_cond(),
        'medication'=>$this->pm->medication(),
        'Allergies' =>$this->pm->allergy(),
        'social_history'=>$this->pm->social_history(),
        'Hospitalization'=>$this->pm->Hospitalization(),
        'Surgery'=>$this->pm->surgery(),
        'patient_consults' => $this->pm->consults(),
        'presc' => $this->pm->prescs(),
        'appoints' => $this->pm->appoints(),
        'temp' => $this->pm->temp_details($email),
        'pulse' => $this->pm->pulse_details($email)
      );

         $page=$this->load->view('patient_document', $data);
         $page = $this->output->get_output();
         $page .= '<link rel="stylesheet" href="C:\xampp\htdocs\Telehealth\css\w3.css">';
         $this->dompdf->loadHtml($page);
         $this->dompdf->setPaper('A4','landscape');
         $this->dompdf->render();
         $this->dompdf->stream(".$pat.",array("Attachment"=>1));

       }
  }

  public function ajax_list()
	 {
		$list = $this->pm->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
      if($person->photo == "No Image"){
      $row[] = '<img src="../../images/iconheader.jpg" alt="avatar" class="w3-image w3-circle w3-small" id="image_three">';
      }else {
      $row[] = '<img src="../../images/'.$person->photo.'" alt="avatar" class="w3-image w3-circle w3-small" id="image_three">';
       }
			$row[] = $person->firstname;
			$row[] = $person->lastname;
      $row[] = $person->email;
			$row[] = $person->gender;
      $row[] = $person->dob;
			$row[] = $person->address;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="View" onclick="edit_person('."'".$person->email."'".')"><i class="glyphicon glyphicon-eye-open"></i>View</a>';
			$row[]='<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->email."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pm->count_all(),
						"recordsFiltered" => $this->pm->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

  public function ajax_single_patient($id){
    $data = $this->pm->select_($id);
    echo json_encode($data);
  }

  public function all($id){
    $da =  $this->pm->allmodal($id);
    echo json_encode($da);
  }
	public function ajax_hc($id)
	{
	  	$data =  $this->pm->get_by_hc($id);
      // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
      echo json_encode($data);

	}
  public function ajax_med($id)
  {
    $da =  $this->pm->get_by_med($id);
    echo json_encode($da);

  }

  public function ajax_allergy($id)
  {
    $da =  $this->pm->get_by_al($id);
    echo json_encode($da);

  }

  public function ajax_add()
  {
  $this->_validate();
  $data = array(
      'firstName' => $this->input->post('firstName'),
      'lastName' => $this->input->post('lastName'),
      'gender' => $this->input->post('gender'),
      'address' => $this->input->post('address'),
      'dob' => $this->input->post('dob'),
    );
  $insert = $this->pm->save($data);
  echo json_encode(array("status" => TRUE));
}

public function ajax_update()
{
  $this->_validate();
  $data = array(
      'firstName' => $this->input->post('firstName'),
      'lastName' => $this->input->post('lastName'),
      'gender' => $this->input->post('gender'),
      'address' => $this->input->post('address'),
      'dob' => $this->input->post('dob'),
    );
  $this->pm->update(array('id' => $this->input->post('id')), $data);
  echo json_encode(array("status" => TRUE));
}

public function ajax_delete($id)
{
  $this->pm->delete_by_id($id);
  echo json_encode(array("status" => TRUE));
}

function get_temperature($id){
  $data = $this->pm->select_temperature($id);
  echo json_encode($data);
}

function get_pulse($id){
  $data = $this->pm->select_pulse($id);
  echo json_encode($data);
}

function test(){
  $email_doc = ($this->session->userdata['logged_in']['email']);
  $email = $this->input->post('email');
  $pat="";

  $pt_id['patient_id']=$this->pm->select_patient($email);

  foreach ($pt_id['patient_id'] as $value) {
    $pat=$value->email;
  }


  $data=array(
    'patient_details' => $this->pm->select_patient($email),
    'health_condition' =>$this->pm->health_cond(),
    'medication'=>$this->pm->medication(),
    'Allergies' =>$this->pm->allergy(),
    'social_history'=>$this->pm->social_history(),
    'Hospitalization'=>$this->pm->Hospitalization(),
    'Surgery'=>$this->pm->surgery(),
    'patient_consults' => $this->pm->consults(),
    'presc' => $this->pm->prescs(),
    'appoints' => $this->pm->appoints(),
    'temp' => $this->pm->temp_details($email),
    'pulse' => $this->pm->pulse_details($email)
  );
  $this->load->view('patient_document', $data);

}
}
