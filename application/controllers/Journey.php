<?php

class Journey extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->database();
    $this->load->helper("URL","DATE","URI","FORM");
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('journeymodel', 'jm');
  }

  function index(){

    $email = ($this->session->userdata['logged_in']['email']);
    $doc="";
    $pat="";
    $doc_id['doctor_id']=$this->jm->select_doctor($email);
    $pt_id['patient_id']=$this->jm->select_patient($email);
    foreach ($doc_id['doctor_id'] as $row) {
      $doc=$row->email;
    }
    foreach ($pt_id['patient_id'] as $value) {
      $pat=$value->email;
    }

    $data=array(
      'home_details' => $this->jm->select_patient($pat),
      'doctor_details' => $this->jm->select_doctor($doc),
      'view_tips'  => $this->jm->view_tips()

    );
    $this->load->view('journeypage',$data);
  }

  function post_tip(){

    $email = ($this->session->userdata['logged_in']['email']);
    $doc="";
    $pat="";
    $doc_id['doctor_id']=$this->jm->select_doctor($email);
    $pt_id['patient_id']=$this->jm->select_patient($email);
    foreach ($doc_id['doctor_id'] as $row) {
      $doc=$row->email;
    }
    foreach ($pt_id['patient_id'] as $value) {
      $pat=$value->email;
    }

    if($_POST['submit']){
    $id = ($this->session->userdata['logged_in']['email']);
    $condition = $this->input->post('concern');
    $age = $this->input->post('group');
    $must = $this->input->post('must');
    $when = $this->input->post('when');
    $config['upload_path'] = './images/';
    $config['allowed_types'] = 'png|jpg|jpeg|mp4|mp3|avi|mov|wmv|pdf';
    $config['max_size'] = '0';
    $config['overwrite'] = FALSE;
    $config['file_name'] = $_FILES['attach']['name'];

    $this->load->library('upload',$config);
    $this->upload->initialize($config);

     if($this->upload->do_upload('attach')){
          $uploadData = $this->upload->data();
          $attach=$uploadData['file_name'];
          }else{
               $attach='No Attachment';
          }

      $data=array(
        'doc_email' => $id,
        'condition' => $condition,
        'age' => $age,
        'must' => $must,
        'when' => $when,
        'Attach' => $attach
      );
      $sms = array(
        'home_details' => $this->jm->select_patient($pat),
        'doctor_details' => $this->jm->select_doctor($doc),
        'view_tips'  => $this->jm->view_tips($doc),
       'success_message' => "Successful submitted"
       );
     $this->jm->tips($data);
     $this->load->view('journeypage',$sms);
      //  }
      }

  }
}
