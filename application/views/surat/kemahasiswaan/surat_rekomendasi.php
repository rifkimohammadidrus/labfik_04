<main class="akun-container">
    <div class="fik-section-title2">
        <span class="fas fa-door-open zzzz"></span>
        <h5>Daftar Pengajuan Surat </h5>
    </div>

    <!-- Search -->
    <form id="form_search" autocomplete="off" action="<?= base_url('kemahasiswaan/search') ?>" method="POST" enctype="multipart/form-data" style="border-left:1px solid rgba(0,0,0,.1);">
        <div class="input-group">
            <div class="input-group-append">
                <select style="text-align: left;" class="btn btn-primary dropdown-toggle" name="sortPencarian" id="sortPencarian" type="button" aria-haspopup="true" aria-expanded="false">
                    <option style="text-indent: -9999px;font-size: 0px;" disabled selected value=""> Filter </option>
                    <option value=""> Semua </option>
                    <option value="nim"> Nim </option>
                    <option value="name"> Nama </option>
                    <option value="prodi"> Prodi </option>
                    <option value="type_surat"> Jenis Beasiswa </option>
                    <option value="status"> Status </option>
                </select>
                <input style="display: none;" type="submit" name="submitPencarian" value="Search">
            </div>
            <input style="display: none;" name="jenis_surat" id="jenis_surat" value="Rekomendasi">
            <input type="text" name="keywordPencarian" id="keywordPencarian" class="form-control" aria-label="Text input with dropdown button" placeholder="Pencarian" value="<?= set_value('keywordPencarian'); ?>">
        </div>
    </form>
    <br>
    <style>
        option {
            padding: 30px;
            background-color: white;
            color: black;
        }
    </style>
    <?= $this->session->flashdata('massage');
    unset($_SESSION['massage']); ?>
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nim</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">Jenis Beasiswa</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>

            <?php
            $roleID = $user['role_id'];
            if ($roleID == '12') {
                $rowColor = array(
                    '1' => '#DCDCDC',
                    '2' => '', '3' => '',
                    '4' => '#DCDCDC',
                    '5' => '', '6' => '',
                    '7' => '', '8' => '', '9' => '', '10' => '', '11' => '', '12' => '', '13' => '',
                );
            } elseif ($roleID == '3') {
                $rowColor = array(
                    '1' => '#DCDCDC',
                    '2' => '', '3' => '',
                    '4' => '',
                    '5' => '', '6' => '',
                    '7' => '', '8' => '', '9' => '', '10' => '', '11' => '', '12' => '', '13' => '',
                );
            } elseif ($roleID == '13') {
                $rowColor = array(
                    '1' => '',
                    '2' => '', '3' => '',
                    '4' => '',
                    '5' => '', '6' => '',
                    '7' => '', '8' => '', '9' => '#DCDCDC', '10' => '#DCDCDC', '11' => '',
                    '12' => '', '13' => '',
                );
            } elseif ($roleID == '14') {
                $rowColor = array(
                    '1' => '',
                    '2' => '', '3' => '',
                    '4' => '',
                    '5' => '', '6' => '#DCDCDC',
                    '7' => '', '8' => '', '9' => '', '10' => '', '11' => '',
                    '12' => '', '13' => '#DCDCDC',
                );
            };
            $no = $this->uri->segment('3') + 1;
            foreach ($surat as $srt) : ?>
                <style>
                    tbody.sorotan:hover {
                        cursor: pointer;
                        /* background-color: orange; */
                    }

                    .sorotan:hover {
                        cursor: pointer;
                        background-color: orange;
                    }

                    table tr td a {
                        display: block;
                        height: 100%;
                        width: 100%;
                    }

                    a:active {
                        color: black;
                    }

                    a:hover {
                        color: black;
                    }

                    table tr td {
                        padding-left: 0;
                        padding-right: 0;
                    }
                </style>
                <tbody class="sorotan " title="Detail Surat">
                    <tr bgcolor="<?= $rowColor[$srt->stat]; ?>">
                        <td>
                            <a href="<?= base_url('kemahasiswaan/detailSurat/' . encrypt_url($srt->id) . ""); ?>"><?= $no++ ?></a>
                        </td>
                        <td>
                            <a href="<?= base_url('kemahasiswaan/detailSurat/' . encrypt_url($srt->id) . ""); ?>"><?= $mhs[$srt->id_mhs]->nim ?></a>
                        </td>
                        <td>
                            <a href="<?= base_url('kemahasiswaan/detailSurat/' . encrypt_url($srt->id) . ""); ?>"><?= $mhs[$srt->id_mhs]->name ?></a>
                        </td>
                        <td>
                            <a href="<?= base_url('kemahasiswaan/detailSurat/' . encrypt_url($srt->id) . ""); ?>"><?= $mhs[$srt->id_mhs]->prodi ?></a>
                        </td>
                        <td>
                            <a href="<?= base_url('kemahasiswaan/detailSurat/' . encrypt_url($srt->id) . ""); ?>"><?= $srt->type_surat ?></a>
                        </td>
                        <td>
                            <a href="<?= base_url('kemahasiswaan/detailSurat/' . encrypt_url($srt->id) . ""); ?>"><?= $status[($srt->stat) - 1]->status  ?></a>
                        </td>

                        <?php if ($roleID == 12) : ?>
                            <?php if ($srt->stat == '1' or $srt->stat == '4' or $srt->stat == '5') : ?>
                                <td>
                                    <a style="margin-bottom:2px;width: 45px;" class="badge badge-success text-light" data-toggle="modal" data-target="#detailAcc<?= $srt->id; ?>">
                                        ACC
                                    </a><br>
                                    <a class="badge badge-danger text-light" style="width: 45px;" data-toggle="modal" data-target="#detailReject<?= $srt->id; ?>">
                                        Tolak
                                    </a><br>
                                    <a class="badge badge-info text-light" style="margin-top:2px;width: 65px;" data-toggle="modal" data-target="#detailLanjut<?= $srt->id; ?>">
                                        Teruskan
                                    </a>
                                </td>
                            <?php elseif ($srt->stat == '2') : ?>
                                <td>
                                    <a class="badge badge-warning text-light" style="width: 45px;" href="<?= base_url('kemahasiswaan/printSurat/' . encrypt_url($srt->id) . ""); ?>">Print</a><br>
                                    <a style="margin-top:2px;width: 45px;" class="badge badge-secondary text-light" data-toggle="modal" data-target="#detailReset<?= $srt->id; ?>">
                                        Reset
                                    </a>
                                </td>
                            <?php elseif ($srt->stat == '7' or $srt->stat == '11') : ?>
                                <td>
                                    <a class="badge badge-warning text-light" style="width: 45px;" href="<?= base_url('kemahasiswaan/printSurat/' . encrypt_url($srt->id) . ""); ?>">Print</a>
                                </td>
                            <?php elseif ($srt->stat == '3' or $srt->stat == '6' or $srt->stat == '10') : ?>
                                <td>
                                    <button type="submit" class="badge badge-primary text-light" style="margin-bottom:2px;width: 45px;opacity: 0.4;" disabled>ACC</button><br>
                                    <button type="submit" class="badge badge-danger text-light" style="margin-bottom:2px;width: 45px;opacity: 0.4;" disabled>Tolak</button>
                                    <br>
                                    <a style="margin-bottom:2px;width: 45px;" class="badge badge-secondary text-light" data-toggle="modal" data-target="#detailReset<?= $srt->id; ?>">
                                        Reset
                                    </a>
                                </td>

                            <?php endif; ?>
                        <?php elseif ($roleID == 3) : ?>
                            <?php if ($srt->stat == '1') : ?>
                                <td>
                                    <a style="margin-bottom:2px;width: 95px;" class="badge badge-primary text-light" data-toggle="modal" data-target="#detailPenilaian<?= $srt->id; ?>">
                                        Beri Penilaian
                                    </a>
                                </td>
                            <?php elseif ($srt->stat == '5') : ?>
                                <td>
                                    <button type="submit" style="margin-bottom:2px;opacity: 0.4;width: 95px;" class="badge badge-primary text-light" disabled>
                                        Beri Penilaian
                                    </button><br>
                                    <a style="margin-top:2px;width: 45px;" class="badge badge-secondary text-light" data-toggle="modal" data-target="#detailReset<?= $srt->id; ?>">
                                        Reset
                                    </a>
                                </td>
                            <?php endif; ?>
                        <?php elseif ($roleID == 13) : ?>
                            <?php if ($srt->stat == '10' or $srt->stat == '13') : ?>
                                <td>
                                    <a style="margin-bottom:2px;width: 45px;" class="badge badge-success text-light" data-toggle="modal" data-target="#detailAcc<?= $srt->id; ?>">
                                        ACC
                                    </a><br>
                                    <a class="badge badge-danger text-light" style="width: 45px;" data-toggle="modal" data-target="#detailReject<?= $srt->id; ?>">
                                        Tolak
                                    </a>
                                </td>
                            <?php elseif ($srt->stat == '11' or $srt->stat == '12') : ?>
                                <td>
                                    <button type="submit" class="badge badge-primary text-light" style="margin-bottom:2px;width: 45px;opacity: 0.4;" disabled>ACC</button><br>
                                    <button type="submit" class="badge badge-danger text-light" style="margin-bottom:2px;width: 45px;opacity: 0.4;" disabled>Tolak</button>
                                    <br>
                                    <a style="margin-top:2px;width: 45px;" class="badge badge-secondary text-light" data-toggle="modal" data-target="#detailReset<?= $srt->id; ?>">
                                        Reset
                                    </a>

                                </td>
                            <?php endif; ?>
                        <?php elseif ($roleID == 14) : ?>
                            <?php if ($srt->stat == '6' or $srt->stat == '9') : ?>
                                <td>
                                    <a style="margin-bottom:2px;width: 45px;" class="badge badge-success text-light" data-toggle="modal" data-target="#detailAcc<?= $srt->id; ?>">
                                        ACC
                                    </a><br>
                                    <a class="badge badge-danger text-light" style="width: 45px;" data-toggle="modal" data-target="#detailReject<?= $srt->id; ?>">
                                        Tolak
                                    </a>
                                </td>
                            <?php elseif ($srt->stat == '7' or $srt->stat == '8') : ?>
                                <td>
                                    <button type="submit" class="badge badge-primary text-light" style="margin-bottom:2px;width: 45px;opacity: 0.4;" disabled>ACC</button><br>
                                    <button type="submit" class="badge badge-danger text-light" style="margin-bottom:2px;width: 45px;opacity: 0.4;" disabled>Tolak</button>
                                    <br>
                                    <a style="width: 45px;" class="badge badge-secondary text-light" data-toggle="modal" data-target="#detailReset<?= $srt->id; ?>">
                                        Reset
                                    </a>
                                </td>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tr>
                </tbody>

            <?php endforeach; ?>
        </table>
    </div>
    <?php if (empty($surat)) : ?>
        <p style="text-align: center;">Surat Tidak Ditemukan</p>
    <?php endif ?>
    <?php
    echo $this->pagination->create_links();
    ?>
