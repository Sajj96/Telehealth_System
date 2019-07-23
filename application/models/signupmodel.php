<?php

class Signupmodel extends CI_Model
{

      function __construct()
      {
        parent::__construct();
        $this->load->database();
      }

      function signup($mydata=array()){
         $this->db->insert('Patients',$mydata);
      }
      function users($data=array()){
         $this->db->insert('Users',$data);
      }
      function doctor($dt=array()){
         $this->db->insert('Doctors',$dt);
      }
      function all_patient(){
        $query=$this->db->get('Patients');
        return $query->result();
      }

}
