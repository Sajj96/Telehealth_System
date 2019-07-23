<?php


class Journeymodel extends CI_Model{

    function __construct(){
      parent::__construct();
      $this->load->database();
    }

    function select_patient($id){
      $this->db->from('Patients');
      $this->db->where('email',$id);
      $query = $this->db->get();
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

    function tips($data=array()){
       $this->db->insert('Tips',$data);
    }

    function view_tips(){
      $this->db->from('Tips');
      $this->db->join('doctors','doctors.email=tips.doc_email');
      $query = $this->db->get();
      return $query->result();
    }
}





 ?>
