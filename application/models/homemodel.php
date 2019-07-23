<?php

class Homemodel extends CI_Model
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

      function vital($data=array()){
         $this->db->insert('Pulse',$data);
         $this->db->limit(1);
      }

      function vital_temp($data=array()){
         $this->db->insert('Temperature',$data);
      }

      function temp_details($id){
        $submission_date = date('Y-m-d',time());
        $this->db->from('patients');
        $this->db->join('Temperature','Temperature.email=patients.email');
        $this->db->where('patients.email',$id);
        $this->db->where('Temperature.date',$submission_date);
        $this->db->where_not_in('Temperature.Temp',"0");
        $this->db->order_by('Temperature.vital_temp_id');
        $query = $this->db->get();
        return $query->result();
      }
      function pulse_details($id){
        $submission_date = date('Y-m-d',time());
        $this->db->from('patients');
        $this->db->join('Pulse','Pulse.email=patients.email');
        $this->db->where('patients.email',$id);
        $this->db->where('Pulse.date',$submission_date);
        $this->db->where_not_in('Pulse.Pulse_bpm',"0");
        $this->db->order_by('Pulse.vital_id');
        $query = $this->db->get();
        return $query->result();
      }

// Functions for health condition
      function health_condition(){
        $email = ($this->session->userdata['logged_in']['email']);

        $data = array(
                 'email' => $email,
                 'HC' => $this->input->post('condition'),
                 'Diagnosed' => $this->input->post('diagnose'),
                 'HC_Med'=> $this->input->post('medication'),
                 'current_past'=> $this->input->post('health')

            );
            $this->db->where('email', $email);
            $this->db->insert('health_condition', $data);
        }

        function health_update(){
          $email = ($this->session->userdata['logged_in']['email']);
          $id = $this->input->post('id');

          $data = array(
                   'id' => $id,
                   'HC' => $this->input->post('condition'),
                   'Diagnosed' => $this->input->post('diagnose'),
                   'HC_Med'=> $this->input->post('medication'),
                   'current_past'=> $this->input->post('health')

              );
              $this->db->where('id', $id);
              $this->db->update('health_condition', $data);
          }
          public function delete_hc($id)
          {
            $this->db->where('id', $id);
            $this->db->delete('health_condition');
          }

          function health_c(){
            $email = ($this->session->userdata['logged_in']['email']);

            $this->db->select('*');
            $this->db->from('health_condition');
            $this->db->where('email', $email);
            $query = $this->db->get();
            return $query->result();
            }

//Functions for medication
      function medication(){
        $email = ($this->session->userdata['logged_in']['email']);

        $data = array(
                 'email' => $email,
                 'medication' => $this->input->post('med'),
                 'dosage' => $this->input->post('dosage'),
                 'taken_for'=> $this->input->post('taken'),
                 'current_past'=> $this->input->post('medication')

            );
            $this->db->where('email', $email);
            $this->db->insert('medication', $data);
      }

      function Medics_update(){
        $email = ($this->session->userdata['logged_in']['email']);
        $id = $this->input->post('id');

        $data = array(
                 'id' => $id,
                 'medication' => $this->input->post('med'),
                 'dosage' => $this->input->post('dosage'),
                 'taken_for'=> $this->input->post('taken'),
                 'current_past'=> $this->input->post('medication')

            );
            $this->db->where('id', $id);
            $this->db->update('medication',$data);
      }
      public function delete_med($id)
      {
        $this->db->where('id', $id);
        $this->db->delete('medication');
      }

      function medic(){
        $email = ($this->session->userdata['logged_in']['email']);

        $this->db->select('*');
        $this->db->from('medication');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->result();
      }

