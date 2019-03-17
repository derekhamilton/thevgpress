$(document).ready(function () {
    $('#newsForm').data('callback-success', function (json) {
        if (typeof json.data !== 'undefined') {
            $('.day-container:last-child .day-news').prepend(atob(json.data[0]));
        }
    });
});
