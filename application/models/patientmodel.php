<?php

class patientmodel extends CI_Model{
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

    function get_names(){
      // $nm=$_GET['nm'];
      $fname=$this->input->post('fname');
      $lname=$this->input->post('lname');
      $this->db->select('*');
      $this->db->from('patients');
      $this->db->like('firstname', $fname);
      // $this->db->or_like('lastname', $lname);
      $query = $this->db->get();
      return $query->result();
    }

    private function _get_datatables_query()
  	{

		$this->db->from($this->table);

		$i = 0;

		foreach ($this->column_search as $item) // loop column
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{

				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

  public function allmodal($id){
    $this->db->from($this->table);
    $this->db->join('health_condition','health_condition.email=patients.email');
    $this->db->join('medication','medication.email=patients.email');
    $this->db->join('allergy','allergy.email=patients.email');
    $this->db->where('patients.email',$id);
    $query = $this->db->get();
    return $query->row();

  }
  function select_($id){
    $this->db->from($this->table);
    $this->db->where('email',$id);
    $query = $this->db->get();
    return $query->row();
  }
	public function get_by_hc($id)
	{
		$this->db->from($this->table);
    $this->db->join('health_condition','health_condition.email=patients.email');
    $this->db->where('patients.email',$id);
		$query = $this->db->get();

		return $query->row();
	}
  public function get_by_med($id)
  {
    $this->db->from($this->table);
    $this->db->join('medication','medication.email=patients.email');
    $this->db->where('patients.email',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function get_by_al($id)
  {
    $this->db->from($this->table);
    $this->db->join('allergy','allergy.email=patients.email');
    $this->db->where('patients.email',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function save($data)
  	{
  		$this->db->insert($this->table, $data);
  		return $this->db->insert_id();
  	}

  	public function update($where, $data)
  	{
  		$this->db->update($this->table, $data, $where);
  		return $this->db->affected_rows();
  	}

  	public function delete_by_id($id)
  	{
  		$this->db->delete($this->table);
      $this->db->where('patients.email', $id);
  	}

  function health_c(){
    $email = ($this->session->userdata['logged_in']['email']);

    $this->db->select('*');
    $this->db->from('health_condition');
    $this->db->where('email', $email);
    $query = $this->db->get();
    return $query->result();
    }

    function health_of_pt($id){
      $this->db->from($this->table);
  		// $this->db->join('health_condition','health_condition.email=patients.email');
      $this->db->where('email',$id);
  		$query = $this->db->get();

  		return $query->row();
      }

  function medic(){
    $email = ($this->session->userdata['logged_in']['email']);

    $this->db->select('*');
    $this->db->from('medication');
    $this->db->where('email', $email);
    $query = $this->db->get();
    return $query->result();
  }

  function aller(){
    $email = ($this->session->userdata['logged_in']['email']);

    $this->db->select('*');
    $this->db->from('allergy');
    $this->db->where('email', $email);
    $query = $this->db->get();
    return $query->result();
  }

  function Hosp(){
    $email = ($this->session->userdata['logged_in']['email']);

    $this->db->select('*');
    $this->db->from('Hospitalization');
    $this->db->where('email', $email);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result();
  }

  function social(){
    $email = ($this->session->userdata['logged_in']['email']);

    $this->db->select('*');
    $this->db->from('social_history');
    $this->db->where('email', $email);
    $query = $this->db->get();
    return $query->result();
  }

  function sur(){
    $email = ($this->session->userdata['logged_in']['email']);

    $this->db->select('*');
    $this->db->from('surgery');
    $this->db->where('email', $email);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result();
  }

  function health_cond(){
    $email = $this->input->post('email');

    $this->db->select('*');
    $this->db->from('health_condition');
    $this->db->where('email', $email);
    $query = $this->db->get();
    return $query->result();
    }

  function medication(){
    $email = $this->input->post('email');

    $this->db->select('*');
    $this->db->from('medication');
    $this->db->where('email', $email);
    $query = $this->db->get();
    return $query->result();
  }

  function allergy(){
    $email = $this->input->post('email');

    $this->db->select('*');
    $this->db->from('allergy');
    $this->db->where('email', $email);
    $query = $this->db->get();
    return $query->result();
  }

  function Hospitalization(){
    $email = $this->input->post('email');

    $this->db->select('*');
    $this->db->from('Hospitalization');
    $this->db->where('email', $email);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result();
  }

  function social_history(){
    $email = $this->input->post('email');

    $this->db->select('*');
    $this->db->from('social_history');
    $this->db->where('email', $email);
    $query = $this->db->get();
    return $query->result();
  }

  function surgery(){
    $email = $this->input->post('email');

    $this->db->select('*');
    $this->db->from('surgery');
    $this->db->where('email', $email);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result();
  }

  function select_temperature($id){
    date_default_timezone_set('Africa/Dar_es_Salaam');
    $dt = date('H:i:s',time());
     $submission_date = date('Y-m-d',time());
     $date = $submission_date;
    $this->db->from($this->table);
    $this->db->join('Temperature','Temperature.email=patients.email');
    $this->db->where('patients.email',$id);
    $this->db->where('Temperature.date',$date);
    $this->db->order_by('Temperature.vital_temp_id');
    $query = $this->db->get();
    return $query->result();
  }

  function select_pulse($id){
    $submission_date = date('Y-m-d',time());
    $this->db->from($this->table);
    $this->db->join('Pulse','Pulse.email=patients.email');
    $this->db->where('patients.email',$id);
    $this->db->where('Pulse.date',$submission_date);
    $this->db->order_by('Pulse.vital_id');
    $query = $this->db->get();
    return $query->result();
  }

  function temp_details($id){
    $submission_date = date('Y-m-d',time());
    $this->db->from($this->table);
    $this->db->join('Temperature','Temperature.email=patients.email');
    $this->db->where('patients.email',$id);
    $this->db->where_not_in('Temperature.Temp',"0");
    $this->db->order_by('Temperature.vital_temp_id');
    $query = $this->db->get();
    return $query->result();
  }
  function pulse_details($id){
    $submission_date = date('Y-m-d',time());
    $this->db->from($this->table);
    $this->db->join('Pulse','Pulse.email=patients.email');
    $this->db->where('patients.email',$id);
    $this->db->where_not_in('Pulse.Pulse_bpm',"0");
    $this->db->order_by('Pulse.vital_id');
    $query = $this->db->get();
    return $query->result();
  }

  function consults(){
    $email = $this->input->post('email');
    $this->db->where('email',$email);
    $query = $this->db->get('Consultation');
    return $query->result();
  }

  function appoints(){
    $email = $this->input->post('email');
    $this->db->where('email',$email);
    $query = $this->db->get('Appointment');
    return $query->result();
  }

  function prescs(){
    $email = $this->input->post('email');
    $this->db->where('email',$email);
    $query=$this->db->get('Prescription');
    return $query->result();
  }
}
