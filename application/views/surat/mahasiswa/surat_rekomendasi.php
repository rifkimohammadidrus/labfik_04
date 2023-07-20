<main class="akun-container">
    <div class="fik-section-title2">
        <span class="fas fa-door-open zzzz"></span>
        <h5>Surat Rekomendasi</h5>
    </div>
    <?= $this->session->flashdata('massage') ?>
    <?= form_open_multipart('mahasiswa/surat_rekomendasi'); ?>
    <div class="card-body">
        <h5>Data Mahasiswa</h5>
        <hr><br>
        <div class="custom-form">
            <div class="form-group has-select">
                <select class="form-control" name="tipe_surat" id="tipe_surat" required>
                    <option style="text-indent: -9999px;font-size: 0px;" disabled selected value="">Jenis Rekomendasi</option>
                    <option value="Pascasarjana (S2)" <?php echo set_select('tipe_surat', 'Pascasarjana (S2)'); ?>>Rekomendasi Alumni </option>
                    <option value="LPDP" <?php echo set_select('tipe_surat', 'LPDP'); ?>>Beasiswa LPDP </option>
                    <option value="Kemendikbud Ristek" <?php echo set_select('tipe_surat', 'Kemendikbud Ristek'); ?>>Beasiswa Kemendikbud Ristek </option>
                    <option value="FAST Brotherhood 95" <?php echo set_select('tipe_surat', 'FAST Brotherhood 95'); ?>>Beasiswa FAST Brotherhood 95 </option>
                    <option value="Lainnya" <?php echo set_select('tipe_surat', 'Lainnya'); ?>>Beasiswa Lainnya </option>
                </select>
                <input type="text" class="form-control custom-form-control" name="surat_lainnya" id="surat_lainnya" cols="30" rows="1" placeholder="Masukan jenis surat rekomendasi lainnya" style="margin-top:12px" autocomplete="off" value="<?= set_value('surat_lainnya'); ?>"></input>
            </div>
            <input type="hidden" name="jenis_surat" class="form-control custom-form-control" id="jenis_surat" value="Rekomendasi">
            <div class="form-group" style="margin-bottom:12px">
                <input readonly type="text" name="nim" class="form-control custom-form-control" required="required" value="<?= $user['nim']; ?>" id="nim" autocomplete="off"><label>Nim</label>
            </div>
            <div class="form-group">
                <input readonly type="text" name="nama" id="nama" class="form-control custom-form-control" value="<?= $user['name']; ?>" autocomplete="off"><label>Nama</label>
            </div>
            <div class="form-group" style="margin-bottom:12px">
                <input readonly type="text" name="prodi" class="form-control custom-form-control" value="<?= $user['prodi']; ?>" autocomplete="off"><label>Program Studi</label>
            </div>
            <div class="form-group" style="margin-bottom:12px">
                <input type="text" name="ipk" class="form-control custom-form-control" required="required" id="ipk" value="<?= set_value('ipk') ?>" autocomplete="off"><label>IPK</label>
            </div>
            <div id="beasiswa_lpdp">
                <div class="form-group" style="margin-bottom:12px">
                    <input type="text" name="instansi" class="form-control custom-form-control" id="instansi" value="<?= set_value('instansi') ?>" autocomplete="off"><label>Nama Instansi</label>
                </div>
                <div class="form-group" style="margin-bottom:12px">
                    <div class="row">
                        <div class="col-md-8">
                            <textarea type="text" name="alamat" class="form-control custom-form-control" id="alamat" value="<?= set_value('alamat'); ?>"></textarea>
                            <label style="margin-left: 16px;">Alamat </label><small class="form-text text-danger"><?= form_error('alamat'); ?></small>
                        </div>
                        <div class="col">
                            <input type="text" name="rt" class="form-control col-md-10" id="rt" value="<?= set_value('rt'); ?>"> <label style="margin-left: 16px;">RT</label><small class="form-text text-danger"><?= form_error('rt'); ?></small>
                        </div>
                        <div class="col">
                            <input type="text" name="rw" class="form-control col-md-10" id="rw" value="<?= set_value('rw'); ?>"><label style="margin-left: 16px;">RW</label><small class="form-text text-danger"><?= form_error('rw'); ?></small>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:12px">
                    <div class="row">
                        <div class="col">
                            <select class="form-control custom-form-control" name="provinsi" id="provinsi" value="<?= set_value('provinsi'); ?>" onchange="ajaxkota(this.value)">
                                <option value='0'>Pilih Provinsi</option>
                                <?php
                                foreach ($provinsi as $data) {
                                    echo '<option value="' . $data->id_prov . '">' . $data->nama . '</option>';
                                }
                                ?>
                            </select><small class="form-text text-danger"><?= form_error('provinsi'); ?></small>
                        </div>
                        <div class="col">
                            <select class="form-control custom-form-control" name="kota" id="kota" value="<?= set_value('kota'); ?>" onchange="ajaxkec(this.value)">
                                <option value='0'>Pilih Kota</option>
                            </select><small class="form-text text-danger"><?= form_error('kota'); ?></small>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:12px">
                    <div class="row">
                        <div class="col">
                            <select name="kec" id="kec" class="form-control" onchange="ajaxkel(this.value)">
                                <option value="">Pilih Kecamatan</option>
                            </select><small class="form-text text-danger"><?= form_error('kec'); ?></small>
                        </div>
                        <div class="col">
                            <select name="kel" id="kel" class="form-control">
                                <option value="">Pilih Kelurahan/Desa</option>
                            </select><small class="form-text text-danger"><?= form_error('kel'); ?></small>
                        </div>
                    </div>
                </div>



            </div>
            <div class="form-group" style="margin-bottom:12px" id="penilaian">
                <h5>Kriteria Penilaian</h5>
                <hr style="margin-bottom: 12px;">
                <div class="row">
                    <div class="col-md-11" style="margin-bottom:12px">
                        <input type="text" name="penilaian[]" class="form-control custom-form-control" id="penilaian" value="<?= set_value('penilaian[]') ?>" autocomplete="off" />
                        <label style="margin-left:16px; ">Penilaian</label>
                    </div>
                    <div class="col-md-1">
                        <i id="addPenilaian" class="fas fa-plus" style="margin-top: 12px;"></i>
                    </div>
                </div>
            </div>
            <div id="tambahPenilaian"></div>
            <h5 style="margin-bottom:12;">Eviden</h5>
            <hr><br>
            <div class="form-group" style="margin-bottom:12;">
                <label for="ktm" style="padding-top: 5;"><b>KTM</b></label>
                <p style="color: white;margin-top:-15px;">.</p>
                <input type="file" name="ktm" id="ktm" class="form-control" style="padding:13px 16px" required="" value="<?= set_value('ktm') ?>">
                <span id="chk-error"></span>
            </div>
            <div class="form-group" style="margin-bottom:12;">
                <label for="transkrip"><b>Transkrip</b></label>
                <p style="color: white;margin-top:-15px;">.</p>
                <input type="file" name="transkrip" id="transkrip" class="form-control" style="padding:13px 16px" required="" value="<?= set_value('transkrip') ?>">
                <span id="chk-error"></span>
            </div>
            <div class="form-group" style="margin-bottom:-12;">
                <label for="iklan"><b>Iklan/Broadcast/Surat Keterangan</b></label>
                <p style="color: white;margin-top:-15px;">.</p>
                <input type="file" name="iklan" id="iklan" class="form-control" style="padding:13px 16px" required="" value="<?= set_value('iklan') ?>">
                <span id="chk-error"></span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-pill btn-sm" value="upload" id="createsuratrekomendasi">Kirim Permintaan</button>
        </div>
        </form>
    </div>
    </div>