</main>

<!-- Dialog ACC -->
<?php foreach ($surat as $s) : ?>
    <style>
        #active:focus {
            color: #fb8c00
        }
    </style>
    <div class="modal fade" id="detailAcc<?= $s->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Terima</h5>
                </div>
                <form action="<?= base_url() ?>kemahasiswaan/action" method="POST" enctype="multipart/form-data">
                    <div class="custom-form">
                        <div class="modal-body">
                            <div>
                                <input type="hidden" name="idSurat" id="idSurat" value="<?= $s->id; ?>">
                                <input type="hidden" name="status" id="status" value="<?= $s->stat; ?>">
                                <input type="hidden" name="nilai" id="nilai" value="<?= $s->keterangan; ?>">
                                <input type="hidden" name="catatan" id="catatan" value="<?= $s->ctt_rekomendasi; ?>">
                                <input type="hidden" name="tipeSurat" id="tipeSurat" value="<?= $s->jenis_surat; ?>">
                                <input type="hidden" name="nama_instansi" id="nama_instansi" value="<?= $s->nama_instansi; ?>">
                                <input type="hidden" name="alamat_instansi" id="alamat_instansi" value="<?= $s->alamat_instansi; ?>">
                                <input type="hidden" name="no_tlp" id="no_tlp" value="<?= $s->no_tlp; ?>">
                                <input type="hidden" name="email" id="email" value="<?= $s->email; ?>">
                                <input type="hidden" name="keterangan" id="keterangan" value="Surat diterima <?= $user['name']; ?>">
                                <p> Apakah anda yakin Terima permintaan surat ini?</p>
                                <?php if ($roleID == 12) : ?>
                                    <div class="form-group" style="margin-top: 12px;">
                                        <input type="text" name="noSurat" id="noSurat" class="form-control custom-form-control" required="required" autocomplete="off" value="<?= set_value('noSurat'); ?>"><label>Nomor Surat</label>
                                    </div>
                                    <?php if ($s->type_surat == 'LPDP' or $s->type_surat == 'Kemendikbud Ristek') : ?>
                                        <div class="form-group" style="margin-top: 12px;">
                                            <input type="text" name="nama_instansi" id="nama_instansi" class="form-control custom-form-control" autocomplete="off" value="<?= set_value('nama_instansi'); ?>"><label>Instansi</label>
                                        </div>
                                        <div class="form-group" style="margin-top: 12px;">
                                            <input type="text" name="alamat_instansi" id="alamat_instansi" class="form-control custom-form-control" autocomplete="off" value="Jl. Telekomunikasi, Terusan Buah Batu Bandung 40257 "><label>Alamat</label>
                                        </div>
                                        <div class="form-group" style="margin-top: 12px;">
                                            <input type="text" name="no_tlp" id="no_tlp" class="form-control custom-form-control" autocomplete="off" value="<?= set_value('no_tlp'); ?>"><label>Telpon</label>
                                        </div>
                                        <div class="form-group" style="margin-top: 12px;">
                                            <input type="text" name="email" id="email" class="form-control custom-form-control" autocomplete="off" value="<?= set_value('email'); ?>"><label> Email</label>
                                        </div>
                                    <?php endif; ?>
                                <?php elseif ($roleID == 13 or $roleID == 14) : ?>
                                    <input type="hidden" name="noSurat" id="noSurat" value="<?= $s->no_surat; ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-pill btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="action" value="Accept" class="btn btn-primary btn-pill btn-sm">Terima Permintaan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endforeach; ?>

