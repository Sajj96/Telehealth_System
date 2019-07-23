<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Patient_details extends CI_Controller{

    function __construct(){
           parent::__construct();
           $this->load->helper('url');
           $this->load->database();
           $this->load->helper("URL","DATE","URI","FORM");
           $this->load->library('form_validation');
           $this->load->library('session');
           $this->load->model('patient_details_model', 'pd');
      }

      // public function index(){
      //   $email_doc = ($this->session->userdata['logged_in']['email']);
      //
      //   $pt_email = $this->session->flashdata('email');
      //   $doc="";
      //   $pat="";
      //   $doc_id['doctor_id']=$this->pd->select_doctor($email_doc);
      //   $pt_id['patient_id']=$this->pd->select_patient($pt_email);
      //   foreach ($doc_id['doctor_id'] as $row) {
      //     $doc=$row->email;
      //   }
      //   foreach ($pt_id['patient_id'] as $value) {
      //     $pat=$value->email;
      //   }
      //
      //   $data=array(
      //     'home_details' => $this->pd->select_patient($pat),
      //     'doctor_details' => $this->pd->select_doctor($doc),
      //     'health_condition' =>$this->pd->health_c(),
      //     'medication'=>$this->pd->medic(),
      //     'Allergies' =>$this->pd->aller(),
      //     'social_history'=>$this->pd->social(),
      //     'Hospitalization'=>$this->pd->Hosp(),
      //     'Surgery'=>$this->pd->sur()
      //
      //   );
      //     $this->load->view('patient_details_page',$data);
      //   }
      //
      //   function get_temperature(){
      //     $data = $this->pd->select_temperature();
      //     echo json_encode($data);
      //   }
      //
      //   function get_pulse(){
      //     $data = $this->pd->select_pulse();
      //     echo json_encode($data);
      //   }
}