</main>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">


<script type="text/javascript">
    //addEviden
    $(document).ready(function() {
        $('#addEviden').on('click', function() {
            $('#tambahEviden').append(`
            <div class="form-group" style="margin-bottom:12;" id="removeEviden">
                <div class="row">
                <div class="col-md-11">
                        <input type="file" name="eviden[]" id="eviden" class="form-control" style="padding:13px 16px" value="<?= set_value('eviden[]') ?>">
                        <span id="chk-error"></span>
                        <label style="margin-left:16px"><b>Eviden</b></label>
                    </div>
                    <div class="col-md-1">
                        <i id="hapus" class="fas fa-trash-alt" ></i>
                    </div>
                </div>
            </div>`)
        });
    });
    $(document).on('click', '#hapus', function() {
        var myobj = document.getElementById("removeEviden");
        myobj.remove();
    });
</script>
<script>
    jQuery(function() {
        jQuery("#tambahPanitia").hide()
        jQuery("#tambahDivisi").hide()
        jQuery("#kepanitiaan").hide()
        jQuery("#jenis_penugasan").change(function() {
            var value = jQuery(this).val();
            if (value == "Kepanitiaan") {
                // jQuery("#kelompok").hide()
                $("#tambahDivisi").show();
                $("#kepanitiaan").show();
                $("#tambahPanitia").show()
            } else {
                jQuery("#tambahDivisi").hide()
                jQuery("#tambahPanitia").hide()
                jQuery("#kepanitiaan").hide()
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#addPenilaian').on('click', function() {
            $('#tambahPenilaian').append(`
            <div class="form-group" style="margin-bottom:12px" id="removePenilaian">
                <div class="row">
                    <div class="col-md-11" style="margin-bottom:12px">
                        <input type="text" name="penilaian[]" class="form-control custom-form-control" id="penilaian" value="<?= set_value('penilaian[]') ?>" required="required" autocomplete="off" />
                        <label style="margin-left:16px; ">Penilaian</label>
                    </div>
                    <div class="col-md-1" >
                        <i id="deleteForm" class="fas fa-trash" style="margin-top: 12px;"></i>
                    </div>
                </div>
            </div>`)
        });
    });
    $(document).on('click', '#deleteForm', function() {
        var myobj = document.getElementById("removePenilaian");
        myobj.remove();
    });
</script>


<script>
    jQuery(function() {
        jQuery("#surat_lainnya").hide()
        jQuery("#penilaian").hide()
        jQuery("#beasiswa_lpdp").hide()
        jQuery("#tipe_surat").change(function() {
            var value = jQuery(this).val();
            if (value == "Lainnya") {
                jQuery("#surat_lainnya").hide()
                jQuery("#penilaian").hide()
                $("#surat_lainnya").show();
            } else if (value == 'Kemendikbud Ristek') {
                jQuery("#surat_lainnya").hide()
                jQuery("#penilaian").hide()
                jQuery("#beasiswa_lpdp").hide()
                $("#penilaian").show();
            } else if (value == 'LPDP') {
                jQuery("#surat_lainnya").hide()
                jQuery("#penilaian").hide()
                jQuery("#beasiswa_lpdp").hide()
                $("#beasiswa_lpdp").show();
            }
        });
    });
</script>