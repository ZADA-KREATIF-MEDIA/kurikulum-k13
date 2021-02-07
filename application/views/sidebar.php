<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <?php if ($this->session->userdata('status') == "admin") : ?>
            <li class="nav-item nav-category">Navigasi Utama</li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>#">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Beranda</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#pengguna" aria-expanded="false" aria-controls="auth">
                    <i class="menu-icon typcn typcn-document-add"></i>
                    <span class="menu-title">Manajemen Pengguna</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="pengguna">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/data_siswa/">Data Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/data_guru/">Data Guru</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#jadwal" aria-expanded="false" aria-controls="auth">
                    <i class="menu-icon typcn typcn-document-add"></i>
                    <span class="menu-title">Data Kelas & Mapel</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="jadwal">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/setup_kelas/">Data Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/ruangkelas_siswa_baru">Siswa Baru</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/jadwal_ruangkelas">Pembangian Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/penjadwalan_wali_kelas">Data Wali Kelas</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#mapel" aria-expanded="false" aria-controls="auth">
                    <i class="menu-icon typcn typcn-document-add"></i>
                    <span class="menu-title">Manajemen Mapel</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="mapel">
                    <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>admin/setup_pelajaran/">Mata Pelajaran</a>
            </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/jadwal_guru">Mapel Guru</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/setup_kkm/">KKM</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#nilai" aria-expanded="false" aria-controls="auth">
                    <i class="menu-icon typcn typcn-document-add"></i>
                    <span class="menu-title">Penilaian Siswa</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="nilai">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?= base_url() ?>admin_editnilai/edit_sikap?m=edit_nilai&sm=edit_sikap">Kompentensi
                                Sikap</a>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?= base_url() ?>/admin_editnilai/edit_nilai_peng_ketr?m=edit_nilai&sm=pengetahuan_ketrampilan">Kompentensi
                                Pengetahuan <br>Dan
                                Ketrampilan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>/admin_editnilai/edit_prestasi">Prestasi
                                Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>/admin/setup_ekstra">Ekstrakurikuler</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/tinggi_berat">Tinggi dan Berat Badan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/kondisi_fisik">Kondisi Fisik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?= base_url() ?>admin_editnilai/edit_data_kehadiran">Ketidakhadiran</a>
                        </li>
                        <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>cetak/cetak_rapor?m=pelaporan&sm=cetak_rapor">Cetak Rapot</a>
            </li>
            </li>
        </ul>
</div>
</li>
<li class="nav-item">
                <a class="nav-link nav-category" href="<?= base_url() ?>admin/setup_tahun_pelajaran/">Tahun Ajaran</a>
            </li>
<?php elseif ($this->session->userdata('status') == "guru") : ?>
<li class="nav-item nav-category">MENU GURU</li>
<li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#guru" aria-expanded="false" aria-controls="auth">
        <i class="menu-icon typcn typcn-document-add"></i>
        <span class="menu-title">Penilaian Siswa</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="guru">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>guru/input_nilai">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Nilai Mata Pelajaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>guru/input_deskripsi_nilai">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Saran/Keterangan Nilai</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>guru/laporan_per_mapel?m=laporan_nilai&sm=per_mapel">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Laporan Nilai Siswa</span>
                </a>
            </li>
        </ul>
    </div>
</li>
<?php elseif ($this->session->userdata('status') == "wali") : ?>
<li class="nav-item nav-category">MENU WALI KELAS</li>
<li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#guru" aria-expanded="false" aria-controls="auth">
        <i class="menu-icon typcn typcn-document-add"></i>
        <span class="menu-title">Penilaian Siswa</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="guru">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>guru/input_catatanwk">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Saran-Saran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>guru/input_kehadiran">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Kehadiran Siswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>guru/input_prestasi">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Prestasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>guru/ekstra_kurikuler">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title ">Ekstrakulikuler</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>guru/input_nilai_sikap">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Kopentensi Sikap</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>guru/input_nilai">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Nilai Mata Pelajaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>guru/input_deskripsi_nilai">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Saran/Keterangan Nilai</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>guru/kondisi_fisik">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Kondisi fisik</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>guru/laporan_per_mapel?m=laporan_nilai&sm=per_mapel">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Laporan Nilai Siswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>guru/tinggi_berat">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Tinggi dan Berat Badan</span>
                </a>
            </li>
        </ul>
    </div>
</li>
<?php else : ?>
<li class="nav-item nav-category">MENU ORANG TUA</li>
<li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>ortu/nilai_raport" aria-expanded="false" aria-controls="auth">
        <i class="menu-icon typcn typcn-document-add"></i>
        <span class="menu-title">Rapot</span>
    </a>
    <a class="nav-link" href="<?= base_url() ?>ortu/kompetensi_siswa" aria-expanded="false" aria-controls="auth">
        <i class="menu-icon typcn typcn-document-add"></i>
        <span class="menu-title">Kompetensi Sikap</span>
    </a>
    <a class="nav-link" href="<?= base_url() ?>ortu/saran_saran" aria-expanded="false" aria-controls="auth">
        <i class="menu-icon typcn typcn-document-add"></i>
        <span class="menu-title">Saran - saran</span>
    </a>
</li>
<?php endif; ?>
<li class="nav-item">
    <a class="nav-link text-danger" href="<?php echo base_url('login/logout');?>" aria-expanded="false"
        aria-controls="auth">
        <i class="menu-icon typcn typcn-document-add"></i>
        <span class="menu-title">Keluar</span>
    </a>
</li>
</ul>
</nav>