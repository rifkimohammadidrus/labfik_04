<main class="akun-container">
    <div class="fik-section-title2">
        <span class="fas fa-door-open zzzz"></span>
        <h5>Surat Tugas</h5>
    </div>
    <?= $this->session->flashdata('massage') ?>
    <?= form_open_multipart('suratTugas/inputSurat'); ?>
    <div class="card-body">
        <h5>Data Kegiatan</h5>
        <hr><br>
        <div class="custom-form">
            <input type="hidden" name="user_id" class="form-control custom-form-control" id="user_id" value="<?= $user['id']; ?>">
            <div class="form-group" style="margin-bottom:12px">
                <input type="text" name="nama_kegiatan" class="form-control custom-form-control" required="required" value="<?= set_value('nama_kegiatan'); ?>" id="nama_kegiatan" autocomplete="off"><label>Nama Kegiatan</label>
                <?= form_error('nama_kegiatan', '<small class="text-danger">', '</small>'); ?>
            </div>


            <div class="form-group">
                <input type="text" name="tanggal_kegiatan" id="datepicker" class="form-control custom-form-control" required="required" value="<?= set_value('tanggal_kegiatan'); ?>" autocomplete="off"><label>Tanggal Kegiatan</label>
            </div>
            <div>
                <div class="form-group" style="margin-bottom:12px">
                    <input type="text" name="no_ememo" class="form-control custom-form-control" id="no_ememo" value="<?= set_value('no_ememo'); ?>" required="required" autocomplete="off"><label>Nomor E-memo Pengajuan</label>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:12px">
                <input type="text" name="tempat_kegiatan" class="form-control custom-form-control" required="required" value="<?= set_value('tempat_kegiatan'); ?>" autocomplete="off"><label>Tempat Kegiatan</label>
            </div>
            <div class="form-group" style="margin-bottom:12px">
                <input type="text" name="periode_penugasan" class="form-control custom-form-control" required="required" id="periode_penugasan" value="<?= set_value('periode_penugasan') ?>" autocomplete="off"><label>Periode Penugasan</label>

            </div>
            <!-- <h5 style="margin-bottom:12px">Periode Penugasan</h5>
            <div class="form-group" style="margin-bottom:12px">
                <div class="row">
                    <div class="col">
                        <input type="text" name="periode_penugasan[]" class="form-control custom-form-control" id="periode_penugasan" value="<?= set_value('periode_penugasan[]') ?>" autocomplete="off"><label style="margin-left:16px; ">Mulai dari</label>
                    </div>
                    <div class="col">
                        <input type="text" name="periode_penugasan[]" class="form-control custom-form-control" id="periode_penugasan1" value="<?= set_value('periode_penugasan[]') ?>" autocomplete="off"><label style="margin-left:16px; ">Sampai dengan</label>
                    </div>
                </div>
            </div> -->
            <div class="form-group" style="margin-bottom:12px">
                <input type="text" name="penyelenggara" class="form-control custom-form-control" required="required" value="<?= set_value('penyelenggara'); ?>" autocomplete="off"><label>Penyelenggara</label>
            </div>
            <div class="form-group has-select">
                <select class="form-control" name="jenis_penugasan" id="jenis_penugasan" required>
                    <option style="text-indent: -9999px;font-size: 0px;" disabled selected value="">Jenis Penugasan</option>
                    <option value="Juri" <?php echo set_select('jenis_penugasan', 'Juri'); ?>>Juri </option>
                    <option value="Pembicara" <?php echo set_select('jenis_penugasan', 'Pembicara'); ?>>Pembicara </option>
                    <option value="Narasumber" <?php echo set_select('jenis_penugasan', 'Narasumber'); ?>>Narasumber </option>
                    <option value="Kepanitiaan">Kepanitiaan </option>
                </select>
            </div>
            <h5 id="kepanitiaan" style="margin-bottom:20px;">Kepanitiaan
                <hr>
            </h5>
            <div class="form-group" style="margin-bottom:12px">
                <div class="row">
                    <div class="col-md-11" style="margin-bottom:12px">

                        <input type="text" name="nip[]" class="form-control custom-form-control" id="nip" value="<?= set_value('nip[]') ?>" required="required" autocomplete="off" />
                        <label style="margin-left:16px; ">NIP</label>
                        <small class="form-text text-danger"></small>

                    </div>
                    <div class="col-md-1" id="tambahPanitia">
                        <i id="addBtn" class="fas fa-plus" style="margin-top: 12px;"></i>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:12px">
                    <input type="text" name="nama_dosen" id="nama_dosen" class="form-control custom-form-control col-md-11" value="<?= set_value('nama_dosen') ?>"><label>Nama Dosen</label>
                </div>
                <div class="form-group" style="margin-bottom:12px">
                    <input type="text" name="jabatan" id="jabatan" class="form-control custom-form-control col-md-11" value="<?= set_value('jabatan') ?>"><label>Jabatan</label>
                </div>
                <div class="form-group" style="margin-bottom:12px" id="tambahDivisi">
                    <div class="row">
                        <div class="col-md-11" style="margin-bottom:12px">
                            <input type="text" name="divisi[]" id="divisi" class="form-control custom-form-control" autocomplete="off" value="<?= set_value('divisi[]') ?>"><label style="margin-left:16px; ">Divisi</label>
                        </div>
                        <!-- <div class="col-md-1">
                            <i id="addBtn" class="fas fa-plus" style="margin-top: 12px;"></i>
                        </div> -->
                    </div>
                    <div id="tbody"></div>
                </div>
                <div class="custom-form">


                    <h5 style="margin-bottom:12;">Eviden</h5>
                    <hr><br>
                    <div class="form-group" style="margin-bottom:12;">
                        <div class="row">
                            <div class="col-md-11" style="margin-bottom:12px">
                                <label for="eviden" style="margin-left: 16px;"><b>Eviden</b></label>
                                <input type="file" name="eviden[]" id="eviden" class="form-control" style="padding:13px 16px" value="<?= set_value('eviden[]') ?>">
                                <span id="chk-error"></span>
                            </div>
                            <div class="col-md-1">
                                <i id="addEviden" class="fas fa-plus" style="margin-top: 12px;"></i>
                            </div>
                        </div>
                        <div id="tambahEviden"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-pill btn-sm" value="upload" id="createsurattugas">Kirim Permintaan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</main>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">


