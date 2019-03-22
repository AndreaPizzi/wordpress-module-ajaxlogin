jQuery(document).ready(function($) {
    
    
    /************************************/
    /*********** Login Form ************/
    /*********************************/

    // Show the login dialog box on click
    $('.popup_btn a').on('click', function(e){
        $('body').prepend('<div class="login_overlay"></div>');
        $('#login_wrp').fadeIn(500);
        $('div.login_overlay, form#login a.close').on('click', function(){
            $('div.login_overlay').remove();
            $('#login_wrp').hide();
        });
        e.preventDefault();
    });
    
    $('a#show_login_reg').on('click', function(e){
        $('body').prepend('<div class="login_overlay"></div>');
        $('#login_wrp').fadeIn(500);
        $('div.login_overlay, form#login a.close').on('click', function(){
            $('div.login_overlay').remove();
            $('#login_wrp').hide();
        });
        
         $('.vb-registration-form').toggleClass('reg_panel_open');
        $('.login_form_wrp').toggleClass('log_panel_open');
        
        e.preventDefault();
    });
    
    // Click on iput for deasapear error message
    $('#login input').click(function () {
        removeError();
    });

    // Perform AJAX login on form submit
    $('form#login').on('submit', function(e){
        $('form#login p.status').show().text(ajax_login_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: { 
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username').val(), 
                'password': $('form#login #password').val(), 
                'security': $('form#login #security').val() },
            success: function(data){
                $('form#login p.status').text(data.message);
                if (data.loggedin == true){
                    document.location.href = ajax_login_object.redirecturl;
                    //console.log(ajax_login_object);
                }else{
                   // console.log('User e pwd errate, si prega di riprovare');
                    $('#login .maintitle').after( "<p style='display:none;' class='log_error_message'>"+data.message+"</p>" );
                    showError();
                }
            }
        });
        e.preventDefault();
    });
    
    
    /*************************************/
    /********* Login Accordion Action *****/
    /************************************/
    
    $('.login_form_wrp').toggleClass('log_panel_open');
    
    $( ".reg_user_btn" ).click(function() {
        $('.vb-registration-form').toggleClass('reg_panel_open');
        $('.login_form_wrp').toggleClass('log_panel_open');
        $('.reg_user_btn').toggleClass('active');
        $('.log_user_btn').toggleClass('active');
    });

    $( ".log_user_btn" ).click(function() {
        $('.vb-registration-form').toggleClass('reg_panel_open');
        $('.login_form_wrp').toggleClass('log_panel_open');
        $('.reg_user_btn').toggleClass('active');
        $('.log_user_btn').toggleClass('active');
    });
    
    function removeError(){
        $( ".log_error_message" ).fadeOut( "slow", function() {
            $(this).remove( );
        });
    }
    
    function showError(){
        $( ".log_error_message" ).fadeIn( "slow" );
    }
    
    /*************************************/
    /*********** Registration Form ******/
    /**********************************/
    
    /**
   * When user clicks on button...
   *
   */
  $('#btn-new-user').click( function(event) {
    
    removeError();
    /**
     * Prevent default action, so when user clicks button he doesn't navigate away from page
     *
     */
    if (event.preventDefault) {
        event.preventDefault();
    } else {
        event.returnValue = false;
    }
 
    // Show 'Please wait' loader to user, so she/he knows something is going on
    $('.indicator').show();
 
    // If for some reason result field is visible hide it
    $('.result-message').hide();
 
    // Collect data from inputs
    var reg_nonce = $('#security').val();
    var reg_user  = $('#vb_username').val();
    var reg_pass  = $('#vb_pass').val();
    var reg_mail  = $('#vb_email').val();
    var reg_name  = $('#vb_name').val();
    var reg_surname  = $('#vb_surname').val();
    var reg_company  = $('#vb_company').val();
 
    /**
     * AJAX URL where to send data
     * (from localize_script)
     */
    var ajax_url = ajax_login_object.ajaxurl;
    
 
    // Data to send
    data = {
      action: 'register_user',
      nonce: reg_nonce,
      user: reg_user,
      pass: reg_pass,
      mail: reg_mail,
      name: reg_name,
      surname: reg_surname,
      company: reg_company,
    };
 
    // Do AJAX request
    $.post( ajax_url, data, function(response) {
 
      // If we have response
      if( response ) {
 
        // Hide 'Please wait' indicator
        $('.indicator').hide();
 
        if( response === '1' ) {
          // If user is created
          //$('.result-message').html('Your submission is complete.'); // Add success message to results div
          //$('.result-message').addClass('alert-success'); // Add class success to results div
          //$('.result-message').show(); // Show results div
          $('#login .maintitle').after( "<p style='display:none' class='log_error_message'>Your submission is complete.</p>" );
          console.log(response);
          showError();
        } else {
         // $('.result-message').html( response ); // If there was an error, display it in results div
         // $('.result-message').addClass('alert-danger'); // Add class failed to results div
         // $('.result-message').show(); // Show results div
           $('#login .maintitle').after( "<p style='display:none' class='log_error_message'>"+response+"</p>" );
           showError();
        }
      }
    });
 
  });

});