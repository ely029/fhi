// $.noConflict();
jQuery( document ).ready(function( $ ) {

    let error = '<span class="invalid-feedback" role="alert"><strong>Invalid credentials</strong></span>';
    let usernameInput = $("input[name='username']");
    $("#login-form").on('submit', function(e){
        e.preventDefault();
        let loginButton = $("#login-button");
        resetErrors();

        $("#loadingModal").modal('show');

        loginButton.attr('disabled', true);
        let username = usernameInput.val();
        let password = $("input[name='password']").val();
        let systemKey = $("#system_key").val();

        var encryptedUsername = CryptoJS.AES.encrypt(username, systemKey);
		var encryptedPassword = CryptoJS.AES.encrypt(password, systemKey);


        // $(".login").submit();

        let data = {
            username : encryptedUsername.toString(),
            password : encryptedPassword.toString(),
        };
        // let data = {
        //     username : username,
        //     password : password,
        // };
     
        $.get("/itis/login", data, function(response) {
    
            if(response.data == 'Not Authorized'){
                $("#loadingModal").modal('hide');
                usernameInput.parent().addClass('has-error').append(error);
            }
            if(response == 'Success'){
                window.location.href = '/role/request';
            }
            loginButton.removeAttr('disabled');
        }).fail(function() {
            console.error('failed');
            $("#loadingModal").modal('hide');
            loginButton.removeAttr('disabled');
        });

    });

    function resetErrors(){
        usernameInput.parent().removeClass('has-error');
        usernameInput.parent().find('span').remove();
    }

  });