<script type="text/javascript">
    $(document).ready(function() {
        $('#nama_kegiatan').autocomplete({
            source: "<?php echo site_url('autocomplete/get_nama_kegiatan'); ?>",
            select: function(event, ui) {
                $('[name="nama_kegiatan"]').val(ui.item.label);
            }
        });
        $('#no_ememo').autocomplete({
            source: "<?php echo site_url('autocomplete/get_ememo'); ?>",
            select: function(event, ui) {
                $('[name="no_ememo"]').val(ui.item.label);
            }
        });
        $('#periode_penugasan').autocomplete({
            source: "<?php echo site_url('autocomplete/get_periode_penugasan'); ?>",
            select: function(event, ui) {
                $('[name="periode_penugasan"]').val(ui.item.label);
            }
        });
        $('#nip').autocomplete({
            source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
            select: function(event, ui) {
                $('[name="nip"]').val(ui.item.label);
                $('[name="nama_dosen"]').val(ui.item.name);
                $('[name="jabatan"]').val(ui.item.jabatan);
            }
        });

    });
    var dateToday = new Date();
    $(function() {
        $("#datepicker").datepicker({
            minDate: 0,
            dateFormat: 'dd/mm/yy'
        });
    });
    //periode penugasan

    //Tambah NIP
    $(document).ready(function() {
        var rowIdx = 0;
        $('#addBtn').on('click', function() {
            $('#tbody').append(`<div id="R${++rowIdx}" >
            
            <div class="show-index" id="showIndex">
                <div class="delete-index" id="remove">
                    <div class="form-group" style="margin-bottom:12px">
                        <div class="row">
                            <div class="col-md-11">
                                <input type="text" name="nip[]" class="autocomplete${rowIdx} form-control custom-form-control " id="nip" required="required" place="nip${rowIdx}">
                                <label style="margin-left:16px">NIP</label>
                            </div>
                            <div class="col-md-1">
                                <i id ="minus" class="fas fa-trash-alt " style="margin-top: 12px;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"  style="margin-bottom:12px">
                        <input type="text" name="nama_dosen" id="nama${rowIdx}" class=" form-control custom-form-control col-md-11" place="nama${rowIdx}" >
                        <label>Nama</label>
                    </div>
                    <div class="form-group"  style="margin-bottom:12px">
                        <input type="text" name="jabatan" class=" form-control custom-form-control col-md-11" id="jabatan" place="jabatan${rowIdx}" >
                        <label>Jabatan</label>
                    </div>
                    <div class="form-group" style="margin-bottom:12px">
                        <input type="text" name="divisi[]" id="divisi" class="form-control custom-form-control col-md-11"  required="required"autocomplete="off" ><label>Divisi</label>
                    </div>
                </div>
            </div>
			</div>`)

            $('.autocomplete1').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama1" ]').val(ui.item.name);
                    $('[place="jabatan1"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete2').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama2" ]').val(ui.item.name);
                    $('[place="jabatan2"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete3').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama3" ]').val(ui.item.name);
                    $('[place="jabatan3"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete4').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama4" ]').val(ui.item.name);
                    $('[place="jabatan4"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete5').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama5" ]').val(ui.item.name);
                    $('[place="jabatan5"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete6').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama6" ]').val(ui.item.name);
                    $('[place="jabatan6"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete7').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama7" ]').val(ui.item.name);
                    $('[place="jabatan7"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete8').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama8" ]').val(ui.item.name);
                    $('[place="jabatan8"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete9').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama9" ]').val(ui.item.name);
                    $('[place="jabatan9"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete10').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama10" ]').val(ui.item.name);
                    $('[place="jabatan10"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete11').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama11" ]').val(ui.item.name);
                    $('[place="jabatan11"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete12').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama12" ]').val(ui.item.name);
                    $('[place="jabatan12"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete13').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama13" ]').val(ui.item.name);
                    $('[place="jabatan13"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete14').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama14" ]').val(ui.item.name);
                    $('[place="jabatan14"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete15').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama15" ]').val(ui.item.name);
                    $('[place="jabatan15"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete16').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama16" ]').val(ui.item.name);
                    $('[place="jabatan16"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete17').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama17" ]').val(ui.item.name);
                    $('[place="jabatan17"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete18').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama18" ]').val(ui.item.name);
                    $('[place="jabatan18"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete19').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama19" ]').val(ui.item.name);
                    $('[place="jabatan19"]').val(ui.item.jabatan);
                }
            });
            $('.autocomplete20').autocomplete({
                source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
                select: function(event, ui) {
                    $('[place="nama20" ]').val(ui.item.name);
                    $('[place="jabatan20"]').val(ui.item.jabatan);
                }
            });
        });
    });
    $(document).on('click', '#minus', function() {
        var myobj = document.getElementById("remove");
        myobj.remove();
    });

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
    // var dateToday = new Date();
    $(function() {
        $("#periode_penugasan").datepicker({
            dateFormat: 'dd M yy'
        });
        $("#periode_penugasan1").datepicker({
            dateFormat: 'dd M yy'
        });
    });
</script>