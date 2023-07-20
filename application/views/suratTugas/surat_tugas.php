<main class="akun-container">
    <script type="text/javascript">
        $(document).on("click", ".open-suratDialog", function() {
            var suratId = $(this).data('id');
            $('.modal-body #idSurat').val(suratId);
        });
    </script>
    <div class="fik-section-title2">
        <span class="fas fa-door-open zzzz"></span>
        <h5>Daftar Pengajuan Surat </h5>
    </div>
    <form id="form_search" autocomplete="off" action="<?= base_url('suratTugas/search') ?>" method="POST" enctype="multipart/form-data" style="border-left:1px solid rgba(0,0,0,.1);">
        <div class="input-group">
            <div class="input-group-append">
                <select style="text-align: left;" class="btn btn-primary dropdown-toggle" name="sortPencarian" id="sortPencarian" type="button" aria-haspopup="true" aria-expanded="false">
                    <option style="text-indent: -9999px;font-size: 0px;text-align: left;" disabled selected value=""> Filter </option>
                    <option value=""> Semua </option>
                    <option value="nama_kegiatan"> Nama Kegiatan </option>
                    <option value="no_ememo"> No E-Memo </option>
                    <option value="periode_penugasan"> Periode Penugasan </option>
                    <option value="status_surat_tugas.status"> Status </option>
                </select>
                <input style="display: none;" type="submit" name="submit">
                <!-- <input style="display: none;" type="submit" name="submit" value="Search"> -->
            </div>
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

    <!-- End Search -->
    <?= $this->session->flashdata('massage');
    unset($_SESSION['massage']); ?>
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th><b style="margin-left:12px">No</b> </th>
                    <th><b style="margin-left:17px">Nama Kegiatan</b> </th>
                    <th><b style="margin-left:17px">No E-Memo</b> </th>
                    <th><b style="margin-left:17px;">Periode </b> <b style="margin-left:17px;">Penugasan</b> </th>
                    <th><b style="margin-left:17px">Status</b> </th>
                    <th>Aksi </th>
                </tr>
            </thead>

            <?php
            $roleID = $user['role_id'];
            if ($roleID == '9') {
                $rowColor = array(
                    '1' => '#DCDCDC',
                    '2' => '', '3' => '',
                    '4' => '#DCDCDC',
                    '5' => '', '6' => '',
                    '7' => '', '8' => '', '9' => '', '10' => '', '11' => '',
                );
            } else if ($roleID == '10') {
                $rowColor = array(
                    '1' => '#DCDCDC',
                    '2' => '', '3' => '', '4' => '', '5' => '', '6' => '',
                    '7' => '#DCDCDC',
                    '8' => '', '9' => '', '10' => '', '11' => '',
                );
            } else if ($roleID == '11') {
                $rowColor = array(
                    '1' => '',
                    '2' => '#DCDCDC',
                    '3' => '', '4' => '',
                    '5' => '#DCDCDC',
                    '6' => '', '7' => '',
                    '8' => '', '9' => '',
                    '10' => '#DCDCDC',
                    '11' => '',
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
                </style>
                <tbody class="sorotan " title="Detail Surat">
                    <tr bgcolor="<?= $rowColor[$srt->stat]; ?>">
                        <th>
                            <form action="<?= base_url(); ?>suratTugas/detail" method="POST" enctype="multipart/form-data">
                                <input style="display: none;" name="idSurat" id="idSurat" value="<?= $srt->id; ?>">
                                <button type="submit" name="detailSurat" id="detailSurat" class=" sorotan btn"><b style="font-size: 12px; text-align: left;"><?= $srt->id ?></b></button>
                            </form>
                        </th>
                        <td>
                            <form action="<?= base_url(); ?>suratTugas/detail" method="POST" enctype="multipart/form-data">
                                <input style="display: none;" name="idSurat" id="idSurat" value="<?= $srt->id; ?>">
                                <button type="submit" name="detailSurat" id="detailSurat" class="sorotan btn" style="width: 250px; ">
                                    <p style="font-size: 12px; text-align: left;"><?= $srt->nama_kegiatan ?></p>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="<?= base_url(); ?>suratTugas/detail" method="POST" enctype="multipart/form-data">
                                <input style="display: none;" name="idSurat" id="idSurat" value="<?= $srt->id; ?>">
                                <button type="submit" name="detailSurat" id="detailSurat" class="sorotan btn">
                                    <p style="font-size: 12px; text-align: left;"><?= $srt->no_ememo ?></p>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="<?= base_url(); ?>suratTugas/detail" method="POST" enctype="multipart/form-data">
                                <input style="display: none;" name="idSurat" id="idSurat" value="<?= $srt->id; ?>">
                                <button type="submit" name="detailSurat" id="detailSurat" class="sorotan btn">
                                    <p style="font-size: 12px; text-align: left;"><?= $srt->periode_penugasan ?></p>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="<?= base_url(); ?>suratTugas/detail" method="POST" enctype="multipart/form-data">
                                <input style="display: none;" name="idSurat" id="idSurat" value="<?= $srt->id; ?>">
                                <button type="submit" name="detailSurat" id="detailSurat" class="sorotan btn">
                                    <p style="font-size: 12px; text-align: left;"><?= $status[($srt->stat) - 1]->status ?></p>
                                </button>
                            </form>
                        </td>

                        <?php if ($roleID == 9 or $roleID == 10) : ?>
                            <?php if ($srt->stat == '1' or $srt->stat == '4' or $srt->stat == '7') : ?>
                                <td>
                                    <a style="margin-bottom:2px;width: 45px;" class="badge badge-success text-light" data-toggle="modal" data-target="#detailAcc<?= $srt->id; ?>">
                                        ACC
                                    </a><br>
                                    <a class="badge badge-danger text-light" style="width: 45px;" data-toggle="modal" data-target="#detailReject<?= $srt->id; ?>">
                                        Tolak
                                    </a>
                                </td>
                            <?php elseif ($srt->stat == '2' or $srt->stat == '3' or $srt->stat == '5' or $srt->stat == '6') : ?>
                                <td>
                                    <a class="badge badge-secondary text-light" style="width: 45px;" data-toggle="modal" data-target="#detailReset<?= $srt->id; ?>">
                                        Reset
                                    </a>
                                </td>
                            <?php endif; ?>
                        <?php elseif ($roleID == 11) : ?>
                            <?php if ($srt->stat == '2' or $srt->stat == '5' or $srt->stat == '10') : ?>
                                <td>
                                    <a style="margin-bottom:2px;width: 45px;" class="badge badge-success text-light" data-toggle="modal" data-target="#detailAcc<?= $srt->id; ?>">
                                        ACC
                                    </a><br>
                                    <a class="badge badge-danger text-light" style="width: 45px;" data-toggle="modal" data-target="#detailReject<?= $srt->id; ?>">
                                        Tolak
                                    </a>
                                </td>
                            <?php elseif ($srt->stat == '8') : ?>
                                <td>
                                    <a style="margin-bottom:2px" class="badge badge-secondary text-light" data-toggle="modal" data-target="#detailReset<?= $srt->id; ?>">
                                        Reset
                                    </a>
                                    <?php if ($srt->jenis_penugasan == 'Kepanitiaan') : ?>
                                        <form action="<?= base_url(); ?>suratTugas/printSurat" method="POST" enctype="multipart/form-data">
                                            <input style="display: none;" name="idSurat" id="idSurat" value="<?= $srt->id; ?>">
                                            <button type="submit" name="printSurat" value="printSuratKelompok" class="badge badge-primary text-light " id="printSurat" style="width: 45px;">Print</button>
                                        </form>
                                    <?php else : ?>
                                        <form action="<?= base_url(); ?>suratTugas/printSurat" method="POST" enctype="multipart/form-data">
                                            <input style="display: none;" name="idSurat" id="idSurat" value="<?= $srt->id; ?>">
                                            <button type="submit" name="printSurat" value="printSuratPerorangan" class="badge badge-primary text-light " id="printSurat" style="width: 45px;">Print</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            <?php elseif ($srt->stat == '9') : ?>
                                <td>
                                    <a style="margin-bottom:2px" class="badge badge-secondary text-light" data-toggle="modal" data-target="#detailReset<?= $srt->id; ?>">
                                        Reset
                                    </a>

                                </td>
                            <?php elseif ($srt->stat == '11') : ?>
                                <td>
                                    <?php if ($srt->jenis_penugasan == 'Kepanitiaan') : ?>
                                        <form action="<?= base_url(); ?>suratTugas/printSurat" method="POST" enctype="multipart/form-data">
                                            <input style="display: none;" name="idSurat" id="idSurat" value="<?= $srt->id; ?>">
                                            <button type="submit" name="printSurat" value="printSuratKelompok" class="badge badge-primary text-light " id="printSurat" style="width: 45px;">Print</button>
                                        </form>
                                    <?php else : ?>
                                        <form action="<?= base_url(); ?>suratTugas/printSurat" method="POST" enctype="multipart/form-data">
                                            <input style="display: none;" name="idSurat" id="idSurat" value="<?= $srt->id; ?>">
                                            <button type="submit" name="printSurat" value="printSuratPerorangan" class="badge badge-primary text-light " id="printSurat" style="width: 45px;">Print</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tr>
                </tbody>

            <?php endforeach; ?>
        </table>
    </div>
    <?php if ($jumlahSurat == 0) : ?>
        <p style="text-align: center;">Surat Tidak Ditemukan</p>
    <?php endif ?>
    <?php
    echo $this->pagination->create_links();
    ?>
    <!-- end of hasil -->
</main>
<!-- Dialog Detail-->
<!-- <?php foreach ($surat as $s) : ?>
    <style>
        #active:focus {
            color: #fb8c00
        }
    </style>
    <div class="modal fade" id="detail<?= $s->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <form action="<?= base_url() ?>user/input_eviden" method="POST" enctype="multipart/form-data">
                    <div class="custom-form">
                        <div class="modal-body">
                            <div>
                                <input style="display: none;" name="idSurat" id="idSurat" value="<?= $s->id; ?>">
                            </div>
                            <h4 style="text-align: center;">Detail Permintaan Surat</h4>
                            <div class="form-group">
                                <div>
                                    <?php $arrID = explode(",", $s->dosen_id);  ?>
                                    <?php $getDivisi = explode(",", $s->divisi);
                                    $no = 0;
                                    ?>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Nama Kegiatan</th>
                                            <td><?= $s->nama_kegiatan ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal kegiatan</th>
                                            <td><?= $s->tanggal_kegiatan ?></td>
                                        </tr>
                                        <tr>
                                            <th>No E-Memo</th>
                                            <td><?= $s->no_ememo ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Dosen</th>
                                            <td>
                                                <?php foreach ($arrID as $id) : ?>
                                                    <div><?= $dosen[$id]->nip ?>-<?= $dosen[$id]->name ?>-<?= $getDivisi[$no++] ?></div>
                                                <?php endforeach; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Penugasan</th>
                                            <td><?= $s->jenis_penugasan ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tempat Kegiatan</th>
                                            <td><?= $s->tempat_kegiatan ?></td>
                                        </tr>
                                        <tr>
                                            <th>Periode Penugasan</th>
                                            <td><?= $s->periode_penugasan ?></td>
                                        </tr>
                                        <tr>
                                            <th>Penyelenggara</th>
                                            <td><?= $s->penyelenggara ?></td>
                                        </tr>
                                        <tr>
                                            <th>Eviden</th>
                                            <?php $getEviden = explode(",", $s->eviden);
                                            ?>
                                            <td><?php foreach ($getEviden as $e) : ?>

                                                    <div><a href="<?= base_url('/assets/eviden/')  . $e ?> " target="_blank"> <?= $e ?></a></div>
                                                <?php endforeach; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endforeach; ?> -->


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
                <form action="<?= base_url() ?>suratTugas/action" method="POST" enctype="multipart/form-data">
                    <div class="custom-form">
                        <div class="modal-body">
                            <div>
                                <input type="text" name="idSurat" id="idSurat" value="<?= $s->id; ?>">
                                <input style="display: none;" name="keterangan" id="keterangan" value="Surat diterima <?= $user['name']; ?>">
                                <p> Apakah anda yakin Terima permintaan surat ini?</p>
                                <?php if ($roleID == 11) : ?>
                                    <div class="form-group" style="margin-top: 12px;">
                                        <input type="text" name="noSurat" id="noSurat" class="form-control custom-form-control" required="required" autocomplete="off" value="<?= set_value('noSurat'); ?>"><label>Nomor Surat</label>
                                    </div>
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
                <form action="<?= base_url() ?>suratTugas/action" method="POST" enctype="multipart/form-data">

                    <div class="custom-form">
                        <div class="modal-body">
                            <div>
                                <input style="display: none;" name="idSurat" id="idSurat" value="<?= $s->id; ?>"></input>
                                <input style="display: none;" name="noSurat" id="noSurat" value="<?= $s->no_surat; ?>">
                            </div>
                            <div class="form-group">
                                <div>
                                    <?php $arrID = explode(",", $s->dosen_id);  ?>
                                    <?php $getEviden = explode(",", $s->eviden);  ?>

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
                                                <th>Nama Kegiatan</th>
                                                <td><?= $s->nama_kegiatan ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[0]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[0]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal kegiatan</th>
                                                <td><?= $s->tanggal_kegiatan ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[1]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[1]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>No E-Memo</th>
                                                <td><?= $s->no_ememo ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[2]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[2]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Nama Dosen</th>
                                                <td>
                                                    <?php foreach ($arrID as $id) : ?>
                                                        <div><?= $dosen[$id]->nip ?>-<?= $dosen[$id]->name ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[3]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[3]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Penugasan</th>
                                                <td><?= $s->jenis_penugasan ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[4]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[4]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tempat Kegiatan</th>
                                                <td><?= $s->tempat_kegiatan ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[5]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[5]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Periode Penugasan</th>
                                                <td><?= $s->periode_penugasan ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[6]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[6]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Penyelenggara</th>
                                                <td><?= $s->penyelenggara ?></td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[7]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[7]" value="1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Eviden</th>
                                                <td><?php foreach ($getEviden as $e) : ?>
                                                        <div><a href="<?= base_url('/assets/eviden/')  . $e ?> " target="_blank"> <?= $e ?></a></div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td style="text-align:center">
                                                    <input class="checkRevisi" type="hidden" name="check[8]" value="0" />
                                                    <input class="checkRevisi" type="checkbox" name="check[8]" value="1" />
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
                <form action="<?= base_url() ?>suratTugas/action" method="POST" enctype="multipart/form-data">
                    <div class="custom-form">
                        <div class="modal-body">
                            <div>
                                <input style="display: none;" name="idSurat" id="idSurat" value="<?= $s->id; ?>">
                                <input style="display: none;" name="keterangan" id="keterangan" value="Surat diReset <?= $user['name']; ?>">
                                <input style="display: none;" name="noSurat" id="noSurat" value="<?= $s->no_surat; ?>">
                                <input type="hidden" name="user_id" id="user_id" value="<?= $s->user_id; ?>">
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