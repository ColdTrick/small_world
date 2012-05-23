<?php

function small_world_route_friends_hook($hook_name, $entity_type, $return, $params){
	$page = elgg_extract("segments", $return);
	
	switch($entity_type){
		case "friends":
			$include_file = "pages/friends/index.php";
			break;
	}
	
	if(!empty($include_file)){
		elgg_set_context('friends');
		if(is_array($page)){
			if (isset($page[0]) && $user = get_user_by_username($page[0])) {
				elgg_set_page_owner_guid($user->getGUID());
			}
		}
		
		if (elgg_get_logged_in_user_guid() !== elgg_get_page_owner_guid()) {
			include(elgg_get_plugins_path() . "small_world/" . $include_file);
			return false;
		}
	}
}