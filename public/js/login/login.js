$(() => {
    let btnLogin = $('#btnLogin')

    btnLogin.on('click', function () {
        let email, pass

        email = $('#email').val()
        pass = $('#pass').val()

        if (email == '' || pass == '') {
            return toast('Harus di isi semuanya !', 'error')
        }

        if (valEmail(email)) {
            $.ajax({
                url: apiurl + 'dologin',
                method: 'POST',
                data: {
                    email: email,
                    pass: pass,
                    _token: _token
                },
                beforeSend: function () {
                    setLoading(btnLogin, 'Login')
                    nstart()
                },
                success: function (res) {
                    ndone()
                    setLoading(btnLogin, 'Login')
                    if (res == 'admin') {
                        Swal.fire('Berhasil !', 'Anda berhasil login, selamat datang pak !', 'success').then((res) => {
                            direct('dashboard')
                        })
                    } else if (res == 'ope') {
                        Swal.fire('Berhasil !', 'Anda berhasil login, selamat datang pak !', 'success').then((res) => {
                            direct('/o/dashboard')
                        })
                    } else {
                        swal('Gagal !', 'Email dan password anda asalah, silahakan coba lagi !', 'error')
                    }
                }
            })

        } else {
            toast('Format email harus benar !', 'error')
        }

    })
})