<!-- DIalog Tolak -->
<?php foreach ($surat as $s) : ?>
    <style>
        #active:focus {
            color: #fb8c00
        }
    </style>
    <script type="text/javascript">
        tinymce.init({
            selector: '#keterangan<?= $s->id; ?>',
            themes: 'simple',
            height: 200,
            keyhint: 'keterangan'
        });


        var boxes = $('.checkRevisi');
        boxes.on('change', function() {
            $('#confirmRejectSurat').prop('disabled', boxes.filter(':checked').length < 1);
            $('#confirmAcceptSurat').prop('disabled', boxes.filter(':checked').length);
        }).trigger('change');
    </script>
    <div class="modal fade" id="detailReject<?= $s->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="<?= base_url() ?>kemahasiswaan/action" method="POST" enctype="multipart/form-data">

                    <div class="custom-form">
                        <div class="modal-body">
                            <div>
                                <input type="hidden" name="idSurat" id="idSurat" value="<?= $s->id; ?>"></input>
                                <input type="hidden" name="status" id="status" value="<?= $s->stat; ?>">
                                <input type="hidden" name="nilai" id="nilai" value="<?= $s->keterangan; ?>">
                                <input type="hidden" name="catatan" id="catatan" value="<?= $s->ctt_rekomendasi; ?>">
                                <input type="hidden" name="tipeSurat" id="tipeSurat" value="<?= $s->jenis_surat; ?>">
                                <input type="hidden" name="nama_instansi" id="nama_instansi" value="<?= $s->nama_instansi; ?>">
                                <input type="hidden" name="alamat_instansi" id="alamat_instansi" value="<?= $s->alamat_instansi; ?>">
                                <input type="hidden" name="no_tlp" id="no_tlp" value="<?= $s->no_tlp; ?>">
                                <input type="hidden" name="email" id="email" value="<?= $s->email; ?>">
                                <input type="hidden" name="noSurat" id="noSurat" value="<?= $s->no_surat; ?>">
                            </div>
                            <div class="form-group">
                                <div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col" style="font-size:17px;">Data</th>
                                                <th scope="col" style="font-size:17px;">Revisi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Nim</th>
                                                <td><?= $mhs[$s->id_mhs]->nim ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[0]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[0]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <td><?= $mhs[$s->id_mhs]->name ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[1]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[1]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Prodi</th>
                                                <td><?= $mhs[$s->id_mhs]->prodi ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[2]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[2]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>IPK</th>
                                                <td><?= $s->ipk ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[3]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[3]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>KTM</th>
                                                <td><?= $s->ktm ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[4]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[4]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Transkrip</th>
                                                <td><?= $s->transkrip ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[5]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[5]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Iklan/Broadcast</th>
                                                <td><?= $s->iklan ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[6]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[6]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Catatan Revisi</th>
                                            </tr>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <textarea class=" keterangan" id="keterangan<?= $s->id; ?>" name="keterangan" value="<?= set_value('keterangan'); ?>" required="">
                                    </textarea><small class="form-text text-danger"><?= form_error('keterangan'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="action" value="Reject" class="btn btn-secondary btn-pill btn-sm" id="confirmRejectSurat">Tolak Permintaan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endforeach; ?>


<!-- Dialog Reset -->
<?php foreach ($surat as $s) : ?>
    <style>
        #active:focus {
            color: #fb8c00
        }
    </style>
    <div class="modal fade" id="detailReset<?= $s->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Reset</h5>
                </div>
                <form action="<?= base_url() ?>kemahasiswaan/action" method="POST" enctype="multipart/form-data">
                    <div class="custom-form">
                        <div class="modal-body">
                            <div>
                                <input type="hidden" name="idSurat" id="idSurat" value="<?= $s->id; ?>">
                                <input type="hidden" name="nilai" id="nilai" value="<?= $s->keterangan; ?>">
                                <input type="hidden" name="catatan" id="catatan" value="<?= $s->ctt_rekomendasi; ?>">
                                <input type="hidden" name="tipeSurat" id="tipeSurat" value="<?= $s->jenis_surat; ?>">
                                <input type="hidden" name="nama_instansi" id="nama_instansi" value="<?= $s->nama_instansi; ?>">
                                <input type="hidden" name="alamat_instansi" id="alamat_instansi" value="<?= $s->alamat_instansi; ?>">
                                <input type="hidden" name="no_tlp" id="no_tlp" value="<?= $s->no_tlp; ?>">
                                <input type="hidden" name="email" id="email" value="<?= $s->email; ?>">
                                <input type="hidden" name="keterangan" id="keterangan" value="Surat diReset <?= $user['name']; ?>">
                                <input type="hidden" name="noSurat" id="noSurat" value="<?= $s->no_surat; ?>">
                            </div>
                            <p> Apakah anda yakin Reset permintaan surat ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-pill btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="action" value="Reset" class="btn btn-primary btn-pill btn-sm">Reset Permintaan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endforeach; ?>

