$(document).ready(function () {
    $("#country_id").on('change', function () {
        var countryId = $(this).val();
        if(countryId){
            $("#turn_the_loader").removeClass('d-none');
            var URL = APP_URL+'/admin/auth/get-states-list/'+countryId;

            var getParams = {};

            $.get(URL, getParams).done(function (response) {
                if(response.status_code == 200){
                    $("#state_id").empty();
                    $("#state_id").append(
                        "<option value='' selected='selected'>Select State</option>"
                    );
                    $.each(response.data, function (index, state) {
                        $("#state_id").append(
                            "<option value='"+state.id+"'>"+state.name+"</option>"
                        );
                    });
                    $("#turn_the_loader").addClass('d-none');
                }else {
                    $("#turn_the_loader").addClass('d-none');
                    alert('Something went wrong please reload the page and try again.')
                    return false;
                }
            }).fail(function (response) {
                $("#turn_the_loader").addClass('d-none');
                alert('Something went wrong please reload the page and try again.')
                return false;
            });
        }

    });

    $(document).on('blur', '#email', function () {
        var email = $("#email").val().trim();
        if(email){
            if(validateEmail(email)){
                $("#turn_the_loader").removeClass('d-none');
                var getParams = {};
                var URL = APP_URL+'/admin/auth/check-email/'+email;

                $.get(URL, getParams, function(response) {
                    if(response){
                        if(response.status_code == 200){
                            $("#check_email").val('n');
                            $("#email").addClass('border border-danger').next('.user_validation_error').removeClass('text-success').addClass('text-danger').html('The provided email is already exists.');
                            $("#turn_the_loader").addClass('d-none');
                        }else if(response.status_code == 204){
                            $("#check_email").val('y');
                            $("#email").removeClass('border border-danger').next('.user_validation_error').removeClass('text-danger').addClass('text-success').html('The email is available to take.');
                            $("#turn_the_loader").addClass('d-none');
                        }else {
                            alert('Something went wrong, please reload the page and try again.')
                        }
                    }else {
                        alert('Something went wrong, please reload the page and try again.')
                    }
                });
            }
        }
    });

    $(document).on('blur', '#username', function () {
        var username = $("#username").val().trim();
        if(username){
            $("#turn_the_loader").removeClass('d-none');
            var getParams = {};
            var URL = APP_URL+'/admin/auth/check-username/'+username;

            $.get(URL, getParams, function(response) {
                if(response){
                    if(response.status_code == 200){
                        $("#check_username").val('n');
                        $("#username").addClass('border border-danger').next('.user_validation_error').removeClass('text-success').addClass('text-danger').html('The provided username is already exists.');
                        $("#turn_the_loader").addClass('d-none');
                    }else if(response.status_code == 204){
                        $("#check_username").val('y');
                        $("#username").removeClass('border border-danger').next('.user_validation_error').removeClass('text-danger').addClass('text-success').html('The username is available to take.');
                        $("#turn_the_loader").addClass('d-none');
                    }else {
                        alert('Something went wrong, please reload the page and try again.')
                    }
                }else {
                    alert('Something went wrong, please reload the page and try again.')
                }
            });
        }
    });

    $(document).on('click', '#create_user_btn', function (e) {
        e.preventDefault();
        $(".user_validation_error").empty();
        $('.form-control').removeClass('border border-danger');
        var focus_on = false;

        var first_name = $("#first_name").val().trim();
        var last_name = $("#last_name").val().trim();
        var email = $("#email").val().trim();
        var username = $("#username").val().trim();
        var password = $("#password").val().trim();
        var password_confirmation = $("#password_confirmation").val().trim();
        var dob = new Date(Date.parse($("#dob").val()));
        var country_id = $("#country_id").val();
        var state_id = $("#state_id").val();
        var city = $("#city").val().trim();
        var address = $("#address").val().trim();
        var check_username = $("#check_username").val();
        var check_email = $("#check_email").val();
        var TodayDate = new Date();

        if(!first_name){
            $("#first_name").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Please provide user first name');
            if(!focus_on)
            {
                $('#first_name').focus();
                focus_on = true;
            }
        }
        if(!last_name){
            $("#last_name").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Please provide user last name');
            if(!focus_on)
            {
                $('#last_name').focus();
                focus_on = true;
            }
        }
        if(!email){
            $("#email").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Please provide user email');
            if(!focus_on)
            {
                $('#email').focus();
                focus_on = true;
            }
        }else if(!validateEmail(email)){
            $("#email").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Please provide a valid email');
            if(!focus_on)
            {
                $('#email').focus();
                focus_on = true;
            }
        }else if(check_email == 'n'){
            $("#email").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('The provided email is already exists');
            if(!focus_on)
            {
                $('#email').focus();
                focus_on = true;
            }
        }
        if(!username){
            $("#username").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Please provide username');
            if(!focus_on)
            {
                $('#username').focus();
                focus_on = true;
            }
        }else if(check_username == 'n'){
            $("#username").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('The provided username is already exists');
            if(!focus_on)
            {
                $('#username').focus();
                focus_on = true;
            }
        }
        if(!password || password.length < 6){
            $("#password").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Please provide at least 6 characters long password');
            if(!focus_on)
            {
                $('#password').focus();
                focus_on = true;
            }
        }
        if(!password_confirmation){
            $("#password_confirmation").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Please confirm the password');
            if(!focus_on)
            {
                $('#password_confirmation').focus();
                focus_on = true;
            }
        }else if(password_confirmation !== password){
            $("#password_confirmation").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Confirm password mismatched!');
            if(!focus_on)
            {
                $('#password_confirmation').focus();
                focus_on = true;
            }
        }
        if(!dob || (dob == 'Invalid Date')){
            $("#dob").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Please provide a valid user Date of Birth');
            if(!focus_on)
            {
                $('#dob').focus();
                focus_on = true;
            }
        }else if(dob > TodayDate){
            $("#dob").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Please provide a valid user Date of Birth and also the date should be before today\'s date');
            if(!focus_on)
            {
                $('#dob').focus();
                focus_on = true;
            }
        }
        if(!country_id){
            $("#country_id").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Please provide user Country');
            if(!focus_on)
            {
                $('#country_id').focus();
                focus_on = true;
            }
        }
        if(!state_id){
            $("#state_id").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Please provide user State');
            if(!focus_on)
            {
                $('#state_id').focus();
                focus_on = true;
            }
        }
        if(!city){
            $("#city").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Please provide user city');
            if(!focus_on)
            {
                $('#city').focus();
                focus_on = true;
            }
        }
        if(!address){
            $("#address").addClass('border border-danger').next('.user_validation_error').addClass('text-danger').html('Please provide user address');
            if(!focus_on)
            {
                $('#address').focus();
                focus_on = true;
            }
        }
        if(!focus_on){
            $("#create_user_form").submit();
        }
    })

    /**
     *
     * @param email
     * @returns {boolean}
     */
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
});
