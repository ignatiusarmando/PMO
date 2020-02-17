<?php 
 
class M_pajak extends CI_Model{	
	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}
	function cek_tagihan($table,$where){
	    return $this->db->get_where($table,$where);
	}
	
	function input_data($table,$data){
	    $this->db->insert($table,$data);
	}
	function data_pelanggan(){
	    $query = "SELECT Data_Pelanggan.Nama, Data_Pelanggan.No_KTP, Data_Pelanggan.No_Kendaraan, (SUM(Data_Pelanggan.Tagihan_1) + SUM(Data_Pelanggan.Tagihan_2) + SUM(Data_Pelanggan.Tagihan_3) + SUM(Data_Pelanggan.Tagihan_4) + SUM(Data_Pelanggan.Tagihan_5)) AS totaltagihan FROM Data_Pelanggan GROUP BY Data_Pelanggan.id_pelanggan";
	    return $this->db->query($query)->result_array();
	}
	 
	function data_pengajuan($table,$where){
	    return $this->db->get_where($table,$where);
	}
	
	function update_pengajuan($table,$id,$data){
	    $this->db->where('id_pengajuan', $id);
	    $this->db->update($table, $data);
	}
	function update_pengajuan1($table,$id,$data){
	    $this->db->where('No_KTP', $id);
	    $this->db->update($table, $data);
	}
	function update_done($table,$id,$data){
	    $this->db->where($id);
	    $this->db->update($table, $data);
	}
	function cek_status($ktp){
	    $query = "SELECT Data_Pelanggan.No_KTP, Data_Pelanggan.No_Kendaraan,(SELECT Status.nama FROM Status JOIN Status_pengajuan ON Status_pengajuan.id_status = Status.id_status WHERE Status_pengajuan.No_KTP = $ktp ) AS status_sekarang  FROM Data_Pelanggan JOIN Status_pengajuan ON Data_Pelanggan.No_KTP = Status_pengajuan.No_KTP WHERE Status_pengajuan.No_KTP = $ktp";
	    return $this->db->query($query)->row_array();
	}
	function delete($id){
	    $this->db->where('id_pengajuan', $id);
	    $this->db->delete('Status_pengajuan');
	}
	
}