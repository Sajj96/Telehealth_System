<?php


class Loginmodel extends CI_Model
{

      function __construct()
      {
        parent::__construct();
        $this->load->database();
      }

      function login_process($username, $password){
           $condition = "email =" . "'" . $username . "' AND " . "password =" . "'" . $password . "'";
           $this->db->select('*');
           $this->db->from('Users');
           $this->db->where($condition);
           $this->db->limit(1);
           $query = $this->db->get();

           if ($query->num_rows() == 1) {
           return true;
           } else {
           return false;
           }
      }

      public function read_user_information($username) {

         $condition = "email =" . "'" . $username . "'";
         $this->db->select('*');
         $this->db->from('Users');
         $this->db->where($condition);
         $this->db->limit(1);
         $query = $this->db->get();

         if ($query->num_rows() == 1) {
              return $query->result();
              } else {
              return false;
              }
         }

         function select_patient($id){
           $this->db->where('email',$id);
           $query=$this->db->get('Patients');
           return $query->result();
         }

         function select_users($id){
           $this->db->where('email',$id);
           $query=$this->db->get('Users');
           return $query->result();
         }

         function select_doctor($id){
           $this->db->where('email',$id);
           $query=$this->db->get('Doctors');
           return $query->result();
         }
         function health_condition(){
           $email = ($this->session->userdata['logged_in']['email']);

           $this->db->select('*');
           $this->db->from('health_condition');
           $this->db->where('email', $email);
           $query = $this->db->get();
           return $query->result();
           }

         function medication(){
           $email = ($this->session->userdata['logged_in']['email']);

           $this->db->select('*');
           $this->db->from('medication');
           $this->db->where('email', $email);
           $query = $this->db->get();
           return $query->result();
         }

         function allergy(){
           $email = ($this->session->userdata['logged_in']['email']);

           $this->db->select('*');
           $this->db->from('allergy');
           $this->db->where('email', $email);
           $query = $this->db->get();
           return $query->result();
         }

         function Hospitalization(){
           $email = ($this->session->userdata['logged_in']['email']);

           $this->db->select('*');
           $this->db->from('Hospitalization');
           $this->db->where('email', $email);
           $this->db->limit(1);
           $query = $this->db->get();
           return $query->result();
         }

         function social_history(){
           $email = ($this->session->userdata['logged_in']['email']);

           $this->db->select('*');
           $this->db->from('social_history');
           $this->db->where('email', $email);
           $query = $this->db->get();
           return $query->result();
         }

         function surgery(){
           $email = ($this->session->userdata['logged_in']['email']);

           $this->db->select('*');
           $this->db->from('surgery');
           $this->db->where('email', $email);
           $this->db->limit(1);
           $query = $this->db->get();
           return $query->result();
         }

         function temp_details($id){
           $submission_date = date('Y-m-d',time());
           $this->db->from('patients');
           $this->db->join('Temperature','Temperature.email=patients.email');
           $this->db->where('patients.email',$id);
           $this->db->where('Temperature.date',$submission_date);
           $this->db->where_not_in('Temperature.Temp',"0");
           $this->db->order_by('Temperature.vital_temp_id');
           $query = $this->db->get();
           return $query->result();
         }
         function pulse_details($id){
           $submission_date = date('Y-m-d',time());
           $this->db->from('patients');
           $this->db->join('Pulse','Pulse.email=patients.email');
           $this->db->where('patients.email',$id);
           $this->db->where('Pulse.date',$submission_date);
           $this->db->where_not_in('Pulse.Pulse_bpm',"0");
           $this->db->order_by('Pulse.vital_id');
           $query = $this->db->get();
           return $query->result();
         }

}
