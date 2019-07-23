<?php

/**
 *
 */
class Diseasemodel extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function select_patient($id){
    $this->db->where('email',$id);
    $query=$this->db->get('Patients');
    return $query->result();
  }
  function select_doctor($id){
    $this->db->where('email',$id);
    $query=$this->db->get('Doctors');
    return $query->result();
  }
  function select_users($id){
    $this->db->where('email',$id);
    $query=$this->db->get('Users');
    return $query->result();
  }

  function disease(){
    $query=$this->db->get('Diseases');
    return $query->result();
  }

  function fetch_data($query)
{
  $this->db->select("*");
  $this->db->from("Diseases");
  if($query != '')
  {
    $this->db->like('disease', $query);
    $this->db->or_like('causes', $query);
    $this->db->or_like('symptoms', $query);
    $this->db->or_like('treatment', $query);
  }
  $this->db->order_by('id', 'ASCE');
  return $this->db->get();
}
}
