<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorium FIK</title>
    <style>
        .table {
            font-family: sans-serif;
            font-size: 15px;
            text-align: justify;
        }

        p {
            font-family: sans-serif;
            font-size: 15px;
            text-align: justify;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            margin-bottom: -2px;
            text-align: center;
            page-break-inside: auto;
        }

        .page {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <?php
    $no = 1;
    foreach ($surat as $srt) :
    ?>
        <?php if ($srt->type_surat == 'Kemendikbud Ristek' or $srt->type_surat == 'LPDP') : ?>
        <?php else : ?>
            <div class="fik-section-title2">
                <div class="jumbotron">
                    <div class="logosurat">
                        <img src="<?php echo 'assets/img/logosurat.png'; ?>" style="width:216px;height:73px; margin-left:477px; margin-top:-34px">
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <p style="text-align: center;padding-top: 20px; margin-left: 25%; margin-right: 25%;"><b>SURAT REKOMENDASI<br>
                <?php
                if ($srt->type_surat == 'Kemendikbud Ristek') {
                    echo 'MENGIKUTI PROGRAM BEASISWA UNGGULAN KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI';
                } else if ($srt->type_surat == 'LPDP') {
                    echo 'MENGIKUTI PROGRAM BEASISWA LEMBAGA PENGELOLA DANA PENDIDIKAN';
                }
                ?></b>
        </p>
        <p style="text-align: center;margin-top: -12px;"> Nomor : <?= $srt->no_surat ?></p>
        <div class="container" style="padding-left: 50px;">
            <p style="padding-left: 3px;">Yang bertandatangan di bawah ini :</p>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td style="padding-left: 80px;"></td>
                        <td>: <?= $approver[0]->name ?></td>
                        <!-- <td>: Doddy Friestya Asharsinyo, S.T., M.T</td> -->
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td style="padding-left: 80px;"></td>
                        <td>: <?= $approver[0]->nip ?></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td style="padding-left: 80px;"></td>
                        <td>: <?= $approver[0]->koordinator ?></td>
                    </tr>

                    <?php if ($srt->type_surat == 'LPDP' or $srt->type_surat == 'Kemendikbud Ristek') : ?>
                        <tr>
                            <td>Intansi</td>
                            <td style="padding-left: 80px;"></td>
                            <td>: <?= $srt->nama_instansi ?></td>
                        </tr>
                        <tr>
                            <td>Alamat </td>
                            <td style="padding-left: 80px;"></td>
                            <td>: <?= $srt->alamat_instansi ?></td>
                        </tr>
                        <tr>
                            <td>Telp.</td>
                            <td style="padding-left: 80px;"></td>
                            <td>: <?= $srt->no_tlp ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td style="padding-left: 80px;"></td>
                            <td>: <?= $srt->email ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <p style=" padding-left: 3px;">Memberkan rekomendasi kepada :</p>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td style="padding-left: 40px;"></td>
                        <td>: <?= $mhs[$srt->id_mhs]->name ?></td>
                    </tr>
                    <?php if ($srt->type_surat == 'Kemendikbud Ristek') : ?>
                        <tr>
                            <td>Jabatan</td>
                            <td></td>
                            <td>: Mahasiswa</td>
                        </tr>
                        <tr>
                            <td>Intansi</td>
                            <td style="padding-left: 80px;"></td>
                            <td>: <?= $srt->instansi ?></td>
                        </tr>
                        <?php if ($srt->mhs_alamat) : ?>
                            <tr>
                                <td>Alamat </td>
                                <td></td>
                                <td>: <?= $srt->mhs_alamat ?>, RT/RW.<?= $srt->rt ?>/<?= $srt->rw ?>,
                                    Kel. <?= $namaKelurahan[$srt->kel]; ?>,
                                    Kec. <?= $namaKecamatan[$srt->kec]; ?>,
                                    <?= $namaKota[$srt->kota]; ?>,<br>
                                    <?= $namaProvinsi[$srt->prov]; ?>.

                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php elseif ($srt->type_surat == 'LPDP') : ?>
                        <tr>
                            <td>Intansi</td>
                            <td style="padding-left: 80px;"></td>
                            <td>: <?= $srt->instansi ?></td>
                        </tr>
                        <?php if ($srt->mhs_alamat) : ?>
                            <tr>
                                <td>Alamat </td>
                                <td></td>
                                <td>: <?= $srt->mhs_alamat ?>, RT/RW.<?= $srt->rt ?>/<?= $srt->rw ?>,
                                    Kel. <?= $namaKelurahan[$srt->kel]; ?>,
                                    Kec. <?= $namaKecamatan[$srt->kec]; ?>,
                                    <?= $namaKota[$srt->kota]; ?>,<br>
                                    <?= $namaProvinsi[$srt->prov]; ?>.

                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php else : ?>
                        <tr>
                            <td>Nim</td>
                            <td></td>
                            <td>: <?= $mhs[$srt->id_mhs]->nim ?></td>
                        </tr>
                        <tr>
                            <td>Prodi/Jurusan</td>
                            <td></td>
                            <td>: <?= $mhs[$srt->id_mhs]->prodi ?></td>
                        </tr>
                        <tr>
                            <td>IPK</td>
                            <td></td>
                            <td>: <?= $srt->ipk ?></td>
                        </tr>

                    <?php endif; ?>
                </tbody>
            </table>

            <?php if ($srt->penilaian) : ?>
                <p style=" padding-left: 3px;">Penilaian ternadap calon peserta (isi dengan tanda X):</p>
                <br>
                <?php
                $penilaian = str_replace('"', "", $srt->penilaian);
                $keterangan = str_replace('"', "", $srt->keterangan);

                $arrPenilaian  = explode(",", $penilaian);
                $arrKeterangan  = explode(",", $keterangan);

                $arrNilai = [];


                foreach ($arrKeterangan as $Nilai) {
                    if ($Nilai == 'Sangat Baik') {
                        $mark = ['', '', '', 'X'];
                    } else if ($Nilai == 'Baik') {
                        $mark = ['', '', 'X', ''];
                    } else if ($Nilai == 'Cukup') {
                        $mark = ['', 'X', '', ''];
                    } else if ($Nilai == 'Kurang') {
                        $mark = ['X', '', '', ''];
                    }
                    array_push($arrNilai, $mark);
                }
                // print_r($arrNilai);
                ?>
                <table class="table" style="margin-left: auto;margin-right: auto;" cellspacing="0">
                    <tbody>
                        <tr>
                            <td allign="center" style=" width: 200px;"></td>
                            <td allign="center" style="text-align: center;border: 0.5px solid black; width: 30px;padding: 5px 5px;">Kurang</td>
                            <td allign="center" style="text-align: center;border: 0.5px solid black; width: 30px;padding: 5px 5px;">Cukup</td>
                            <td allign="center" style="text-align: center;border: 0.5px solid black; width: 30px;padding: 5px 5px;">Baik</td>
                            <td allign="center" style="text-align: center;border: 1px solid black; width: 30px;padding: 5px 5px;">Sangat Baik</td>
                        </tr>
                        <?php
                        $no = 0;
                        foreach ($arrPenilaian as $parameter) {
                        ?>
                            <tr>
                                <td style="text-align: left;border: 0.5px solid black; padding: 5px 5px;">
                                    <?php echo  $parameter; ?>
                                </td>
                                <td allign="center" style="text-align: center;border: 0.5px solid black; width: 30px;padding: 5px 5px;">
                                    <?php echo  $arrNilai[$no][0]; ?>
                                </td>
                                <td allign="center" style="text-align: center;border: 0.5px solid black; width: 30px;padding: 5px 5px;">
                                    <?php echo  $arrNilai[$no][1]; ?>
                                </td>
                                <td allign="center" style="text-align: center;border: 0.5px solid black; width: 30px;padding: 5px 5px;">
                                    <?php echo  $arrNilai[$no][2]; ?>
                                </td>
                                <td allign="center" style="text-align: center;border: 0.5px solid black; width: 30px;padding: 5px 5px;">
                                    <?php echo  $arrNilai[$no][3]; ?>
                                </td>
                            <?php
                            $no++;
                        }
                            ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <!-- HAlaman kedua -->

            <?php if ($srt->type_surat == 'Kemendikbud Ristek') : ?>
                <div class="page"></div>
                <p style="padding-left: 3px;" align="justify">Alasan memberikan rekomendasi:</p>
                <table class="table" style="border:1px solid black;">
                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align: left; padding: 5px 5px;">
                                Ketentuan pengisian
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 10px;"></td>
                            <td style="text-align: left; padding: 5px 5px; margin-left: 15px;">
                                1. Seberapa dekat dengan pelamar;
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 10px;"></td>
                            <td style="text-align: left; padding: 5px 5px; margin-left: 15px;">
                                2. Prestasi yang (elah dicapai pelamar beserta aktivitasnya);
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 10px;"></td>
                            <td style="text-align: left; padding: 5px 5px; margin-left: 15px;">
                                3. Alasan memberikan rekomendasi;
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 10px;"></td>
                            <td style="text-align: left; padding: 5px 5px; margin-left: 15px;">
                                4. Boleh menambah lembaran.
                            </td>
                        </tr>
                    </tbody>
                </table><br>
                <table class="table">
                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align: left; padding: 5px 5px;line-height: 1.8;">
                                <?= $srt->ctt_rekomendasi ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p style="padding-left: 3px;" align="justify">Demikian surat rekomendasi ini dibuat dengan sesungguhnya dan tanpa ada paksaan dari pihak manapun serta akan dilaksanakan dengan sebagaimana mestinya.</p>
                <br>
                <p style=" margin-left:370px">Bandung, <?= $tgl ?></p>
                <p style=" margin-left:370px">Hormat Kami,</p><br>
                <img style="width: 100px; margin-left:410px" src="<?= 'assets/img/qrcode/' . $srt->id . '.png' ?>">
                <p style=" margin-top:-20px; margin-left:340px"><b><u><?= $approver[0]->name ?></b></u></p>
                <p style=" margin-top:-20px; margin-left:340px"><b><u><?= $approver[0]->koordinator ?></b></u></p>
            <?php elseif ($srt->type_surat == 'LPDP') : ?>
                <p style="padding-left: 3px;" align="justify">Deskripsi Rekomendasi:</p>
                <table class="table" style="border:1px solid black;">
                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align: left; padding: 5px 5px;">
                                <?= $srt->ctt_rekomendasi ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p style="padding-left: 3px;" align="justify">Demikian surat rekomendasi ini dibuat dengan sebenar-benarnya untuk dapat digunakan sebagaimana mestinya.</p>

                <p style=" margin-left:370px">Bandung, <?= $tgl ?></p>
                <p style=" margin-left:370px">Hormat Kami,</p><br>
                <img style="width: 100px; margin-left:410px" src="<?= 'assets/img/qrcode/' . $srt->id . '.png' ?>">
                <p style=" margin-top:-20px; margin-left:340px"><b><u><?= $approver[0]->name ?></b></u></p>
                <p style=" margin-top:-20px; margin-left:340px"><b><u><?= $approver[0]->koordinator ?></b></u></p>
            <?php else : ?>
                <p>Untuk menjadi kandidat penerima beasiswa <b><?= $srt->type_surat ?></b>. Surat rekomendasi ini diberikan dengan mempertimbangkan kondisi akademik dan non akademik yang bersangkutan selama menjadi mahasiswa program studi <b><?= $mhs[$srt->id_mhs]->prodi ?></b> di Fakultas Industri Kreatif Universitas Telkom.</p>
                <p>Demikian surat rekomendasi ini dibuat dan dapat digunakan sebagaimana mestinya.</p>
                <p>Bandung, <?= $tgl ?></p>
                <p>Hormat Kami,</p><br>
                <img style="width: 100px;" src="<?= 'assets/img/qrcode/' . $srt->id . '.png' ?>">
                <p style=" margin-top:-20px;"><b><u><?= $approver[0]->name ?></b></u></p>
                <p style=" margin-top:-20px;"><b><u><?= $approver[0]->koordinator ?></b></u></p>

                <footer>
                    <img src="<?= 'assets/img/logo/footer2.png' ?> ">
                </footer>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
</body>

</html>