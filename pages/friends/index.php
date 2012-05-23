<?php
/**
 * Elgg friends page
 *
 * @package Elgg.Core
 * @subpackage Social.Friends
 */

$owner = elgg_get_page_owner_entity();
if (!$owner) {
	// unknown user so send away (@todo some sort of 404 error)
	forward();
}
$title = elgg_echo("friends:owned", array($owner->name));

if($shared_friends = small_world_get_shared_friends()){
	$options = array(
		"type" => "user",
		"offset" => (int) get_input("offset_shared", 0),
		"limit" => 10,
		"relationship" => "friend",
		"relationship_guid" => $owner->getGUID(),
		"wheres" => array("r.guid_two IN (SELECT r2.guid_two FROM " . elgg_get_config("dbprefix") . "entity_relationships r2 where r2.guid_one = '" . elgg_get_logged_in_user_guid() . "' AND r2.relationship = 'friend')"),
		"offset_key" => "offset_shared"
	);
	
	$shared = elgg_list_entities_from_relationship($options);
	

	$options["offset"] = (int) get_input("offset_other", 0);
	$options["offset_key"] = "offset_other";
	$options["wheres"] = array("r.guid_two NOT IN (SELECT r2.guid_two FROM " . elgg_get_config("dbprefix") . "entity_relationships r2 where r2.guid_one = '" . elgg_get_logged_in_user_guid() . "' AND r2.relationship = 'friend')");
	
	$other = elgg_list_entities_from_relationship($options);
	
	$content = elgg_view_module("info", elgg_echo("small_world:friends:shared"), $shared);
	$content .= elgg_view_module("info", elgg_echo("small_world:friends:other"), $other);
	
} else {

	$options = array(
		'relationship' => 'friend',
		'relationship_guid' => $owner->getGUID(),
		'inverse_relationship' => FALSE,
		'type' => 'user',
		'full_view' => FALSE
	);
	$content = elgg_list_entities_from_relationship($options);
}
if (!$content) {
	$content = elgg_echo('friends:none');
}

$params = array(
	'content' => $content,
	'title' => $title,
);
$body = elgg_view_layout('one_sidebar', $params);

echo elgg_view_page($title, $body);
