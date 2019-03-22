<?php 

// Retrive current URL
$loadingmessage =  "Sending user info, please wait...";
//$redirecturl =  home_url().'/case-history';
$redirecturl = $_SERVER['REQUEST_URI'];
$loggoedin_error = "Wrong username or password.";
$loggoedin_confirm = "Login successful, redirecting...";

$user_registration_confirm = 'utente registrato - a breve riceverete una mail di conferma di avvenuta registrazione contenente il link di accesso alle nostre case history.<br><br> <a class="close close_reg left" href=""> Chiudi il popup <i class="fa fa-times-circle-o" aria-hidden="true"></i> <?php _e("Close Popup", "ajaxlogin"); ?></a>';

$mail_subject = "Iscrizione all' area privata di GN Techonomy";
$mail_introtext = 'Di seguito i dati di registrazione per accedere all area privata di GN Techonomy';
$mail_footertext = 'Clikka qui per accedere e cosultare le nostre <a href="https://www.gntechonomy.com/case-history/" target="_blank">Case Hystory</a>';

function ajax_login_init(){

    global $loadingmessage;
    global $redirecturl;
    
    wp_register_script('ajax-login-script', get_template_directory_uri() . '/modules/ajax_login/js/ajax-login-script.js', array('jquery') );  // register js
    wp_enqueue_script('ajax-login-script');

    // Register CSS

    wp_enqueue_style( 'ajaxlogin-css',  get_template_directory_uri() .'/modules/ajax_login/css/style.css' ); // register css

    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => $redirecturl, // Set the redirect URL
        'loadingmessage' => __($loadingmessage, 'ajaxlogin')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
}

/* Check if fontawesome is registered */

add_action('wp_enqueue_scripts', 'check_font_awesome', 99999);

function check_font_awesome() {
  global $wp_styles;
  $srcs = array_map('basename', (array) wp_list_pluck($wp_styles->registered, 'src') );
  if ( in_array('font-awesome.min.css', $srcs) || in_array('font-awesome.min.css', $srcs)  ) {
  } else {
     wp_enqueue_style( 'font-awseome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
  }
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'ajax_login_init');
}


function ajax_login(){

    global $loggoedin_error;
    global $loggoedin_confirm;

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__($loggoedin_error, 'ajaxlogin')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__($loggoedin_confirm, 'ajaxlogin')));
    }

    die();
}



/* Registration */

/**
 * New User registration
 *
 */
function vb_reg_new_user() {




  // Verify nonce
 // if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'vb_new_user' ) )
   // die( 'Ooops, something went wrong, please try again later.' );
 
  // Post values
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $email    = $_POST['mail'];
    $name     = $_POST['name'];
    $surname     = $_POST['surname'];
    $company     = $_POST['company'];
 
    /**
     * IMPORTANT: You should make server side validation here!
     *
     */
 
    $userdata = array(
        'user_login' => $username,
        'user_pass'  => $password,
        'user_email' => $email,
        'first_name' => $name,
        'last_name' => $surname,
        'company' => $company,
    );
 
    $user_id = wp_insert_user( $userdata ) ;
 
    // Return
    if( !is_wp_error($user_id) ) {

        global $user_registration_confirm;
        global $mail_subject;
        global $mail_introtext;

        echo $user_registration_confirm;
        
        $to = $email;
        $subject = $mail_subject;
        $body = $mail_introtext .'<br/><strong>Nome:</strong> '.$name.'<br/><strong>Cognome:</strong> '.$surname.'<br/><strong>Azienda:</strong> '.$company.'<br/><strong>E-mail:</strong> '.$email.'<br/><strong>Username</strong>: '.$username.'<br/><strong>Password:</strong> '.$password.'<br/><br/>'.$mail_footertext;
        $headers = array('Content-Type: text/html; charset=UTF-8');
 
wp_mail( $to, $subject, $body, $headers );

    } else {
        echo $user_id->get_error_message();
    }
  die();
 
}
 
add_action('wp_ajax_register_user', 'vb_reg_new_user');
add_action('wp_ajax_nopriv_register_user', 'vb_reg_new_user');


add_filter('wp_mail_from','yoursite_wp_mail_from');
function yoursite_wp_mail_from($content_type) {
  return 'marketing.web@gntechonomy.com';
}
add_filter('wp_mail_from_name','yoursite_wp_mail_from_name');
function yoursite_wp_mail_from_name($name) {
  return 'Gn Marketing';
}

?>