$.fn.select2.defaults.set("theme", "bootstrap");

let tableOperator

var constraints = {
    ikeh: {
        presence: {
            message: "Nama wajib di isi"
        },
        length: {
            minimum: 3,
            message: "Nama harus lebih dari 3 karakter"
        }
    },
    tps: {
        presence: true,
        numericality: {
            onlyInteger: true,
            greaterThan: 0,
            message: "Nomer TPS harus di isi lebih dari 0"
        }
    },
    kec: {
        presence: {
            message: 'Kecamatan harus diisi'
        },
        numericality: {
            onlyInteger: true,
            greaterThan: 0,
            message: "Pilih kecamatan terlebih dahulu"
        }
    },
    kel: {
        presence: {
            message: 'Kelurahan harus diisi'
        },
        numericality: {
            onlyInteger: true,
            greaterThan: 0,
            message: "Pilih kelurahan terlebih dahulu"
        }
    },
    email: {
        presence: true,
        email: {
            message: "Format email harus benar"
        }
    },
    pass: {
        presence: true,
        length: {
            minimum: 6,
            message: "Password harus lebih dari 6 karakter"
        }
    },
    passkon: {
        presence: true,
        equality: {
            attribute: 'pass',
            message: 'Password konfirmasi harus sama'
        }
    }
};

$(document).ready(function () {
    let rajaApiToken;

    $(".custom-select").select2();

    $("#kec").on("select2:select", function (e) {
        var idKec = e.params.data;
        getKelurahan(rajaApiToken, idKec.id);
        $('#kectext').val(e.params.data.text)
    });

    $("#kel").on("select2:select", function (e) {
        $('#keltext').val(e.params.data.text)
    });

    $("#btnModalAddOperator").on("click", function () {

        setLoading($(this), 'TAMBAH OPERATOR')
        $.ajax({
            url: "https://x.rajaapi.com/poe",
            beforeSend: function () {
                nstart();
            },
            success: function (d) {
                ndone();
                rajaApiToken = d.token;
                getKecamatan(rajaApiToken);
                $("#modalOperator").modal("show");
                setLoading($('#btnModalAddOperator'), 'TAMBAH OPERATOR')
            },
            timeout: 3000,
            error: function (e) {
                if (e.statusText == 'timeout') {
                    toast('Koneksi internet anda lemot, silahkan coba lagi !', 'warning')
                }
                ndone()
                setLoading($('#btnModalAddOperator'), 'TAMBAH OPERATOR')
            }
        });
    });

    $("#btnAddOperator").on("click", function () {
        var passValidate = validate({
                ikeh: $("#nama").val(),
                tps: $("#tps").val(),
                kec: $("#kec").val(),
                kel: $("#kel").val(),
                email: $("#email").val(),
                pass: $("#pass").val(),
                passkon: $("#passKon").val(),
            },
            constraints, {
                format: "flat"
            }
        );
        if (passValidate != undefined) {
            toast(passValidate[0].substr(passValidate[0].indexOf(" ") + 1), 'error')
        } else {
            $.ajax({
                url: '/api/api/addoperator',
                method: 'POST',
                data: {
                    nama: $("#nama").val(),
                    tps: $("#tps").val(),
                    kec: $("#kec").val(),
                    kel: $("#kel").val(),
                    email: $("#email").val(),
                    pass: $("#pass").val(),
                    kectext: $('#kectext').val(),
                    keltext: $('#keltext').val(),
                },
                beforeSend: function () {
                    nstart()
                },
                success: function (data) {
                    ndone()
                    if (data == 'x') {
                        return a('Gagal !', 'Email yang anda masukkan sudah terdaftar, silahkan coba lagi!', 'error')
                    } else {
                        $('#modalOperator').modal('hide');
                        $('#nama').val('')
                        $('#tps').val('')
                        $('#email').val('')
                        $('#pass').val('')
                        $('#passKon').val('')
                        $('#kec').val(null).trigger('change')
                        $('#kel').val(null).trigger('change')
                        $("#kel").empty();
                        $("#kel").append(
                            '<option disabled selected value="0">Pilih kecamatan terlebih dahulu</option>'
                        );
                        $("#kel").select2();
                        tableOperator.ajax.reload()
                    }
                }
            })
        }
    });


    tableOperator = $('#tableOperator').DataTable({
        ajax: '/api/api/getoperator',
        processing: true,
        serverSide: true,
        columns: [{
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'tps',
                name: 'tps'
            },
            {
                data: null,
                name: 'kectext',
                render: function (data) {
                    return kapital(data.kectext)
                }
            },
            {
                data: null,
                name: 'keltext',
                render: function (data) {
                    return kapital(data.keltext)
                }
            },
            {
                data: 'email',
                name: 'email'
            }, {
                data: null,
                name: 'aksi',
                render: function (data) {
                    var btn = ''
                    btn += '<button class="btn btn-danger btn-sm" onclick="deleteoperator(' + data.id + ')"><i class="fas fa-trash fa-xs"></i></button>'
                    return btn
                }
            }
        ]
    })
});

function getKecamatan(token) {
    $.ajax({
        url: "https://x.rajaapi.com/MeP7c5ne" +
            token +
            "/m/wilayah/kecamatan?idkabupaten=3523",
        method: "GET",
        beforeSend: function () {
            nstart();
        },
        success: function (data) {
            ndone();
            $("#kec").empty();
            $("#kec").append(
                '<option disabled selected value="0">Silahkan pilih kecamatan</option>'
            );
            $.each(data.data, function (i, d) {
                $("#kec").append(
                    '<option value="' + d.id + '">' + d.name + "</option>"
                );
            });
            $("#kec").select2();
        },
        timeout: 3000,
        error: function (e) {
            if (e.statusText == 'timeout') {
                toast('Koneksi internet anda lemot, silahkan coba lagi !', 'warning')
            }
            ndone()
        }
    });
}

function getKelurahan(token, idKec) {
    $.ajax({
        url: "https://x.rajaapi.com/MeP7c5ne" +
            token +
            "/m/wilayah/kelurahan?idkecamatan=" +
            idKec +
            "",
        method: "GET",
        beforeSend: function () {
            nstart();
        },
        success: function (data) {
            ndone();
            $("#kel").empty();
            $("#kel").append(
                '<option disabled selected value="0">Silahkan pilih kelurahan</option>'
            );
            $.each(data.data, function (i, d) {
                $("#kel").append(
                    '<option value="' + d.id + '">' + d.name + "</option>"
                );
            });
            $("#kel").select2();
        },
        timeout: 3000,
        error: function (e) {
            if (e.statusText == 'timeout') {
                toast('Koneksi internet anda lemot, silahkan coba lagi !', 'warning')
            }
            ndone()
        }
    });
}


function deleteoperator(id) {
    Swal.fire({
        title: 'Peringatan !',
        text: 'Apakah anda yakin ingin menghapus data .?',
        type: 'warning',
        showCancelButton: true
    }).then((res) => {
        if (res.value) {
            $.ajax({
                url: '/api/api/deleteoperator',
                method: 'POST',
                data: {
                    id: id
                },
                beforeSend: function () {
                    nstart()
                },
                success: function () {
                    ndone()
                    tableOperator.ajax.reload()
                    toast('Berhasil menghapus data !', 'success')
                }
            })
        }
    });

}
