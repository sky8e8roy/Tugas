<?= $this->extend('layout/main') ?>
<?= $this->section('menu') ?>
                            <li class="has-submenu">
                                <a href="<?= base_url()?>"><i class="mdi mdi-airplay"></i>Beranda</a>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="mdi mdi-bullseye"></i>Adminstratif</a>
                                <ul class="submenu">
                                    <li><a href="<?= base_url()?>/kabupaten"><i class="mdi mdi-airplay"></i>Kabupaten</a></li>
                                    <li><a href="<?= base_url()?>/kecamatan"><i class="mdi mdi-airplay"></i>Kecamatan</a></li>
                                    <li><a href="<?= base_url()?>/kampung"><i class="mdi mdi-airplay"></i>Kampung</a></li>
                                </ul>
                            </li>
                            
                            <li class="has-submenu">
                                <a href="<?= base_url()?>/satker"><i class="mdi mdi-airplay"></i>Satuan Kerja</a>
                            </li>
                            
                            <li class="has-submenu">
                                <a href="<?= base_url()?>/sektor"><i class="mdi mdi-airplay"></i>Sektor</a>
                            </li>
                            
                            <li class="has-submenu">
                                <a href="<?= base_url()?>/subsektor"><i class="mdi mdi-airplay"></i>Subsektor</a>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="mdi mdi-layers"></i>Data</a>
                                <ul class="submenu">
                                    <li><a href="<?= base_url()?>/jenisdata"><i class="mdi mdi-airplay"></i>Jenis Data</a></li>
                                    <li><a href="<?= base_url()?>/satuan"><i class="mdi mdi-airplay"></i>Satuan</a></li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="mdi mdi-gauge"></i>Riwayat Data</a>
                                <ul class="submenu">
                                    <li><a href="<?= base_url()?>/riwayat_kabupaten"><i class="mdi mdi-airplay"></i>Kabupaten</a></li>
                                    <li><a href="<?= base_url()?>/riwayat_kecamatan"><i class="mdi mdi-airplay"></i>Kecamatan</a></li>
                                    <li><a href="<?= base_url()?>/riwayat_kampung"><i class="mdi mdi-airplay"></i>Kampung</a></li>
                                </ul>
                            </li>
<?= $this->endSection() ?>