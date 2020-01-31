$(() => {
    var validationRule = {
        numbering: {
            presence: true,
            numericality: {
                onlyInteger: true,
                message: "Hanya menerima angka !"
            }
        }
    };

    function validateNumber(el) {
        var str = el.val();
        var validation = validate({
                numbering: str
            },
            validationRule, {
                format: "flat"
            }
        );

        if (validation != undefined) {
            el.val(str.substring(0, str.length - 1));
            var msg = validation[0];
            toast(msg.substr(msg.indexOf(" ") + 1), "error");
        }
    }

    function countGender(x, y) {
        var lk = $("#" + x).val();
        var pr = $("#" + y).val();
        var awalan = x.substring(0, 1)
        var total = '';

        if (awalan == 'a' || awalan == 'b' || awalan == 'c') {
            total = awalan + 'jumlah'
        } else {
            total = 'jumlahGender'
        }

        var res = parseInt(lk) + parseInt(pr);
        if (isNaN(res)) {
            $("#" + total).val("");
        } else {
            $("#" + total).val(res);
        }
    }

    var fieldNumber = ['lk', 'pr', 'alk', 'apr', 'blk', 'bpr', 'clk', 'cpr']

    $.each(fieldNumber, (i, d) => {

        $("#" + d).on("keyup", function () {
            validateNumber($(this));
            if ((i - 1) % 2 == 0) {
                countGender(d, fieldNumber[i - 1]);
            } else {
                countGender(d, fieldNumber[i + 1]);
            }
        });
    })

    $.each(["#kertas", "#bilik", "#alas", "#tinta"], function (i, d) {
        $(d).on("keyup", function () {
            validateNumber($(d));
        });
    });

    $("#saveInfoTps").on("click", function () {
        var arr = ['#lk', '#pr', "#kertas", "#bilik", "#alas", "#tinta"]
        $.each(arr,
            function (i, d) {
                if (isNaN($(d).val()) || $(d).val() == '') {
                    toast('Harus diisi dengan angka semuanya !', 'error')
                    return false
                } else {
                    if (i == (arr.length - 1)) {
                        saveInfoTps()
                    }
                }
            }
        )
    });

    $("#saveDataPemilih").on("click", function () {
        var arr = ['#alk', '#apr', '#blk', '#bpr', '#clk', '#cpr']
        $.each(arr,
            function (i, d) {
                if (isNaN($(d).val()) || $(d).val() == '') {
                    toast('Harus diisi dengan angka semuanya !', 'error')
                    return false
                } else {
                    if (i == (arr.length - 1)) {
                        saveDataPemilih()
                    }
                }
            }
        )
    });

    function saveInfoTps() {
        Swal.fire({
            title: 'Peringatan !',
            text: 'Apakah anda yakin data yang anda masukkan sudah benar .?',
            showCancelButton: true,
            type: 'warning'
        }).then((res) => {
            if (res.value) {
                $.ajax({
                    url: apiurl + 'saveinfotps',
                    method: 'POST',
                    data: {
                        lk: $("#lk").val(),
                        pr: $("#pr").val(),
                        jumlah: $('#jumlahGender').val(),
                        kertas: $("#kertas").val(),
                        bilik: $("#bilik").val(),
                        alas: $("#alas").val(),
                        tinta: $("#tinta").val(),
                        _token: _token
                    },
                    beforeSend: function () {
                        nstart('#over')
                    },
                    success: function () {
                        finalTahapSatu()
                        $('#saveInfoTps').remove()
                        toast('Berhasil menyimpan info TPS !')
                        ndone()
                    }
                })
            }
        });
    }

    function saveDataPemilih() {
        Swal.fire({
            title: 'Peringatan !',
            text: 'Apakah anda yakin data yang anda masukkan sudah benar .?',
            showCancelButton: true,
            type: 'warning'
        }).then((res) => {
            if (res.value) {
                $.ajax({
                    url: apiurl + 'savedatapemilih',
                    method: 'POST',
                    data: {
                        alk: $("#alk").val(),
                        apr: $("#apr").val(),
                        blk: $("#blk").val(),
                        bpr: $("#bpr").val(),
                        clk: $("#clk").val(),
                        cpr: $("#cpr").val(),
                        _token: _token
                    },
                    beforeSend: function () {
                        nstart('#over')
                    },
                    success: function () {
                        finalTahapDua()
                        $('#saveDataPemilih').remove()
                        toast('Berhasil menyimpan data pemilih !')
                        ndone()
                    }
                })
            }
        });
    }

    function finalTahapSatu(data = null) {
        $('#tahapSatu').removeClass('c-border-left-warning')
        $('#tahapSatu').addClass('c-border-left-success')

        var el = ['lk', 'pr', 'jumlahGender', 'kertas', 'bilik', 'alas', 'tinta']

        $.each(el, function (i, element) {
            $("#" + element).attr({
                disabled: '',
                readonly: '',
            })
        })

        if (data != null) {
            var dpt = JSON.parse(data.dpt)
            data.dpt = dpt

            $('#lk').val(data.dpt.lk)
            $('#pr').val(data.dpt.pr)
            $('#jumlahGender').val(data.dpt.jumlah)
            $('#kertas').val(data.kertas)
            $('#bilik').val(data.bilik)
            $('#alas').val(data.alas)
            $('#tinta').val(data.tinta)
        }
    }

    function finalTahapDua(data = null) {
        $('#tahapDua').removeClass('c-border-left-warning')
        $('#tahapDua').addClass('c-border-left-success')

        var el = ['alk', 'apr', 'ajumlah', 'blk', 'bpr', 'bjumlah', 'clk', 'cpr', 'cjumlah']

        $.each(el, function (i, element) {
            $("#" + element).attr({
                disabled: '',
                readonly: '',
            })
        })

        if (data != null) {
            var dpt = JSON.parse(data.dpt)
            var dpph = JSON.parse(data.dpph)
            var dptb = JSON.parse(data.dptb)
            data.dpt = dpt
            data.dpph = dpph
            data.dptb = dptb

            $('#alk').val(data.dpt.lk)
            $('#apr').val(data.dpt.pr)
            $('#ajumlah').val(data.dpt.jumlah)

            $('#blk').val(data.dpph.lk)
            $('#bpr').val(data.dpph.pr)
            $('#bjumlah').val(data.dpph.jumlah)

            $('#clk').val(data.dptb.lk)
            $('#cpr').val(data.dptb.pr)
            $('#cjumlah').val(data.dptb.jumlah)
        }
    }

    function cekStateStep() {
        $.ajax({
            url: apiurl + 'getinfotahap',
            method: 'GET',
            beforeSend: function () {
                nstart('#over')
            },
            success: function (data) {
                renderTahap(data);

                var element = ['satu', 'dua']
                $.each(element, (i, d) => {
                    prosesElement(d, data)
                })

                ndone()
            }
        })
    }

    cekStateStep()

    function renderTahap(data) {
        var el = [
            '#tahapSatu',
            '#tahapDua',
            '#tahapTiga',
        ]

        var role = [
            [false, false, 'c-border-left-danger'],
            [true, false, 'c-border-left-warning'],
            [true, true, 'c-border-left-success'],
        ]

        for (var i = 0; i < 3; i++) {
            if (data.jam.tahapSatu == role[i][0] && data.exist.tahapSatu == role[i][1]) {
                $(el[0]).addClass(role[i][2])
            }
            if (data.jam.tahapDua == role[i][0] && data.exist.tahapDua == role[i][1]) {
                $(el[1]).addClass(role[i][2])
            }
            if (data.jam.tahapTiga == role[i][0] && data.exist.tahapTiga == role[i][1]) {
                $(el[2]).addClass(role[i][2])
            }
        }
    }

    function prosesElement(type = '', data) {
        switch (type) {
            case 'satu':
                if (data.jam.tahapSatu == true && data.exist.tahapSatu == false) {
                    $('#overSatu').remove()
                } else if (data.jam.tahapSatu == false && data.exist.tahapSatu == false) {
                    $('#saveInfoTps').remove()
                } else if (data.jam.tahapSatu == true && data.exist.tahapSatu == true) {
                    $('#overSatu').remove()
                    $('#saveInfoTps').remove()
                    finalTahapSatu(data.data.tahapSatu)
                }
                break;
            case 'dua':
                if (data.jam.tahapDua == true && data.exist.tahapDua == false) {
                    $('#overDua').remove()
                } else if (data.jam.tahapDua == false && data.exist.tahapDua == false) {
                    $('#saveDataPemilih').remove()
                } else if (data.jam.tahapDua == true && data.exist.tahapDua == true) {
                    $('#overDua').remove()
                    $('#saveDataPemilih').remove()
                    finalTahapDua(data.data.tahapDua)
                }
                break;
        }
    }
});

// console.log(role[i][0] + '|' + role[i][1] + '|' + role[i][2] + '|' + el[0])
// console.log(role[i][0] + '|' + role[i][1] + '|' + role[i][2] + '|' + el[1])
// console.log(role[i][0] + '|' + role[i][1] + '|' + role[i][2] + '|' + el[2])
