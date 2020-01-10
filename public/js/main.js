// $.ajaxSetup({
//     xhrFields: {
//         // The 'xhrFields' property sets additional fields on the XMLHttpRequest.
//         // This can be used to set the 'withCredentials' property.
//         // Set the value to 'true' if you'd like to pass cookies to the server.
//         // If this is enabled, your server must respond with the header
//         // 'Access-Control-Allow-Credentials: true'.
//         withCredentials: false
//     },
//     contentType: 'json'
// });
$.fn.select2.defaults.set("theme", "bootstrap");

function setLoading(el, text) {
    if (el.attr("is-loading") == "" || el.attr("is-loading") == undefined) {
        el.attr("is-loading", "true");
        el.attr("disabled", "");
        el.html(
            '<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>'
        );
    } else if (el.attr("is-loading") == "true") {
        el.removeAttr("is-loading", "");
        el.removeAttr("disabled");
        el.html(text);
    }
}

let apiurl = "/api/api/";

function nstart() {
    NProgress.start();
}

function ndone() {
    NProgress.done();
}

function swal(title, text, type = "success") {
    Swal.fire({
        title: title,
        text: text,
        type: type
    });
}

function includeFile(url) {
    var script = document.createElement("script"); // create a script DOM node
    script.src = url; // set its src to the provided URL

    document.body.appendChild(script); // add it to the end of the head section of the page (could change 'head' to 'body' to add it to the end of the body section instead)
}

let _token, _rajaapitoken;
$(() => {
    let btnLogout = $("#btnLogout");
    btnLogout.on("click", function() {
        direct("/dologout");
    });
    _token = $('meta[name="csrf-token"]').attr("content");

    $.ajax({
        url: "https://x.rajaapi.com/poe",
        beforeSend: function() {
            nstart();
        },
        success: function(d) {
            ndone();
            _rajaapitoken = d.token;
        }
        // timeout: 3000
        // error: function(e) {
        //     if (e.statusText == "timeout") {
        //         toast(
        //             "Koneksi internet anda lemot, silahkan refresh halaman ini !",
        //             "warning"
        //         );
        //     }
        //     ndone();
        // }
    });
});
