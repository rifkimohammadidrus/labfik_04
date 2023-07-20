var ajaxku = buatajax();

function ajaxkota(id) {
    var url = "getKab/" + id + "/" + Math.random();
    ajaxku.onreadystatechange = stateChanged;
    ajaxku.open("GET", url, true);
    ajaxku.send(null);
}

function ajaxkec(id) {
    var url = "getKec/" + id + "/" + Math.random();
    ajaxku.onreadystatechange = stateChangedKec;
    ajaxku.open("GET", url, true);
    ajaxku.send(null);
}

function ajaxkel(id) {
    var url = "getKel/" + id + "/" + Math.random();
    ajaxku.onreadystatechange = stateChangedKel;
    ajaxku.open("GET", url, true);
    ajaxku.send(null);
}
// function ajaxuserid(id) {
//     var url = "get_data_user/" + id + "/" + Math.random();
//     ajaxku.onreadystatechange = stateChangeduserid;
//     ajaxku.open("GET", url, true);
//     ajaxku.send(null);
// }

function buatajax() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
    if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}


// function stateChangeduserid() {
//     var data;
//     if (ajaxku.readyState == 4) {
//         data = ajaxku.responseText;
//         if (data.length >= 0) {
//             document.getElementById("nim").innerHTML = data
//         }
//         document.getElementById("nim").style.display = 'table-row';
//     }
// }
function stateChanged() {
    var data;
    if (ajaxku.readyState == 4) {
        data = ajaxku.responseText;
        if (data.length >= 0) {
            document.getElementById("kota").innerHTML = data
        } else {
            document.getElementById("kota").value = "<option selected>Pilih Kota/Kabupaten</option>";
        }
        document.getElementById("kab_box").style.display = 'table-row';
        document.getElementById("kec_box").style.display = 'table-row';
        document.getElementById("kel_box").style.display = 'table-row';
    }
}

function stateChangedKec() {
    var data;
    if (ajaxku.readyState == 4) {
        data = ajaxku.responseText;
        if (data.length >= 0) {
            document.getElementById("kec").innerHTML = data
        } else {
            document.getElementById("kec").value = "<option selected>Pilih Kecamatan</option>";
        }
        document.getElementById("kec_box").style.display = 'table-row';
        document.getElementById("kel_box").style.display = 'table-row';
    }
}

function stateChangedKel() {
    var data;
    if (ajaxku.readyState == 4) {
        data = ajaxku.responseText;
        if (data.length >= 0) {
            document.getElementById("kel").innerHTML = data
        } else {
            document.getElementById("kel").value = "<option selected>Pilih Kelurahan/Desa</option>";
        }
        document.getElementById("kel_box").style.display = 'table-row';
    }
}