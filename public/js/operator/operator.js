let tableOperator;

var constraintsadd = {
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
            message: "Kecamatan harus diisi"
        },
        numericality: {
            onlyInteger: true,
            greaterThan: 0,
            message: "Pilih kecamatan terlebih dahulu"
        }
    },
    kel: {
        presence: {
            message: "Kelurahan harus diisi"
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
            attribute: "pass",
            message: "Password konfirmasi harus sama"
        }
    }
};

var constraintsedit = {
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
            message: "Kecamatan harus diisi"
        },
        numericality: {
            onlyInteger: true,
            greaterThan: 0,
            message: "Pilih kecamatan terlebih dahulu"
        }
    },
    kel: {
        presence: {
            message: "Kelurahan harus diisi"
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
    }
};

$(document).ready(function () {
    $(".custom-select").select2();

    $("#kec").on("select2:select", function (e) {
        var idKec = e.params.data;
        getKelurahan(_rajaapitoken, idKec.id);
        $("#kectext").val(e.params.data.text);
    });

    $("#kel").on("select2:select", function (e) {
        $("#keltext").val(e.params.data.text);
    });

    $("#btnModalAddOperator").on("click", function () {
        localStorage.setItem("modeOperator", btoa("add"));
        $("#passwordField").show();
        getKecamatan(_rajaapitoken);
        $("#kel").empty();
        $("#kel").append(
            '<option disabled selected value="0">Pilih kecamatan terlebih dahulu</option>'
        );
        $("#kel")
            .val(0)
            .trigger("change");
        kosongkan();
        $("#btnAddOperator").html("TAMBAH");
        $("#modalOperator").modal("show");
    });

    $("#btnAddOperator").on("click", function () {
        let modeOperator = atob(localStorage.getItem("modeOperator"));
        let passValidate;
        if (modeOperator == "add") {
            passValidate = validate({
                    ikeh: $("#nama").val(),
                    tps: $("#tps").val(),
                    kec: $("#kec").val(),
                    kel: $("#kel").val(),
                    email: $("#email").val(),
                    pass: $("#pass").val(),
                    passkon: $("#passKon").val()
                },
                constraintsadd, {
                    format: "flat"
                }
            );
        } else if (modeOperator == "edit") {
            passValidate = validate({
                    ikeh: $("#nama").val(),
                    tps: $("#tps").val(),
                    kec: $("#kec").val(),
                    kel: $("#kel").val(),
                    email: $("#email").val(),
                    pass: $("#pass").val(),
                    passkon: $("#passKon").val()
                },
                constraintsedit, {
                    format: "flat"
                }
            );
        }
        if (passValidate != undefined) {
            toast(
                passValidate[0].substr(passValidate[0].indexOf(" ") + 1),
                "error"
            );
        } else {
            if (modeOperator == "add") {
                $.ajax({
                    url: apiurl + "addoperator",
                    method: "POST",
                    data: {
                        nama: $("#nama").val(),
                        tps: $("#tps").val(),
                        kec: $("#kec").val(),
                        kel: $("#kel").val(),
                        email: $("#email").val(),
                        pass: $("#pass").val(),
                        kectext: $("#kectext").val(),
                        keltext: $("#keltext").val(),
                        _token: _token
                    },
                    beforeSend: function () {
                        nstart();
                    },
                    success: function (data) {
                        ndone();
                        if (data == "x") {
                            return a(
                                "Gagal !",
                                "Email yang anda masukkan sudah terdaftar, silahkan coba lagi!",
                                "error"
                            );
                        } else {
                            $("#modalOperator").modal("hide");
                            kosongkan();
                            tableOperator.ajax.reload();
                            toast('Berhasil menambahkan operator')
                        }
                    }
                });
            } else if (modeOperator == "edit") {
                if (localStorage.getItem('idoperator') == '') {
                    toast("Sesuatu error terjadi, harap ulangi sekali lagi !", 'error')
                } else {
                    $.ajax({
                        url: apiurl + "updateoperator",
                        method: "POST",
                        data: {
                            nama: $("#nama").val(),
                            tps: $("#tps").val(),
                            kec: $("#kec").val(),
                            kel: $("#kel").val(),
                            kectext: $("#kectext").val(),
                            keltext: $("#keltext").val(),
                            email: $("#email").val(),
                            _token: _token,
                            id: atob(localStorage.getItem('idoperator')),
                            isChange: atob(localStorage.getItem('isChange'))
                        },
                        beforeSend: function () {
                            nstart();
                        },
                        success: function (data) {
                            ndone();
                            if (data == "x") {
                                return a(
                                    "Gagal !",
                                    "Email yang anda masukkan sudah terdaftar, silahkan coba lagi!",
                                    "error"
                                );
                            } else {
                                $("#modalOperator").modal("hide");
                                tableOperator.ajax.reload();
                                toast('Berhasil mengubah data !')
                            }
                        }
                    });
                }
            } else {
                toast("Sesuatu error terjadi, harap ulangi sekali lagi !", 'error')
            }
        }
    });

    $('#email').on('keyup', function () {
        if (atob(localStorage.getItem('modeOperator')) == 'edit') {
            localStorage.setItem('isChange', btoa(true))
        }
    })

    tableOperator = $("#tableOperator").DataTable({
        ajax: apiurl + "getoperator",
        processing: true,
        serverSide: true,
        columns: [{
                data: "nama",
                name: "nama"
            },
            {
                data: "tps",
                name: "tps"
            },
            {
                data: null,
                name: "kectext",
                render: function (data) {
                    return kapital(data.kectext);
                }
            },
            {
                data: null,
                name: "keltext",
                render: function (data) {
                    return kapital(data.keltext);
                }
            },
            {
                data: "email",
                name: "email"
            },
            {
                orderable: false,
                data: null,
                name: "aksi",
                render: function (data) {
                    var btn = "";
                    btn +=
                        '<button class="btn btn-warning btn-sm mr-1" onclick="editoperator(' +
                        data.id +
                        ')"><i class="fas fa-edit fa-xs text-white"></i></button>';
                    btn +=
                        '<button class="btn btn-danger btn-sm" onclick="deleteoperator(' +
                        data.id +
                        ')"><i class="fas fa-trash fa-xs"></i></button>';
                    return btn;
                }
            }
        ]
    });
});

