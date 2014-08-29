<!DOCTYPE html>

<html <?php language_attributes(); ?> ng-app="wpApp">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php echo esc_attr(bloginfo('title')); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="author" content="Eric W. Greene">
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="ROBOTS" content="INDEX, FOLLOW" />
	<meta content="IE=edge,chrome=1" name="X-UA-Compatible" />
<?php

	wp_print_styles();
	wp_print_head_scripts();

?>
	<link rel="shortcut icon" href="<?php echo get_bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon" />
</head>

<body>
	<div class="container">
		<header id="page-header" class="row">
			<div class="col-xs-12 col-sm-8">
				<h1><?php echo bloginfo('title'); ?></h1>
			</div>
			<div class="col-sm-4 hidden-xs">
			</div>
		</header>