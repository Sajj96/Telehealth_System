<?php
defined('BASEPATH') OR exit('No direct script access allowed');



  class Consultation extends CI_Controller{

    public function __construct(){
      parent::__construct();
      $this->load->helper('url');
      $this->load->database();
      $this->load->helper("URL","DATE","URI","FORM");
      $this->load->library('form_validation');
      $this->load->library('session');
      $this->load->model('consultmodel', 'cm');
    }

    public function index(){
      $email = ($this->session->userdata['logged_in']['email']);
      $doc="";
      $pat="";
      $dt['pt_cond'] = $this->cm->all_patient();
      $doc_id['doctor_id']=$this->cm->select_doctor($email);
      $pt_id['patient_id']=$this->cm->select_patient($email);
      foreach ($doc_id['doctor_id'] as $row) {
        $doc=$row->email;
      }
      foreach ($pt_id['patient_id'] as $value) {
        $pat=$value->email;
      }

      $data=array(
        'home_details' => $this->cm->select_patient($pat),
        'doctor_details' => $this->cm->select_doctor($doc),
        'all_patients' => $this->cm->all_patient(),
        'patients' => $this->cm->patients(),
        'all_consults' => $this->cm->all_consults($email),
        'presc' => $this->cm->prescs($email)

      );
        $this->load->view('Consultpage',$data);
    }

    function Consults(){
      $email = ($this->session->userdata['logged_in']['email']);
      $doc="";
      $pat="";
      $dt['pt_cond'] = $this->cm->all_patient();
      $doc_id['doctor_id']=$this->cm->select_doctor($email);
      $pt_id['patient_id']=$this->cm->select_patient($email);
      foreach ($doc_id['doctor_id'] as $row) {
        $doc=$row->email;
      }
      foreach ($pt_id['patient_id'] as $value) {
        $pat=$value->email;
      }
      if($_POST['submit']){
      // $id = ($this->session->userdata['logged_in']['id']);
      $doctor = $this->input->post('dtname');
      $email_pt = $this->input->post('email_of_pt');
      $appoint_type = $this->input->post('appoint_type');
      $patient = $this->input->post('ptname');
      $assoc_appoint = $this->input->post('date_appoint');
      $date = $this->input->post('dateof');
      $time = $this->input->post('timeof');
      $reason = $this->input->post('reasonof');
      $notes = $this->input->post('notes');
      $med = $this->input->post('med');
      $dosage = $this->input->post('doses');
      $start = $this->input->post('start');
      $stop = $this->input->post('stop');
      $quantity = $this->input->post('quantity');

      $dt = array(
        'doctor' => $doctor,
        'type' => $appoint_type,
        'email' => $patient,
        'asso_appoint' => $assoc_appoint,
        'date' => $date,
        'start_at' => $time,
        'reason' => $reason,
        'notes' => $notes
      );

      $data = array(
        'email' => $patient,
        'medics' => $med,
        'dosage' => $dosage,
        'start'  => $start,
        'stop' => $stop,
        'quantity' => $quantity
      );


      $dat=array(
        'home_details' => $this->cm->select_patient($pat),
        'doctor_details' => $this->cm->select_doctor($doc),
        'all_patients' => $this->cm->all_patient(),
        'patients' => $this->cm->patients(),
        'all_consults' => $this->cm->all_consults($email),
        'presc' => $this->cm->prescs($email),
        'success_message' => "Successful submitted"

      );
      $this->cm->consult($dt);
      $this->cm->prescribe($data);
      $this->load->view('Consultpage',$dat);

     }
    }

    public function ajax_list()
    {
     $list = $this->cm->get_datatables();
     $data = array();
     $no = $_POST['start'];
     foreach ($list as $person) {
       $no++;
       $row = array();
       $row[] = $person->doctor;
       $row[] = $person->type;
        $row[] = $person->email;
       $row[] = $person->asso_appoint;
        $row[] = $person->date;
       $row[] = $person->start_at;
       $row[] = $person->reason;
       $row[] = $person->notes;

       //add html for action

       $data[] = $row;
     }

     $output = array(
             "draw" => $_POST['draw'],
             "recordsTotal" => $this->cm->count_all(),
             "recordsFiltered" => $this->cm->count_filtered(),
             "data" => $data,
         );
     //output to json format
     echo json_encode($output);
   }


    function fetch_appoint(){
      if($this->input->post('email')){
        echo $this->cm->appointment($this->input->post('email'));
      }
    }

    function fetch_(){
      if($this->input->post('email')){
        echo $this->cm->appoin($this->input->post('email'));
      }
    }

    function consult_two(){
      $email = ($this->session->userdata['logged_in']['email']);
      $firstname = ($this->session->userdata['logged_in']['firstname']);
      $lastname = ($this->session->userdata['logged_in']['lastname']);
      $doc="";
      $pat="";
      $dt['pt_cond'] = $this->cm->all_patient();
      $doc_id['doctor_id']=$this->cm->select_doctor($email);
      $pt_id['patient_id']=$this->cm->select_patient($email);
      foreach ($doc_id['doctor_id'] as $row) {
        $doc=$row->email;
      }
      foreach ($pt_id['patient_id'] as $value) {
        $pat=$value->email;
      }

      $data=array(
        'home_details' => $this->cm->select_patient($pat),
        'doctor_details' => $this->cm->select_doctor($doc),
        'all_patients' => $this->cm->all_patient(),
        'patients' => $this->cm->patients(),
        'all_cons' => $this->cm->all_cons($firstname,$lastname),
        'presc' => $this->cm->prescs($email)

      );
        $this->load->view('Consultpage_two',$data);
    }
  }
 ?>
