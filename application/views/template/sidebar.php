<div class="fik-db-side-menu">
    <div id="accordion">
        <div class="card show-mobile profil">
            <div class="img-wrapper">
                <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="919afcffe4203414b4ad613b-|49"></script><img src="https://ifik.telkomuniversity.ac.id/assets/img/7.jpg" data-pagespeed-url-hash="1357802400" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
            </div>
            <b><?= $user['name']; ?></b>
            <?= $title; ?>
        </div>
        <div class="divider show-mobile" style="margin-top:20px"></div>
        <div class="card">
            <a href="<?php echo base_url() ?>users" class="btn"><span class="fas fa-th-large"></span> Dashboard</a>
        </div>

        <div class="divider"></div>
        <div class="card">
            <a href="#" class="btn" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse3"><span class="fas fa-align-left"></span> TA Online</a>
            <div id="collapse4" class="collapse" data-parent="#accordion">
                <ul>
                    <li><a href="<?php echo base_url() ?>users/pendaftarantugasakhir">Pendaftaran</a></li>
                    <li><a href="<?php echo base_url() ?>users/bimbingantugasakhir">Bimbingan</a></li>
                    <li><a href="<?php echo base_url() ?>users/sidang">Sidang</a></li>
                </ul>
            </div>
        </div>

        <div class="divider"></div>
        <div class="card">
            <a href="#" class="btn" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2"><span class="fas fa-door-open"></span> Peminjaman Ruangan</a>
            <div id="collapse2" class="collapse" data-parent="#accordion">
                <ul>
                    <li><a data-toggle="modal" data-target="#makebooking">Buat Peminjaman</a></li>
                    <li><a href="<?php echo base_url() ?>users/daftarsemuatempat">Daftar Ruangan</a></li>
                    <li><a href="<?php echo base_url() ?>users/riwayat">Riwayat</a></li>
                </ul>
            </div>
        </div>

        <div class="card">
            <a href="#" class="btn" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1"><span class="fas fa-box"></span> Peminjaman Barang</a>
            <div id="collapse1" class="collapse" data-parent="#accordion">
                <ul>

                    <li><a href="<?php echo base_url() ?>item/listDosenMhs ">Daftar Semua Barang</a></li>
                    <li><a href="<?php echo base_url() ?>borrowing/listAllById/5f64747073268">Riwayat</a></li>
                </ul>
            </div>
        </div>

        <div class="divider"></div>
        <div class="card">
            <a href="#" class="btn" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3"><span class="fas fa-upload"></span> Listing Karya</a>
            <div id="collapse3" class="collapse" data-parent="#accordion">
                <ul>
                    <li><a href="<?php echo base_url() ?>karya/listbymhs">Karya Saya</a></li>
                    <li><a href="<?php echo base_url() ?>karya/tambahbymhs">Upload File</a></li>
                    <li><a href="<?php echo base_url() ?>karya/tambahbymhsvid">Upload Video</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Surat -->
        <div class="divider"></div>
        <?php
        $roleID = $user['role_id'];
        if ($roleID == 7 or $roleID == 8) : ?>
            <div class="card">
                <a href="<?= base_url('user/surat_tugas') ?>" class="btn"><span class="fas fa-envelope-open-text"></span> Surat Tugas</a>
            </div>
            <div class="card">
                <a href="<?= base_url('user/list_pengajuan') ?>" class="btn"><span class="fas fa-palette"></span> List Surat Tugas</a>
            </div>
        <?php elseif ($roleID == 9 or $roleID == 10) : ?>
            <div class="card">
                <a href="<?= base_url('suratTugas/surat_tugas') ?>" class="btn"><span class="fas fa-envelope-open-text"></span> Surat Tugas</a>
            </div>
        <?php elseif ($roleID == 11) : ?>
            <div class="card">
                <a href="<?= base_url('suratTugas/inputSurat') ?>" class="btn"><span class="fas fa-envelope-open-text"></span> Input Surat Tugas</a>
            </div>
            <div class="card">
                <a href="<?= base_url('suratTugas/surat_tugas') ?>" class="btn"><span class="fas fa-palette"></span> List Surat Tugas</a>
            </div>
        <?php elseif ($roleID == 4) : ?>
            <div class="card">
                <a href="<?= base_url('mahasiswa/surat_rekomendasi') ?>" class="btn"><span class="fas fa-envelope-open-text"></span>Surat Rekomendasi</a>
            </div>
            <div class="card">
                <a href="<?= base_url('mahasiswa/suratKeterangan') ?>" class="btn"><span class="fas fa-envelope-open-text"></span>Surat Keterangan</a>
            </div>
            <div class="card">
                <a href="<?= base_url('mahasiswa/list_pengajuan') ?>" class="btn"><span class="fas fa-palette"></span> List Pengajuan</a>
            </div>
        <?php elseif ($roleID == 12 or $roleID == 13 or $roleID == 14) : ?>
            <div class="card">
                <a href="<?= base_url('kemahasiswaan/surat_rekomendasi') ?>" class="btn"><span class="fas fa-envelope-open-text"></span>Surat Rekomendasi</a>
            </div>
            <div class="card">
                <a href="<?= base_url('kemahasiswaan/surat_keterangan') ?>" class="btn"><span class="fas fa-envelope-open-text"></span>Surat Keterangan</a>
            </div>
        <?php elseif ($roleID == 3) : ?>
            <div class="card">
                <a href="<?= base_url('kemahasiswaan/surat_rekomendasi') ?>" class="btn"><span class="fas fa-envelope-open-text"></span>Surat Rekomendasi</a>
            </div>
        <?php endif; ?>
        <div class="card logout">
            <button class="btn" data-toggle="modal" data-target="#logout"><span class="fas fa-sign-out-alt"></span> Logout</button>
        </div>
    </div>
