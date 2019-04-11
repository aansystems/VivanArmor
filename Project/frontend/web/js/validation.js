/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// created by bharath

$('#user-email').change(function () {
    email = this.value;

    $.get('email-validation', {email: email}, function (data) {
        if (data == 1) {
            text = "Email  already exists!";
            $('.help-inline[for="signupemail"]').html(text).css({color: 'red'});
            $('#user-email').val('');
            $('.help-inline').val('');
        } else if (data == 0) {
            $('.help-inline[for="signupemail"]').html("");
        }
    });
});



$('#user-phone').change(function () {
    phone = this.value;

    $.get('phone-validation', {phone: phone}, function (data) {
        if (data == 1) {
            text = "Mobile Number  already exist!";
            $('.help-inline[for="signupmobile"]').html(text).css({color: 'red'});
            $('#user-phone').val('');
            $('.help-inline').val('');
        } else if (data == 0) {
            text = "Mobile Number is not valid!";
            $('.help-inline[for="signupmobile"]').html(text).css({color: 'red'});
            $('#user-phone').val('');
            $('.help-inline').val('');
        } else if (data == 2) {
            $('.help-inline[for="signupmobile"]').html("");
        }
    });
});
$('#address-country').change(function () {
    country_id = $(this).val();
    $.get('get-states-list', {id: country_id}, function (data) {
        $('#address-state').html(data);
        $('#address-city').html("");
    });
    $.get('get-phonecode', {id: country_id}, function (data) {
        $('#user-phone_code').val(data);
    });
    $('#address-state').change(function () {
        state_id = $(this).val();
        $.get('get-cities-list', {id: state_id}, function (data) {
            $('#address-city').html(data);
        });
    });

});
    //validations for branch 
 $('#branchmanagers-branch_id').change(function() {
    branch_name = this.value;
       
    $.get('branch-validation', {branch_name : branch_name}, function(data){         
        if(data == 1) {
            text = " Branch Manager already assigned to this Branch. Please select different Branch!";
            $('.help-inline[for="signupbranch"]').html(text).css({color:'red'});
             $('#branchmanagers-branch_id').val('');
          $('.help-inline').val('');
        }
        else if(data == 0) {
            $('.help-inline[for="signupbranch"]').html("");
        }
    });
});


        $('#address-city').change(function() {
            city_id = $(this).val();
            $.get('get-areacode', { id : city_id}, function(data){          
            $('#company-area_code').val(data);
            });
        });

     //validations for company website
        $('#company-website').change(function() {
    website = this.value;
       
    $.get('website-validation', {website : website}, function(data){ 
        if(data == 1) {
            text = "Website already exists!";
            $('.help-inline[for="signupwebsite"]').html(text).css({color:'red'});
            $('#company-website').val('');
          $('.help-inline').val('');
        }
        else if(data == 0) {
            $('.help-inline[for="signupwebsite"]').html("");
        }
    });
});