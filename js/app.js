$(document).ready(function() {

    $("#sign-in-link").click(function() {
        $("#sign-up-form-container").hide();
        $("#sign-in-form-container").fadeIn(500);
    });

    $("#sign-up-link").click(function() {
        $("#sign-in-form-container").hide();
        $("#sign-up-form-container").fadeIn(500);
    });

    $("#signInForm").submit(function(e) {
        e.preventDefault();
        $.post("ajax/login.php", { formData:$(this).serialize() }, function(data) {
            console.log(data);
            if(data.success === true) {
                window.location.reload();
            } else {
                errors_data = '<ul>';
                for(var i = 0; i<data.errors.length; i++)
                {
                    errors_data += '<li>' + data.errors[i] + '</li>';
                }
                errors_data += '</ul>';
                $("#signInForm .alert-errors").html(errors_data).hide().fadeIn(1000);
            }
        }, 'json');
    });

    $("#signUpForm").submit(function(e) {
        e.preventDefault();
        $.post("ajax/register.php", { formData:$(this).serialize() }, function(data) {
            console.log(data);
            if(data.success === true) {
                $("#signUpForm .alert-errors").html("").hide();
                $("#signUpForm .alert-success").html("Successful registration. Redirecting to dashboard in 3 seconds. Please wait...").fadeIn(1000);
                setTimeout(function() {
                    window.location.reload();
                }, 3000);
            }
            else {
                errors_data = '<ul>';
                for(var i = 0; i<data.errors.length; i++)
                {
                    errors_data += '<li>' + data.errors[i] + '</li>';
                }
                errors_data += '</ul>';
                $("#signUpForm .alert-errors").html(errors_data).hide().fadeIn(1000);
            }
        }, 'json');
    });

});