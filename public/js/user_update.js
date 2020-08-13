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

    $(document).on('click', '#edit_user_btn', function (e) {
        e.preventDefault();
        $(".user_validation_error").empty();
        $('.form-control').removeClass('border border-danger');
        var focus_on = false;

        var first_name = $("#first_name").val().trim();
        var last_name = $("#last_name").val().trim();
        var dob = new Date(Date.parse($("#dob").val()));
        var country_id = $("#country_id").val();
        var state_id = $("#state_id").val();
        var city = $("#city").val().trim();
        var address = $("#address").val().trim();
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
            $("#edit_user_form").submit();
        }
    })
});
