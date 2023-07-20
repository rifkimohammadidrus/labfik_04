<main class="akun-container">

    <div class="fik-section-title2">
        <span class="fas fa-door-open zzzz"></span>
        <h5>Detail Surat </h5>
    </div>

    <!-- Dialog Detail-->
    <?php foreach ($surat as $s) : ?>

        <div>
            <input style="display: none;" name="idSurat" id="idSurat" value="<?= $s->id; ?>">
        </div>
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
                        $no = 1;
                        $i = 1; ?>
                        <td><?php foreach ($getEviden as $e) : ?>
                                <div><a data-toggle="modal" data-target="#detailSurat<?= $no++ ?>"> <?= $e ?></a></div>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
</main>

<?php foreach ($surat as $s) : ?>
    <?php $getEviden = explode(",", $s->eviden); ?>
    <?php foreach ($getEviden as $e) : ?>
        <style>
            #active:focus {
                color: #fb8c00
            }
        </style>
        <div class="modal fade" id="detailSurat<?= $i++ ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Eviden</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <embed src="<?= base_url('/assets/eviden/')  . $e ?>" frameborder="0" width="100%" height="400px">
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
<?php endforeach; ?>