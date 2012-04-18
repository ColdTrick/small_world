<?php 

	global $small_world_shared_friends;
	global $CONFIG;

	$img = "";
	$second_degree_widget = "";
	if (check_entity_relationship(get_loggedin_userid(), 'friend', page_owner())){
		$img = "<img title='" . elgg_echo("small_world:profile:first_degree") . "' src='" . $CONFIG->wwwroot . "mod/small_world/_graphics/icon_degree_1.gif'>";
	} elseif(count($small_world_shared_friends) > 0){
		$img = "<img title='" . elgg_echo("small_world:profile:second_degree") . "' src='" . $CONFIG->wwwroot . "mod/small_world/_graphics/icon_degree_2.gif'>";
		$second_degree_widget = elgg_view("small_world/second_degree_widget");
	}
	
	if(!empty($img)){
?>
<script type="text/javascript">
	$(document).ready(function(){
		
		$("#profile_info_column_middle h2").append(" <?php echo $img;?>");
		<?php if(!empty($second_degree_widget)){ ?>
		$("#widgets_right").prepend("<?php echo $second_degree_widget;?>");
		<?php }?>
	});
</script> 
<?php }?>