<?php

use Dotenv\Dotenv;

function tha_dotenv() {
	$mode = WP_DEBUG ? 'development' : 'production';
	$files = array_filter( [
		get_template_directory() . '/.env',
		get_template_directory() . '/.env.local',
		get_template_directory() . '/.env.' . $mode,
		get_template_directory() . '/.env.' . $mode . '.local',
	], 'file_exists' );

	foreach ( $files as $file ) {
		$dotenv = Dotenv::create( get_template_directory(), basename( $file ) );
		$dotenv->overload();
	}
}

tha_dotenv();
