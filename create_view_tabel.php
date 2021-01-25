<?php

CREATE OR REPLACE VIEW `view_siswa_prestasi` AS SELECT siswa_dikelas.nis, siswa_dikelas.nama_siswa, siswa_dikelas.id_kelas, prestasi.id_wali, prestasi.id_tahun, prestasi.id_semester FROM tbl_prestasi_siswa AS prestasi RIGHT JOIN (SELECT tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nama_siswa FROM tbl_ruangan, data_siswa, setup_kelas, setup_tahun WHERE tbl_ruangan.nis=data_siswa.nis AND tbl_ruangan.id_kelas=setup_kelas.id_kelas AND tbl_ruangan.id_tahun=setup_tahun.id_tahun AND setup_tahun.status_aktif=1) AS siswa_dikelas ON siswa_dikelas.nis=prestasi.nis ORDER BY siswa_dikelas.nis ASC;

?>