</div>

<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Logout</h5>
            </div>
            <div class="modal-body">
                Anda yakin akan keluar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" onclick="if (!window.__cfRLUnblockHandlers) return false; location.href='<?php echo base_url() ?>auth/logout';" class="btn btn-primary" data-cf-modified-919afcffe4203414b4ad613b-="">Keluar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="makebooking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog wide" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Buat Peminjaman</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="https://ifik.telkomuniversity.ac.id/booking/bookingplace" method="POST" enctype="multipart/form-data">
                    <div class="custom-form">
                        <div class="form-group" style="margin-bottom:12px">
                            <input type="text" name="name" class="form-control" placeholder="" required="required" value="agung ginanjar" autocomplete="off" />
                            <label>Nama Lengkap</label>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="id_kategori" id="kategoriruanganmhs" required>
                                <option disabled selected>Kategori Ruangan</option>
                                <option value="5fc7957302bc8">
                                    AULA </option>
                                <option value="603e0e6aa2950">
                                    Galeri Idealoka </option>
                                <option value="11">
                                    Kelas Biasa </option>
                                <option value="5f9100d974da1">
                                    Lab Audio </option>
                                <option value="3">
                                    Lab Batik </option>
                                <option value="5f80133d512dc">
                                    Lab Bengkel </option>
                                <option value="5f8013736ff7e">
                                    Lab CGI </option>
                                <option value="2">
                                    Lab Cintiq </option>
                                <option value="5f80141d17719">
                                    Lab Creative business & Incubator room </option>
                                <option value="5f801485c6804">
                                    Lab Ergonomi & lighting </option>
                                <option value="5f8014524363e">
                                    Lab Finishing </option>
                                <option value="5f9100c5e3022">
                                    Lab Green Screen </option>
                                <option value="4">
                                    Lab Lukis </option>
                                <option value="6">
                                    Lab Multimedia </option>
                                <option value="7">
                                    Lab Pola dan Jahit </option>
                                <option value="5">
                                    Lab Sablon </option>
                                <option value="5f90fd482bdf8">
                                    Lab. Fotografi </option>
                                <option value="5f5d728af1b1d">
                                    Lab. Mac </option>
                                <option value="5f755879363dd">
                                    Laboratorium Klinik Desain </option>
                                <option value="5f7557222a173">
                                    Laboratorium Lukis </option>
                                <option value="5f801b7a84341">
                                    Prototyping & 3D printing </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="id_ruangan" id="ruangan" onchange="if (!window.__cfRLUnblockHandlers) return false; disablemodals()" disabled required data-cf-modified-919afcffe4203414b4ad613b-="">
                                <option disabled selected>Pilih Ruangan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="keterangan" class="form-control" placeholder="" required="required" autocomplete="off"></textarea>
                            <label>Keterangan</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="tanggal" id="tanggal" onchange="if (!window.__cfRLUnblockHandlers) return false; Bookingmodals()" class="form-control" disabled placeholder="" required="required" autocomplete="off" data-cf-modified-919afcffe4203414b4ad613b-="" />
                            <label>Tanggal Peminjaman</label>
                        </div>
                        <div class="form-group" style="margin-bottom:0">
                            <div class="form-control waktu">Waktu</div>
                        </div>
                    </div><br>
                    <div class="jadwal-ruangan" id="jadwal">
                        <table border="0" class="table bookings" id="booking">
                            <tbody>
                                <tr class="display" style="background:transparent">
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="id_peminjam" class="form-control" placeholder="" value="5f64747073268" required="required" autocomplete="off" />
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-pill btn-sm" id="createbookingmodals">Kirim Permintaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="919afcffe4203414b4ad613b-text/javascript">
    $(document).ready(function() {
        $('#kategoriruanganmhs').change(function() {
            document.getElementById("ruangan").disabled = false;
            var id_kategori = $('#kategoriruanganmhs').val();
            if (id_kategori != '') {
                $.ajax({
                    url: "https://ifik.telkomuniversity.ac.id/booking/fetchRuanganMhs",
                    method: "POST",
                    data: {
                        id_kategori: id_kategori
                    },
                    success: function(data) {
                        $('#ruangan').html(data);
                    }
                })
            }
        });
        $('#kategoriruangandsn').change(function() {
            document.getElementById("ruangan").disabled = false;
            var id_kategori = $('#kategoriruangandsn').val();
            if (id_kategori != '') {
                $.ajax({
                    url: "https://ifik.telkomuniversity.ac.id/booking/fetchRuanganDsn",
                    method: "POST",
                    data: {
                        id_kategori: id_kategori
                    },
                    success: function(data) {
                        $('#ruangan').html(data);
                    }
                })
            }
        });
    });
</script>