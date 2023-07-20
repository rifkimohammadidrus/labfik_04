<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorium FIK</title>
    <style>
        .container {
            margin-left: 70px;
            margin-right: 70px;
            margin-top: 30px;
        }

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
    <div class="container">

        <?php
        $no = 1;
        foreach ($surat as $srt) :
        ?>
            <p style="text-align: center;font-family:calibri, sans-serif;font-weight: bold; font-size: 27px; text-decoration: underline;">SURAT TUGAS</p>
            <p style="text-align: center;margin-top: -20px;font-family:sans-serif; margin-bottom:30px;">Nomor :<?= $srt->no_surat ?></p>
            <p> Pada hari <?= $hari ?> tanggal <?= $tgl ?> bertempat di Fakultas Industri Kreatif (FIK) Universitas Telkom, dengan mempertimbangkan hal-hal sebagai berikut:
            </p>
            <table class="table">
                <tbody>
                    <tr>
                        <td style="vertical-align: top;">a)</td>
                        <td>Nota Dinas Nomor ND. <?= $srt->no_surat ?>/TELKOM UNIVERSITY - TEL U/SDM7/2021 Perihal:
                            Penugasan Fakultas pada Program Kompetensi DIKTI 2021 dari Direktur Sumber Daya
                            Manusia, Telkom University;</td>

                    </tr>
                    <tr>
                        <td style="vertical-align: top;">b)</td>
                        <td>Permohonan Surat Tugas dari Wakil Dekan Bidang Sumber Daya, Keuangan dan Kemahasiswaan FIK melalui e-memo nomor ND. <?= $srt->no_ememo ?>/TELKOM UNIVERSITY - TELU/SDM33/2021 tanggal 23 Juni 2021.</td>
                    </tr>
                </tbody>
            </table>
            <p style="padding-top: 20px;">Saya yang bertandatangan di bawah ini :</p>
            <?php
            foreach ($dekan as $dekan) :
            ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td style="padding-left: 70px;"></td>
                            <td>: <?= $dekan->name ?></td>
                            <!-- <td>: Doddy Friestya Asharsinyo, S.T., M.T</td> -->
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td></td>
                            <td>: <?= $dekan->nip ?></td>
                        </tr>
                        <tr>
                            <td>Jabatan </td>
                            <td></td>
                            <td>: <?= $dekan->koordinator ?></td>
                        </tr>
                    </tbody>
                </table>
                <p>Menugaskan kepada dosen-dosen yang tercantum pada lampiran surat tugas ini,
                    untuk mengikuti <?= $srt->nama_kegiatan ?> yang diselenggarakan oleh
                    <?= $srt->penyelenggara ?>. </p>
                <p>Surat tugas ini berlaku mulai diterbitkan sampai dengan <?= $srt->periode_penugasan ?></p>
                <p>Demikian penugasan ini untuk dilaksanakan dengan penuh tanggung jawab.</p><br>
                <p style=" margin-left:340px">Bandung, <?= $tgl ?></p><br>
                <img style="width: 100px; margin-left:380px" src="<?= 'assets/img/qrcode/' . $srt->id . '.png' ?>">
                <p style=" margin-top:-20px; margin-left:310px"><?= $dekan->name ?></p>
                <p style=" margin-top:-20px; margin-left:310px"><?= $dekan->koordinator ?></p>

            <?php endforeach; ?>

            <footer>
                <img src="<?= 'assets/img/logo/footer2.png' ?> ">
            </footer>
            <div class="page"></div>
            <table class="table" style="border: 1px solid black;border-collapse: collapse; width: 100%;">
                <thead style="border: 1px solid black;border-collapse: collapse;">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col" style="border: 1px solid black; ">NIP</th>
                        <th scope="col" style="border: 1px solid black;">Nama</th>
                        <th scope="col" style="border: 1px solid black;">Jabatan</th>
                    </tr>
                </thead>
                <tbody style="border: 1px solid black;border-collapse: collapse;">

                    <?php $arrID = explode(",", $srt->dosen_id);  ?>
                    <?php foreach ($arrID as $id) : ?>
                        <tr>
                            <td style="border: 1px solid black; text-align: center;"><?= $no++ ?></td>
                            <td style="border: 1px solid black; text-align: center;"><?= $dosen[$id]->nip  ?></td>
                            <td style="border: 1px solid black; text-align: center;"><?= $dosen[$id]->name ?></td>
                            <td style="border: 1px solid black; text-align: center;"><?= $dosen[$id]->koordinator ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>
</body>

</html>