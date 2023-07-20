<main class="akun-container">
    <div class="fik-section-title2">
        <span class="fas fa-door-open zzzz"></span>
        <h5>Revisi Surat Rekomendasi</h5>
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('massage') ?>
        <?= form_open_multipart('mahasiswa/editSuratKmhs'); ?>
        <div class="custom-form">
            <?php
            $no = 1;
            foreach ($surat as $srt) :
                //get indikator field yang butuh direvisi
                $statSurat =  $srt->stat;
                if ($statSurat == '1' or $statSurat == '2' or $statSurat == '7' or $statSurat == '11') {
                    $statField = array(
                        'nim' => 'readonly',
                        'nama' => 'readonly',
                        'prodi' => 'readonly',
                        'ipk' => 'readonly',
                        'ktm' => 'readonly',
                        'transkrip' => 'readonly',
                        'iklan' => 'readonly',
                    );

                    echo "<h6 style='color:red; margin-top:-20px; center;'>Data pada surat yang sudah diterima tidak bisa diubah.  </h6>";
                } else if ($statSurat == '1') {
                    $statField = array(
                        'nim' => '',
                        'nama' => '',
                        'prodi' => '',
                        'ipk' => '',
                        'ktm' => '',
                        'transkrip' => '',
                        'iklan' => '',
                    );
                    echo "Ubah Data Pengajuan sebelum diperiksa LAA";
                } else if ($statSurat == '3' or $statSurat == '8' or $statSurat == '12') {
                    $srt->field_revisi = str_replace('0', "readonly", $srt->field_revisi);
                    $srt->field_revisi = str_replace('1', "", $srt->field_revisi);
                    $arrRev = explode(',', $srt->field_revisi);
                    // print_r($arrRev);
                    $statField = array(
                        'nim' => $arrRev[0],
                        'nama' => $arrRev[1],
                        'prodi' => $arrRev[2],
                        'ipk' => $arrRev[3],
                        'ktm' => $arrRev[4],
                        'transkrip' => $arrRev[5],
                        'iklan' => $arrRev[6],
                    );
                    echo "<h6>Catatan Revisi : </h6>";
                };
            ?>
                <label style="color: red; font-size:medium;"><?= $srt->ctt_revisi ?></label>
                <hr>
                <div class="form-group" style="margin-bottom:12px">
                    <input type="hidden" name="idSurat" id="idSurat" value="<?= set_value('idSurat'); ?>">
                    <input type="hidden" name="keterangan" id="keterangan" value="Hasil Revisi <?php echo $user['name']; ?>">
                    <input type="hidden" name="statSurat" id="statSurat" value="<?= $srt->stat ?>">
                    <input type="hidden" name="instansi" id="instansi" value="<?= $srt->instansi ?>">
                    <input type="hidden" name="penilaian" id="penilaian" value="<?= $srt->penilaian ?>">
                    <input type="hidden" name="nilaiDosenWali" id="nilaiDosenWali" value="<?= $srt->keterangan ?>">
                    <input type="hidden" name="ctt_rekomendasi" id="ctt_rekomendasi" value="<?= $srt->ctt_rekomendasi ?>">
                    <input type="hidden" name="jenis_surat" class="form-control custom-form-control" id="jenis_surat" value="Rekomendasi">
                </div>
                <br>
                <h5>Data Mahasiswa</h5>
                <hr><br>
                <div class="form-group" style="margin-bottom:12px">
                    <input readonly style="background-color:#E8F0FE;" type="text" name="tipe_surat" class="form-control custom-form-control" id="tipe_surat" value="<?= $srt->type_surat ?>">
                    <label style="background-color:#E8F0FE;border-radius:3px;">Jenis Beasiswa</label>
                </div>

                <?php $revStat = $statField['nim'];
                if ($revStat == 'readonly') { ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <input readonly style="background-color:#E8F0FE;" type="text" name="nim" class="form-control custom-form-control" id="nim" value="<?= $mhs[$srt->id_mhs]->nim ?>">
                        <label style="background-color:#E8F0FE;border-radius:3px;">NIM</label>
                    </div>
                <?php } else { ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <input type="text" name="nim" class="form-control custom-form-control" id="nim" value="<?= $mhs[$srt->id_mhs]->nim ?>">
                        <label>NIM</label>
                    </div>
                <?php } ?>
                <?php $revStat = $statField['nama'];
                if ($revStat == 'readonly') { ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <input readonly style="background-color:#E8F0FE;" type="text" name="nama" class="form-control custom-form-control" id="nama" value="<?= $mhs[$srt->id_mhs]->name ?>">
                        <label style="background-color:#E8F0FE;border-radius:3px;">Nama</label>
                    </div>
                <?php } else { ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <input type="text" name="nama" class="form-control custom-form-control" id="nama" value="<?= $mhs[$srt->id_mhs]->name ?>">
                        <label>Nama</label>
                    </div>
                <?php } ?>
                <?php $revStat = $statField['prodi'];
                if ($revStat == 'readonly') { ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <input readonly style="background-color:#E8F0FE;" type="text" name="prodi" class="form-control custom-form-control" id="prodi" value="<?= $mhs[$srt->id_mhs]->prodi ?>">
                        <label style="background-color:#E8F0FE;border-radius:3px;">Prodi</label>
                    </div>
                <?php } else { ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <input type="text" name="prodi" class="form-control custom-form-control" id="prodi" value="<?= $mhs[$srt->id_mhs]->prodi ?>">
                        <label>Prodi</label>
                    </div>
                <?php } ?>




                <div class="custom-form">
                    <?php $revStat = $statField['ipk'];
                    if ($revStat == 'readonly') { ?>
                        <div class="form-group" style="margin-bottom:12px">
                            <input readonly style="background-color:#E8F0FE;" type="text" name="ipk" class="form-control custom-form-control" id="ipk" value="<?= $srt->ipk ?>">
                            <label style="background-color:#E8F0FE;border-radius:3px;">IPK</label>
                        </div>
                    <?php } else { ?>
                        <div class="form-group" style="margin-bottom:12px">
                            <input type="text" name="ipk" class="form-control custom-form-control" id="ipk" value="<?= $srt->ipk ?>">
                            <label>IPK</label>
                        </div>
                    <?php } ?>
                    <h5 style="margin-bottom:12;">Eviden</h5>
                    <hr><br>
                    <?php $revStat = $statField['ktm'];
                    if ($revStat == 'readonly') { ?>
                        <div class="form-group" style="margin-bottom:12px">
                            <input readonly style="background-color:#E8F0FE;" type="text" name="ktm" class="form-control custom-form-control" id="ktm" value="<?= $srt->ktm ?>">
                            <label style="background-color:#E8F0FE;border-radius:3px;">KTM</label>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class=" col">
                                <label for="ktm" style="margin-left:12px;"><b>KTM</b></label>
                                <input type="file" name="ktm" id="ktm" class="form-control" style="padding:13px 16px" value=" <?= base_url('/assets/kmhs/')  . $srt->ktm ?>"><span></span>
                                <span id="chk-error"></span>
                            </div>
                            <div class=" col" style="padding:13px 16px">
                                <a href="<?= base_url('/assets/ktm/')  .  $srt->ktm ?> "> <?= $srt->ktm ?></a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php $revStat = $statField['transkrip'];
                    if ($revStat == 'readonly') { ?>
                        <div class="form-group" style="margin-bottom:12px">
                            <input readonly style="background-color:#E8F0FE;" type="text" name="transkrip" class="form-control custom-form-control" id="transkrip" value="<?= $srt->transkrip ?>">
                            <label style="background-color:#E8F0FE;border-radius:3px;">Transkrip</label>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class=" col">
                                <label for="transkrip" style="margin-left:12px;"><b>Transkrip</b></label>
                                <input type="file" name="transkrip" id="transkrip" class="form-control" style="padding:13px 16px" value=" <?= base_url('/assets/kmhs/')  . $srt->transkrip ?>"><span></span>
                                <span id="chk-error"></span>
                            </div>
                            <div class=" col" style="padding:13px 16px">
                                <a href="<?= base_url('/assets/kmhs/')  .  $srt->transkrip ?> "> <?= $srt->transkrip ?></a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php $revStat = $statField['iklan'] ?>
                    <?php if ($revStat == 'readonly') { ?>
                        <div class="custom-form">
                            <div class="form-group" style="margin-bottom:12px">
                                <input readonly style="background-color:#E8F0FE;" type="text" name="iklan" class="form-control custom-form-control" id="iklan" value="<?= $srt->iklan ?>">
                                <label style="background-color:#E8F0FE;border-radius:3px;">iklan</label>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class=" col">
                                <label for="iklan" style="margin-left:12px;"><b>Iklan</b></label>
                                <input type="file" name="iklan" id="iklan" class="form-control" style="padding:13px 16px" value=" <?= base_url('/assets/kmhs/')  . $srt->iklan ?>"><span></span>
                                <span id="chk-error"></span>
                            </div>
                            <div class=" col" style="padding:13px 16px">
                                <a href="<?= base_url('/assets/iklan/')  .  $srt->iklan ?> "> <?= $srt->iklan ?></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="editSurat" class="btn btn-primary btn-pill btn-sm" id="editsurat">Kirim Permintaan</button>
                </div>
            <?php endforeach; ?>
            </form>
        </div>
</main>
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
        jQuery("#tipe_surat").change(function() {
            var value = jQuery(this).val();
            if (value == "Lainnya") {
                jQuery("#surat_lainnya").hide()
                jQuery("#penilaian").hide()
                $("#surat_lainnya").show();
            } else if (value == 'Kemendikbud Ristek') {
                jQuery("#surat_lainnya").hide()
                jQuery("#penilaian").hide()
                $("#penilaian").show();
            }
        });
    });
</script>