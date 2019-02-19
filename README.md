# wordpress-module-ajaxlogin
a wordpress simple font-end ajax login / register panel


<strong>Ajax Login</strong> by <strong>Andrea Pizzigalli</strong>
Build Status Stable Version

This module , create a "Login or Register new user" ajax panel in your website.
You can insert it where you need.

For install:
First, create a folder "modules" under your theme root,  download "ajax_login" from repository, paste this folder inside the folder "modules" you had just created.
now open your theme function.php, scroll till the end, add:

 /* Register files for ajax_login */

require_once(get_template_directory() . '/modules/ajax_login/include_files.php');

This snippet, call the module part that check and register .js and .css files ( a custom js, a cutom .css and fontawesome ).
Next things is open the theme part where you want add the button " login / logout / register " and add :

<?php require_once(get_template_directory() . '/modules/ajax_login/ajax_loginlogout_buttons.php'); ?>

This snippets, call the module part where check if user is logged in or not and so show login or logout button.

Last thing is add the panel on our theme.
Open "header.php" and immediatly after "<body>"  paste :

<?php
if ( !is_user_logged_in() ) {
	require_once(get_template_directory() . '/modules/ajax_login/ajax_login.php');
}
?>

This snippet, check if user is logged in and if isn't , adds the popup code to the page.

If you reload your site, you should see the login / logut button, and on click, a popup with the two form, one for the login, and one for register new users, is called.
