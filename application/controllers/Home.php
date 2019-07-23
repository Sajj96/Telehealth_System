<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

  function __construct(){
         parent::__construct();
         $this->load->helper('url');
         $this->load->database();
         $this->load->helper("URL","DATE","URI","FORM");
         $this->load->library('form_validation');
         $this->load->library('session');
         $this->load->model('homemodel', 'hm');
    }

  public function index(){
    $email = ($this->session->userdata['logged_in']['email']);
    $doc="";
    $pat="";
    $doc_id['doctor_id']=$this->hm->select_doctor($email);
    $pt_id['patient_id']=$this->hm->select_patient($email);
    foreach ($doc_id['doctor_id'] as $row) {
      $doc=$row->email;
    }
    foreach ($pt_id['patient_id'] as $value) {
      $pat=$value->email;
    }

    $data=array(
      'home_details' => $this->hm->select_patient($pat),
      'doctor_details' => $this->hm->select_doctor($doc),
      'health_condition' =>$this->hm->health_c(),
      'medication'=>$this->hm->medic(),
      'Allergies' =>$this->hm->aller(),
      'social_history'=>$this->hm->social(),
      'Hospitalization'=>$this->hm->Hosp(),
      'Surgery'=>$this->hm->sur(),
      'temp' => $this->hm->temp_details($email),
      'pulse' => $this->hm->pulse_details($email)
    );
    $this->load->view('homepage',$data);
  }

  function Pulse_rate(){
    $email = ($this->session->userdata['logged_in']['email']);
    $doc="";
    $pat="";
    $doc_id['doctor_id']=$this->hm->select_doctor($email);
    $pt_id['patient_id']=$this->hm->select_patient($email);
    foreach ($doc_id['doctor_id'] as $row) {
      $doc=$row->email;
    }
    foreach ($pt_id['patient_id'] as $value) {
      $pat=$value->email;
    }

    $vital = $this->input->post('vital');
    $date = $this->input->post('date');
    $time = $this->input->post('time');
    $in = $this->input->post('in');
    $value = $this->input->post('value');
    $location = $this->input->post('loc');
    $note = $this->input->post('note');

    if(isset($_POST['submit'])){
    $data=array(
      'email' => $email,
      'Pulse_bpm' => $value,
      'Times' =>$in,
      'date'=>$date,
      'At' =>$time,
      'location'=>$location,
      'note'=>$note
    );

      $this->hm->vital($data);

      $dat=array(
        'home_details' => $this->hm->select_patient($pat),
        'doctor_details' => $this->hm->select_doctor($doc),
        'health_condition' =>$this->hm->health_c(),
        'medication'=>$this->hm->medic(),
        'Allergies' =>$this->hm->aller(),
        'social_history'=>$this->hm->social(),
        'Hospitalization'=>$this->hm->Hosp(),
        'Surgery'=>$this->hm->sur(),
        'temp' => $this->hm->temp_details($email),
        'pulse' => $this->hm->pulse_details($email)
      );
      $this->load->view('homepage',$dat);
    }
  }
   function Temp(){
     $email = "captainsajjad@gmail.com";
     $value = $this->input->get('temp');
     date_default_timezone_set('Africa/Dar_es_Salaam');
     $dt = date('H:i:s',time());
     $submission_date = date('Y-m-d',time());
     $time = date("H");
     $hr = "";
     if($time < "12"){
       $hr = "Morning";
     }
     elseif($time > "12" && $time < "15"){
       $hr = "Afternoon";
     }
     elseif($time > "15" && $time < "19"){
       $hr = "Evening";
     }
     elseif($time >= "19"){
       $hr = "Night";
     }
     $date = $submission_date ." ".$dt;
      $data = array(
        'email' => $email,
        'Temp' => $value,
        'Time' => $hr,
        'date' => $submission_date,
        'At' => $dt
      );

    $this->hm->vital_temp($data);
    redirect('home/');
   }
// Health Condition
   function health_condition(){
     $this->hm->health_condition();
        redirect('home/');
   }
   public function health_update()
   {
     $this->hm->health_update();
        redirect('home/');
   }

   function delete_hcondition($id)
   {
     $data = $this->hm->delete_hc($id);
     echo json_encode(array("id" => ""));
   }

  // Medication
   function Medics(){
     $this->hm->medication();
     redirect('home/');
   }
   public function Medics_update()
   {
     $this->hm->Medics_update();
        redirect('home/');
   }
   function delete_med($id)
   {
    $data = $this->hm->delete_med($id);
     echo json_encode(array("id" => ""));
   }

  //Allergies
   function Allergies(){
     $this->hm->allergy();
     redirect('home/');
   }

   public function Allergy_update()
   {
     $this->hm->Allergy_update();
        redirect('home/');
   }

   function delete_al($id)
   {
    $data = $this->hm->delete_al($id);
     echo json_encode(array("id" => ""));
   }


  //Social History
   function social_hist(){
     $this->hm->social_history();
     redirect('home/');
   }

  //Hospitalization
   function hospital(){
     $this->hm->Hospitalization();
     redirect('home/');

   }

   public function hospital_update()
   {
     $this->hm->hospital_update();
        redirect('home/');
   }

   function delete_hosp($id)
   {
    $data = $this->hm->delete_hosp($id);
     echo json_encode(array("id" => ""));
   }
  //Surgery
   function surgery(){
     $this->hm->surgery();
     redirect('home/');
   }

   public function surgery_update()
   {
     $this->hm->surgery_update();
        redirect('home/');
   }

   function delete_surg($id)
   {
    $data = $this->hm->delete_surg($id);
     echo json_encode(array("id" => ""));
   }
  //Logout
   function logout(){
     session_destroy();
     redirect('login/');
   }

   function test(){
     date_default_timezone_set('Africa/Dar_es_Salaam');
     $dt = date('H:i:s',time());
     $d = date('l');
      $submission_date = date('Y-m-d',time());
     $time = date("H");
     $hr = "";
     if($time < "12"){
       $hr = "Morning";
     }
     elseif($time > "12" && $time < "15"){
       $hr = "Afternoon";
     }
     elseif($time > "15" && $time < "19"){
       $hr = "Evening";
     }
     elseif($time >= "19"){
       $hr = "Night";
     }
     echo $hr;
     echo $submission_date ." ".$dt;
     echo $d;

   }

}
