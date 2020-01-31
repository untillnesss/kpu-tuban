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

    function countGender() {
        var lk = $("#lk").val();
        var pr = $("#pr").val();

        var res = parseInt(lk) + parseInt(pr);
        if (isNaN(res)) {
            $("#jumlahGender").val("");
        } else {
            $("#jumlahGender").val(res);
        }
    }

    $("#lk").on("keyup", function () {
        validateNumber($(this));
        countGender();
    });

    $("#pr").on("keyup", function () {
        validateNumber($(this));
        countGender();
    });

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

    function finalTahapSatu(data = null) {
        $('#tahapSatu').removeClass('c-border-left-warning')
        $('#tahapSatu').addClass('c-border-left-success')

        var el = ['lk', 'pr', 'jumlahGender', 'kertas', 'bilik', 'alas', 'tinta']
        var object = [
            ['lk', 'lk'],
            ['pr', 'pr'],
            ['jumlahGender', 'jumlah'],
            ['kertas', 'kertas'],
            ['bilik', 'bilik'],
            ['alas', 'alas'],
            ['tinta', 'tinta'],
        ]

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

    function cekStateStep() {
        $.ajax({
            url: apiurl + 'getinfotahap',
            method: 'GET',
            beforeSend: function () {
                nstart('#over')
            },
            success: function (data) {
                renderTahap(data);

                if (data.jam.tahapSatu == true && data.exist.tahapSatu == false) {
                    $('#overSatu').remove()
                } else if (data.jam.tahapSatu == false && data.exist.tahapSatu == false) {
                    $('#saveInfoTps').remove()
                } else if (data.jam.tahapSatu == true && data.exist.tahapSatu == true) {
                    $('#overSatu').remove()
                    $('#saveInfoTps').remove()
                    finalTahapSatu(data.data.tahapSatu)
                }
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
            // [false, true, 'c-border-left-danger'],
            [true, false, 'c-border-left-warning'],
            [true, true, 'c-border-left-success'],
        ]

        for (var i = 0; i < 3; i++) {
            if (data.jam.tahapSatu == role[i][0] && data.exist.tahapSatu == role[i][1]) {
                $(el[0]).addClass(role[i][2])
                console.log(role[i][0] + '|' + role[i][1] + '|' + role[i][2] + '|' + el[0])
            }

            if (data.jam.tahapDua == role[i][0] && data.exist.tahapDua == role[i][1]) {
                $(el[1]).addClass(role[i][2])
                console.log(role[i][0] + '|' + role[i][1] + '|' + role[i][2] + '|' + el[1])
            }
            if (data.jam.tahapTiga == role[i][0] && data.exist.tahapTiga == role[i][1]) {
                $(el[2]).addClass(role[i][2])
                console.log(role[i][0] + '|' + role[i][1] + '|' + role[i][2] + '|' + el[2])
            }
        }
    }
});
