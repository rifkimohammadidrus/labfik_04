function disablemodals() {
    $("#tanggal").val("");
    document.getElementById("tanggal").disabled = false;
    $("#jadwal").slideUp(500);
}

function Bookingmodals() {
    var date = $('#tanggal').val();
    var id_ruangan = $('select[name=id_ruangan] option').filter(':selected').val();
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    currentDate = yyyy + '-' + mm + '-' + dd;
    if (date != '') {
        if (date >= currentDate) {
            document.getElementById('createbookingmodals').disabled = false;
            $.ajax({
                url: "../booking/fetchDate",
                type: "POST",
                data: {
                    'date': date,
                    'id_ruangan': id_ruangan,
                },
                dataType: 'json',
                success: function (data) {
                    var arrTime = [
                        "06.30 - 07.30", "07.30 - 08.30", '08.30 - 09.30',
                        '09.30 - 10.30', '10.30 - 11.30', '11.30 - 12.30',
                        '12.30 - 13.30', '13.30 - 14.30', '14.30 - 15.30',
                        '15.30 - 16.30', '16.30 - 17.30', '17.30 - 18.30',
                        '18.30 - 19.30', '19.30 - 20.30', '20.30 - 21.30',
                        '21.30 - 22.30'
                    ];
                    if (!data.time) {
                        var html = '';
                        for (i in arrTime) {
                            html += '<td class="free" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn"><input type="checkbox" name="time[]" value="' + arrTime[i] + '" class="time" id="time' + arrTime[i] + '">' + arrTime[i] + '</a></div></td>';
                            $("tbody .display").html(html);
                        }
                    } else {
                        var html = '';
                        for (i in data) {
                            var time = data[i];
                            var splitTime = time.split(", ");
                        }
                        for (i = 0; i < arrTime.length; i++) {
                            if (splitTime.includes(arrTime[i])) {
                                html += '<td class="free red" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn">' + arrTime[i] + '</a></div></td>';
                                $("tbody .display").html(html);
                            } else {
                                html += '<td class="free" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn"><input type="checkbox" name="time[]" value="' + arrTime[i] + '" class="time" id="time">' + arrTime[i] + '</a></div></td>';
                                $("tbody .display").html(html);
                            }
                        }
                    }
                }
            });
        } else {
            document.getElementById('createbookingmodals').disabled = true;
            $.ajax({
                url: "../booking/fetchDate",
                type: "POST",
                data: {
                    'date': date,
                    'id_ruangan': id_ruangan,
                },
                dataType: 'json',
                success: function (data) {
                    var arrTime = [
                        "06.30 - 07.30", "07.30 - 08.30", '08.30 - 09.30',
                        '09.30 - 10.30', '10.30 - 11.30', '11.30 - 12.30',
                        '12.30 - 13.30', '13.30 - 14.30', '14.30 - 15.30',
                        '15.30 - 16.30', '16.30 - 17.30', '17.30 - 18.30',
                        '18.30 - 19.30', '19.30 - 20.30', '20.30 - 21.30',
                        '21.30 - 22.30'
                    ];
                    if (!data.time) {
                        var html = '';
                        for (i in arrTime) {
                            html += '<td class="free empty" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn">' + arrTime[i] + '</a></div></td>';
                            $("tbody .display").html(html);
                        }
                    } else {
                        var html = '';
                        for (i in data) {
                            var time = data[i];
                            var splitTime = time.split(", ");
                        }
                        for (i = 0; i < arrTime.length; i++) {
                            if (splitTime.includes(arrTime[i])) {
                                html += '<td class="free red" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn">' + arrTime[i] + '</a></div></td>';
                                $("tbody .display").html(html);
                            } else {
                                html += '<td class="free empty" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn">' + arrTime[i] + '</a></div></td>';
                                $("tbody .display").html(html);
                            }
                        }
                    }
                }
            })
        }

    } else {
        // 
    }
}

