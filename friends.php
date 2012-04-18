<?php 

	if (!$owner = page_owner_entity()) {
		gatekeeper();
		set_page_owner($_SESSION['user']->getGUID());
		$owner = $_SESSION['user'];
	}
	
	$area1 = elgg_view_title(elgg_echo('friends'));
	$area2 = elgg_view("small_world/friends", array("owner" => $owner));
	$body = elgg_view_layout('two_column_left_sidebar', '', $area1 . $area2);
	
	page_draw(sprintf(elgg_echo("friends:owned"),$owner->name),$body);

?>