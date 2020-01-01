let rajaApiToken
$.ajax({
    url: 'https://x.rajaapi.com/poe',
    beforeSend: function () {
        nstart()
    },
    success: function (d) {
        ndone()
        rajaApiToken = d.token
    }
})
