<script>
    $('textarea[name="email_body"]').hide();
    $('label[for="email_body"]').hide();
    $('textarea[name="text_body"]').hide();
    $('label[for="text_body"]').hide();
$(document).ready(function() {
    $('textarea[name="email_body"]').hide();
    $('label[for="email_body"]').hide();
    $('textarea[name="email_body"]').attr('required', true);
    
    $('textarea[name="text_body"]').hide();
    $('label[for="text_body"]').hide();
    $('textarea[name="text_body"]').attr('required', true);
    
    function toggleEmailBody() {
        let cohortId = $('select[name="cohort_id"]').val();
        let sendEmail = cohorts[cohortId].send_email;
        
        if (sendEmail) {
            $('textarea[name="email_body"]').show();
            $('label[for="email_body"]').show();
            $('textarea[name="email_body"]').attr('required', true);
        } else {
            $('textarea[name="email_body"]').hide();
            $('label[for="email_body"]').hide();
            $('textarea[name="email_body"]').removeAttr('required');
        }
    }
    
    function toggleTextBody() {
        let cohortId = $('select[name="cohort_id"]').val();
        let sendText = cohorts[cohortId].send_text;
        
        if (sendText) {
            $('textarea[name="text_body"]').show();
            $('label[for="text_body"]').show();
            $('textarea[name="text_body"]').attr('required', true);
        } else {
            $('textarea[name="text_body"]').hide();
            $('label[for="text_body"]').hide();
            $('textarea[name="text_body"]').removeAttr('required');
        }
    }
    
    let cohorts = {!! json_encode(\App\Models\Cohort::where('is_active', true)->get(['id', 'name', 'send_email', 'send_text'])) !!}.reduce(function(map, obj) {
        map[obj.id] = {name: obj.name, send_email: obj.send_email, send_text: obj.send_text};
        return map;
    }, {});
    
    let options = Object.keys(cohorts).map(function(id) {
        return {id: id, text: cohorts[id].name};
    });
    
    $('select[name="cohort_id"]').select2({data: options});
    
    $(document).on('change', 'select[name="cohort_id"]', function() {
        toggleEmailBody();
        toggleTextBody();
    });
    
    toggleEmailBody();
    toggleTextBody();
});

</script>
