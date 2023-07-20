<main class="akun-container">
    <div class="fik-section-title2">
        <span class="fas fa-door-open zzzz"></span>
        <h5>Kirim Ulang Surat Tugas</h5>
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('massage') ?>
        <?= form_open_multipart('user/editSurat'); ?>
        <div class="custom-form">
            <?php
            $no = 1;
            foreach ($surat as $srt) :
                //get indikator field yang butuh direvisi
                $statSurat =  $srt->stat;
                if ($statSurat == '2' or $statSurat == '5' or $statSurat == '8') {
                    $statField = array(
                        'nama_kegiatan' => 'readonly', //0
                        'tanggal_kegiatan' => 'readonly', //1
                        'no_ememo' => 'readonly', //2
                        'dosen_id' => 'readonly', //3
                        'jenis_penugasan' => 'readonly', //4
                        'tempat_kegiatan' => 'readonly', //5
                        'periode_penugasan' => 'readonly', //6
                        'penyelenggara' => 'readonly', //7
                        'eviden' => 'readonly', //8
                        // 'undangan' => 'readonly', //9
                        // 'bukti_kegiatan' => 'readonly', //10
                        // 'poster_kegiatan' => 'readonly', //11
                    );

                    echo "<h6 style='color:red; margin-top:-20px; center;'>Data pada surat yang sudah diterima tidak bisa diubah.  </h6>";
                } else if ($statSurat == '1') {
                    $statField = array(
                        'nama_kegiatan' => '',
                        'tanggal_kegiatan' => '',
                        'no_ememo' => '',
                        'dosen_id' => '',
                        'jenis_penugasan' => '',
                        'tempat_kegiatan' => '',
                        'periode_penugasan' => '',
                        'penyelenggara' => '',
                        'eviden' => '',
                        // 'undangan' => '',
                        // 'bukti_kegiatan' => '',
                        // 'poster_kegiatan' => '',
                    );
                    echo "Ubah Data Pengajuan sebelum diperiksa LAA";
                } else if ($statSurat == '3' or $statSurat == '6' or $statSurat == '9') {
                    $srt->field_revisi = str_replace('0', "readonly", $srt->field_revisi);
                    $srt->field_revisi = str_replace('1', "", $srt->field_revisi);
                    $arrRev = explode(',', $srt->field_revisi);
                    // print_r($arrRev);
                    $statField = array(
                        'nama_kegiatan' => $arrRev[0],
                        'tanggal_kegiatan' => $arrRev[1],
                        'no_ememo' => $arrRev[2],
                        'dosen_id' => $arrRev[3],
                        'jenis_penugasan' => $arrRev[4],
                        'tempat_kegiatan' => $arrRev[5],
                        'periode_penugasan' => $arrRev[6],
                        'penyelenggara' => $arrRev[7],
                        'eviden' => $arrRev[8],
                        // 'undangan' => $arrRev[9],
                        // 'bukti_kegiatan' => $arrRev[10],
                        // 'poster_kegiatan' => $arrRev[11]
                    );
                    echo "<h6>Catatan Revisi : </h6>";
                };
            ?>
                <label style="color: red; font-size:medium;"><?= $srt->ctt_revisi ?></label>
                <hr>
                <?php $arrID = explode(",", $srt->dosen_id);
                $getDivisi = explode(",", $srt->divisi);
                $no = 0;
                $getEviden = explode(",", $srt->eviden);
                $index = 0;
                ?>
                <div class="form-group" style="margin-bottom:12px">
                    <input type="hidden" name="idSurat" id="idSurat" value="<?= set_value('idSurat'); ?>">
                    <!-- <input type="hidden" name="keterangan" id="keterangan" value="Hasil Revisi <?php echo $user['name']; ?>"> -->
                    <input type="hidden" name="keterangan" id="keterangan" value="Hasil Revisi <?php echo $user['name']; ?>">
                    <input type="hidden" name="user_id" class="form-control custom-form-control" id="user_id" value="<?= $user['id']; ?>">
                    <input type="hidden" name="statSurat" id="statSurat" value="<?= $srt->stat ?>">
                    <input type="hidden" name="nip_kaprodikk" id="nip_kaprodikk" value="<?= $srt->nip_kaprodikk ?>">
                </div>

                <?php $revStat = $statField['nama_kegiatan'];
                if ($revStat == 'readonly') { ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <input readonly style="background-color:#E8F0FE;" type="text" name="nama_kegiatan" class="form-control custom-form-control" id="nama_kegiatan" value="<?= $srt->nama_kegiatan ?>">
                        <label style="background-color:#E8F0FE;border-radius:3px;">Nama Kegiatan</label>
                    </div>
                <?php } else { ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <input type="text" name="nama_kegiatan" class="form-control custom-form-control" id="nama_kegiatan" value="<?= $srt->nama_kegiatan ?>">
                        <label>Nama Kegiatan</label>
                    </div>
                <?php } ?>
                <?php $revStat = $statField['tanggal_kegiatan'];
                if ($revStat == 'readonly') { ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <input readonly style="background-color:#E8F0FE;" type="text" name="tanggal_kegiatan" class="form-control custom-form-control" id="tanggal_kegiatan" value="<?= $srt->tanggal_kegiatan ?>">
                        <label style="background-color:#E8F0FE;border-radius:3px;">Tanggal Kegiatan</label>
                    </div>
                <?php } else { ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <input type="text" name="tanggal_kegiatan" id="datepicker" class="form-control custom-form-control" placeholder=" " value="<?= $srt->tanggal_kegiatan ?>">
                        <label>Tanggal Kegiatan</label>
                    </div>
                <?php } ?>
                <?php $revStat = $statField['no_ememo'];
                if ($revStat == 'readonly') { ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <input readonly style="background-color:#E8F0FE;" type="text" name="no_ememo" class="form-control custom-form-control" id="no_ememo" value="<?= $srt->no_ememo ?>">
                        <label style="background-color:#E8F0FE;border-radius:3px;">Nomor E-memo Pengajuan</label>
                    </div>
                <?php } else { ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <input type="text" name="no_ememo" class="form-control custom-form-control" id="no_ememo" value="<?= $srt->no_ememo ?>">
                        <label>Nomor E-memo Pengajuan</label>
                    </div>
                <?php } ?>


        </div>

        <div class="form-group has-select">

            <?php $revisiStat = $statField['jenis_penugasan']; ?>
            <?php if ($revisiStat == 'readonly') : ?>
                <input style="background-color:#d2e1fc;" type="hidden" name="jenis_penugasan" id="jenis_penugasan" value="<?= $srt->jenis_penugasan ?>">
                <select style="background-color: #d2e1fc;" class="form-control " name="jenis_penugasan" id="jenis_penugasan" disabled>
                <?php else : ?>
                    <select class=" form-control" name="jenis_penugasan" id="jenis_penugasan">
                    <?php endif; ?>
                    <?php foreach ($jenisPenugasan as $jenis) : ?>
                        <?php if ($jenis == $srt->jenis_penugasan) : ?>
                            <option style="color:black" value="<?= $jenis; ?>" selected><?= $jenis; ?></option>
                        <?php else : ?>
                            <option value="<?= $jenis; ?>"><?= $jenis; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </select>


        </div>

        <div class="custom-form">
            <?php $revStat = $statField['tempat_kegiatan'];
                if ($revStat == 'readonly') { ?>
                <div class="form-group" style="margin-bottom:12px">
                    <input readonly style="background-color:#E8F0FE;" type="text" name="tempat_kegiatan" class="form-control custom-form-control" id="tempat_kegiatan" value="<?= $srt->tempat_kegiatan ?>">
                    <label style="background-color:#E8F0FE;border-radius:3px;">Tempat Kegiatan</label>
                </div>
            <?php } else { ?>
                <div class="form-group" style="margin-bottom:12px">
                    <input type="text" name="tempat_kegiatan" class="form-control custom-form-control" id="tempat_kegiatan" value="<?= $srt->tempat_kegiatan ?>">
                    <label>Tempat Kegiatan</label>
                </div>
            <?php } ?>
            <?php $revStat = $statField['periode_penugasan'];
                if ($revStat == 'readonly') { ?>
                <div class="form-group" style="margin-bottom:12px">
                    <input readonly style="background-color:#E8F0FE;" type="text" name="periode_penugasan" class="form-control custom-form-control" id="periode_penugasan" value="<?= $srt->periode_penugasan ?>">
                    <label style="background-color:#E8F0FE;border-radius:3px;">Periode Penugasan</label>
                </div>
            <?php } else { ?>
                <div class="form-group" style="margin-bottom:12px">
                    <input type="text" name="periode_penugasan" class="form-control custom-form-control" id="periode_penugasan" value="<?= $srt->periode_penugasan ?>">
                    <label>Periode Penugasan</label>
                </div>
            <?php } ?>
            <?php $revStat = $statField['penyelenggara'];
                if ($revStat == 'readonly') { ?>
                <div class="form-group" style="margin-bottom:12px">
                    <input readonly style="background-color:#E8F0FE;" type="text" name="penyelenggara" class="form-control custom-form-control" id="penyelenggara" value="<?= $srt->penyelenggara ?>">
                    <label style="background-color:#E8F0FE;border-radius:3px;">Penyelenggara</label>
                </div>
            <?php } else { ?>
                <div class="form-group" style="margin-bottom:12px">
                    <input type="text" name="penyelenggara" class="form-control custom-form-control" id="penyelenggara" value="<?= $srt->penyelenggara ?>">
                    <label>Penyelenggara</label>
                </div>
            <?php } ?>
        </div>
        <div class="custom-form">
            <?php if ($srt->jenis_penugasan == 'Kepanitiaan') : ?>
                <h5 id="kepanitiaan" style="margin-bottom:20px;">Kepanitiaan</h5>
            <?php endif; ?>
            <?php foreach ($arrID as $id) : ?>
                <?php $revisiStat = $statField['dosen_id'];
                    if ($revisiStat == 'readonly') : ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <input readonly type="text" name="nip[]" class="form-control custom-form-control " style="background-color: #E8F0FE;" id="nip" value="<?= $dosen[$id]->nip  ?>" <?= $statField['dosen_id'] ?>><label style="background-color: #E8F0FE; border-radius:3px;">NIP</label>
                    </div>
                    <div class="form-group" style="margin-bottom:12px">
                        <input readonly type="text" name="nama_dosen[]" class="form-control custom-form-control" style="background-color: #E8F0FE;" id="nama_dosen" value="<?= $dosen[$id]->name ?>" <?= $statField['dosen_id'] ?>><label style="background-color: #E8F0FE; border-radius:3px;">Nama</label>
                    </div>
                    <div class="form-group" style="margin-bottom:12px">
                        <input readonly type="text" name="jabatan[]" class="form-control custom-form-control" style="background-color: #E8F0FE; " id="jabatan" value="<?= $dosen[$id]->koordinator ?>" <?= $statField['dosen_id'] ?>><label style="background-color: #E8F0FE; border-radius:3px;">Jabatan</label>
                    </div>
                    <?php if ($srt->jenis_penugasan == 'Kepanitiaan') : ?>
                        <div class="form-group" style="margin-bottom:12px" name="kelompok" id="kelompok">
                            <input readonly type="text" name="divisi[]" id="divisi" class="form-control custom-form-control" style="background-color: #E8F0FE;" placeholder="" value=" <?= $getDivisi[$no++] ?>"><label style="background-color: #E8F0FE; border-radius:3px;">Divisi</label>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <div class="row">
                            <div class="col-md-11">
                                <input type="text" name="nip[]" class="form-control custom-form-control " id="nip" value="<?= $dosen[$id]->nip  ?>"><label style="margin-left: 16px;">NIP</label>
                            </div>
                            <div class="col-md-1">
                                <i id="addBtn" class="fas fa-plus" style="margin-top: 12px;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom:12px">
                        <input type="text" name="nama_dosen[]" class="form-control custom-form-control" id="nama_dosen" value="<?= $dosen[$id]->name ?>"><label>Nama Dosen</label>
                    </div>
                    <div class="form-group" style="margin-bottom:12px">
                        <input type="text" name="jabatan[]" class="form-control custom-form-control" id="jabatan" value="<?= $dosen[$id]->koordinator ?>"><label>Jabatan</label>
                    </div>
                    <div class="form-group" style="margin-bottom:12px" name="kelompok" id="kelompok">
                        <input type="text" name="divisi[]" id="divisi" class="form-control custom-form-control col-md-11" placeholder="" value="<?= $getDivisi[$no++] ?>"><label>Divisi</label>
                    </div>
                    <div id="tbody"></div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <h5 style="margin-bottom:12px" name="kelompok" id="kelompok">Eviden</h5>
        <?php foreach ($getEviden as $eviden) : ?>
            <?php $revStat = $statField['eviden'] ?>
            <?php if ($revStat == 'readonly') { ?>
                <div class="custom-form">
                    <div class="form-group" style="margin-bottom:12px">
                        <input readonly style="background-color:#E8F0FE;" type="text" name="eviden[]" class="form-control custom-form-control" id="eviden" value="<?= $eviden ?>">
                        <label style="background-color:#E8F0FE;border-radius:3px;"><b>Eviden</b></label>
                    </div>
                </div>
            <?php } else { ?>
                <div class="custom-form">
                    <div class="form-group" style="margin-bottom:12;">
                        <div class="row">
                            <div class=" col">
                                <label for="eviden" style="margin-left:12px;"><b>Eviden</b></label>
                                <input type="file" name="eviden[]" id="eviden" class="form-control" style="padding:13px 16px" value=" <?= base_url('/assets/eviden/')  . $eviden ?>"><span></span>
                                <span id="chk-error"></span>
                            </div>
                            <div class=" col" style="padding:13px 16px">
                                <a href="<?= base_url('/assets/eviden/')  .  $eviden ?> "> <?= $eviden ?></a>
                            </div>
                            <div class="col-md-1">
                                <i id="addEviden" class="fas fa-plus" style="margin-top: 12px;"></i>
                            </div>
                        </div>
                    </div>
                    <div id="tambahEviden"></div>
                </div>
            <?php } ?>
        <?php endforeach; ?>

        <div class="modal-footer">
            <button type="submit" name="editSurat" class="btn btn-primary btn-pill btn-sm" id="editsurat">Kirim Permintaan</button>
        </div>
    <?php endforeach; ?>
    </form>
    </div>
