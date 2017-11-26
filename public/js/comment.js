$(document).ready(function()
{
    var token = $('input[name=_token]').val();
    $('input.like').change(function()
    {
        var commentId = $(this).val();
        var params = {
            commentId: commentId,
            liked: $(this).prop('checked') ? 1 : 0,
            _token: token
        };
        $.post('/comment/like', params, function(data)
        {
            $('#comment-score-'+commentId).html(data);
        });
    });

    $('#comment').wysihtml5({
        "style": true,
        "font-size": true,
        "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
        "emphasis": true, //Italics, bold, etc. Default true
        "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
        "html": true, //Button which allows you to edit the generated HTML. Default false
        "link": true, //Button to insert a link. Default true
        "image": true, //Button to insert an image. Default true,
        "color": true, //Button to change color of font
        "stylesheets": ['/css/wysihtml5-colors.css'], //CSS stylesheets to load
        parser: function(html) {
            return html;
        }
    });

    $('button.preview').click(function()
    {
        var params = {
            comment: $('#comment').val(),
            topicId: $('#forumTopicId').val(),
            _token: token
        };
        $.post('/comment/preview', params, function(data)
        {
            $('#comment-0').remove();
            $('#comments').append(data);
            $('#comment-0 input.like').bootstrapToggle('off');
        });
    });
});
