<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorium FIK</title>
    <style>
        /* .container {
            margin-left: 70px;
            margin-right: 70px;
            margin-top: 30px;
        } */

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
    <div class="fik-section-title2">
        <div class="jumbotron">
            <div class="logosurat">
                <img src="<?php echo 'assets/img/logosurat.png'; ?>" style="width:216px;height:73px; margin-left:477px; margin-top:-34px">
            </div>
        </div>
    </div>
    <?php
    $no = 1;
    foreach ($surat as $srt) :
    ?>
        <p style="text-align: center;padding-top: 30px;"><b><u>SURAT KETERANGAN
                    <?php
                    if ($srt->type_surat == 'Kelakuan Baik') {
                        echo 'KELAKUAN BAIK';
                    } ?></u></b>
            <br>Nomor : <?= $srt->no_surat ?>
        </p>
        <div class="container" style="padding-top: 10px;padding-left: 50px;">
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
                        <!-- <td>: Doddy Friestya Asharsinyo, S.T., M.T</td> -->
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td style="padding-left: 80px;"></td>
                        <td>: <?= $approver[0]->koordinator ?></td>
                    </tr>
                    <tr>
                        <td>Alamat </td>
                        <td style="padding-left: 80px;"></td>
                        <td>: Jl. Telekomunikasi, Terusan Buah Batu Bandung 40257</td>
                    </tr>
                </tbody>
            </table>
            <p style=" padding-left: 3px;">Menerangkan bahwa :</p>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td style="padding-left: 40px;"></td>
                        <td>: <?= $mhs[$srt->id_mhs]->name ?></td>
                    </tr>
                    <tr>
                        <td>Nim</td>
                        <td></td>
                        <td>: <?= $mhs[$srt->id_mhs]->nim ?></td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td></td>
                        <td>: <?= $srt->mhs_smt ?></td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td></td>
                        <td>: <?= $mhs[$srt->id_mhs]->prodi ?></td>
                    </tr>
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
                </tbody>
            </table>
            <p style="padding-left: 3px; text-align:justify">Yang bersangkutan adalah benar masih aktif berkuliah sebagai mahasiswa Fakultas Industri Kreatif (FIK) Universitas Telkom sejak tahun akademik <?= $srt->thn_akademik ?>, dan <b>berkelakuan baik serta tidak sedang menjalani sanksi akademik.</b></p>
            <p style="padding-left: 3px; text-align:justify">Demikian surat keterangan ini dibuat dan diberikan kepada yang bersangkutan untuk digunakan sebagai persyaratan mengajukan <b><?= $srt->instansi ?>.</b></p>
            <p>Bandung, <?= $tgl ?></p>
            <p>Hormat Kami,</p><br>
            <img style="width: 100px;" src="<?= 'assets/img/qrcode/' . $srt->id . '.png' ?>">
            <p style=" margin-top:-20px;"><b><u><?= $approver[0]->name ?></b></u></p>
            <p style=" margin-top:-20px;"><b><?= $approver[0]->koordinator ?></b></p>
            <footer>
                <img src="<?= 'assets/img/logo/footer2.png' ?> ">
            </footer>
        <?php endforeach; ?>
        </div>
</body>

</html>