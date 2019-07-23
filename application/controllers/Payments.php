<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Payments extends CI_Controller{

    function __construct(){
           parent::__construct();
           $this->load->helper('url');
           $this->load->database();
           $this->load->helper("URL","DATE","URI","FORM");
           $this->load->library('form_validation');
           $this->load->library('session');
           $this->load->library('pdf');
           $this->load->model('Paymentmodel', 'py');
      }

      public function index(){
        $email = ($this->session->userdata['logged_in']['email']);
        $doc="";
        $pat="";
        $doc_id['doctor_id']=$this->py->select_doctor($email);
        $pt_id['patient_id']=$this->py->select_patient($email);
        foreach ($doc_id['doctor_id'] as $row) {
          $doc=$row->email;
        }
        foreach ($pt_id['patient_id'] as $value) {
          $pat=$value->email;
        }

        $data=array(
          'home_details' => $this->py->select_patient($pat),
          'doctor_details' => $this->py->select_doctor($doc),
          'sum' => $this->py->get_sum()

        );
          $this->load->view('Paymentspage',$data);
        }

        function pays(){
          $email = ($this->session->userdata['logged_in']['email']);
          $doc="";
          $pat="";
          $doc_id['doctor_id']=$this->py->select_doctor($email);
          $pt_id['patient_id']=$this->py->select_patient($email);
          foreach ($doc_id['doctor_id'] as $row) {
            $doc=$row->email;
          }
          foreach ($pt_id['patient_id'] as $value) {
            $pat=$value->email;
          }

          if($_POST['submit']){
          $for = $this->input->post('for');
          $by = $this->input->post('pay');
          $number = $this->input->post('num');
          $code = $this->input->post('code');
          $month = $this->input->post('month');
          $year = $this->input->post('year');
          $vcode = $this->input->post('vcode');
          $amt = $this->input->post('amount');
            $data=array(
              'payfor' => $for,
              'email' => $email,
              'By' => $by,
              'Card' => $number,
              'code' => $code,
              'month' => $month,
              'year' => $year,
              'vcode' => $vcode,
              'Amount' => $amt
            );
            $sms = array(
              'home_details' => $this->py->select_patient($pat),
              'doctor_details' => $this->py->select_doctor($doc),
             'success_message' => "Successful submitted"
             );
           $this->py->payment($data);
           $this->load->view('Paymentspage',$sms);
            //  }
            }
        }

        public function ajax_list()
         {
          $list = $this->py->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = $person->payfor;
            $row[] = $person->email;
            $row[] = $person->By;
            $row[] = $person->Card;
            $row[] = $person->month;
            $row[] = $person->year;
            $row[] = $person->Amount;
            $row[] = $person->vcode;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-success" href="javascript:void(0)" title="View">'.$person->status.'</a>';

            $data[] = $row;
          }

          $output = array(
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->py->count_all(),
                  "recordsFiltered" => $this->py->count_filtered(),
                  "data" => $data,
              );
          //output to json format
          echo json_encode($output);
        }

}
