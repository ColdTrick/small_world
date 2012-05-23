<?php ?>
elgg.provide("elgg.small_world");

elgg.small_world.init = function() {
	$("#small-world-profile-degree").appendTo($("#profile-details > h2:first")).removeClass("hidden");
}

elgg.register_hook_handler('init', 'system', elgg.small_world.init);