function Booking() {
    var date = $('#date').val();
    var id_ruangan = $("input[name= id_ruangan]").val();
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    currentDate = yyyy + '-' + mm + '-' + dd;
    if (date != '') {
        if (date >= currentDate) {
            document.getElementById('createbooking').disabled = false;
            $.ajax({
                url: '../fetchDate',
                type: "POST",
                data: {
                    'date': date,
                    'id_ruangan': id_ruangan,
                },
                dataType: 'json',
                success: function (data) {
                    var arrTime = [
                        "06.30 - 07.30", "07.30 - 08.30", '08.30 - 09.30',
                        '09.30 - 10.30', '10.30 - 11.30', '11.30 - 12.30',
                        '12.30 - 13.30', '13.30 - 14.30', '14.30 - 15.30',
                        '15.30 - 16.30', '16.30 - 17.30', '17.30 - 18.30',
                        '18.30 - 19.30', '19.30 - 20.30', '20.30 - 21.30',
                        '21.30 - 22.30'
                    ];
                    if (!data.time) {
                        var html = '';
                        for (i in arrTime) {
                            html += '<td class="free" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn"><input type="checkbox" name="time[]" value="' + arrTime[i] + '" class="time" id="time' + arrTime[i] + '">' + arrTime[i] + '</a></div></td>';
                            $("tbody tr").html(html);
                        }
                    } else {
                        var html = '';
                        console.log(data)
                        for (i in data) {
                            var time = data[i];
                            var splitTime = time.split(", ");
                        }
                        for (i = 0; i < arrTime.length; i++) {
                            if (splitTime.includes(arrTime[i])) {
                                html += '<td class="free red" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn">' + arrTime[i] + '</a></div></td>';
                                $("tbody tr").html(html);
                            } else {
                                html += '<td class="free" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn"><input type="checkbox" name="time[]" value="' + arrTime[i] + '" class="time" id="time">' + arrTime[i] + '</a></div></td>';
                                $("tbody tr").html(html);
                            }
                        }
                    }
                }
            });
        } else {
            document.getElementById('createbooking').disabled = true;
            $.ajax({
                url: '../fetchDate',
                type: "POST",
                data: {
                    'date': date,
                    'id_ruangan': id_ruangan,
                },
                dataType: 'json',
                success: function (data) {
                    var arrTime = [
                        "06.30 - 07.30", "07.30 - 08.30", '08.30 - 09.30',
                        '09.30 - 10.30', '10.30 - 11.30', '11.30 - 12.30',
                        '12.30 - 13.30', '13.30 - 14.30', '14.30 - 15.30',
                        '15.30 - 16.30', '16.30 - 17.30', '17.30 - 18.30',
                        '18.30 - 19.30', '19.30 - 20.30', '20.30 - 21.30',
                        '21.30 - 22.30'
                    ];
                    if (!data.time) {
                        var html = '';
                        for (i in arrTime) {
                            html += '<td class="free empty" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn">' + arrTime[i] + '</a></div></td>';
                            $("tbody tr").html(html);
                        }
                    } else {
                        var html = '';
                        // console.log(data)
                        for (i in data) {
                            var time = data[i];
                            var splitTime = time.split(", ");
                        }
                        for (i = 0; i < arrTime.length; i++) {
                            if (splitTime.includes(arrTime[i])) {
                                html += '<td class="free red" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn">' + arrTime[i] + '</a></div></td>';
                                $("tbody tr").html(html);
                            } else {
                                html += '<td class="free empty" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn">' + arrTime[i] + '</a></div></td>';
                                $("tbody tr").html(html);
                            }
                        }
                    }
                }
            });
        }
    } else {
        // 
    }

};

function disable() {
    document.getElementById("datebooking").disabled = false;
    $("#datebooking").val("");
    // $("#schedule").slideUp(500);
}

