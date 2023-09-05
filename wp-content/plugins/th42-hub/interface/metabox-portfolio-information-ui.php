<div class="row">
    <div class="col-md-6">
        <label for="name" class="fw-bold">Name <span class="text-danger">*</span></label>
        <input id="name" class="form-control" name="name">
        <span id="error_name" class="text-danger"></span>
    </div>
    <div class="col-md-6">
        <label for="account_name" class="fw-bold">Account name</label>
        <input id="account_name" class="form-control" name="account_name">
    </div>
    <div class="col-md-6">
        <label for="major" class="fw-bold">Major</label>
        <input id="major" class="form-control" name="major">
    </div>
    <div class="col-md-6">
        <label for="phone" class="fw-bold">Phone</label>
        <input id="phone" class="form-control" name="phone">
        <span id="error_phone" class="text-danger"></span>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        function validateForm() {
            let status = true;
            const name = $("input[name='name']").val();
            const phone = $("input[name='phone']").val();
            const subject = $("input[name='post_title']").val()

            //validate name
            if (name.length == 0) {
                $('#error_name').html('Please enter name')
                status = false;
            }

            //validate subject
            if (subject.length == 0) {
                $('#titlewrap').append('<span class="text-danger">Please enter subject</span>');
                status =  false;
            }

            //validate phone
            var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
            if (!vnf_regex.test(phone) && phone.length!=0) {
                $('#error_phone').html('Phone enter wrong format, please enter phone again')
                status = false;
            }      

            return status;
        }

        $('#post').submit(function(e) {
            const statusSubmit = validateForm();
            if (!statusSubmit) {
                e.preventDefault();
            }
        })
    })
</script>