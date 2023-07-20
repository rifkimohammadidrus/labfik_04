<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="https://ifik.telkomuniversity.ac.id/assets/js/loadMore.js" type="8adbcf2d5865138ccf152acc-text/javascript"></script>
<script type="8adbcf2d5865138ccf152acc-text/javascript">
    $('.fik-carousel-info').owlCarousel({
        margin: 0,
        margin: 0,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        items: 1,
    });
    $('.fik-lab-div-list').owlCarousel({
        margin: 0,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        nav: true,
        navText: ["<span class='fas fa-arrow-left'>", "<span class='fas fa-arrow-right'>"],
        dots: false,
        responsive: {
            0: {
                items: 1,
                autoplay: false
            },
            480: {
                items: 2
            },
            720: {
                items: 4
            }
        }
    });
    $('.fik-carousel-schedule').owlCarousel({
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        margin: 0,
        margin: 0,
        loop: true,
        autoplay: true,
        autoplayTimeout: 15000,
        items: 1,
        dots: false,
    });
</script>

<div class="footer">
    <div class="padding-t50"></div>
    <footer class="fik-footer">
        <div class="credit" style="text-align:left;padding-left:285px;border-top:1px solid #ddd;background-color:#f8f8fa">Laboratorium, Bengkel &amp; Studio FIK &copy; 2020</div>
    </footer>
</div>

<script src="https://ifik.telkomuniversity.ac.id/assets/js/tambahan.js.pagespeed.jm.MEPT9sPKdv.js" type="8adbcf2d5865138ccf152acc-text/javascript"></script>
<script type="8adbcf2d5865138ccf152acc-text/javascript">
    $(document).ready(function() {
        $('#chatSection').TrackpadScrollEmulator();
    });
</script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="8adbcf2d5865138ccf152acc-|49" defer=""></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"65ca96ecbba020a1","token":"5613f381e16b4e2d98bbb338537f090e","version":"2021.5.2","si":10}'></script>
<script src="<?php echo base_url() . 'assets/js/jquery-3.3.1.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'assets/js/jquery-ui.js' ?>" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/ajax_daerah2.js"></script>
<script src="<?= base_url(); ?>assets/js/ajax_daerah.js"></script>
<script src="<?= base_url(); ?>assets/js/loadpdf.js"></script>

<script type="text/javascript">
    $(function() {

        $("#keywordPencarian").focusin(function() {
            if ($('#sortPencarian').val() == 'nama_kegiatan') {
                $('#keywordPencarian').autocomplete({
                    source: "<?php echo site_url('/autocomplete/get_nama_kegiatan'); ?>",
                    select: function(event, ui) {
                        $('[name="keywordPencarian"]').val(ui.item.label);
                    }
                });
            } else if ($('#sortPencarian').val() == 'no_ememo') {
                $('#keywordPencarian').autocomplete({
                    source: "<?php echo site_url('/autocomplete/get_ememo'); ?>",
                    select: function(event, ui) {
                        $('[name="keywordPencarian"]').val(ui.item.label);
                    }
                });
            } else if ($('#sortPencarian').val() == 'periode_penugasan') {
                $('#keywordPencarian').autocomplete({
                    source: "<?php echo site_url('/autocomplete/get_periode_penugasan'); ?>",
                    select: function(event, ui) {
                        $('[name="keywordPencarian"]').val(ui.item.label);
                    }
                });
            } else if ($('#sortPencarian').val() == 'status_surat_tugas.status') {
                $('#keywordPencarian').autocomplete({
                    source: "<?php echo site_url('/autocomplete/get_stat'); ?>",
                    select: function(event, ui) {
                        $('[name="sortPencarian"]').val(ui.item.label);
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $("#keywordPencarian").focusin(function() {
            if ($('#sortPencarian').val() == 'name') {
                $('#keywordPencarian').autocomplete({
                    source: "<?php echo site_url('/autocomplete/get_namaMhs'); ?>",

                    select: function(event, ui) {
                        $('[name="keywordPencarian"]').val(ui.item.label);
                    }
                });
            } else if ($('#sortPencarian').val() == 'nim') {
                $('#keywordPencarian').autocomplete({
                    source: "<?php echo site_url('/autocomplete/get_nimMhs'); ?>",

                    select: function(event, ui) {
                        $('[name="keywordPencarian"]').val(ui.item.label);
                    }
                });
            } else if ($('#sortPencarian').val() == 'prodi') {
                $('#keywordPencarian').autocomplete({
                    source: "<?php echo site_url('/autocomplete/get_prodiMhs'); ?>",

                    select: function(event, ui) {
                        $('[name="sortPencarian"]').val(ui.item.label);
                    }
                });
            } else if ($('#sortPencarian').val() == 'type_surat') {
                $('#keywordPencarian').autocomplete({
                    source: "<?php echo site_url('/autocomplete/get_typeSurat'); ?>",

                    select: function(event, ui) {
                        $('[name="sortPencarian"]').val(ui.item.label);
                    }
                });
            } else if ($('#sortPencarian').val() == 'status') {
                $('#keywordPencarian').autocomplete({
                    source: "<?php echo site_url('/autocomplete/get_statusMhs'); ?>",

                    select: function(event, ui) {
                        $('[name="sortPencarian"]').val(ui.item.label);
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#nim').autocomplete({
            source: "<?php echo site_url('/autocomplete/get_nim'); ?>",

            select: function(event, ui) {
                $('[name="nim"]').val(ui.item.label);
                $('[name="nama"]').val(ui.item.name);
                $('[name="prodi"]').val(ui.item.prodi);


            }
        });

    });
</script>
</body>

</html>