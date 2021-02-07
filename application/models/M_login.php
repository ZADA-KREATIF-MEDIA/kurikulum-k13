<?php

class M_login extends CI_Model{

	function cek_login($table,$where){
		return $this->db->get_where($table,$where);
	}

	function select_dataFrom($table){
		return $this->db->get($table);
	}

	function update_dataTable($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	function cek_wali($id)
	{
		$this->db->select()
			->from('tbl_wali')
			->where('id_guru',$id);
		$query = $this->db->count_all_results(); 
		return $query;
	}
}
