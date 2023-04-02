<script>
$(document).ready(function() {
    $('textarea[name="email_body"]').attr('required', true);
    $('.send_email').change(function() {
        if ($('.send_email').is(':checked')) {
            $('textarea[name="email_body"]').show();
            $('label[for="email_body"]').show();
            $('textarea[name="email_body"]').attr('required', true);
        } else {
            $('textarea[name="email_body"]').hide();
            $('label[for="email_body"]').hide();
            $('textarea[name="email_body"]').removeAttr('required');
        }
    });
    if (!$('.send_email').is(':checked')) {
        $('textarea[name="email_body"]').hide();
        $('label[for="email_body"]').hide();
    }
});
$(document).ready(function() {
    $('textarea[name="text_body"]').attr('required', true);
    $('.send_text').change(function() {
        if ($('.send_text').is(':checked')) {
            $('textarea[name="text_body"]').show();
            $('label[for="text_body"]').show();
            $('textarea[name="text_body"]').attr('required', true);
        } else {
            $('textarea[name="text_body"]').hide();
            $('label[for="text_body"]').hide();
            $('textarea[name="text_body"]').removeAttr('required');
        }
    });
    if (!$('.send_text').is(':checked')) {
        $('textarea[name="text_body"]').hide();
        $('label[for="text_body"]').hide();
    }
});

</script>