<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pelayanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pelayanan_model', 'pelayanan');
    }

    public function index()
    {
        $data['title'] = 'Pendaftaran Pasien Baru';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $this->session->userdata('role_id')])->row_array();

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('place', 'place', 'required');
        $this->form_validation->set_rules('birth', 'Birth', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('blood', 'Blood Type', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('religion', 'Religion', 'required');
        $this->form_validation->set_rules('marital', 'Marital Status', 'required');
        $this->form_validation->set_rules('job', 'Job', 'required');
        $this->form_validation->set_rules('nationality', 'Nationality', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pelayanan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                "nik" => $_POST['nik'],
                "name" => $_POST['name'],
                "place" => $_POST['place'],
                "birth" => $_POST['birth'],
                "gender" => $_POST['gender'],
                "blood_type" => $_POST['blood'],
                "address" => $_POST['address'],
                "religion" => $_POST['religion'],
                "marital_status" => $_POST['marital'],
                "job" => $_POST['job'],
                "nationality" => $_POST['nationality'],  
            );
    
            $this->db->insert('patient', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pasien telah didaftarkan, Silahkan cek halaman Pendataan Pasien!</div>');
            redirect('pelayanan/index');         
        } 
    }


    public function p_pasien()
    {
        $data['title'] = 'Pendataan Pasien';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $this->session->userdata('role_id')])->row_array();
        $this->load->model('Pelayanan_model', 'pelayanan');

        $data['patient'] = $this->pelayanan->getPatient();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelayanan/p_pasien', $data);
        $this->load->view('templates/footer');
    }

    public function editPatient($id)
    {
        $this->pelayanan->savePatient($id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pasien sudah diubah!</div>');
        redirect('pelayanan/p_pasien');
    }

    public function d_patient($id)
    {
        $this->load->model('Pelayanan_model', 'pelayanan');
        $this->pelayanan->delPatient($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success mx-auto" role="alert">Pasien dihapus</div>');
        redirect('pelayanan/p_pasien');
    }

    public function daftar()
    {
        $data['title'] = 'Pendaftaran Pasien ke Poli';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $this->session->userdata('role_id')])->row_array();
        $this->load->model('Pelayanan_model', 'pelayanan');

        $data['patient'] = $this->pelayanan->getPatient();
        $data['poly'] = $this->db->get('poly')->result_array();
        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelayanan/daftar', $data);
        $this->load->view('templates/footer');
    }

    public function daftarPatient($id)
    {
        $data['title'] = 'Pendaftaran Pasien ke Poli';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $this->session->userdata('role_id')])->row_array();
        $this->load->model('Pelayanan_model', 'pelayanan');

        $data['patient'] = $this->pelayanan->getPatient();
        $data['poly'] = $this->db->get('poly')->result_array();

        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('poly', 'Poly', 'required');
        $this->form_validation->set_rules('pdate', 'Date', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pelayanan/daftar', $data);
            $this->load->view('templates/footer');
        } else {
            $this->pelayanan->schPatient($id);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pasien sudah didaftarkan!</div>');
            redirect('pelayanan/daftar');
        }
    }

    public function p_poli()
    {
        $data['title'] = 'Pendataan Poli Pasien';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $this->session->userdata('role_id')])->row_array();
        
        $this->load->model('Pelayanan_model', 'pelayanan');
        $data['gpoly'] = $this->pelayanan->getPoly();
        $data['poly'] = $this->db->get('poly')->result_array();
        $data['d'] = new DateTime('now', new DateTimezone('Asia/Jakarta'));

        $this->form_validation->set_rules('poly_id', 'Poly_id', 'required');
        $this->form_validation->set_rules('patient_id', 'Patient_id', 'required');
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('pay_date', 'Date', 'required');
        $this->form_validation->set_rules('cost4', 'Biaya Konsultasi', 'required');
        $this->form_validation->set_rules('cost5', 'Biaya Obat', 'required');

        if ($this->input->post('cost4') == NULL OR $this->input->post('cost5') == NULL OR $this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pelayanan/p_poli', $data);
            $this->load->view('templates/footer');
        } else {
            $harga_str = preg_replace("/[^0-9]/", "", $_POST['cost3']);
            $harga_int = (int) $harga_str;
            $harga_str2 = preg_replace("/[^0-9]/", "", $_POST['cost4']);
            $harga_int2 = (int) $harga_str2;
            $harga_str3 = preg_replace("/[^0-9]/", "", $_POST['cost5']);
            $harga_int3 = (int) $harga_str3;
            
            $data = array(
                "patient_id" => $_POST['patient_id'],
                "poly_id" => $_POST['poly_id'],
                "poly_reg_id" => $_POST['id'],
                "pay_date" => $_POST['pay_date'],
                "total" => $harga_int + $harga_int2 + $harga_int3,
                "status" => 'Belum dibayar',
            );
    
            $this->db->insert('payment', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil, Silahkan cek halaman Pencatatan Pembayaran!</div>');
            redirect('pelayanan/p_poli');         
        } 
    }

    public function editPoli($id)
    {
        $this->load->model('Pelayanan_model', 'pelayanan');
        $this->pelayanan->savePoly($id);

        $this->form_validation->set_rules('poly_id', 'Poly_id', 'required');
        $this->form_validation->set_rules('patient_id', 'Patient_id', 'required');
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('pay_date', 'Date', 'required');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jadwal Pasien sudah diubah!</div>');
        redirect('pelayanan/p_poli');
    }

    public function pasienBayar($id)
    {
        $data['title'] = 'Pendataan Poli Pasien';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $this->session->userdata('role_id')])->row_array();
        
        $this->load->model('Pelayanan_model', 'pelayanan');
        $data['gpoly'] = $this->pelayanan->getPoly();
        $data['poly'] = $this->db->get('poly')->result_array();

        $this->form_validation->set_rules('cost4', 'Biaya Konsultasi', 'required');
        $this->form_validation->set_rules('cost5', 'Biaya Obat', 'required');

        if ($this->input->post('cost4') == NULL OR $this->input->post('cost5')) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pelayanan/p_poli', $data);
            $this->load->view('templates/footer');
        } else {
            $this->pelayanan->addPayment($id);


        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jadwal Pasien sudah diubah!</div>');
        redirect('pelayanan/p_poli');
        }
    }

    public function d_poli($id)
    {
        $this->load->model('Pelayanan_model', 'pelayanan');
        $this->pelayanan->delPoly($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success mx-auto" role="alert">Pendaftaran Poli Pasien dihapus</div>');
        redirect('pelayanan/p_poli');
    }

    public function pembayaran()
    {
        $data['title'] = 'Pembayaran Pasien';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $this->session->userdata('role_id')])->row_array();
        
        $this->load->model('Pelayanan_model', 'pelayanan');
        $data['gpay'] = $this->pelayanan->getPayment();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelayanan/pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function editBayar($id)
    {
        $this->load->model('Pelayanan_model', 'pelayanan');
        $this->pelayanan->saveBayar($id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembayaran berhasil</div>');
        redirect('pelayanan/pembayaran');
    }

    public function excel()
	{
		$this->load->model('Pelayanan_model');
        $spreadsheet = new Spreadsheet();
            
		$sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'No. Kartu Medis');
		$sheet->setCellValue('C1', 'NIK');
        $sheet->setCellValue('D1', 'Nama');
        $sheet->setCellValue('E1', 'Tempat Lahir');
        $sheet->setCellValue('F1', 'Tanggal Lahir');
		$sheet->setCellValue('G1', 'Jenis Kelamin');
		$sheet->setCellValue('H1', 'Gol. Darah');
        $sheet->setCellValue('I1', 'Alamat');
        $sheet->setCellValue('J1', 'Agama');
        $sheet->setCellValue('K1', 'Status Perkawinan');
        $sheet->setCellValue('L1', 'Pekerjaan');
        $sheet->setCellValue('M1', 'Kewarganegaraan');
        
		$pelayanan = $this->Pelayanan_model->getAll();
		$no = 1;
		$x = 2;
		foreach($pelayanan as $row)
		{
            $sheet->setCellValue('A'.$x, $no++);
            $sheet->setCellValue('B'.$x, $row->id);
			$sheet->setCellValue('C'.$x, $row->nik);
            $sheet->setCellValue('D'.$x, $row->name);
			$sheet->setCellValue('E'.$x, $row->place);
            $sheet->setCellValue('F'.$x, $row->birth);
            $sheet->setCellValue('G'.$x, $row->gender);
            $sheet->setCellValue('H'.$x, $row->blood_type);
            $sheet->setCellValue('I'.$x, $row->address);
            $sheet->setCellValue('J'.$x, $row->religion);
            $sheet->setCellValue('K'.$x, $row->marital_status);
            $sheet->setCellValue('L'.$x, $row->job);
            $sheet->setCellValue('M'.$x, $row->nationality);
			$x++;
		}
        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
		$filename = 'Data Pasien';
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
	    $writer->save('php://output');
    }
    
    public function excelBayar()
	{
		$this->load->model('Pelayanan_model');
        $spreadsheet = new Spreadsheet();
            
		$sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'No. Kartu Medis');
		$sheet->setCellValue('C1', 'NIK');
        $sheet->setCellValue('D1', 'Nama');
        $sheet->setCellValue('E1', 'Jenis Poli');
        $sheet->setCellValue('F1', 'Waktu Check-Out');
		$sheet->setCellValue('G1', 'Total');
		$sheet->setCellValue('H1', 'Status Pembayaran');
        
        $pembayaran = $this->Pelayanan_model->getAllBayar();
		$no = 1;
		$x = 2;
		foreach($pembayaran as $row)
		{
            $sheet->setCellValue('A'.$x, $no++);
            $sheet->setCellValue('B'.$x, $row->pid);
			$sheet->setCellValue('C'.$x, $row->nik);
            $sheet->setCellValue('D'.$x, $row->name);
            $sheet->setCellValue('E'.$x, $row->poly_name);
            $sheet->setCellValue('F'.$x, $row->pay_date);
            $sheet->setCellValue('G'.$x, $row->total);
            $sheet->setCellValue('H'.$x, $row->status);
			$x++;
		}
        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
		$filename = 'Data Pembayaran Pasien';
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
	    $writer->save('php://output');
	}
}
