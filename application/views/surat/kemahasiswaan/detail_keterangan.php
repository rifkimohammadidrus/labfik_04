<main class="akun-container">

    <?php foreach ($surat as $s) : ?>
        <div class="fik-section-title2">
            <span class="fas fa-door-open zzzz"></span>
            <h5>Detail Surat Keterangan <?= $s->type_surat ?></h5>
        </div>
        <div>
            <input style="display: none;" name="idSurat" id="idSurat" value="<?= $s->id; ?>">
        </div>
        <div class="form-group">
            <div>
                <h5>Data Mahasiswa</h5>
                <hr>
                <table class="table table-hover">
                    <tr>
                        <th>Surat Keterangan</th>
                        <td><?= $s->type_surat ?></td>
                    </tr>
                    <tr>
                        <th>Nomor Surat</th>
                        <td><?= $s->no_surat ?></td>
                    </tr>
                    <tr>
                        <th>Nim</th>
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
                        <th>Alamat</th>
                        <td><?= $s->mhs_alamat ?>,
                            <?= $namaKelurahan[$s->kel]; ?>,
                            <?= $namaKecamatan[$s->kec]; ?>,
                            <?= $namaKota[$s->kota]; ?>,
                            <?= $namaProvinsi[$s->prov]; ?></td>
                    </tr>
                    <?php if ($s->instansi) : ?>
                        <tr>
                            <th>Instansi</th>
                            <td><?= $s->instansi ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th>
                            <br>
                            <h5>Eviden Surat</h5>
                            <hr>
                        </th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>KTM</th>
                        <td><a data-toggle="modal" data-target="#detailKtm"> <?= $s->ktm ?></td>
                    </tr>
                    <tr>
                        <th>Transkrip</th>
                        <td><a data-toggle="modal" data-target="#detailTranskrip"> <?= $s->transkrip ?></td>
                    </tr>
                    <tr>
                        <th>Iklan/Broadcast</th>
                        <td><a data-toggle="modal" data-target="#detailIklan"> <?= $s->iklan ?></td>
                    </tr>
                    <!-- <tr>
                        <th>Catatan Revisi</th>
                    </tr> -->

                </table>
            </div>
        </div>
    <?php endforeach; ?>
</main>

<?php foreach ($surat as $s) : ?>
    <style>
        #active:focus {
            color: #fb8c00
        }
    </style>
    <div class="modal fade" id="detailKtm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">KTM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <embed src="<?= base_url('/assets/kmhs/')  . $s->ktm ?>" frameborder="0" width="100%" height="400px">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detailTranskrip" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Transkrip</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <embed src="<?= base_url('/assets/kmhs/')  . $s->transkrip ?>" frameborder="0" width="100%" height="400px">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detailIklan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Iklan/Broadcast</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <embed src="<?= base_url('/assets/kmhs/')  . $s->iklan ?>" frameborder="0" width="100%" height="400px">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>