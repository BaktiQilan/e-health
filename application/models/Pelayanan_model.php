<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Pelayanan_model extends CI_Model
{
    public function addPatient($data2)
    {
        $this->db->insert('patient', $data2);
    }

    public function getAll()
     {
		  $data_pasien = $this->db->get('patient')->result();
          return $data_pasien;
     }

    public function getPatient()
    {
        $query = "SELECT * FROM `patient`";
        return $this->db->query($query)->result_array();
    }

    public function delPatient($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('patient');
    }

    public function savePatient($id)
    {
        $data = array(
            "nik" => $this->input->post('nik'),
            "name" => $this->input->post('name'),
            "place" => $this->input->post('place'),
            "birth" => $this->input->post('birth'),
            "gender" => $this->input->post('gender'),
            "blood_type" => $this->input->post('blood'),
            "address" => $this->input->post('address'),
            "religion" => $this->input->post('religion'),
            "marital_status" => $this->input->post('marital'),
            "job" => $this->input->post('job'),
            "nationality" => $this->input->post('nationality'),
        );

        $this->db->where('id', $id);
        $this->db->update('patient', $data);
    }

    public function schPatient($id)
    {
        $data = array(
            "patient_id" => $this->input->post('id'),
            "poly_id" => $this->input->post('poly'),
            "date" => $this->input->post('pdate'),
        );

        $this->db->insert('poly_registration', $data);
    }
    
    public function getPoly()
    {
        $this->db->select('poly.id as poly_id, poly.name as poly_name, poly.cost as poly_cost, poly_registration.*, patient.id as pid,patient.nik, patient.name, patient.place, patient.birth');
        $this->db->from('poly');
        $this->db->join('poly_registration', 'poly.id = poly_registration.poly_id');
        $this->db->join('patient', 'poly_registration.patient_id = patient.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function savePoly($id)
    {
        $data = array(
            "patient_id" => $this->input->post('pid'),
            "date" => $this->input->post('pdate'),
        );

        $this->db->where('id', $id);
        $this->db->update('poly_registration', $data);
    }

    public function delPoly($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('poly_registration');
    }

    public function getPayment()
    {
        $this->db->select('payment.*, poly.name as poly_name, poly.cost as poly_cost, poly_registration.patient_id as reg_patient,
                        poly_registration.poly_id as reg_poly, poly_registration.date as reg_date,
                        patient.id as pid, patient.nik, patient.name');
        $this->db->from('payment');
        $this->db->join('poly', 'payment.poly_id = poly.id');
        $this->db->join('poly_registration', 'payment.poly_reg_id = poly_registration.id');
        $this->db->join('patient', 'payment.patient_id = patient.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllBayar()
    {
        $this->db->select('payment.*, poly.name as poly_name, poly.cost as poly_cost, poly_registration.patient_id as reg_patient,
                        poly_registration.poly_id as reg_poly, poly_registration.date as reg_date,
                        patient.id as pid, patient.nik, patient.name');
        $this->db->from('payment');
        $this->db->join('poly', 'payment.poly_id = poly.id');
        $this->db->join('poly_registration', 'payment.poly_reg_id = poly_registration.id');
        $this->db->join('patient', 'payment.patient_id = patient.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function saveBayar($id)
    {
        $data = array(
            "status" => 'Lunas',
        );

        $this->db->where('id', $id);
        $this->db->update('payment', $data);
    }
}
