<?php



  class consultmodel extends CI_Model{
    var $order_column=array("firstname","lastname",null,null,null);
    var $table = 'Consultation';
   var $column_order = array('doctor','type','email','asso_appoint','date','start_at','reason','notes',null); //set column field database for datatable orderable
   var $column_search = array('doctor','type','email','asso_appoint','date','start_at'); //set column field database for datatable searchable just firstname , lastname , address are searchable
   var $order = array('date' => 'desc'); // default order
    function __construct(){

      parent::__construct();
      $this->load->database();
    }

    function select_patient($id){
      $this->db->from('patients');
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

    function select_vital_sign(){
      $this->db->select('*');
      $this->db->from('vital_signs');
      $this->db->order_by('vital_id');
      $query = $this->db->get();
      return $query->result();
    }

    function select_vital_(){
      $this->db->select('*');
      $this->db->from('vital_signs');
      $this->db->order_by('vital_id');
      $query = $this->db->get();
      return $query->result();
    }

    function consult($data=array()){
       $this->db->insert('Consultation',$data);
    }

    function prescribe($data=array()){
       $this->db->insert('Prescription',$data);
    }

    function all_consults($email){
      $this->db->where('email',$email);
      $query=$this->db->get('Consultation');
      return $query->result();
    }

    function all_cons($fname,$lname){
      $this->db->where('doctor', "Dr.".$fname." ".$lname);
      $query=$this->db->get('Consultation');
      return $query->result();
    }

    function patients(){
      $query=$this->db->get('Patients');
      return $query->result();
    }

    function appointment($name){
      $this->db->where('email',$name);
      $query=$this->db->get('appointment');
      $output = '<option value="">Choose appointment</option>';
      foreach ($query->result() as $key) {
        $output .= '<option value="'.$key->day."".$key->sub_date.'">'.$key->day." ".$key->sub_date.'</option>';
      }
      return $output;
    }

    function appoin($name){
      $this->db->where('email',$name);
      $query=$this->db->get('appointment');
      foreach ($query->result() as $key) {
        $out .= '<option value="'.$key->email.'">'.$key->email.'</option>';
      }
      return $out;
    }

    function prescs($email){
      $this->db->where('email',$email);
      $query=$this->db->get('Prescription');
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

  }
 ?>
