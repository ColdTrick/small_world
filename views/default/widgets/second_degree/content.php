<?php
$widget = $vars["entity"];

if($user = elgg_get_logged_in_user_entity()){
	if($widget->owner_guid == $user->getGUID()){
		echo elgg_echo("widgets:second_degree:content:own_profile");
	} else {
		if(user_is_friend($user->getGUID(), $widget->getOwnerGUID())){
			echo elgg_echo("widgets:second_degree:content:friend");
		} elseif($friends = small_world_get_shared_friends()){
			$max_visible_connections = 5;
			
			echo "<div class='center'>";
			echo "<b>" . elgg_echo('widgets:second_degree:content:you') . "</b><br />";
			echo "<img src='" . elgg_get_site_url() . "mod/small_world/_graphics/arrowdown.gif'><br />";
			
			$more = "";
			
			foreach($friends as $key => $friend){
				if($key < $max_visible_connections){
					echo "<a href='" . $friend->getURL() . "'>" . $friend->name . "</a><br />";
				} else {
					$more .= "<a href='" . $friend->getURL() . "'>" . $friend->name . "</a><br />";
				}
			}
			
			if($more){
				echo "<a href='#widgets-second-degree-more' onclick='$(this).hide();' rel='toggle'>" . strtolower(elgg_echo("more")) . " (" . (count($friends) - $max_visible_connections) . ")<br /></a>";
				echo "<span id='widgets-second-degree-more' class='hidden'>";
				echo $more;
				echo "</span>";
			}
			
			echo "<img src='" . elgg_get_site_url() . "mod/small_world/_graphics/arrowdown.gif'><br />";
			echo elgg_get_page_owner_entity()->name . "<br /><br />";
			echo "</div>";
		} else {
			echo elgg_echo("widgets:second_degree:content:not_connected");
		}
		echo "<div class='elgg-widget-more'><a href='" . elgg_get_site_url() . "friends/" . $widget->getOwnerEntity()->username . "'>" . elgg_echo("widgets:second_degree:content:view_friends", array($widget->getOwnerEntity()->name)) . "</a></div>";
	}
} else {
	echo elgg_echo("widgets:second_degree:content:not_logged_in"); 
}

