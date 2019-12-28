$(() => {
    let btnLogin = $('#btnLogin')

    btnLogin.on('click', function () {
        let email, pass

        email = $('#email').val()
        pass = $('#pass').val()

        setLoading(btnLogin, 'Login')
    })
})
