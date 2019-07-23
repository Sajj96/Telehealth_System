<?php

class Appointment extends CI_Controller{


    function __construct(){
      parent::__construct();
      $this->load->helper('url');
      $this->load->database();
      $this->load->helper("URL","DATE","URI","FORM");
      $this->load->library('form_validation');
      $this->load->library('session');
      $this->load->model('Appointmodel', 'am');
    }

    function index(){
      $email = ($this->session->userdata['logged_in']['email']);
      $doc="";
      $pat="";
      $apt = "";
      $doc_id['doctor_id']=$this->am->select_doctor($email);
      $pt_id['patient_id']=$this->am->select_patient($email);
      $appoint['appointment'] = $this->am->select_appoint($email);
      foreach ($doc_id['doctor_id'] as $row) {
        $doc=$row->email;
      }
      foreach ($pt_id['patient_id'] as $value) {
        $pat=$value->email;
      }
      foreach($appoint['appointment'] as $row){
        $apt = $row->email;
      }

      $data=array(
        'home_details' => $this->am->select_patient($pat),
        'doctor_details' => $this->am->select_doctor($doc),
        'Appointment' => $this->am->select_appoint($apt),
        'requests' => $this->am->select_one(),
        'doctors' => $this->am->doctors(),
        'payment' => $this->am->payment($email)
      );
      $this->load->view('appointpage',$data);
    }

    function appoint(){
      $email = ($this->session->userdata['logged_in']['email']);
      $dt = date('D g:i A',time());
      $submission_date = date('j/M/Y',time());
      $doc="";
      $pat="";
      $apt = "";
      $appoint['appointment'] = $this->am->select_appoint($email);
      $doc_id['doctor_id']=$this->am->select_doctor($email);
      $pt_id['patient_id']=$this->am->select_patient($email);
      foreach ($doc_id['doctor_id'] as $row) {
        $doc=$row->email;
      }
      foreach ($pt_id['patient_id'] as $value) {
        $pat=$value->email;
      }
      foreach($appoint['appointment'] as $row){
        $apt = $row->email;
      }

      if($_POST['submit']){

      // $id = ($this->session->userdata['logged_in']['id']);
      $name = $this->input->post('name');
      $date = $this->input->post('date');
      $time = $this->input->post('time');
      $pname = $this->input->post('pname');
      $email = $this->input->post('email');
      $phone = $this->input->post('phone');
      $reason = $this->input->post('reason');

      $query = $this->db->get_where('appointment', array('email' => $email));
      if($query->num_rows() > 0){
          $sms = array(
            'home_details' => $this->am->select_patient($pat),
            'doctor_details' => $this->am->select_doctor($doc),
            'Appointment' => $this->am->select_appoint($apt),
            'doctors' => $this->am->doctors(),
            'payment' => $this->am->payment($email),
             'error' => "Your appointment is in progress, please wait..."
          );
          $this->load->view('appointpage', $sms);

        } else{

          $data=array(
            'doctor' => $name,
            'date' => $date,
            'time' => $time,
            'patient' => $pname,
            'email' => $email,
            'phone' => $phone,
            'reason' => $reason,
            'status' => "Pending",
            'sub_date' => $dt,
            'day' => $submission_date,
            'notification' => "0"

          );
          $dat = array(
            'home_details' => $this->am->select_patient($pat),
            'doctor_details' => $this->am->select_doctor($doc),
            'Appointment' => $this->am->select_appoint($apt),
            'doctors' => $this->am->doctors(),
            'payment' => $this->am->payment($email),
             'success_message' => "Successful submitted"
           );
      $this->am->appoint($data);
      $this->load->view('appointpage', $dat);
    }
   }
 }

 public function ajax_list()
 {
  $list = $this->am->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $person) {
    $no++;
    $row = array();
    $row[] = $person->doctor;
    $row[] = $person->date;
     $row[] = $person->time;
    $row[] = $person->patient;
     $row[] = $person->email;
    $row[] = $person->reason;
    $row[] = $person->status;
    $row[] = $person->sub_date;
    $row[] = $person->day;

    //add html for action

    $data[] = $row;
  }

  $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->am->count_all(),
          "recordsFiltered" => $this->am->count_filtered(),
          "data" => $data,
      );
  //output to json format
  echo json_encode($output);
}

  function cancel()
 {
   $email = $this->input->post('email');
   $this->am->Cancel_appoint($email);
   redirect('appointment/');
 }

  function reschedule()
 {
   $email = $this->input->post('email');
   $this->am->Reschedule_appoint($email);
   redirect('appointment/');
 }

 function confirm()
 {
   if(isset($_POST['submit'])){
   $this->am->Confirm_appoint();
   redirect('appointment/');
   }
 }

}
