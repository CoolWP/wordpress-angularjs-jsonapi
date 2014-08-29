<?php

add_action('init', 'register_styles_and_scripts');
function register_styles_and_scripts() {

	if (!is_admin()) {

		// register scripts
		wp_deregister_script("jquery"); // remove the old version of jquery that comes with wordpress

		wp_register_script("jquery", get_template_directory_uri()."/scripts/jquery.min.js", array(), false, true);
		wp_register_script("bootstrap", get_template_directory_uri()."/scripts/bootstrap.min.js", array(), false, true);
		wp_register_script("angular", get_template_directory_uri()."/scripts/angular.min.js", array(), false, true);
		wp_register_script("angular-route", get_template_directory_uri()."/scripts/angular-route.min.js", array(), false, true);
		wp_register_script("angular-sanitize", get_template_directory_uri()."/scripts/angular-sanitize.min.js", array(), false, true);
		wp_register_script("moment", get_template_directory_uri()."/scripts/moment.min.js", array(), false, true);

		// register the wpapp modules
		wp_register_script("wpapp.constants", get_template_directory_uri()."/scripts/wpapp.constants.php", array(), false, true);
		wp_register_script("wpapp.config", get_template_directory_uri()."/scripts/wpapp.config.js", array(), false, true);
		wp_register_script("wpapp.controllers", get_template_directory_uri()."/scripts/wpapp.controllers.js", array(), false, true);
		wp_register_script("wpapp", get_template_directory_uri()."/scripts/wpapp.js", array(), false, true);

		// register styles
		wp_register_style("bootstrap", get_template_directory_uri()."/styles/bootstrap.min.css");
		wp_register_style("bootstrap-theme", get_template_directory_uri()."/styles/bootstrap-theme.min.css");

		// enqueue scripts
		wp_enqueue_script("jquery");
		wp_enqueue_script("bootstrap");
		wp_enqueue_script("angular");
		wp_enqueue_script("angular-route");
		wp_enqueue_script("angular-sanitize");
		wp_enqueue_script("moment");

		// enqueue the wpapp modules
		wp_enqueue_script("wpapp.constants");
		wp_enqueue_script("wpapp.config");
		wp_enqueue_script("wpapp.controllers");
		wp_enqueue_script("wpapp");

		// enqueue styles
		wp_enqueue_style("bootstrap");
		wp_enqueue_style("bootstrap-theme");
	}

}


?>