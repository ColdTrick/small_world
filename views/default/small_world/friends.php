<?php 
	global $small_world_shared_friends;
	global $small_world_other_friends;
	
	
	$shared_limit = 10;
	$other_limit = 10;
	
	$shared_count = count($small_world_shared_friends);
	$other_count = count($small_world_other_friends);
	
	$shared_offset = get_input("sharedoff", 0);
	$other_offset = get_input("otheroff", 0);
	
	
?>
<div class='contentWrapper'>
<?php
	echo "<h3 class='settings'>" . elgg_echo("small_world:friends:shared") . " (" . $shared_count . ")</h3>"; 
	$nav = elgg_view('navigation/pagination',
		array(
			'baseurl' => $_SERVER['REQUEST_URI'],
			'offset' => $shared_offset,
			'count' => $shared_count,
			'limit' => $shared_limit,
			'word' => "sharedoff"
			));
			
	echo $nav;
	foreach(array_slice($small_world_shared_friends, $shared_offset, $shared_limit) as $friend) {
		echo elgg_view_entity($friend);
	}
	echo $nav;
?>
<?php 
	echo "<h3 class='settings'>" . elgg_echo("small_world:friends:other") . " (" . $other_count . ")</h3>";
	$nav = elgg_view('navigation/pagination',
		array(
			'baseurl' => $_SERVER['REQUEST_URI'],
			'offset' => $other_offset,
			'count' => $other_count,
			'limit' => $other_limit,
			'word' => "otheroff"
			));
			
	echo $nav;
	foreach(array_slice($small_world_other_friends, $other_offset, $other_limit) as $friend) {
		echo elgg_view_entity($friend);
	}
	echo $nav;
?>
</div>