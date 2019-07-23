<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller{

  function __construct(){
         parent::__construct();
         $this->load->helper('url');
         $this->load->library('session');
         $this->load->helper("URL","DATE","URI","FORM");
         $this->load->library('form_validation');
         $this->load->model('signupmodel', 'su');
    }

  public function index(){

    $this->load->view('signuppage');
  }

  function signup_users(){

    $id = "";

    $dt['pt_cond'] = $this->su->all_patient();
    if($_POST['submit']){
    // $id = ($this->session->userdata['logged_in']['id']);
    $email = $this->input->post('email');
    $address = $this->input->post('address');
    $position = $this->input->post('position');
    $fname = $this->input->post('fname');
    $lname = $this->input->post('lname');
    $professional = $this->input->post('professional');
    $category = $this->input->post('category');
    $dat = $this->input->post('day');
    $time = $this->input->post('time');
    $gender = $this->input->post('gender');
    $dob = $this->input->post('date');
    $condition = $this->input->post('policy');
    $phone = $this->input->post('phone');
    $password=md5($this->input->post('pass'));
    $config['upload_path'] = './images/';
    $config['allowed_types'] = 'png|jpg|jpeg';
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


    // foreach($dt['pt_cond'] as $row){
    $query = $this->db->get_where('patients', array('email' => $email));
    if($query->num_rows() > 0){
        $sms = array(
           'error' => "Email already exist, please try another"
        );
        $this->load->view('signuppage',$sms);
    }
    else{
      $mydata= array(
        'firstname' => $fname,
        'lastname' => $lname,
        'email' => $email,
        'dob' => $dob,
        'gender' => $gender,
        'phone' => $phone,
        'Address' => $address,
        'conditions' => $condition,
        'password' => $password,
        'photo' => $attach
      );

      $data=array(
        'firstname' => $fname,
        'lastname' => $lname,
        'email' => $email,
        'position' => $position,
        'password' => $password
      );

     $sms = array(
      'message' => "Successful submitted"
      );
     $this->su->signup($mydata);
     $this->su->users($data);
     $this->load->view('signuppage',$sms);
       }
      // }
    }
}
  // function test(){
  //   $dt['pt_cond'] = $this->su->all_patient();
  //   for($i=0;$i<$dat;$i++){
  //     $id = $dat[i]->email;
  //     echo $id;
  //   }

}
