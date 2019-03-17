$(document).ready(function () {
    $('body').on('click', '.news-item a', function () {
        $.post('/news/click', { id: $(this).data('id'), _token: CSRF_TOKEN });
    });
});
