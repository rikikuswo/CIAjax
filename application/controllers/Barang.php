<?php
class Barang extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_utama');
	}
	function index(){
		$this->load->view('v_barang');
	}

	function data_barang(){
		$tabel = 'tbl_barang';
		$hasil = $this->m_utama->list_data($tabel);
		echo json_encode($hasil);
	}

	function get_barang(){
		$tabel = 'tbl_barang';
		$where = 'barang_kode';
		$kode = $this->input->get('id');
		$hasil = $this->m_utama->get_data_by_kode($tabel,$where,$kode);
		if($hasil->num_rows()>0){
			foreach ($hasil->result() as $row) {
				$hasil=array(
					'barang_kode' => $row->barang_kode,
					'barang_nama' => $row->barang_nama,
					'barang_harga' => $row->barang_harga
					);
			}
		}
		echo json_encode($hasil);
	}

	function simpan_barang(){
		$tabel = 'tbl_barang';
		$kobar = $this->input->post('kobar');
		$nabar = $this->input->post('nabar');
		$harga = $this->input->post('harga');
		$data = array(
                'barang_kode' => $kobar,
                'barang_nama' => $nabar,
                'barang_harga' => $harga
                );
		$hasil = $this->m_utama->simpan_data($tabel,$data);
		echo json_encode($hasil);
	}

	function update_barang(){
		$tabel = 'tbl_barang';
		$where = 'barang_kode';
		$kode = $this->input->post('kobar');
		$nabar = $this->input->post('nabar');
		$harga = $this->input->post('harga');
		$data = array(
                'barang_nama' => $nabar,
                'barang_harga' => $harga
                );
		$hasil = $this->m_utama->update_data($tabel,$data,$where,$kode);
		echo json_encode($hasil);
	}

	function hapus_barang(){
		$tabel = 'tbl_barang';
		$where = 'barang_kode';
		$kode = $this->input->post('kode');
		$hasil = $this->m_utama->hapus_data($tabel,$where,$kode);
		echo json_encode($hasil);
	}

}