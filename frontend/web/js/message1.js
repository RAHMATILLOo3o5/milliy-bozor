$(document).ready(function () {
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    var user = $('.chat-list_content');
    var chatRoom = $('#chat-message');
    var note = $('.note');
    var messageText = $('#chat-text');

    $('.select_user').on('click', function (e) {
        e.preventDefault();
        note.children('.text-info').addClass('d-none');
        note.children('span').removeClass('d-none');
        let selectUser = $(this).children('.chat-list_content');
        if (user.hasClass('active')) {
            user.removeClass('active');
        }
        $.ajax({
            type: 'POST',
            url: $(this).attr('href'),
            dataType: 'json',
            success: function (data) {
                if (data.status === 200) {
                    note.children('span').addClass('d-none');
                    selectUser.addClass('active');
                    chatRoom.html(data.content);
                    return false;
                } else {
                    note.children('span').addClass('d-none');
                    note.children('.text-danger').removeClass('d-none');
                    return false;
                }
            }
        });
    });



});