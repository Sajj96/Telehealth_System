<?php

class patient_details_model extends CI_Model{
  var $order_column=array("firstname","lastname",null,null,null);
  var $table = 'patients';
	var $column_order = array('firstname','lastname','gender','address','dob',null); //set column field database for datatable orderable
	var $column_search = array('firstname','lastname','address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('email' => 'desc'); // default order
    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    function select_patient($id){
      $this->db->from($this->table);
      $this->db->where('email',$id);
      $query = $this->db->get();
      return $query->result();
    }
    function all_patient(){
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

  function select_($id){
    $this->db->from($this->table);
    $this->db->where('email',$id);
    $query = $this->db->get();
    return $query->row();
  }

  function health_c(){
    $pt_email = $this->session->flashdata('email');

    $this->db->select('*');
    $this->db->from('health_condition');
    $this->db->where('email', $pt_email);
    $query = $this->db->get();
    return $query->result();
    }

  function medic(){
    $email = $this->input->post('email');

    $this->db->select('*');
    $this->db->from('medication');
    $this->db->where('email', $email);
    $query = $this->db->get();
    return $query->result();
  }

  function aller(){
    $email = $this->input->post('email');

    $this->db->select('*');
    $this->db->from('allergy');
    $this->db->where('email', $email);
    $query = $this->db->get();
    return $query->result();
  }

  function Hosp(){
    $email = $this->input->post('email');

    $this->db->select('*');
    $this->db->from('Hospitalization');
    $this->db->where('email', $email);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result();
  }

  function social(){
    $email = $this->input->post('email');

    $this->db->select('*');
    $this->db->from('social_history');
    $this->db->where('email', $email);
    $query = $this->db->get();
    return $query->result();
  }

  function sur(){
    $email = $this->input->post('email');

    $this->db->select('*');
    $this->db->from('surgery');
    $this->db->where('email', $email);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result();
  }

  function select_temperature(){
    $this->db->select('*');
    $this->db->from('temperature');
    $this->db->order_by('vital_temp_id');
    $query = $this->db->get();
    return $query->result();
  }

  function select_pulse(){
    $this->db->select('*');
    $this->db->from('pulse');
    $this->db->order_by('vital_id');
    $query = $this->db->get();
    return $query->result();
  }
}
