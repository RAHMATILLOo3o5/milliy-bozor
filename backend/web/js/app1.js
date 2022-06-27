$(document).ready(function () {
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $('.view-modal').on('click', function (e) {
        e.preventDefault();
        $('.create-modal').modal('show');

        send($(this).attr('href'));
    });

    $('.create').on('click', function (e) {
        e.preventDefault();
        $('.create-modal').modal('show');

        send($(this).attr('href'));
    });

    $('.updated-modal').on('click', function (e) {
        e.preventDefault();
        $('.create-modal').modal('show');

        send($(this).attr('href'));
    });

    function send(url) {
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data) {
                    $('.render-form').html(data);
                }
            }
        });
    }

});