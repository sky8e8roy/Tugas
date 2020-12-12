<?= $this->extend('layout/main') ?>
<?= $this->section('menu') ?>
                            <li class="has-submenu">
                                <a href="<?= base_url()?>"><i class="mdi mdi-airplay"></i>Beranda</a>
                            </li>
                            
                            <li class="has-submenu">
                                <a href="<?= base_url()?>/kabupaten"><i class="mdi mdi-airplay"></i>Kabupaten</a>
                            </li>
                            
                            <li class="has-submenu">
                                <a href="<?= base_url()?>/kecamatan"><i class="mdi mdi-airplay"></i>Kecamatan</a>
                            </li>
                            
                            <li class="has-submenu">
                                <a href="<?= base_url()?>/kampung"><i class="mdi mdi-airplay"></i>Kampung</a>
                            </li>
<?= $this->endSection() ?>