<?php
$sql_detek_wali="SELECT tbl_wali.id_wali, tbl_wali.id_guru, tbl_wali.id_tahun, tbl_wali.id_kelas, setup_tahun.id_tahun, setup_tahun.status_aktif FROM tbl_wali,setup_tahun WHERE tbl_wali.id_guru=? and tbl_wali.id_tahun=setup_tahun.id_tahun and setup_tahun.status_aktif=1";

$result = $this->db->query($sql_detek_wali,array($id_guru));

$id_wali_kelas = $result->row('id_kelas');
$wali_id_wali = $result->row('id_wali');
?>