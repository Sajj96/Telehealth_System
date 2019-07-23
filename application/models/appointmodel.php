<?php

class Appointmodel extends CI_Model{
  var $order_column=array("doctor","date",null,null,null);
  var $table = 'appointment';
 var $column_order = array('doctor','date','time','patient','email','reason','status','sub_date','day',null); //set column field database for datatable orderable
 var $column_search = array('doctor','date','patient','email','status','sub_date'); //set column field database for datatable searchable just firstname , lastname , address are searchable
 var $order = array('date' => 'asce'); // default order

  function __construct(){

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
  function appoint($mydata=array()){
     $this->db->insert('Appointment',$mydata);
  }
  function select_one(){
    $this->db->select('patients.photo,appointment.doctor,appointment.date,appointment.time,appointment.patient,appointment.email,appointment.phone,appointment.reason,appointment.status,appointment.sub_date,appointment.day');
    $this->db->from('patients');
    $this->db->join('appointment','patients.email=appointment.email');
    $query=$this->db->get();
    return $query->result();
  }
  function select_appoint($id){
    $this->db->where('email',$id);
    $query=$this->db->get('appointment');
    return $query->result();
  }
  function doctors(){
    $query=$this->db->get('Doctors');
    return $query->result();
  }

  function payment($id){
    $this->db->where('email',$id);
    $query=$this->db->get('Payments');
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

  public function Cancel_appoint($email)
  {
    $dt = date('D g:i A',time());
    $submission_date = date('j/M/Y',time());
    $cancel_reason = $this->input->post('cancelbox');
    $data = array(
         'status' => 'Cancel',
         'sub_date' => $dt,
         'day' => $submission_date,
         'c_reason' => $cancel_reason,
         'notification' => "1"

    );
    $this->db->where('email', $email);
    $this->db->update('appointment', $data);
  }

  public function Reschedule_appoint($email)
  {
    $time= $this->input->post('time');
    $day = $this->input->post('date');
    $data = array(
         'status' => 'Rescheduled',
         'time' => $time,
         'day' => $day,
         'notification' => "1"
    );
    $this->db->where('email', $email);
    $this->db->update('appointment', $data);
  }

  public function Confirm_appoint()
  {
    $dt = date('D g:i A',time());
    $email = $this->input->post('email');
    $submission_date = date('j/M/Y',time());
    $data = array(
         'status' => 'Confirmed',
         'sub_date' => $dt,
         'day' => $submission_date,
         'notification' => "1"
    );
    $this->db->where('email', $email);
    $this->db->update('appointment', $data);
  }
}
 ?>
