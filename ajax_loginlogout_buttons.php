<?php /* Place where you want the buttons appear :

 require_once(get_template_directory() . '/modules/ajax_login/ajax_loginlogout_buttons.php');  */?>

<?php /* 

change the href value of logout button if you want redirect to : 

- home :

<a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>

- External page ( you'll need to make use of the allowed_redirect_hosts filter: ) : 

add_filter('allowed_redirect_hosts','allow_ms_parent_redirect');
function allow_ms_parent_redirect($allowed)
{
    $allowed[] = 'google.com';
    return $allowed;
}

<a href="<?php echo wp_logout_url( 'http://google.com' ); ?>">Logout</a>

*/ ?>

<?php if ( is_user_logged_in() ) { ?>
    <li class="show_logout"><a style="font-size: 70% !important; margin-top: 1px;" href="<?php echo str_replace('/en', '', wp_logout_url( icl_get_home_url() ) ); ?>"><?php _e("Logout", 'ajaxlogin'); ?></a> </li>
<?php } else { ?>
    <li class="popup_btn show_login"><a style="font-size: 70% !important; margin-top: 1px;" href="http://#"><?php _e("Login / Register", 'ajaxlogin'); ?></a></li>
<?php } ?>

