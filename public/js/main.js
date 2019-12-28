function setLoading(el, text) {
    if (el.attr('is-loading') == '' || el.attr('is-loading') == undefined) {
        el.attr('is-loading', 'true')
        el.attr('disabled', '')
        el.html('<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>')
    } else if (el.attr('is-loading') == 'true') {
        el.removeAttr('is-loading', '')
        el.removeAttr('disabled')
        el.html(text)
    }
}
