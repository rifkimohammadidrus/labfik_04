<main class="akun-container">
    <div class="fik-section-title2">
        <span class="fas fa-door-open zzzz"></span>
        <h5>Kirim Ulang Surat Tugas</h5>
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
                if ($statSurat == '2' or $statSurat == '5' or $statSurat == '8') {
                    $statField = array(
                        'nim' => 'readonly',
                        'nama' => 'readonly',
                        'prodi' => 'readonly',
                        'mhs_smt' => 'readonly',
                        'mhs_alamat' => 'readonly',
                        'instansi' => 'readonly',
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
                        'mhs_smt' => '',
                        'mhs_alamat' => '',
                        'instansi' => '',
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
                        'mhs_smt' => $arrRev[3],
                        'mhs_alamat' => $arrRev[4],
                        'instansi' => $arrRev[5],
                        'ktm' => $arrRev[6],
                        'transkrip' => $arrRev[7],
                        'iklan' => $arrRev[8],
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
                    <input type="hidden" name="jenis_surat" class="form-control custom-form-control" id="jenis_surat" value="Keterangan">
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
                <div class="form-group has-select">
                    <?php $revisiStat = $statField['mhs_smt'];
                    if ($revisiStat == 'readonly') : ?>
                        <input style="display: none;" name="mhs_smt" id="mhs_smt" value="<?= $srt->mhs_smt ?>">
                        <select style="background-color: #d2e1fc;" class="form-control" name="mhs_smt" id="mhs_smt" disabled>
                        <?php else : ?>
                            <select class="form-control" name="mhs_smt" id="mhs_smt">
                            <?php endif; ?>
                            <?php foreach ($semester as $smt) : ?>
                                <?php if ($smt == $mhs[$srt->mhs_id]->mhs_smt) : ?>
                                    <option value="<?= $smt; ?>" selected><?= $smt; ?></option>
                                <?php else : ?>
                                    <option value="<?= $smt; ?>"><?= $smt; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                </div>
                <?php $revStat = $statField['mhs_alamat'];
                if ($revStat == 'readonly') { ?>
                    <div class="form-group" style="margin-bottom:12px">
                        <div class="row">
                            <div class="col-md-8">
                                <textarea readonly style="background-color:#E8F0FE;" type="text" name="alamat" class="form-control custom-form-control" id="alamat"><?= $srt->mhs_alamat ?></textarea>
                                <label style=" margin-left: 16px;background-color:#E8F0FE;border-radius:3px;">Alamat </label>
                            </div>
                            <div class="col">
                                <input readonly style="background-color:#E8F0FE;" type="text" name="rt" class="form-control col-md-10" id="rt" value="<?= $srt->rt ?>"> <label style="margin-left: 16px;background-color:#E8F0FE;border-radius:3px;">RT</label>
                            </div>
                            <div class="col">
                                <input readonly style="background-color:#E8F0FE;" type="text" name="rw" class="form-control col-md-10" id="rw" value="<?= $srt->rw ?>"><label style="margin-left: 16px;background-color:#E8F0FE;border-radius:3px;">RW</label>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>

                    <div class="form-group" style="margin-bottom:12px">
                        <div class="row">
                            <div class="col-md-8">
                                <textarea type="text" name="alamat" class="form-control custom-form-control" id="alamat" value="<?= $srt->mhs_alamat ?>"><?= $srt->mhs_alamat ?></textarea>
                                <label style="margin-left: 16px;">Alamat </label>
                            </div>
                            <div class="col">
                                <input type="text" name="rt" class="form-control col-md-10" id="rt" value="<?= $srt->rt ?>"> <label style="margin-left: 16px;">RT</label>
                            </div>
                            <div class="col">
                                <input type="text" name="rw" class="form-control col-md-10" id="rw" value="<?= $srt->rw ?>"><label style="margin-left: 16px;">RW</label>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- START OF ALAMAT MHS FORM -->
                <?php $revStat = $statField['mhs_alamat'];
                if ($revStat == 'readonly') { ?>
                    <input style="display: none;" name="provinsi" id="provinsi" value="<?= $srt->prov ?>"></input>
                    <input style="display: none;" name="kota" id="kota" value="<?= $srt->kota ?>"></input>
                    <input style="display: none;" name="kec" id="kec" value="<?= $srt->kec ?>"></input>
                    <input style="display: none;" name="kel" id="kel" value="<?= $srt->kel ?>"></input>
                <?php } else { ?>
                    <div class="form-group" style="margin-bottom:12px" <?php echo $statField['mhs_alamat'] ?>>
                        <div class="row">
                            <div class="col">
                                <select class="form-control custom-form-control" name="provinsi" id="provinsi" value="<?= set_value('provinsi'); ?>" onchange="ajaxkota(this.value)" <?php echo $statField['mhs_alamat'] ?>>
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
                <?php } ?>
                <div class="custom-form">
                    <?php if ($srt->instansi) : ?>
                        <?php $revStat = $statField['instansi'];
                        if ($revStat == 'readonly') { ?>
                            <div class="form-group" style="margin-bottom:12px">
                                <input readonly style="background-color:#E8F0FE;" type="text" name="instansi" class="form-control custom-form-control" id="instansi" value="<?= $srt->instansi ?>">
                                <label style="background-color:#E8F0FE;border-radius:3px;">Instansi</label>
                            </div>
                        <?php } else { ?>
                            <div class="form-group" style="margin-bottom:12px">
                                <input type="text" name="instansi" class="form-control custom-form-control" id="instansi" value="<?= $srt->instansi ?>">
                                <label>Instansi</label>
                            </div>
                        <?php } ?>
                    <?php endif; ?>
                    <h5 style="margin-bottom:12;">Eviden</h5>
                    <hr><br>
                    <?php $revStat = $statField['ktm'];
                    if ($revStat == 'readonly') { ?>
                        <div class="form-group" style="margin-bottom:12px">
                            <input readonly style="background-color:#E8F0FE;" type="text" name="ktm" class="form-control custom-form-control" id="ktm" value="<?= $srt->ktm ?>">
                            <label style="background-color:#E8F0FE;border-radius:3px;">KTM</label>
                        </div>
                    <?php } else { ?>
                        <div class="custom-form">
                            <div class="form-group" style="margin-bottom:12;">
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
                        <div class="custom-form">
                            <div class="form-group" style="margin-bottom:12;">
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
                        <div class="custom-form">
                            <div class="form-group" style="margin-bottom:12;">
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