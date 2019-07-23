<?php


  class qnmodel extends CI_Model{

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

    function question($data=array()){
       $this->db->insert('Questions',$data);
    }

    function all_questions(){
      $this->db->from('Questions');
      $this->db->join('patients','Questions.email=patients.email');
      $query = $this->db->get();
      return $query->result();
    }

    function Answer($id){
      $answer = $this->input->post('ans');
      $data = array(
           'answer' => $answer,
           'status' => 'Answered'

      );
      $this->db->where('id', $id);
      $this->db->update('Questions', $data);
    }
  }
 ?>
