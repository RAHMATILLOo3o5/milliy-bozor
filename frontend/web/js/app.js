$(document).ready(function () {
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    let like = $('.like-active');
    if (like.hasClass('active')) {
        $(this).attr('data-original-title', 'Saralanganlardan o\'chirish');
    } else {
        $(this).attr('data-original-title', 'Saralanganlara qo\'shish');
    }
    $('.spam').on('click', function (event) {
        event.preventDefault();
        $('#myModal').modal('show');
        let url = $(this).attr('href');
        send(url);
    });
    $('.like-active').on('click', function (event) {
        event.preventDefault();
        let url = $(this).parent().attr('href');
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $(this).parent().attr('data-original-title', 'Saralanganlardan o\'chirish');
        } else {
            $(this).parent().attr('data-original-title', 'Saralanganlara qo\'shish');
        }

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
            }
        });
    });

    function send(_url) {
        $.ajax({
            url: _url,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
            }
        });
    }

    var sendButton = $('.send');
    var messageText = $('#message-text');
    messageText.keyup(function () {
        if (messageText.val() !== '') {
            sendButton.removeClass('disabled');
        } else {
            sendButton.addClass('disabled');
        }
    });
    var alert = $('#message-alert');
    $('#message-form').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let formData = new FormData(form[0]);
        if (messageText.val() !== '') {
            sendMessage(form, formData);
            messageText.val('');
            sendButton.addClass('disabled');
            return false;
        } else {
            return false;
        }
    });

    function sendMessage(form, formData) {
        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status === 200) {
                    alert.removeClass('d-none');
                    return false;
                } else {
                    alert.addClass('d-none');
                    return false;
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
});