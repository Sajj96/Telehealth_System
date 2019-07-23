<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Question extends CI_Controller{

    function __construct(){
           parent::__construct();
           $this->load->helper('url');
           $this->load->database();
           $this->load->helper("URL","DATE","URI","FORM");
           $this->load->library('form_validation');
           $this->load->library('session');
           $this->load->model('qnmodel', 'qn');
      }

      public function index(){
        $email = ($this->session->userdata['logged_in']['email']);
        $doc="";
        $pat="";
        $doc_id['doctor_id']=$this->qn->select_doctor($email);
        $pt_id['patient_id']=$this->qn->select_patient($email);
        foreach ($doc_id['doctor_id'] as $row) {
          $doc=$row->email;
        }
        foreach ($pt_id['patient_id'] as $value) {
          $pat=$value->email;
        }

        $data=array(
          'home_details' => $this->qn->select_patient($pat),
          'doctor_details' => $this->qn->select_doctor($doc),
          'doctors' => $this->qn->doctors(),
          'all_questions' => $this->qn->all_questions()

        );
          $this->load->view('qstnpage',$data);
        }

        function Asked_Question(){
          $email = ($this->session->userdata['logged_in']['email']);
          $doc="";
          $pat="";
          $doc_id['doctor_id']=$this->qn->select_doctor($email);
          $pt_id['patient_id']=$this->qn->select_patient($email);
          foreach ($doc_id['doctor_id'] as $row) {
            $doc=$row->email;
          }
          foreach ($pt_id['patient_id'] as $value) {
            $pat=$value->email;
          }
          if($_POST['ask']){
          // $id = ($this->session->userdata['logged_in']['id']);
          $qstn = $this->input->post('qstn');
          $receiver = $this->input->post('to_who');
          $config['upload_path'] = './images/';
          $config['allowed_types'] = 'png|jpg|jpeg|mp4|webm';
          $config['max_size'] = '5000000000';
          $config['overwrite'] = FALSE;
          $config['file_name'] = $_FILES['attach']['name'];

          $this->load->library('upload',$config);
          $this->upload->initialize($config);

           if($this->upload->do_upload('attach')){
                $uploadData = $this->upload->data();
                $attach=$uploadData['file_name'];
                }else{
                     $attach='No Image';
                }

            $data=array(
              'question' => $qstn,
              'attachment' => $attach,
              'email' => $email,
              'receiver' => $receiver,
              'status' => "Not Answered"
            );

           $sms = array(
             'home_details' => $this->qn->select_patient($pat),
             'doctor_details' => $this->qn->select_doctor($doc),
             'doctors' => $this->qn->doctors(),
             'all_questions' => $this->qn->all_questions(),
            'message' => "Successful submitted"
            );
           $this->qn->question($data);
           $this->load->view('qstnpage',$sms);
          }
        }

      function Answered()
       {
         $id = $this->input->post('id');
         $this->qn->Answer($id);
         redirect('Question/');
       }

    }
 ?>
