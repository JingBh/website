window.Popper = require('popper.js').default;

window.$ = window.jQuery = require('jquery');

require('bootstrap');

$.ajaxSetup({
    beforeSend: function(xhr, options) {
        options.url = "/autozp/" + options.url;
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
