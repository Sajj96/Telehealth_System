<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

  function __construct(){
         parent::__construct();
         $this->load->helper('url');
         $this->load->library('session');
         $this->load->helper('form');
         $this->load->library('form_validation');
         $this->load->helper('security');
         $this->load->model('loginmodel', 'lg');
    }

  public function index(){
    $this->load->view('loginpage');
  }
  function verify_user(){
          $this->form_validation->set_rules('username', '', 'trim|required|xss_clean');
          $this->form_validation->set_rules('pass', '', 'trim|required|xss_clean');

          $username = $this->input->post('username');
          $pass = md5($this->input->post('pass'));

          if ($this->form_validation->run() == FALSE) {
               if(isset($this->session->userdata['logged_in'])){
               redirect('home/');
                 // session_destroy();
               }else{
               redirect('login/');
               }
               } else {
                 $username = $this->input->post('username');
                 $pass = md5($this->input->post('pass'));
                    $result = $this->lg->login_process($username, $pass);
                    // $result1 = $this->lm->login_process($username, $password);
                    if($result == TRUE){
                         $username = $this->input->post('username');
                         $result = $this->lg->read_user_information($username);
                         // $result1 = $this->lm->get_hod($username);
                         if($result != false){
                              //put this piece of code into a function, the call it here.
                              $session_data = array(
                                   'id' => $result[0]->id,
                                   'firstname' => $result[0]->firstname,
                                   'lastname' => $result[0]->lastname,
                                   'email' => $result[0]->email,
                                   'position' => $result[0]->position
                              );

                              $this->session->set_userdata('logged_in', $session_data);
                              $email = ($this->session->userdata['logged_in']['email']);
                              $doc="";
                              $pat="";
                              $doc_id['doctor_id']=$this->lg->select_doctor($email);
                              $pt_id['patient_id']=$this->lg->select_patient($email);
                              foreach ($doc_id['doctor_id'] as $row) {
                                $doc=$row->email;
                              }
                              foreach ($pt_id['patient_id'] as $value) {
                                $pat=$value->email;
                              }

                              $data=array(
                                'home_details' => $this->lg->select_patient($pat),
                                'doctor_details' => $this->lg->select_doctor($doc),
                                'health_condition' =>$this->lg->health_condition(),
                                'medication'=>$this->lg->medication(),
                                'Allergies' =>$this->lg->allergy(),
                                'social_history'=>$this->lg->social_history(),
                                'Hospitalization'=>$this->lg->Hospitalization(),
                                'Surgery'=>$this->lg->surgery(),
                                'temp' => $this->lg->temp_details($email),
                                'pulse' => $this->lg->pulse_details($email)
                              );
                              $this->load->view('homepage',$data);
                         }
                    }else{
                         $data = array(
                              'error_message' => "Invalid username or password"
                         );
                         $this->form_validation->set_message('username','incorrect username');
                         $this->load->view('loginpage', $data);
                    }
          }
     }

}
