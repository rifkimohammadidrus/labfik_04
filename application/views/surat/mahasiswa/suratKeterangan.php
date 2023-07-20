<main class="akun-container">
    <div class="fik-section-title2">
        <span class="fas fa-door-open zzzz"></span>
        <h5>Surat Keterangan</h5>
    </div>
    <?= $this->session->flashdata('massage') ?>
    <?= form_open_multipart('mahasiswa/suratKeterangan'); ?>
    <div class="card-body">
        <h5>Data Mahasiswa</h5>
        <hr><br>
        <div class="custom-form">
            <div class="form-group has-select">
                <select class="form-control" name="tipe_surat" id="tipe_surat" required>
                    <option style="text-indent: -9999px;font-size: 0px;" disabled selected value="">Tipe Surat</option>
                    <option value="Kelakuan Baik" <?php echo set_select('tipe_surat', 'Kelakuan Baik'); ?>>Kelakuan Baik </option>
                    <option value="Tidak Menerima Sanksi Akademik" <?php echo set_select('tipe_surat', 'Tidak Menerima Sanksi Akademik'); ?>>Tidak Menerima Sanksi Akademik </option>
                    <option value="Rekam Jejak" <?php echo set_select('tipe_surat', 'Rekam Jejak'); ?>>Rekam Jejak </option>
                    <option value="Tidak menerima beasiswa dari pihak lain " <?php echo set_select('tipe_surat', 'Tidak menerima beasiswa dari pihak lain'); ?>>Tidak menerima beasiswa dari pihak lain </option>
                </select>
            </div>
            <input type="hidden" name="jenis_surat" class="form-control custom-form-control" id="jenis_surat" value="Keterangan">
            <div class="form-group" style="margin-bottom:12px">
                <input readonly type="text" name="nim" class="form-control custom-form-control" required="required" value="<?= $user['nim']; ?>" id="nim" autocomplete="off"><label>Nim</label>
            </div>
            <div class="form-group">
                <input readonly type="text" name="nama" id="nama" class="form-control custom-form-control" value="<?= $user['name']; ?>" autocomplete="off"><label>Nama</label>
            </div>
            <div class="form-group" style="margin-bottom:12px">
                <input readonly type="text" name="prodi" class="form-control custom-form-control" value="<?= $user['prodi']; ?>" autocomplete="off"><label>Program Studi</label>
            </div>
            <div class="form-group has-select">
                <select class="form-control" name="mhs_smt" id="mhs_smt" value="<?= set_value('mhs_smt'); ?>">
                    <option disabled="" selected="">Semester Alur Studi</option>
                    <option value="I (Satu) - Ganjil">I (Satu) - Ganjil</option>
                    <option value="II (Dua) - Genap">II (Dua) - Genap</option>
                    <option value="III (Tiga) - Ganjil">III (Tiga) - Ganjil</option>
                    <option value="IV (Empat) - Genap">IV (Empat) - Genap</option>
                    <option value="V (Lima) - Ganjil">V (Lima) - Ganjil</option>
                    <option value="VI (Enam) - Genap">VI (Enam) - Genap</option>
                    <option value="VII (Tujuh) - Ganjil">VII (Tujuh) - Ganjil</option>
                    <option value="VIII (Delapan) - Genap">VIII (Delapan) - Genap</option>
                </select>
                <small class="form-text text-danger"><?= form_error('mhs_smt'); ?></small>
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
            <div class="form-group" style="margin-bottom:12px" id="instansi">
                <input type="text" name="instansi" class="form-control custom-form-control" value="<?= set_value('instansi'); ?>" autocomplete="off"><label> Instansi</label>
            </div>
            <h5 style="margin-bottom:12;">Eviden</h5>
            <hr><br>
            <div class="form-group" style="margin-bottom:12;">
                <label for="ktm"><b>KTM</b></label>
                <input type="file" name="ktm" id="ktm" class="form-control" style="padding:13px 16px" required="" value="<?= set_value('ktm') ?>">
                <span id="chk-error"></span>
            </div>
            <div class="form-group" style="margin-bottom:12;">
                <label for="transkrip"><b>Transkrip</b></label>
                <input type="file" name="transkrip" id="transkrip" class="form-control" style="padding:13px 16px" required="" value="<?= set_value('transkrip') ?>">
                <span id="chk-error"></span>
            </div>
            <div class="form-group" style="margin-bottom:12;">
                <label for="iklan"><b>Iklan/Broadcast/Surat Keterangan</b></label>
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
        jQuery("#instansi").hide()
        jQuery("#tipe_surat").change(function() {
            var value = jQuery(this).val();
            if (value == "Tidak menerima beasiswa dari pihak lain") {
                jQuery("#instansi").hide()
            } else if ((value == "Kelakuan Baik") || (value == "Rekam Jejak") || (value == "Tidak Menerima Sanksi Akademik")) {
                jQuery("#instansi").hide()
                $("#instansi").show()

            }
        });
    });
</script>