
<div id="login_wrp">
<form id="login" action="login" method="post">
<h2 class="form_title orange maintitle"><?php _e('Reserved Area Login', 'ajaxlogin'); ?></h2>
        <div class="login_form_wrp">
        <p class="form_title orange log_user_btn  log_user_btn_top"><small> <?php _e('Insert user and password, for access to private area', 'ajaxlogin'); ?></small></p>
        <p class="status"></p>
        <input id="username" type="text" name="username" placeholder="<?php _e('Username', 'ajaxlogin'); ?>">
        <input id="password" type="password" name="password" placeholder="<?php _e('Password', 'ajaxlogin'); ?>">
        <input class="submit_button" type="submit" value="<?php _e('Login', 'ajaxlogin'); ?>" name="submit">
        <a class="close left" href="" style="margin-right: .5rem;"><i class="fa fa-times-circle-o" aria-hidden="true"></i><?php _e('Close ', 'ajaxlogin'); ?></a>
        <a class="lost right" href="<?php echo wp_lostpassword_url(); ?>"><i class="fa fa-lock" aria-hidden="true"></i><?php _e('Lost Password ?', 'ajaxlogin'); ?></a>
        </div>
        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
        <span class="divider"> </span>
</form>
<p class="form_title orange reg_user_btn active"><small><i class="fa fa-user-plus" aria-hidden="true"></i> <?php _e(' New users click for registered', 'ajaxlogin'); ?></small></p>
<p class="form_title orange log_user_btn"><small><i class="fa fa-user-plus" aria-hidden="true"></i> <?php _e(' Have an account ? click for login', 'ajaxlogin'); ?></small></p>
<div class="vb-registration-form">
  <form class="form-horizontal registraion-form" role="form">
 
    <div class="form-group">
      <input type="text" name="vb_name" id="vb_name" value="" placeholder="<?php _e('your Name', 'ajaxlogin'); ?>" class="form-control" />
    </div>
    <div class="form-group">
      <input type="text" name="vb_surname" id="vb_surname" value="" placeholder="<?php _e('Your Surname', 'ajaxlogin'); ?>" class="form-control" />
    </div>

    <div class="form-group">
      <input type="text" name="vb_company" id="vb_company" value="" placeholder="<?php _e('Company name', 'ajaxlogin'); ?>" class="form-control" />
    </div>
 
    <div class="form-group">
      <input type="email" name="vb_email" id="vb_email" value="" placeholder="<?php _e('Your Email', 'ajaxlogin'); ?>" class="form-control" />
    </div>
 
    <div class="form-group">
      <input type="text" name="vb_username" id="vb_username" value="" placeholder="<?php _e('Choose Username', 'ajaxlogin'); ?>" class="form-control" />
      <p class="help-block"><small><?php _e('Minimum 5 characters', 'ajaxlogin'); ?></small></p>
    </div>
 
    <div class="form-group">
      <input type="password" name="vb_pass" id="vb_pass" value="" placeholder="<?php _e('Choose Password', 'ajaxlogin'); ?>" class="form-control" />
      <p class="help-block"><small><?php _e('Minimum 8 characters', 'ajaxlogin'); ?></small></p>
    </div>

    <?php wp_nonce_field( 'ajax-login-nonce', 'security' , true, true ); ?>
 
    <input type="submit" class="submit_button" id="btn-new-user" value="<?php _e('Register', 'ajaxlogin'); ?>" />
  </form>
</div>
 
</div>