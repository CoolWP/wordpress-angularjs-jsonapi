<?php

require_once("../../../../wp-blog-header.php");

header("Content-Type: text/javascript");

?>
angular.module('wpApp.Constants', [])
	.constant("templateBaseUrl", '<?php echo get_template_directory_uri(); ?>');