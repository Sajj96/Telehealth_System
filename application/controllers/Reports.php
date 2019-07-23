<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Reports extends CI_Controller{

    function __construct(){
           parent::__construct();
           $this->load->helper('url');
           $this->load->database();
           $this->load->helper("URL","DATE","URI","FORM");
           $this->load->library('form_validation');
           $this->load->library('session');
           $this->load->model('reportmodel', 'rm');
      }

      public function index(){
        $email = ($this->session->userdata['logged_in']['email']);
        $doc="";
        $pat="";
        $doc_id['doctor_id']=$this->rm->select_doctor($email);
        $pt_id['patient_id']=$this->rm->select_patient($email);
        foreach ($doc_id['doctor_id'] as $row) {
          $doc=$row->email;
        }
        foreach ($pt_id['patient_id'] as $value) {
          $pat=$value->email;
        }

        $data=array(
          'home_details' => $this->rm->select_patient($pat),
          'doctor_details' => $this->rm->select_doctor($doc),
          'doctors' => $this->rm->doctors()

        );
          $this->load->view('reportspage',$data);
        }

    }
 ?>
