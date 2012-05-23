<?php 
	require_once(dirname(__FILE__) . "/lib/functions.php");
	require_once(dirname(__FILE__) . "/lib/hooks.php");

	// init
	function small_world_init(){
		
		elgg_register_widget_type("second_degree", elgg_echo("widgets:second_degree:title"), elgg_echo("widgets:second_degree:description"), "profile");
		elgg_extend_view("profile/details", "small_world/profile/degree", 100);
		elgg_extend_view("js/elgg", "small_world/js/site");
		elgg_extend_view("css/elgg", "small_world/css/site");
	}
	
	// Default event handlers for plugin functionality
	elgg_register_event_handler('init', 'system', 'small_world_init');
	elgg_register_plugin_hook_handler("route", "friends", "small_world_route_friends_hook");