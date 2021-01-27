<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="profile-image">
                        <img class="img-xs rounded-circle" src="<?= base_url() ?>assets/images/faces/face8.jpg"
                            alt="profile image">
                        <div class="dot-indicator bg-success"></div>
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">Allen Moreno</p>
                        <p class="designation">Premium user</p>
                    </div>
                </a>
            </li>
            <li class="nav-item nav-category">Menu Utama</li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>#">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Beranda</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#pengguna" aria-expanded="false" aria-controls="auth">
                    <i class="menu-icon typcn typcn-document-add"></i>
                    <span class="menu-title">Data Pengguna</span>
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
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= base_url() ?>#">Data Administrator</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#jadwal" aria-expanded="false" aria-controls="auth">
                    <i class="menu-icon typcn typcn-document-add"></i>
                    <span class="menu-title">Penjadwalan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="jadwal">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/ruangkelas_siswa_baru">Setting Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/jadwal_ruangkelas">Ruang Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/jadwal_guru">Jadwal Guru</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/penjadwalan_wali_kelas">Wali Kelas</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#master" aria-expanded="false" aria-controls="auth">
                    <i class="menu-icon typcn typcn-document-add"></i>
                    <span class="menu-title">Data Master</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="master">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/setup_pelajaran/">Mata Pelajaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/setup_kelas/">Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/setup_tahun_pelajaran/">Tahun Ajaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>admin/setup_kkm/">KKM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?= base_url() ?>admin_editnilai/edit_sikap?m=edit_nilai&sm=edit_sikap">Kompentensi
                                Sikap</a>
                        </li>
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
                            <a class="nav-link text-danger" href="<?= base_url() ?>/#">Tinggi dan Berat Badan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= base_url() ?>/#">Kondisi Fisik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?= base_url() ?>/admin_editnilai/edit_data_kehadiran?m=edit_nilai&sm=data_kehadiran">Ketidakhadiran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= base_url() ?>/#">Saran-saran</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#rapot" aria-expanded="false" aria-controls="auth">
                    <i class="menu-icon typcn typcn-document-add"></i>
                    <span class="menu-title">E-RAPORT</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="rapot">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link text-warning"
                                href="<?= base_url() ?>cetak/legger_semua?m=pelaporan&sm=legger_semua">Legger Rapot</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?= base_url() ?>cetak/cetak_rapor?m=pelaporan&sm=cetak_rapor">Cetak Rapot</a>
                        </li>
                    </ul>
                </div>
            </li>
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
                            <a class="nav-link"
                                href="<?= base_url() ?>guru/laporan_per_mapel?m=laporan_nilai&sm=per_mapel">
                                <i class="menu-icon typcn typcn-document-text"></i>
                                <span class="menu-title">Laporan Nilai Siswa</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>