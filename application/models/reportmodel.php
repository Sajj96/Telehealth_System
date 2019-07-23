<?php


  class Reportmodel extends CI_Model{

    function select_patient($id){
      $this->db->from('patients');
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

    function doctors(){
      $query=$this->db->get('Doctors');
      return $query->result();
    }

  }
 ?>