<!-- Dialog Teruskan -->
<?php foreach ($surat as $lanjut) : ?>
    <style>
        #active:focus {
            color: #fb8c00
        }
    </style>
    <div class="modal fade" id="detailLanjut<?= $lanjut->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Meneruskan Surat</h5>
                </div>
                <form action="<?= base_url() ?>kemahasiswaan/action" method="POST" enctype="multipart/form-data">
                    <div class="custom-form">
                        <div class="modal-body">
                            <div>
                                <input type="hidden" name="idSurat" id="idSurat" value="<?= $lanjut->id; ?>">
                                <input type="hidden" name="nilai" id="nilai" value="<?= $lanjut->keterangan; ?>">
                                <input type="hidden" name="catatan" id="catatan" value="<?= $lanjut->ctt_rekomendasi; ?>">
                                <input style="display: none;" name="tipeSurat" id="tipeSurat" value="<?= $lanjut->jenis_surat; ?>">
                                <input style="display: none;" name="keterangan" id="keterangan" value="Surat diteruskan">
                                <p> Apakah anda yakin Meneruskan surat ini?</p>
                                <br>
                                <div class="form-group has-select">
                                    <select class="form-control" name="teruskanSurat" id="teruskanSurat" required>
                                        <option style="text-indent: -9999px;font-size: 0px;" disabled selected value="">Teruskan Ke-</option>
                                        <option value="Wadek">Wakil Dekan II </option>
                                        <option value="Dekan">Dekan </option>
                                    </select>
                                </div>
                                <div class="form-group" style="margin-top: 12px;">
                                    <input type="text" name="noSurat" id="noSurat" class="form-control custom-form-control" required="required" autocomplete="off" value="<?= set_value('noSurat'); ?>"><label>Nomor Surat</label>
                                </div>
                                <div class="form-group" style="margin-top: 12px;">
                                    <input type="text" name="nama_instansi" id="nama_instansi" class="form-control custom-form-control" required="required" autocomplete="off" value="<?= set_value('nama_instansi'); ?>"><label>Instansi</label>
                                </div>
                                <div class="form-group" style="margin-top: 12px;">
                                    <input type="text" name="alamat_instansi" id="alamat_instansi" class="form-control custom-form-control" required="required" autocomplete="off" value="<?= set_value('alamat_instansi'); ?>"><label>Alamat</label>
                                </div>
                                <div class="form-group" style="margin-top: 12px;">
                                    <input type="text" name="no_tlp" id="no_tlp" class="form-control custom-form-control" required="required" autocomplete="off" value="<?= set_value('no_tlp'); ?>"><label>Telpon</label>
                                </div>
                                <div class="form-group" style="margin-top: 12px;">
                                    <input type="text" name="email" id="email" class="form-control custom-form-control" required="required" autocomplete="off" value="<?= set_value('email'); ?>"><label> Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-pill btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" id="teruskanWadek" name="action" value="LanjutSurat" class="btn btn-primary btn-pill btn-sm">Teruskan</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endforeach; ?>