function getKecamatan(token, callback = false, selection = null, idkel = null) {
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
            if (callback) {
                $("#kec")
                    .val(selection)
                    .trigger("change");
                getKelurahan(_rajaapitoken, selection, callback, idkel);
            }
        },
        timeout: 3000,
        error: function (e) {
            if (e.statusText == "timeout") {
                toast(
                    "Koneksi internet anda lemot, silahkan coba lagi !",
                    "warning"
                );
            }
            ndone();
        }
    });
}

function getKelurahan(token, idKec, callback = null, selection = null) {
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
            if (callback) {
                $("#kel")
                    .val(selection)
                    .trigger("change");
            }
        },
        timeout: 3000,
        error: function (e) {
            if (e.statusText == "timeout") {
                toast(
                    "Koneksi internet anda lemot, silahkan coba lagi !",
                    "warning"
                );
            }
            ndone();
        }
    });
}

function deleteoperator(id) {
    Swal.fire({
        title: "Peringatan !",
        text: "Apakah anda yakin ingin menghapus data .?",
        type: "warning",
        showCancelButton: true
    }).then(res => {
        if (res.value) {
            $.ajax({
                url: apiurl + "deleteoperator",
                method: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                beforeSend: function () {
                    nstart();
                },
                success: function () {
                    ndone();
                    tableOperator.ajax.reload();
                    toast("Berhasil menghapus data !", "success");
                }
            });
        }
    });
}

function editoperator(id) {
    $("#passwordField").hide();
    $("#btnAddOperator").html("SIMPAN");

    localStorage.setItem("modeOperator", btoa('edit'));
    localStorage.setItem("isChange", btoa(false));

    $.ajax({
        url: apiurl + "getoperator/" + id + "",
        method: "POST",
        data: {
            id: id,
            _token: _token
        },
        beforeSend: function () {
            kosongkan();
            nstart();
        },
        success: function (data) {
            ndone();
            getKecamatan(_rajaapitoken, true, data.kec, data.kel);

            $("#nama").val(data.nama);
            $("#tps").val(data.tps);
            $("#email").val(data.email);
            $("#kectext").val(data.kectext);
            $("#keltext").val(data.keltext);
            $("#modalOperator").modal("show");
            localStorage.setItem('idoperator', btoa(id))
        }
    });
}

function kosongkan() {
    $("#nama").val("");
    $("#tps").val("");
    $("#email").val("");
    $("#pass").val("");
    $("#passKon").val("");
    $("#kec")
        .val(null)
        .trigger("change");
    $("#kel")
        .val(null)
        .trigger("change");
    $("#kel").empty();
    $("#kel").append(
        '<option disabled selected value="0">Pilih kecamatan terlebih dahulu</option>'
    );
    $("#kel").select2();
}
