<?php

class M_ortu extends CI_Model
{

    public function m_get_kompetensi($id)
    {
        $this->db->select()
			->from('data_siswa')
			->where('id_siswa',$id);
		$query = $this->db->get_compiled_select();
		$data_mhs = $this->db->query($query)->row_array();
        
        $this->db->select('d.nama_kelas,b.semester,c.tahun,a.predikat_spiritual,a.sikap_spiritual,a.predikat_sosial,a.sikap_sosial')
            ->from('tbl_nilai_sikap AS a')
            ->join('setup_semester AS b','a.id_semester=b.id_semester','left')
            ->join('setup_tahun AS c','a.id_tahun=c.id_tahun','left')
            ->join('setup_kelas AS d','a.id_kelas=d.id_kelas','left')
			->where('a.nis',$data_mhs['nis']);
		$query = $this->db->get_compiled_select();
		$data = $this->db->query($query)->result_array();
		return $data;
    }

    public function m_get_saran($id)
    {
        $this->db->select()
            ->from('data_siswa')
            ->where('id_siswa',$id);
        $query = $this->db->get_compiled_select();
        $data_mhs = $this->db->query($query)->row_array();

        $this->db->select('d.nama_kelas,b.semester,c.tahun,a.catatanwk')
            ->from('tbl_catatanwk AS a')
            ->join('setup_semester AS b','a.id_semester=b.id_semester','left')
            ->join('setup_tahun AS c','a.id_tahun=c.id_tahun','left')
            ->join('setup_kelas AS d','a.id_kelas=d.id_kelas','left')
            ->where('a.nis',$data_mhs['nis']);
        $query = $this->db->get_compiled_select();
        $data = $this->db->query($query)->result_array();
        return $data;
    
    }
}