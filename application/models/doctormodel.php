<?php

class Doctormodel extends CI_Model
{
    var $order_column=array("firstname","lastname",null,null,null);
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
      function get_names(){
        // $nm=$_GET['nm'];
        $fname=$this->input->post('fname');
        $lname=$this->input->post('lname');
        $this->db->select('*');
        $this->db->from('Doctors');
        $this->db->like('firstname', $fname);
        // $this->db->or_like('lastname', $lname);
        $query = $this->db->get();
        return $query->result();
      }
    
      function fetch_data($query)
  	{
  		$this->db->select("*");
  		$this->db->from("Doctors");
  		if($query != '')
  		{
        $this->db->like('firstname', $query);
        $this->db->or_like('lastname', $query);
        $this->db->or_like('address', $query);
        $this->db->or_like('category', $query);
  		}
  		$this->db->order_by('email', 'DESC');
  		return $this->db->get();
  	}
}
