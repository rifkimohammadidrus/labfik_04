<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorium FIK</title>
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
        <p style="text-align: center;padding-top: 30px; margin-left: 25%; margin-right: 25%;"><b>SURAT REKOMENDASI<br>
                <?php
                if ($srt->type_surat == 'Kemendikbud Ristek') {
                    echo 'MENGIKUTI PROGRAM BEASISWA UNGGULAN KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI';
                } else if ($srt->type_surat == 'LPDP') {
                    echo 'MENGIKUTI PROGRAM BEASISWA LEMBAGA PENGELOLA DANA PENDIDIKAN';
                } else if ($srt->type_surat == 'Beasiswa lain') {
                    echo 'MENGIKUTI PROGRAM BEASISWA';
                }
                ?></b>
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
                        <td>Jabatan</td>
                        <td style="padding-left: 80px;"></td>
                        <td>: <?= $approver[0]->koordinator ?></td>
                    </tr>
                    <tr>
                        <td>Intansi</td>
                        <td style="padding-left: 80px;"></td>
                        <td>: Telkom University</td>
                    </tr>
                    <tr>
                        <td>Alamat </td>
                        <td style="padding-left: 80px;"></td>
                        <td>: Jl. Telekomunikasi, Terusan Buah Batu Bandung 40257</td>
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
                    <tr>
                        <td>Jabatan</td>
                        <td></td>
                        <td>: Mahasiswa</td>
                    </tr>
                    <tr>
                        <td>Intansi</td>
                        <td style="padding-left: 80px;"></td>
                        <td>: Telkom University</td>
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
                </tbody>
            </table>
            <p style=" padding-left: 3px;">Penilaian terhadap calon peserta (isi dengan tanda X):</p>
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
            <!-- HAlaman kedua -->
            <br>
            <p style="padding-left: 3px; margin-top: 100px" align="justify">Alasan memberikan rekomendasi:</p>
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
            </table>
            <br>
            <p style="padding-left: 3px;" align="justify">.....</p>
            <p style="padding-left: 3px;" align="justify">Demikian surat rekomendasi ini dibuat dengan sesungguhnya dan tanpa ada paksaan dari pihak manapun serta akan dilaksanakan dengan sebagaimana mestinya.</p>

            <p style="padding-left: 400px;">Bandung, <?= $tgl ?></p>
            <p style="padding-left: 400px;">Hormat Kami,</p>
            <img style="width: 100px; margin-left:425px" src="<?= 'assets/img/qrcode/' . $srt->qr_code; ?>">
            <p style="padding-left: 400px;margin-bottom:20px"><b><u><?= $approver[0]->koordinator ?></b></u></p>
            <p style=" margin-top:-20px; margin-left:400px"><?= $approver[0]->name ?></p>

        <?php endforeach; ?>
        </div>
</body>

</html>