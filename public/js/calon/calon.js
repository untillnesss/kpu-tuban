$(() => {

    let imgCrop = document.getElementById('imgCrop')
    let opCropImg = {
        responsive: true,
        viewMode: 1,
        // minContainerWidth: 466.021,
        // minContainerHeight: 466.021,
        aspectRatio: 1 / 1,
        // zoomable: false
    }

    let cropImage = new Cropper(imgCrop, opCropImg)


    $('#rotateLeft').on('click', function () {
        cropImage.rotate(-90)
    })

    $('#rotateRight').on('click', function () {
        cropImage.rotate(90)
    })

    $('#reset').on('click', function () {
        cropImage.reset()
    })


    var input = document.querySelector('input[type=file]');

    // You will receive the Base64 value every time a user selects a file from his device
    // As an example I selected a one-pixel red dot GIF file from my computer
    input.onchange = function () {
        var file = input.files[0],
            reader = new FileReader();

        reader.onloadend = function () {
            // Since it contains the Data URI, we should remove the prefix and keep only Base64 string
            // var b64 = reader.result.replace(/^data:.+;base64,/, '');
            imgCrop.src = reader.result
            cropImage.destroy();
            cropImage = new Cropper(imgCrop, opCropImg);
            imgCrop.value = null;
            $('#modalBodyFotoBupati').slideDown()
        };

        reader.readAsDataURL(file);
    };

    $('#ubahFotoBupati').on('click', function () {
        localStorage.setItem('modeFoto', btoa('bupati'))
    })

    $('#ubahFotoWakil').on('click', function () {
        localStorage.setItem('modeFoto', btoa('wakil'))
    })

    $('#getCropedImg').on('click', function () {
        var res = cropImage.getCroppedCanvas({
            width: 160,
            height: 90,
            minWidth: 256,
            minHeight: 256,
            maxWidth: 4096,
            maxHeight: 4096,
            fillColor: '#fff',
            imageSmoothingEnabled: false,
            imageSmoothingQuality: 'high',
        }).toDataURL();

        Swal.fire({
            title: "Memperoses ...",
            onBeforeOpen: () => {
                Swal.showLoading()
            },
            allowOutsideClick: false
        })

        var type = atob(localStorage.getItem('modeFoto'))
        if (type == 'bupati') {
            $('#imgBupati').attr('src', res)
            localStorage.setItem('imgBupati', res)
        } else if (type == 'wakil') {
            $('#imgWakil').attr('src', res)
            localStorage.setItem('imgWakil', res)
        }
        $('#modalBodyFotoBupati').slideUp()
        $('#modalFotoBupati').modal('hide')

        setTimeout(function () {
            toast('Berhasil mengubah foto !')
        }, 1000)
    })


    $('#btnModalCalon').on('click', function () {
        localStorage.setItem('imgBupati', '/img/poto.png')
        localStorage.setItem('imgWakil', '/img/poto.png')

        $('#imgBupati').attr('src', '/img/poto.png')
        $('#imgWakil').attr('src', '/img/poto.png')

    })

    $('#closeModalCalonBupati').on('click', function () {
        Swal.fire({
            title: 'Peringatan !',
            text: 'Apakah anda yakin ingin keluar.? Data tidak akan tersimpan !',
            type: 'warning',
            showCancelButton: true
        }).then((res) => {
            if (res.value) {
                $('#modalCalon').modal('hide')
            }
        });
    })

    $('#saveCalon').on('click', function () {
        var rule = {
            namabupati: {
                presence: {
                    message: "Nama bupati wajib di isi"
                },
                length: {
                    minimum: 3,
                    message: "Nama bupati harus lebih dari 3 karakter"
                }
            },
            namawakil: {
                presence: {
                    message: "Nama wakil bupati wajib di isi"
                },
                length: {
                    minimum: 3,
                    message: "Nama wakil bupati harus lebih dari 3 karakter"
                }
            },
        }

        var validates = validate({
                namabupati: $('#namaBupati').val(),
                namawakil: $('#namaWakil').val(),
            },
            rule, {
                format: "flat"
            }
        );

        if (validates != undefined) {
            toast(
                validates[0].substr(validates[0].indexOf(" ") + 1),
                "error"
            );
        } else {
            var data = {
                namaBupati: $('#namaBupati').val(),
                namaWakil: $('#namaWakil').val(),
                imgBupati: localStorage.getItem('imgBupati'),
                imgWakil: localStorage.getItem('imgWakil'),
                _token: _token
            }

            $.ajax({
                url: apiurl + 'addcalon',
                method: 'POST',
                data: data,
                beforeSend: function () {
                    nstart()
                },
                success: function () {
                    ndone()
                }
            })
        }
    })
})