// Functions for Allergies
      function allergy(){
        $email = ($this->session->userdata['logged_in']['email']);

        $data = array(
                 'email' => $email,
                 'allergy' => $this->input->post('allergy'),
                 'triggered_by' => $this->input->post('triggered_by'),
                 'allergy_med'=> $this->input->post('allergy_med'),
                 'reaction'=> $this->input->post('reaction')

            );
            $this->db->where('email', $email);
            $this->db->insert('allergy', $data);
      }

      function Allergy_update(){
        $email = ($this->session->userdata['logged_in']['email']);
        $id = $this->input->post('id');

        $data = array(
                 'id' => $id,
                 'allergy' => $this->input->post('allergy'),
                 'triggered_by' => $this->input->post('triggered_by'),
                 'allergy_med'=> $this->input->post('allergy_med'),
                 'reaction'=> $this->input->post('reaction')

            );
            $this->db->where('id', $id);
            $this->db->update('allergy',$data);
      }

      function aller(){
        $email = ($this->session->userdata['logged_in']['email']);

        $this->db->select('*');
        $this->db->from('allergy');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->result();
      }

      public function delete_al($id)
      {
        $this->db->where('id', $id);
        $this->db->delete('allergy');
      }

//Functions for Hospitalization
      function Hospitalization(){
        $email = ($this->session->userdata['logged_in']['email']);
        $config['upload_path'] = './uploads/';
                  $config['allowed_types'] = 'pdf|docx|png|jpg|jpeg';
                  $config['max_size'] = '5000000000';
                  $config['overwrite'] = FALSE;
                  $config['file_name'] = $_FILES['attach']['name'];

                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);

                   if($this->upload->do_upload('attach')){
                        $uploadData = $this->upload->data();
                        $attach=$uploadData['file_name'];
                        }else{
                             $attach='No Document(s)';
                        }
        $data = array(
                 'email' => $email,
                 'when' => $this->input->post('when'),
                 'hosp_reason' => $this->input->post('hosp_reason'),
                 'where'=> $this->input->post('where'),
                 'report'=> $attach

            );
            $this->db->where('email', $email);
            $this->db->insert('Hospitalization', $data);
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

      function hospital_update(){
        $email = ($this->session->userdata['logged_in']['email']);
        $id = $this->input->post('id');

        $config['upload_path'] = './uploads/';
                  $config['allowed_types'] = 'pdf|docx|png|jpg|jpeg';
                  $config['max_size'] = '5000000000';
                  $config['overwrite'] = FALSE;
                  $config['file_name'] = $_FILES['attach']['name'];

                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);

                   if($this->upload->do_upload('attach')){
                        $uploadData = $this->upload->data();
                        $attach=$uploadData['file_name'];
                        }else{
                             $attach='No Document(s)';
                        }
        $data = array(
                 'id' => $id,
                 'when' => $this->input->post('when'),
                 'hosp_reason' => $this->input->post('hosp_reason'),
                 'where'=> $this->input->post('where'),
                 'report'=> $attach

            );
            $this->db->where('id', $id);
            $this->db->update('Hospitalization',$data);
      }

      public function delete_hosp($id)
      {
        $this->db->where('id', $id);
        $this->db->delete('Hospitalization');
      }
//Functions for social history
      function social_history(){
        $email = ($this->session->userdata['logged_in']['email']);

        $data = array(
                  'email' => $email,
                  'social_hist' => $this->input->post('social')
            );
            $this->db->where('email', $email);
            $this->db->insert('social_history', $data);
      }

      function social(){
        $email = ($this->session->userdata['logged_in']['email']);

        $this->db->select('*');
        $this->db->from('social_history');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->result();
      }

//Functions for Surgery
      function surgery(){
        $email = ($this->session->userdata['logged_in']['email']);

        $data = array(
                 'email' => $email,
                 'surgery' => $this->input->post('surgery'),
                 'implants' => $this->input->post('implant'),
                 'done_on'=> $this->input->post('done_on'),
                 'by'=> $this->input->post('by')

            );
            $this->db->where('email', $email);
            $this->db->insert('Surgery', $data);
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

      function surgery_update(){
        $email = ($this->session->userdata['logged_in']['email']);
        $id = $this->input->post('id');

        $data = array(
                 'id' => $id,
                 'surgery' => $this->input->post('surgery'),
                 'implants' => $this->input->post('implant'),
                 'done_on'=> $this->input->post('done_on'),
                 'by'=> $this->input->post('by')

            );
            $this->db->where('id', $id);
            $this->db->update('Surgery',$data);
      }

      public function delete_surg($id)
      {
        $this->db->where('id', $id);
        $this->db->delete('Surgery');
      }
}
