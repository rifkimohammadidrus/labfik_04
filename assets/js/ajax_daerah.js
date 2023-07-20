var ajaxda = createajax();

function ajaxotherkota(id) {
    var url = "get_kab/" + id + "/" + Math.random();
    ajaxda.onreadystatechange = stateChangedKota;
    ajaxda.open("GET", url, true);
    ajaxda.send(null);
}

function ajaxotherkec(id) {
    var url = "get_kec/" + id + "/" + Math.random();
    ajaxda.onreadystatechange = stateChangedKecam;
    ajaxda.open("GET", url, true);
    ajaxda.send(null);
}

function ajaxotherkel(id) {
    var url = "get_kel/" + id + "/" + Math.random();
    ajaxda.onreadystatechange = stateChangedKelur;
    ajaxda.open("GET", url, true);
    ajaxda.send(null);
}

function createajax() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
    if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}


function stateChangedKota() {
    var data;
    if (ajaxda.readyState == 4) {
        data = ajaxda.responseText;
        if (data.length >= 0) {
            document.getElementById("other_kota").innerHTML = data
        } else {
            document.getElementById("other_kota").value = "<option selected>Pilih Kabupaten/Kota</option>";
        }
        document.getElementById("kab_box").style.display = 'table-row';
        document.getElementById("kec_box").style.display = 'table-row';
        document.getElementById("kel_box").style.display = 'table-row';
    }
}

function stateChangedKecam() {
    var data;
    if (ajaxda.readyState == 4) {
        data = ajaxda.responseText;
        if (data.length >= 0) {
            document.getElementById("other_kec").innerHTML = data
        } else {
            document.getElementById("other_kec").value = "<option selected>Pilih Kecamatan</option>";
        }
        document.getElementById("kec_box").style.display = 'table-row';
        document.getElementById("kel_box").style.display = 'table-row';
    }
}

function stateChangedKelur() {
    var data;
    if (ajaxda.readyState == 4) {
        data = ajaxda.responseText;
        if (data.length >= 0) {
            document.getElementById("other_kel").innerHTML = data
        } else {
            document.getElementById("other_kel").value = "<option selected>Pilih Kelurahan/Desa</option>";
        }
        document.getElementById("kel_box").style.display = 'table-row';
    }
}