<!-- Dialog penilaian -->
<?php foreach ($surat as $s) : ?>
    <script>
        $('input[type="checkbox"]').on('change', function() {
            $(this).siblings('input[type="checkbox"]').prop('checked', false);
        });
    </script>
    <style>
        #active:focus {
            color: #fb8c00
        }
    </style>
    <script type="text/javascript">
        tinymce.init({
            selector: '#catatan<?= $s->id; ?>',
            themes: 'simple',
            height: 200,
            keyhint: 'catatan'
        });
    </script>
    <div class="modal fade" id="detailPenilaian<?= $s->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Detail Penilaian</h5>
                </div>
                <?php if ($roleID == 3) : ?>
                    <form action="<?= base_url() ?>kemahasiswaan/action" method="POST" enctype="multipart/form-data">
                        <div class="custom-form">
                            <div class="modal-body">
                                <div>
                                    <input type="hidden" name="idSurat" id="idSurat" value="<?= $s->id; ?>">
                                    <input style="display: none;" name="keterangan" id="keterangan" value="Surat Dinilai Dosen Wali">
                                    <input style="display: none;" name="tipeSurat" id="tipeSurat" value="<?= $lanjut->jenis_surat; ?>">
                                    <?php if ($s->penilaian) : ?>
                                        <table class="table table-hover">
                                            <p style="margin-left: 12cm;"><b> Kurang &nbsp;&nbsp;&nbsp;Cukup &nbsp;&nbsp;&nbsp;Baik &nbsp;&nbsp;&nbsp;Sangat Baik </b></p>
                                            <hr><br>
                                            <tr>
                                                <?php $getPenilaian = explode(",", $s->penilaian); ?>

                                                <?php foreach ($getPenilaian as $p) : ?>
                                                    <div style="margin-bottom: 20px;"> <b><?= $p ?></b>
                                                        <div style="margin-left: 470px; margin-top:-15px;">
                                                            <input style="margin-left: 8px;" class="checkNilai" type="checkbox" name="checkNilai[]" value="Kurang" />
                                                            <input style="margin-left: 40px;" class="checkNilai" type="checkbox" name="checkNilai[]" value="Cukup" />
                                                            <input style="margin-left: 40px;" class="checkNilai" type="checkbox" name="checkNilai[]" value="Baik" />
                                                            <input style="margin-left: 40px;" class="checkNilai" type="checkbox" name="checkNilai[]" value="Sangat Baik" />
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </tr>
                                        </table>
                                    <?php endif ?>
                                </div>
                                <b>Alasan Memberikan Rekomendasi:</b>
                                <div class="form-group">
                                    <textarea class="catatan" id="catatan<?= $s->id; ?>" name="catatan" value="<?= set_value('catatan'); ?>" required="">
                                </textarea><small class="form-text text-danger"><?= form_error('catatan'); ?></small>
                                </div>
                                <b>Ketentuan Pengisian:</b>
                                <p>1. Seberapa dekat dengan pelamar</p>
                                <p>2. Prestasi yang telah dicapai pelamar beserta aktivitasnya;</p>
                                <p>3. Alasan Memberikan rekomendasi;</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-pill btn-sm" data-dismiss="modal">Batal</button>
                                <button type="submit" name="action" value="Nilai" class="btn btn-primary btn-pill btn-sm">Kirim</button>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>