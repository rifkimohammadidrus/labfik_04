<main class="akun-container">
    <!-- script custom dialog -->
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

    <!-- Search -->
    <form id="form_search" autocomplete="off" action="<?= base_url() ?>user/search" method="POST" enctype="multipart/form-data" style="border-left:1px solid rgba(0,0,0,.1);">
        <div class="input-group">
            <div class="input-group-append">
                <select style="text-align: left;" class="btn btn-primary dropdown-toggle" name="sortPencarian" id="sortPencarian" type="button" aria-haspopup="true" aria-expanded="false">
                    <option style="text-indent: -9999px;font-size: 0px;" disabled selected value=""> Filter </option>
                    <option value=""> Semua </option>
                    <option value="nama_kegiatan"> Nama Kegiatan </option>
                    <option value="no_ememo"> No E-Memo </option>
                    <option value="periode_penugasan"> Periode Penugasan </option>
                    <option value="status_surat_tugas.status"> Status </option>
                </select>
                <input style="display: none;" type="submit" name="submit" value="Search">
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
    <?= $this->session->flashdata('massage');
    unset($_SESSION['massage']); ?>
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kegiatan</th>
                    <th scope="col">No E-Memo</th>
                    <th scope="col">Periode Penugasan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <?php
            $no = $this->uri->segment('3') + 1;
            foreach ($surat as $srt) : ?>
                <style>
                    tbody.sorotan:hover {
                        cursor: pointer;
                        background-color: orange;
                    }
                </style>
                <tbody class="sorotan " title="Detail Surat">
                    <tr>
                        <th data-toggle="modal" data-target="#detail<?= $srt->id; ?>" scope="row"><?= $no++ ?></th>
                        <td data-toggle="modal" data-target="#detail<?= $srt->id; ?>"><?= $srt->nama_kegiatan ?></td>
                        <td data-toggle="modal" data-target="#detail<?= $srt->id; ?>"><?= $srt->no_ememo ?></td>
                        <td data-toggle="modal" data-target="#detail<?= $srt->id; ?>"><?= $srt->periode_penugasan ?></td>
                        <?php
                        $statSurat = $srt->stat; ?>
                        <!-- reject -->
                        <?php if ($statSurat == '3' or $statSurat == '6' or $statSurat == '9') { ?>
                            <td data-toggle="modal" data-target="#detail<?= $srt->id; ?>" style="color:#DC143C; font-weight:bold;"><?= $status[($srt->stat) - 1]->status ?></td>
                            <!--status approve  -->
                        <?php } else if ($statSurat == '2' or $statSurat == '5' or $statSurat == '8') { ?>
                            <td data-toggle="modal" data-target="#detail<?= $srt->id; ?>" style="color:#228B22;font-weight:bold;"><?= $status[($srt->stat) - 1]->status ?></td>
                            <!-- status lain -->
                        <?php } else { ?>
                            <td data-toggle="modal" data-target="#detail<?= $srt->id; ?>"><?= $status[($srt->stat) - 1]->status ?></td>
                        <?php }; ?>

                        <!-- reject -->
                        <?php if ($srt->stat == '3' or $srt->stat == '6' or $srt->stat == '9') : ?>
                            <td>
                                <form action="<?= base_url() ?>user/editSurat" method="POST" enctype="multipart/form-data">
                                    <input style="display: none;" name="idSurat" id="idSurat" value="<?= $srt->id; ?>">
                                    <button type="submit" name="edittSurat" value="editSurat" class="badge badge-primary text-light" id="editSurat" style="width: 50px;margin-top:2px;">Revisi</button>
                                </form>
                            </td>
                        <?php else : ?>
                            <td>
                                <a type="submit" name="edittSurat" value="editSurat" class="badge badge-primary text-light" id="editSurat" style="width: 50px;opacity: 0.4;margin-top:2px;" disable>Revisi</a>

                            </td>
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
<?php foreach ($surat as $s) : ?>
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
                            <h5 style="text-align: center;">Detail Permintaan Surat</h5><br>
                            <div>
                                <input style="display: none;" name="idSurat" id="idSurat" value="<?= $s->id; ?>">
                            </div>
                            <div class="form-group">
                                <div>
                                    <?php $arrID = explode(",", $s->dosen_id);  ?>
                                    <?php $getDivisi = explode(",", $s->divisi);  ?>
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
                                                    <div><?= $dosen[$id]->nip ?>-<?= $dosen[$id]->name ?></div>
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
                                            $nomor = 1;  ?>
                                            <td><?php foreach ($getEviden as $e) : ?>
                                                    <div><?= $nomor++ ?>. &nbsp;<a href="<?= base_url('/assets/eviden/')  . $e ?> " target="_blank"> <?= $e ?></a></div>
                                                <?php endforeach; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <td><?= $s->ctt_revisi ?></td>
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

<?php endforeach; ?>