</main>
<script src="<?= base_url() . 'assets/js/jquery-3.3.1.js' ?>" type="text/javascript"></script>
<script src="<?= base_url() . 'assets/js/jquery-ui.js' ?>" type="text/javascript"></script>

<script>
    jQuery(function() {
        jQuery("#jenis_penugasan").change(function() {
            var value = jQuery(this).val();
            if (value == "Kepanitiaan") {
                jQuery("#kelompok").hide()
                $("#kelompok").show();
                $("#kepanitiaan").show();
                jQuery("#perorang").hide()
            } else if (value == "Pembicara") {
                jQuery("#perorang").hide()
                jQuery("#kelompok").hide()
                jQuery("#kepanitiaan").hide()
            }
        });
    });
</script>

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
            dateFormat: 'dd-mm-yy'
        });
    });
    //Tambah NIP
    $(document).ready(function() {
        var rowIdx = 0;
        $('#addBtn').on('click', function() {
            $('#tbody').append(`<div id="R${++rowIdx}" >
            <div class="delete-index" id="remove">
                <div class="form-group" style="margin-bottom:12px">
                    <div class="row">
                        <div class="col-md-11">
                            <input type="text" name="nip[]" class="autocomplete${rowIdx} form-control custom-form-control " id="nip"  place="nip${rowIdx}">
                            <label style="margin-left:16px">NIP</label>
                        </div>
                        <div class="col-md-1">
                            <i id ="minus" class="fas fa-trash-alt " style="margin-top: 12px;"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group"  style="margin-bottom:12px">
                    <input type="text" name="nama_dosen[]" id="nama" class=" form-control custom-form-control col-md-11" place="nama${rowIdx}" >
                    <label>Nama</label>
                </div>
                <div class="form-group"  style="margin-bottom:12px">
                    <input type="text" name="jabatan[]" class=" form-control custom-form-control col-md-11" id="jabatan" place="jabatan${rowIdx}">
                    <label>Jabatan</label>
                </div>
                <div class="form-group" style="margin-bottom:12px">
                    <input type="text" name="divisi[]" id="divisi" class="form-control custom-form-control col-md-11"  ><label>Divisi</label>
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
                            <input type="file" name="eviden[]" id="eviden" class="form-control" style="padding:13px 16px" >
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