function bookingByAdmin() {
    var date = $('#datebooking').val();
    var id_ruangan = $('select[name=id_ruangan] option').filter(':selected').val();
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    currentDate = yyyy + '-' + mm + '-' + dd;
    if (date != '') {
        if (date >= currentDate) {
            document.getElementById('createbookingbyadmin').disabled = false;
            $.ajax({
                url: '../booking/fetchDate',
                type: "POST",
                data: {
                    'date': date,
                    'id_ruangan': id_ruangan,
                },
                dataType: 'json',
                success: function (data) {
                    var arrTime = [
                        "06.30 - 07.30", "07.30 - 08.30", '08.30 - 09.30',
                        '09.30 - 10.30', '10.30 - 11.30', '11.30 - 12.30',
                        '12.30 - 13.30', '13.30 - 14.30', '14.30 - 15.30',
                        '15.30 - 16.30', '16.30 - 17.30', '17.30 - 18.30',
                        '18.30 - 19.30', '19.30 - 20.30', '20.30 - 21.30',
                        '21.30 - 22.30'
                    ];
                    // console.log(data)
                    if (!data.time) {
                        var html = '';
                        for (i in arrTime) {
                            html += '<td class="free" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn"><input type="checkbox" name="time[]" value="' + arrTime[i] + '" class="time" id="time' + arrTime[i] + '">' + arrTime[i] + '</a></div></td>';
                            $("tbody .displaydate").html(html);
                        }
                    } else {
                        var html = '';
                        for (i in data) {
                            var time = data[i];
                            var splitTime = time.split(", ");
                        }
                        for (i = 0; i < arrTime.length; i++) {
                            if (splitTime.includes(arrTime[i])) {
                                html += '<td class="free red" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn">' + arrTime[i] + '</a></div></td>';
                                $("tbody .displaydate").html(html);
                            } else {
                                html += '<td class="free" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn"><input type="checkbox" name="time[]" value="' + arrTime[i] + '" class="time" id="time">' + arrTime[i] + '</a></div></td>';
                                $("tbody .displaydate").html(html);
                            }
                        }
                    }
                }
            });
        } else {
            document.getElementById('createbookingbyadmin').disabled = true;
            $.ajax({
                url: '../booking/fetchDate',
                type: "POST",
                data: {
                    'date': date,
                    'id_ruangan': id_ruangan,
                },
                dataType: 'json',
                success: function (data) {
                    var arrTime = [
                        "06.30 - 07.30", "07.30 - 08.30", '08.30 - 09.30',
                        '09.30 - 10.30', '10.30 - 11.30', '11.30 - 12.30',
                        '12.30 - 13.30', '13.30 - 14.30', '14.30 - 15.30',
                        '15.30 - 16.30', '16.30 - 17.30', '17.30 - 18.30',
                        '18.30 - 19.30', '19.30 - 20.30', '20.30 - 21.30',
                        '21.30 - 22.30'
                    ];
                    if (!data.time) {
                        var html = '';
                        for (i in arrTime) {
                            html += '<td class="free empty" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn">' + arrTime[i] + '</a></div></td>';
                            $("tbody .displaydate").html(html);
                        }
                    } else {
                        var html = '';
                        for (i in data) {
                            var time = data[i];
                            var splitTime = time.split(", ");
                        }
                        for (i = 0; i < arrTime.length; i++) {
                            if (splitTime.includes(arrTime[i])) {
                                html += '<td class="free red" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn">' + arrTime[i] + '</a></div></td>';
                                $("tbody .displaydate").html(html);
                            } else {
                                html += '<td class="free empty" align="center" id="btnchange" valign="middle" width="13%" style="overflow:hidden"><div width="100%" style="overflow:hidden"><a class="time" id="btn">' + arrTime[i] + ' disabled</a></div></td>';
                                $("tbody .displaydate").html(html);
                            }
                        }
                    }
                }

            });
        }
    } else {
        // 
    }
};