<?php
class M_utama extends CI_Model{

	function list_data($tabel){
		$hasil=$this->db->get($tabel);
		return $hasil->result();
	}

	function simpan_data($tabel,$data){
		$hasil = $this->db->insert($tabel, $data);
		return $hasil;
	}

	function get_data_by_kode($tabel,$where,$kode){
		$hasil = $this->db->get_where($tabel, array($where => $kode));
		return $hasil;
	}

	function update_data($tabel,$data,$where,$kode){
		$this->db->set($data);
		$this->db->where($where, $kode);
		$hasil = $this->db->update($tabel);
		return $hasil;
	}

	function hapus_data($tabel,$where,$kode){
		$hasil = $this->db->delete($tabel, array($where => $kode));
		return $hasil;
	}
	
}