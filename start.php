<?php 

	global $small_world_shared_friends;
	global $small_world_other_friends;

	// init
	function small_world_init(){
		global $CONFIG;
		if(isloggedin()){
			register_page_handler('friends','small_world_friends_page_handler');
			if(get_context() == "profile"){
				extend_view("metatags", "small_world/metatags");
			}			
		}
		
	}

	// overriding default pagehandler for friends page
	function small_world_friends_page_handler($page_elements){
		global $CONFIG;
		
		if (isset($page_elements[0]) && $user = get_user_by_username($page_elements[0])) {
			set_page_owner($user->getGUID());
		}
		if ($_SESSION['guid'] == page_owner()) {
			collections_submenu_items();
			require_once(dirname(dirname(dirname(__FILE__))) . "/friends/index.php");
		} else {
			include($CONFIG->pluginspath . "small_world/friends.php"); 
		}
		
	}
	
	// Pagesetup
	// both arrays are used in multiple views
	function small_world_page_setup(){
		if(isloggedin() && $_SESSION['guid'] != page_owner()){
			if(get_context() == "profile" || get_context() == "friends"){
				global $small_world_shared_friends;
				global $small_world_other_friends;
				
				$current_userid = get_loggedin_userid();	
				$owner = page_owner();
				 
				$owner_friends_max = get_entities_from_relationship('friend',$owner,false,'user','',0,"",10,0,true);
				$owner_friends = get_entities_from_relationship('friend',$owner,false,'user','',0,"",$owner_friends_max);
				
				$shared = array();
				$other = array();
				
				foreach($owner_friends as $friend){
					if(check_entity_relationship($current_userid, "friend", $friend->guid)){
						$shared[$friend->guid] = $friend;
					} else {
						$other[$friend->guid] = $friend;
					}
				}
				
				$small_world_shared_friends = $shared;
				$small_world_other_friends = $other;
			}
		}
	}
	
	
	// Default event handlers for plugin functionality
	register_elgg_event_handler('init', 'system', 'small_world_init');
	register_elgg_event_handler('pagesetup', 'system', 'small_world_page_setup');
?>