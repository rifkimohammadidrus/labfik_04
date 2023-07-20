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
            bottom: -1px;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            /* margin-top: 30px; */
            text-align: center;
        }
    </style>
</head>


<body>
    <img src="<?php echo 'assets/img/logosurat.png'; ?>" style="width:216px;height:73px; margin-left:477px; margin-top:-10px">
    <div class="container">
        <?php
        $no = 1;
        foreach ($surat as $srt) :
        ?>
            <p style="text-align: center;font-family:calibri, sans-serif;font-weight: bold; font-size: 27px; text-decoration: underline;">SURAT TUGAS</p>
            <p style="text-align: center;margin-top: -20px;font-family:sans-serif; margin-bottom:30px;">Nomor :
                <?= $srt->no_surat ?></p>
            <p> Pada hari <?= $hari ?> tanggal <?= $tgl ?> bertempat di Fakultas Industri Kreatif (FIK) Universitas Telkom, dengan mempertimbangkan hal-hal sebagai berikut:
            </p>
            <table class="table">
                <tbody>
                    <tr>
                        <td style="vertical-align: top;">a)</td>
                        <td>Tri dharma Perguruan Tinggi meliputi Pendidikan, Penelitian, Pengabdian Masyarakat wajib dilakukan oleh setiap dosen;</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">b)</td>
                        <td>Permohonan Surat Tugas dari
                            <?= $kaprodikk[0]->koordinator ?>, TELKOM UNIVERSITY,
                            melalui e-memo nomor ND. <?= $srt->no_ememo ?>/TELKOM UNIVERSITY - TELU/SDM33/2021 tanggal 23 Juni 2021.
                        </td>
                    </tr>
                </tbody>
            </table>
            <p>Saya yang bertandatangan di bawah ini :</p>
            <?php
            foreach ($dekan as $dekan) :
            ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td style="padding-left: 70px;"></td>
                            <td>: <?= $dekan->name ?></td>
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
                <p>Menugaskan kepada :</p>
                <table class="table">
                    <tbody>
                        <?php $arrID = explode(",", $srt->dosen_id);  ?>
                        <?php foreach ($arrID as $id) : ?>
                            <tr>
                                <td>Nama</td>
                                <td style="padding-left: 70px;"></td>
                                <td>: <?= $dosen[$id]->name ?></td>
                            </tr>
                            <tr>
                                <td>NIP</td>
                                <td></td>
                                <td>: <?= $dosen[$id]->nip  ?></td>
                            </tr>
                            <tr>
                                <td>Jabatan </td>
                                <td></td>
                                <td>: <?= $dosen[$id]->koordinator ?></td>
                            </tr>
                    </tbody>
                <?php endforeach; ?>
                </table>
                <p> sebagai <b><?= $srt->jenis_penugasan ?></b> dalam <b><?= $srt->nama_kegiatan ?></b>, yang diselenggarakan oleh <?= $srt->penyelenggara ?> pada tanggal <?= $srt->tanggal_kegiatan ?></p>
                <p>Surat tugas ini berlaku sesuai tanggal kegiatan yang tercantum di atas.</p>
                <p>Demikian penugasan ini untuk dilaksanakan dengan penuh tanggung jawab.</p>
                <p style=" margin-left:340px">Bandung, <?= $tgl ?></p><br>
                <img style="margin-top:-5px; width: 100px; margin-left:380px" src="<?= 'assets/img/qrcode/' . $srt->id . '.png' ?>">
                <p style=" margin-top:-22px; margin-left:310px"><?= $dekan->name ?></p>
                <p style=" margin-top:-22px; margin-left:310px"><?= $dekan->koordinator ?></p>
                <p>Tembusan : <br> <?= $kaprodikk[0]->koordinator ?></p>

            <?php endforeach; ?>

            <footer>
                <img src="<?= 'assets/img/logo/footer2.png' ?> ">
            </footer>
        <?php endforeach; ?>
    </div>
</body>

</html>