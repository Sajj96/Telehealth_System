<?php
 // session_destroy();
$count="";
if($count !="0"){
$this->db->select('*');
$this->db->from('appointment');
$this->db->where('status','Pending');
$this->db->where('doctor',$firstname." ".$lastname);
$this->db->where('notification','0');
$query=$this->db->get();
$count = $query->num_rows();
}
else{
  $count="0";
}

$count_patient="";
if($count_patient !="0"){
$this->db->select('*');
$this->db->from('patients');
$query=$this->db->get();
$count_patient = $query->num_rows();
}
else{
  $count_patient="0";
}

$count_amount= "";
if($count_amount !=""){
$sql = "SELECT sum(Amount) as Amount from Payments";
$count_amount = $this->db->query($sql);
return $count_amount->row()->Amount;
}
else{
  $count_amount="0";
}

$count_docs="";
if($count_docs !="0"){
$this->db->select('*');
$this->db->from('doctors');
$query=$this->db->get();
$count_docs = $query->num_rows();
}
else{
  $count_docs="0";
}

$count_question="";
if($count_question !="0"){
$this->db->select('*');
$this->db->from('Questions');
$this->db->where('status','Not Answered');
$this->db->where('receiver',$firstname." ".$lastname);
$query=$this->db->get();
$count_question = $query->num_rows();
}
else{
  $count_question="0";
}

$count_reschedule="";
if($count_reschedule !="0"){
$this->db->select('*');
$this->db->from('appointment');
$this->db->where('status','Rescheduled');
$this->db->where('doctor',$firstname." ".$lastname);
$query=$this->db->get();
$count_reschedule = $query->num_rows();
}
else{
  $count_reschedule="0";
}

$count_cancel="";
if($count_cancel !="0"){
$this->db->select('*');
$this->db->from('appointment');
$this->db->where('status','Cancel');
$this->db->where('doctor',$firstname." ".$lastname);
$query=$this->db->get();
$count_cancel = $query->num_rows();
}
else{
  $count_cancel="0";
}

$count_confirm="";
if($count_confirm !="0"){
$this->db->select('*');
$this->db->from('appointment');
$this->db->where('status','Confirmed');
$this->db->where('doctor',$firstname." ".$lastname);
$query=$this->db->get();
$count_confirm = $query->num_rows();
}
else{
  $count_confirm="0";
}
 ?>
