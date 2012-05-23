<?php
if($user_guid = elgg_get_logged_in_user_guid()){
	if($page_owner_guid = elgg_get_page_owner_guid()){
		if($user_guid !== $page_owner_guid){
			if(user_is_friend($user_guid, $page_owner_guid)){
				echo elgg_view("output/img", array("id" => "small-world-profile-degree", "src" => "/mod/small_world/_graphics/icon_degree_1.gif", "title" => elgg_echo("small_world:profile:first_degree"), "class" => "hidden mls"));
			} elseif(small_world_get_shared_friends()){
				echo elgg_view("output/img", array("id" => "small-world-profile-degree", "src" => "/mod/small_world/_graphics/icon_degree_2.gif", "title" => elgg_echo("small_world:profile:second_degree"), "class" => "hidden mls"));
			}
		}
	}
}