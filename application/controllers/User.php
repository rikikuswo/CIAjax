<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_utama');
	}

	public function index()
	{
		$this->load->view('v_user');
	}

	public function data_user()
	{
		$tabel = 'tbl_user';
		$hasil = $this->m_utama->list_data($tabel);
		echo json_encode($hasil);
	}

	public function simpan_user()
	{
		$tabel = 'tbl_user';
		$nama = $this->input->post('nama');
		$handphone = $this->input->post('handphone');
		$role = $this->input->post('role');
		$data = array(
			'nama' => $nama, 
			'telp' => $handphone,
			'role' => $role
		);
		$hasil = $this->m_utama->simpan_data($tabel, $data);
		echo json_encode($hasil);
	}

	public function get_user()
	{
		$tabel = 'tbl_user';
		$where = 'iduser';
		$id = $this->input->get('id');
		$hasil = $this->m_utama->get_data_by_kode($tabel,$where,$id);
		if($hasil->num_rows()>0){
			foreach ($hasil->result() as $row) {
				$hasil=array(
					'iduser' => $row->iduser,
					'nama' => $row->nama,
					'telp' => $row->telp,
					'role' => $row->role
					);
			}
		}
		echo json_encode($hasil);
	}

	public function update_user()
	{
		$tabel = 'tbl_user';
		$where = 'iduser';
		$iduser = $this->input->post('iduser');
		$nama = $this->input->post('nama');
		$handphone = $this->input->post('handphone');
		$role = $this->input->post('role');
		$data = array(
			'nama' => $nama, 
			'telp' => $handphone,
			'role' => $role
		);
		$hasil = $this->m_utama->update_data($tabel, $data, $where, $iduser);
		echo json_encode($hasil);
	}

	public function hapus_user()
	{
		$tabel = 'tbl_user';
		$where = 'iduser';
		$iduser = $this->input->post('iduser');
		$hasil = $this->m_utama->hapus_data($tabel, $where, $iduser);
		echo json_encode($hasil);
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */