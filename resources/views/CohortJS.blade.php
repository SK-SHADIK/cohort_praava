<!-- <script>
$(document).ready(function() {
    $('textarea[name="email_body"]').show();
    $('label[for="email_body"]').show();
    $('textarea[name="text_body"]').show();
    $('label[for="text_body"]').show();
    $('textarea[name="email_body"]').hide();
    $('label[for="email_body"]').hide();
    $('textarea[name="text_body"]').hide();
    $('label[for="text_body"]').hide();

    $('select[name="cohort_id"]').change(function() {
        let cohortId = $(this).val();

        $.ajax({
            url: '/admin/cohortid/' + cohortId,
            method: 'GET',
            success: function(response) {
                let sendEmail = response['send_email'];
                let sendText = response['send_text'];
                
                if (sendEmail == true) {
                    $('textarea[name="email_body"]').show();
                    $('label[for="email_body"]').show();
                    $('textarea[name="email_body"]').attr('required', true);
                } else {
                    $('textarea[name="email_body"]').hide();
                    $('label[for="email_body"]').hide();
                    $('textarea[name="email_body"]').removeAttr('required');
                }

                if (sendText == true) {
                    $('textarea[name="text_body"]').show();
                    $('label[for="text_body"]').show();
                    $('textarea[name="text_body"]').attr('required', true);
                } else {
                    $('textarea[name="text_body"]').hide();
                    $('label[for="text_body"]').hide();
                    $('textarea[name="text_body"]').removeAttr('required');
                }
            }
        });
    });
});
</script> -->
