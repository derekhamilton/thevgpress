$(document).ready(function()
{
    /*
        Handle form submissions through AJAX
        Data is serialized and posted to the action address
        Error messages prevent redirects or reloads
     */
    $('form.ajax').submit(function()
    {
        var form = $(this);
        $.post($(this).attr('action'), $(this).serialize())
            .done(function(data)
            {
                try
                {
                    var json = $.parseJSON(data);
                    var messages = json.messages;

                    if (
                        typeof messages != "undefined"
                            && typeof messages.errors != "undefined"
                    )
                    {
                        showMessages(messages);
                    }
                    else
                    {
                        if (typeof json.redirect != "undefined")
                            window.location = json.redirect;
                        else if (json.refresh)
                            location.reload();
                        else
                            showMessages(messages);
                    }

                    var callback = form.data('callback-success');
                    if (callback) {
                        callback(json);
                    }
                }
                catch (e)
                {
                    // invalid JSON
                    showMessages({messages:{errors:{0:e}}});
                    var callback = form.data('callback-error');
                    if (callback) {
                        callback($data);
                    }
                }
            });

        return false;
    });

    $.ajaxPrefilter(function(options, originalOptions, jqXHR)
    {
        // disable button and show loading
        var btns = $('input[type=submit].btn');
        //btns.button('loading');
        jqXHR.done(function()
        {
            btns.button('reset');
        });

        jqXHR.fail(function(data)
        {
            showMessages({messages:{errors:{0:data.responseText}}});
        });
    });

    if ($('.chat').length > 0)
    {
        $('.chat').click(function()
        {
        });
    }

    if ($('#login-modal').length > 0) // login exists
    {
        $('.login').click(function()
        {
            $('#login-modal').modal('show');
            return false;
        });
    }

    if ($('#chat-modal').length > 0)
    {
        $('.chat').click(function()
        {
            $('#chat-modal .modal-body').load('/chat', function()
            {
                $('#chat-modal').modal('show');
            });
            return false;
        });
    }

    // autofocus in modal -- html5 autofocus doesn't
    // function properly with the modal
    $('.modal').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    });
});

/**
 * Display messages in appropriate alert
 *
 * Messages take the form of
 * { messages: { errors: {}, successes: {}, etc. } }
 */
function showMessages(messages)
{
    for (var type in messages)
    {
        for (var target in messages[type])
        {
            var list = '<ul>';
            for (var i in messages[type][target])
            {
                list += '<li>' + messages[type][target][i] + '</li>';
            }
            list += '</ul>';
            $('#'+target).html(list).hide().fadeIn();
            $('html, body').animate({
                scrollTop: $('#'+target).offset().top
            }, 500);
        }
    }
}
