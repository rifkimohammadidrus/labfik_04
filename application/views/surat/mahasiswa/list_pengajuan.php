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
                    <th scope="col">Jenis Surat</th>
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
                        <td data-toggle="modal" data-target="#detail<?= $srt->id; ?>"><?= $mhs[$srt->id_mhs]->nim ?></td>
                        <td data-toggle="modal" data-target="#detail<?= $srt->id; ?>"><?= $mhs[$srt->id_mhs]->name ?></td>
                        <td data-toggle="modal" data-target="#detail<?= $srt->id; ?>"><?= $mhs[$srt->id_mhs]->prodi ?></td>
                        <td data-toggle="modal" data-target="#detail<?= $srt->id; ?>"><?= $srt->type_surat ?></td>
                        <?php
                        $statSurat = $srt->stat; ?>
                        <!-- reject -->
                        <?php if ($statSurat == '3') { ?>
                            <td data-toggle="modal" data-target="#detail<?= $srt->id; ?>" style="color:#DC143C; font-weight:bold;"><?= $status[($srt->stat) - 1]->status ?></td>
                            <!--status approve  -->
                        <?php } else if ($statSurat == '2') { ?>
                            <td data-toggle="modal" data-target="#detail<?= $srt->id; ?>" style="color:#228B22;font-weight:bold;"><?= $status[($srt->stat) - 1]->status ?></td>
                            <!-- status lain -->
                        <?php } else { ?>
                            <td data-toggle="modal" data-target="#detail<?= $srt->id; ?>"><?= $status[($srt->stat) - 1]->status ?></td>
                        <?php }; ?>

                        <!-- reject -->
                        <?php if ($srt->stat == '3' or $srt->stat == '8' or $srt->stat == '12') : ?>
                            <td>
                                <form action="<?= base_url() ?>mahasiswa/editSuratKmhs" method="POST" enctype="multipart/form-data">
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
                                    <table class="table table-hover">
                                        <tr>
                                            <th>NIM</th>
                                            <td><?= $mhs[$s->id_mhs]->nim ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td><?= $mhs[$s->id_mhs]->name ?></td>
                                        </tr>
                                        <tr>
                                            <th>Prodi</th>
                                            <td><?= $mhs[$s->id_mhs]->prodi ?></td>
                                        </tr>
                                        <tr>
                                            <th>IPK</th>
                                            <td>
                                                <?= $s->ipk ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>KTM</th>
                                            <td><?= $s->ktm ?></td>
                                        </tr>
                                        <tr>
                                            <th>Transkrip</th>
                                            <td><?= $s->transkrip ?></td>
                                        </tr>
                                        <tr>
                                            <th>Iklan/Broadcast</th>
                                            <td><?= $s->iklan ?></td>
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