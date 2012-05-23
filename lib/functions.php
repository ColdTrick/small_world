<?php

function small_world_get_shared_friends($page_owner_guid = null){
	$result = false;
	if($current_user_guid = elgg_get_logged_in_user_guid()){
		if(empty($page_owner_guid)){
			if(elgg_instanceof(elgg_get_page_owner_entity(), "user")){
				$page_owner_guid = elgg_get_page_owner_guid();
			}
		}
		
		if(!empty($page_owner_guid)){
			if($current_user_guid !== $page_owner_guid){
				$options = array(
					"type" => "user",
					"offset" => 0,
					"limit" => 10,
					"relationship" => "friend",
					"relationship_guid" => $page_owner_guid,
					"wheres" => array("r.guid_two IN (SELECT r2.guid_two FROM " . elgg_get_config("dbprefix") . "entity_relationships r2 where r2.guid_one = '" . $current_user_guid . "' AND r2.relationship = 'friend')")
				);
				
				$result = elgg_get_entities_from_relationship($options);
			}
		}
	}
	
	return $result;
}